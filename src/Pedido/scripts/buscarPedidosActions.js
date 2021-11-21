function onchangeListener(element){
var $wrapper = document.querySelector('.form-floating');
var categorias = sessionStorage.getItem('categorias');
var catJson = JSON.parse(categorias);

if(element){
    //se for true, ele destroi o input e cria um select
    var node = document.getElementById("buscaTXT");
        if (node.parentNode) {
            node.parentNode.removeChild(node);
        }

        //criar select
        var newSelect = document.createElement('select');
        newSelect.id = "selectCat";
        newSelect.name = "selectCat";
        newSelect.className = "custom-select";
        //criar options select
        for(var i in catJson) {
            var option = document.createElement('option');
            option.value = catJson[i]["cod"];
            option.text = catJson[i]["categoria"];
            newSelect.appendChild(option);
         }
        $wrapper.insertBefore(newSelect, $wrapper.firstChild);

}else{
    //senão, ele destroi o select e cria o input
    var node = document.getElementById("selectCat");
        if (node.parentNode) {
            node.parentNode.removeChild(node);
        }
        //criar input
        var newItem = document.createElement('input');
        newItem.type = "text";
        newItem.placeholder = "Pesquisar por...";
        newItem.id = "buscaTXT";
        newItem.name = "buscaTXT";
        newItem.required = "required";
        newItem.className = "form-control";
        $wrapper.insertBefore(newItem, $wrapper.firstChild);

}
}
function cleanStorage(){
    sessionStorage.clear();
}