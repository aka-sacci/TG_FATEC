function bodyLoadCategorias(){
    var qtdeCats = sessionStorage.getItem("counterCategorias");
    qtdeCats--;
    while(qtdeCats > 0){
        document.getElementById("selectCategorias"+qtdeCats).disabled = true;
        qtdeCats--;
    }
}