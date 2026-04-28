import { createElement, showToast, parseBRL, showSwalWithReload, showLoader, hideLoader } from "./utils.js";

let products = [],
    listProducts = [],
    searchedProduct,
    totals = {
        mercadorias: 0,
        descontos: 0,
        volumes: 0,
        subtotal: 0
    };

const  divSearchedProduct = document.querySelector("#productSearch"),
       formSearched = document.querySelector(".searchContainer form"),
       quantityInput = document.getElementById("quantityInput"),
       searchInput = document.getElementById("searchInput"),
       precoUnitarioInput = document.getElementById("precoUnitario"),
       volumesInput = document.getElementById("volumesInput"),
       descontosInput = document.getElementById("descontosInput"),
       mercadoriasInput = document.getElementById("mercadoriasInput"),
       subTotalInput = document.getElementById("subTotalInput"),
       finalizeSale = document.getElementById("finalizeSale");

async function loadProducts() {
  const res = await fetch("http://localhost:8000/api/products/getAll");
  const data = await res.json();
  products = data;
  renderSuggestions(products);
}      

function renderSuggestions(products){

     const ul = document.getElementById("productSuggestions");

     products.forEach((produto) => {
          const li = createElement("li");

          const div = createElement("div");
          div.addEventListener('click', () => selectProduct(produto.id));

          const img = createElement("img", {src: `/${produto.imagem_path}`, alt: produto.produto});

          const span = createElement("span", {className: "productName", textContent: produto.produto});

          div.append(img, span);
          li.appendChild(div);
          ul.appendChild(li);

      });

}      

function filterProducts(){
    let filter,
        ul,
        li,
        div,
        i,
        span,
        txtValue,
        count = 0;
    
    ul = document.getElementById("productSuggestions");
    
    filter = searchInput.value.toLowerCase();

    li = ul.getElementsByTagName("li");

    for(i=0; i < li.length; i++){

      div = li[i].getElementsByTagName("div")[0];

      txtValue = div.textContent || div.innerText;

      if(txtValue.toLowerCase().indexOf(filter) > -1){
          li[i].style.display = "";

          count++;

          span = li[i].querySelector(".productName");

          if(span){
            span.innerHTML = txtValue.replace(new RegExp(filter, "gi"), (match) => {
                return "<strong>"+match+"</strong>";
            })
          }
      }else{
          li[i].style.display = "none";
      }

    }

    if(count === 0){
      ul.style.display = "none";
    }else{
      ul.style.display = "block";
    }

}

function selectProduct(id){

  if(typeof searchedProduct === "object" && Object.keys(searchedProduct).length > 0){
       divSearchedProduct.innerHTML = "";
  }  

  searchedProduct = products.find(p => p.id === id);

  let ul = document.getElementById("productSuggestions"),
  divProduct,
  divTotalItem,
  img,
  span,
  spanTotalItem,
  title;

  divProduct = createElement("div", {id: "product"});
  
  img = createElement("img", {src: `/${searchedProduct.imagem_path}` , alt: searchedProduct.produto});

  span = createElement("span", {textContent: searchedProduct.produto}); 

  divProduct.append(img, span);

  divTotalItem = createElement("div", {id: "totalItem"});

  title = createElement("h5", {textContent: "Total item"});

  spanTotalItem = createElement("span", {id: "valueTotalItem", textContent: parseBRL(searchedProduct.preco_venda)})

  divTotalItem.append(title, spanTotalItem);;                 
  
  divSearchedProduct.append(divProduct, divTotalItem);

  searchedProduct.quantidade = 1;
  searchedProduct.total = searchedProduct.preco_venda;
  searchInput.value = searchedProduct.produto;
  precoUnitarioInput.value = searchedProduct.preco_venda;
  quantityInput.value = 1;

  ul.style.display = "none";

  quantityInput.focus();

}

function calcQuantity(){

    let span,
        quantity,
        totalItem,
        valueProduct;

    if(!searchedProduct){
        showToast("error", "Produto não selecionado");
        return;
    }

    span = divSearchedProduct.querySelector("#totalItem #valueTotalItem");
    quantity = parseFloat(quantityInput.value);
    valueProduct = parseFloat(searchedProduct.preco_venda);
    searchedProduct.quantidade = 0;

    if(Number.isNaN(quantity)){
        return
    }

    if(!Number.isInteger(quantity) && !Number.isNaN(quantity) || quantity < 1){
        showToast("error", "Quantidade inválida");
        return;
    }

    if(quantity > searchedProduct.estoque){
        showToast("error", "Estoque insuficiente");
        return;
    }

    if(quantity > 0){
        totalItem = valueProduct * quantity;
        span.textContent = parseBRL(totalItem);
        searchedProduct.quantidade = quantity;
        searchedProduct.total = totalItem;
    }else{
        span.textContent = parseBRL(valueProduct);
    }

}

function calcDiscount(){
    
    let discount = parseFloat(descontosInput.value),
        newSubTotal;

    if(discount > totals.subtotal){
        showToast("error", "O desconto aplicado é maior que o valor da compra.");
        descontosInput.value = "";
        subTotalInput.value = totals.subtotal;
        return;
    }

    if(totals.subtotal && discount >= 1){
        totals.descontos = discount;
        newSubTotal = parseFloat(totals.subtotal - totals.descontos);
        subTotalInput.value = newSubTotal.toFixed(2);
    }else if(discount < 1 || Number.isNaN(discount)){
        subTotalInput.value = totals.subtotal.toFixed(2);
    }else{
        showToast("error", "adicione itens a lista");
    }

}

function addList(e){
    e.preventDefault();

    if(!searchedProduct){
        showToast("error", "Produto não selecionado");
        return;
    }

    if(searchedProduct.estoque == 0){
        showToast("error", "Estoque vazio");
        return;
    }
    
    if(searchedProduct.quantidade < 1){
        showToast("error", "Quantidade inválida ou estoque insuficiente");
        return;
    }

    let productExist = listProducts.find(product => product.id === searchedProduct.id);

    if(productExist){
        
        let estoque = productExist.estoque - productExist.quantidade;

        if(estoque == 0 || parseInt(quantityInput.value) > estoque){
            showToast("error", "Estoque insuficiente");
            return;
        }

        productExist.quantidade += searchedProduct.quantidade;
        productExist.total = productExist.quantidade * productExist.preco_venda;

    }else{
        showToast("success", "Produto adicionado à lista");
        listProducts.push({...searchedProduct});
    }

    totals.volumes += parseFloat(searchedProduct.quantidade);
    totals.mercadorias += parseFloat(searchedProduct.total);
    totals.subtotal += parseFloat(searchedProduct.total);
    renderProductList();
    renderTotals();
    searchInput.focus();
}

function renderProductList(){
    const ul = document.getElementById("productsList");
    ul.innerHTML = "";

    if(!listProducts){
        return;
    }

    listProducts.forEach((product) => {

        let li,
            img,
            divName,
            divQty,
            lessBtn,
            spanQty,
            plusBtn,
            divTotal,
            removeBtn;
        
        li = createElement("li", {id: `p${product.id}`});        

        img = createElement("img", {src: `/${product.imagem_path}`, alt: product.produto});
        
        divName = createElement("div", {className: "nameProduct", textContent: product.produto});

        divQty = createElement("div", {className: "quantity"});

        lessBtn = createElement("button", {className: "lessBtn", innerHTML:"<i class=\"bi bi-dash\">"});
        lessBtn.addEventListener("click", () => lessProduct(product.id));

        spanQty = createElement("span", {className: "qty", textContent: product.quantidade});

        plusBtn = createElement("button", {className: "plusBtn", innerHTML: "<i class=\"bi bi-plus\"></i>"});
        plusBtn.addEventListener("click", () => plusProduct(product.id));

        divTotal = createElement("div", {className: "total", textContent: parseBRL(product.total)});

        removeBtn = createElement("button", {className: "removeBtn", innerHTML: "<i class=\"bi bi-trash\"></i>"})
        removeBtn.addEventListener("click", () => removeProduct(product.id, product.produto, product.quantidade, product.total));

        divQty.append(lessBtn, spanQty, plusBtn);
        li.append(img, divName, divQty, divTotal, removeBtn);

        ul.appendChild(li);

    });

    resetSearchContainer();
}

function lessProduct(id){

    const found = listProducts.find(p => p.id === id),
          product = document.getElementById(`p${found.id}`);     

    if(found && product && found.quantidade > 1){

        found.quantidade--;
        found.total -= parseFloat(found.preco_venda);
        
        let total = product.querySelector(".total"),
            qty = product.querySelector(".quantity .qty"),
            preco = parseFloat(found.preco_venda);

        qty.textContent = found.quantidade;
        total.textContent = parseBRL(found.quantidade * preco);

        totals.volumes--;
        totals.mercadorias -= preco;
        totals.subtotal -= preco;
        
        renderTotals();

    }else{
        showToast("error", "Operação inválida");
    }

}

function plusProduct(id){
    const found = listProducts.find(p => p.id === id),
          product = document.getElementById(`p${found.id}`);     

    if(found.quantidade >= searchedProduct.estoque){
        showToast("error", "Estoque insuficiente")
        return;
    }       

    if(found && product){

        found.quantidade++;
        found.total += parseFloat(found.preco_venda);
        
        let total = product.querySelector(".total"),
            qty = product.querySelector(".quantity .qty"),
            preco = parseFloat(found.preco_venda);

        qty.textContent = found.quantidade;
        total.textContent = parseBRL(found.quantidade * preco);

        totals.volumes++;
        totals.mercadorias += preco;
        totals.subtotal += preco;
        
        renderTotals();

    }else{
        showToast("error", "Operação inválida");
    }
}

function removeProduct(id, productName, quantidade, total){

    let newList = listProducts.filter(p => p.id !== id);
    listProducts = newList;

    totals.volumes -= quantidade;
    totals.mercadorias -= total;
    totals.subtotal -= total;

    renderTotals();
    renderProductList();
    showToast("info", `${productName} foi removido`);
    
}

function resetSearchContainer(){
        
    divSearchedProduct.replaceChildren();
    searchInput.value = "";
    quantityInput.value = "";
    precoUnitarioInput.value = "";

}

function renderTotals(){
    volumesInput.value = totals.volumes;
    mercadoriasInput.value = totals.mercadorias.toFixed(2);
    subTotalInput.value = totals.subtotal.toFixed(2);
    descontosInput.value = "";
}

async function submitList(){

    try{
        
        const response = await fetch("http://localhost:8000/api/products/update", {
            method: "post",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(listProducts)
        }) ;   
    
        if(!response.ok){
            showSwal(`Erro: ${response.status}`, "error");
        }
    
        const data = await response.json();

        return [data.message, data.icon];

    }catch(error){
        console.error(error);
    }

}

formSearched.addEventListener("submit", addList);
searchInput.addEventListener("keyup", () => filterProducts());
quantityInput.addEventListener("keyup", () => calcQuantity());
descontosInput.addEventListener("keyup",() => calcDiscount());

document.addEventListener("click", (e) => {

    const ul = document.getElementById("productSuggestions");
    if(!ul.contains(e.target) && e.target !== searchInput){
        ul.style.display = "none";
    }

});

finalizeSale.addEventListener("click", async () => {

   if (!totals.subtotal || totals.subtotal <= 0) {
      return; 
   }

   let subtotalValue = totals.subtotal;
   if(totals.descontos){
        subtotalValue = totals.subtotal - totals.descontos;
   }

  const { value: formValues } = await Swal.fire({
    title: "Calcular troco",
    html: `
      <label for="totalInput" class="swal-label">Total (R$)</label>
      <input id="totalInput" class="swalInput" type="number" value="${subtotalValue.toFixed(2)}" readonly>

      <label for="receivedInput" class="swal-label">Valor recebido (R$)</label>
      <input id="receivedInput" class="swalInput" type="number">

      <label for="changeInput" class="swal-label">Troco (R$)</label>
      <input id="changeInput" class="swalInput" type="number" readonly>
    `,
    focusConfirm: false,
    confirmButtonText: "Concluir",
    confirmButtonColor: "#28a745",
    didOpen: () => {

      const receivedInput = document.getElementById("receivedInput");
      const totalInput = document.getElementById("totalInput");
      const changeInput = document.getElementById("changeInput");

      receivedInput.focus();

      receivedInput.addEventListener("input", () => {
        const total = parseFloat(totalInput.value) || 0;
        const received = parseFloat(receivedInput.value) || 0;
        changeInput.value = (received - total).toFixed(2);
      });
    },
    preConfirm: () => {
      const total = parseFloat(document.getElementById("totalInput").value) || 0;
      const received = parseFloat(document.getElementById("receivedInput").value) || 0;

      if (received < total) {
        Swal.showValidationMessage("O valor recebido não pode ser menor que o total!");
        return false;
      }

    }});

  if (formValues) {
        showLoader();
        let [message, icon] = await submitList();
        hideLoader();
        showSwalWithReload(message, icon);
    }
});

loadProducts();