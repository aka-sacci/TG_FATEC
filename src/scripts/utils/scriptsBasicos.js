function validarSenha(name1, name2)
{
    var senha1 = document.getElementById(name1).value;
    var senha2 = document.getElementById(name2).value;

    if (senha1 != "" && senha2 != "" && senha1 === senha2) {
        //alert('senha iguais');
        document.getElementById("txtConfirmacao").innerHTML = "";
        document.getElementById("btnSubmit").disabled = false;
    } else {
        //alert('senhas diferentes');
          document.getElementById("txtConfirmacao").innerHTML = "Senhas divergentes!";
          document.getElementById("btnSubmit").disabled = true;
    }
}

function adicionarCategoria()
{
    var counterCategorias  = sessionStorage.getItem('counterCategorias');
    if (counterCategorias < 5) {
        var categorias = sessionStorage.getItem('categorias');
        document.getElementById("selectCategorias" + counterCategorias).disabled = true;
        var catJson = JSON.parse(categorias);
        counterCategorias++;
        var $wrapper = document.querySelector('.divSelects');
        var newSelect = document.createElement('select');
        newSelect.id = "selectCategorias" + counterCategorias;
        newSelect.name = "selectCategorias" + counterCategorias;

        var i = 0;
        while (catJson[i]) {
            var option = document.createElement("option");
            option.value = catJson[i]['cod'];
            option.text = catJson[i]['categoria'];
            newSelect.appendChild(option);
            i++;
        }

        $wrapper.insertBefore(newSelect, $wrapper.lastChild);
        sessionStorage.setItem('counterCategorias', counterCategorias);
    }

}

function deleteCategoria()
{

    var i = sessionStorage.getItem('counterCategorias');
    if (i == 1) {
    } else {
        var node = document.getElementById("selectCategorias" + i);
        if (node.parentNode) {
            node.parentNode.removeChild(node);
            i--;
            document.getElementById("selectCategorias" + i).disabled = false;
            sessionStorage.setItem("counterCategorias", i)
        }
    }
}

function enableCategoria()
{
    var i = sessionStorage.getItem('counterCategorias');

    while (i >= 1) {
        document.getElementById("selectCategorias" + i).disabled = false;
        i--;
    }
    var $wrapper = document.querySelector('.divSelects');
    var newInput = document.createElement('input');
    newInput.name = "qtdeCategorias";
    newInput.value = sessionStorage.getItem('counterCategorias');
    newInput.hidden = "true";
    $wrapper.insertBefore(newInput, $wrapper.lastChild);
    sessionStorage.clear();
}