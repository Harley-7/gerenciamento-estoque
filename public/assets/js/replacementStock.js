const entryNum = document.getElementById("entryNum");
const updatedStockNum = document.getElementById("updatedStockNum");
const entryInput = document.getElementById("entryInput");
const previousStockNum = document.getElementById("previousStockNum");

entryInput.addEventListener("keyup", () => {
    if(entryInput.value >= 1){
        entryNum.textContent = `+${entryInput.value}`; 
        updatedStockNum.textContent = parseFloat(entryInput.value) + parseFloat(previousStockNum.textContent); 
    }else{
        entryNum.textContent = "+0";
        updatedStockNum.textContent = previousStockNum.textContent; 
    }

});