<div class="centerContainer">

    <a class="backBtn" href="/<?php echo $_SESSION['user']->access_level ?>"><i class="bi bi-arrow-90deg-left"></i></a>
    
    <div class="searchContainer">

        <form >
            <div id="searchAndSuggestionsContainer">
                <div class="formControl">
                    <label for="searchInput">Mercadoria</label>
                    <input type="text" name="mercadoria" id="searchInput" placeholder="Digite o nome da mercadoria">
                </div>
                <ul id="productSuggestions"></ul>
            </div>

            <div class="formControl">
                <label for="quantidade">Quantidade</label>
                <input id = "quantityInput" type="number" name="quantidade" placeholder="Digite a quantidade" step="1">
            </div>

            <div class="formControl">
                <label for="preco_unitario">Preço Unitário</label>
                <input id="precoUnitario" type="number" name="preco_unitario" placeholder="Preço unitário" readonly>
            </div>
            
            <button type="submit"><i class="bi bi-plus"></i></button>
        </form>
        
        <div id="productSearch">
            
            <!-- <div id="product">

                <img src="" alt="">

                <span>
                    
                </span>
            
            </div> -->
            
            <!-- <div id="totalItem">
                <h5>Total item</h5>
                <span id="valueTotalItem">R$ 0,00</span>
            </div> -->
        </div>

    </div>

    <div class="mainContainerSales">

        <div class="totals">
            <form>

                <div class="rowTotals">
                    <div class="formControl">
                        <label for="volumes">Volumes</label>
                        <input id="volumesInput" type="number" name="volumes" readonly>
                    </div>

                    <div class="formControl">
                        <label for="descontos">Descontos(R$)</label>
                        <input id="descontosInput" type="number" name="descontos">
                    </div>
                </div>

                <div class="formControl">
                    <label for="mercadorias">Mercadorias(R$)</label>
                    <input type="number" name="" id="mercadoriasInput" readonly>
                </div>

                <div class="formControl">
                    <label id="titleSubTotal" for="subTotal">Subtotal(R$)</label>
                    <input id="subTotalInput" type="number" name="subtotal" readonly>
                </div>

            </form>
        </div>

        <div id="listContainer">

               <ul id="productsList">
                   
                  <!--  <li>
                        <img src="/" alt="">

                        <div class="nameProduct"></div>

                        <div class="quantity">
                            <button id="lessBtn"><i class="bi bi-dash"></i></button>
                            <span id="qty">1</span>
                            <button id="plusBtn"><i class="bi bi-plus"></i></button>
                        </div>

                        <div class="total">
                            R$
                        </div>

                        <button id="removeBtn"><i class="bi bi-trash"></i></button>
                    </li>
                    
                    -->
               </ul> 
            
        </div>
    
    </div>

    <button id="finalizeSale">Finalizar Venda</button>

</div>

<script type="module" src="/assets/js/searchProduct.js" ></script>
