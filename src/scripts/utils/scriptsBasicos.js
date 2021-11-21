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
        var catJson = JSON.parse(categorias);

          //filtro de elementos
          var elementos = document.getElementById("divSelects").getElementsByTagName("select");
        for (var i = 0, max = elementos.length; i < max; i++) {
            var busca = elementos[i].value;
            var b = 0;
            while (catJson[b]) {
                if (busca == catJson[b]['cod']) {
                    catJson.splice(b,1);
                }
                b++;
            }
        }

        if (!(catJson[0] == null)) {
        //desativa o select anterior
            document.getElementById("selectCategorias" + counterCategorias).disabled = true;
            counterCategorias++;
        //seleciona o elemento que vai receber o novo select
            var $wrapper = document.querySelector('.divSelects');
        //cria o novo select
            var newSelect = document.createElement('select');
            newSelect.id = "selectCategorias" + counterCategorias;
            newSelect.name = "selectCategorias" + counterCategorias;
            newSelect.style = "margin-right: 0.45rem; margin-bottom: 0.45rem";

        //preenche o select com os dados filtrados
            var i = 0;
            while (catJson[i]) {
                var option = document.createElement("option");
                option.value = catJson[i]['cod'];
                option.text = catJson[i]['categoria'];
                newSelect.appendChild(option);
                i++;
            }

        //insere no html
            $wrapper.insertBefore(newSelect, $wrapper.lastChild);
            sessionStorage.setItem('counterCategorias', counterCategorias);
        }
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

function goBack()
{
    window.history.back()
}