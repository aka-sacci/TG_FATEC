function adicionarItem()
{
    var counterItens  = sessionStorage.getItem('counterItens');
    if (counterItens < 50) {
        document.getElementById("removeItem").disabled = false;
        counterItens++;
        var $wrapper = document.querySelector('.divItens');
        var itemParagraph = document.createElement('p');
        itemParagraph.className = "p" + counterItens;
        itemParagraph.id = "p" + counterItens;
        $wrapper.insertBefore(itemParagraph, $wrapper.lastChild);
        var $paragraphWrapper = document.querySelector('.p' + counterItens);

        //criar input
        var newItem = document.createElement('input');
        newItem.type = "text";
        newItem.placeholder = "Título do Item #" + counterItens;
        newItem.maxLength = "50";
        newItem.id = "txtItem" + counterItens;
        newItem.name = "txtItem" + counterItens;
        newItem.required = "required";

        //criar textarea
        var newDescricao = document.createElement('textarea');
        newDescricao.id = "txtDesc" + counterItens;
        newDescricao.name = "txtDesc" + counterItens;
        newDescricao.placeholder = "Descrição detalhada do item #" + counterItens;
        newDescricao.maxLength = "400";

        //criar input qtde
        var newItemQtde = document.createElement('input');
        newItemQtde.type = "number";
        newItemQtde.placeholder = "Quantidade";
        newItemQtde.id = "txtQtde" + counterItens;
        newItemQtde.name = "txtQtde" + counterItens;
        newItemQtde.value = "1";
        newItemQtde.required = "required";

        //criar select
        var newSelect = document.createElement('select');
        newSelect.id = "selectQtde" + counterItens;
        newSelect.name = "selectQtde" + counterItens;
        //criar options select
        var option1 = document.createElement('option');
        option1.value = "un";
        option1.text = "Unidade";
        var option2 = document.createElement('option');
        option2.value = "mt";
        option2.text = "Metro";
        var option3 = document.createElement('option');
        option3.value = "lt";
        option3.text = "Litro";
        //linkar ambos
        newSelect.appendChild(option1);
        newSelect.appendChild(option2);
        newSelect.appendChild(option3);


        //insere td
        $paragraphWrapper.insertBefore(newSelect, $paragraphWrapper.firstChild);
        $paragraphWrapper.insertBefore(newItemQtde, $paragraphWrapper.firstChild);
        $paragraphWrapper.insertBefore(newDescricao, $paragraphWrapper.firstChild);
        $paragraphWrapper.insertBefore(newItem, $paragraphWrapper.firstChild);

        sessionStorage.setItem('counterItens', counterItens);

        if (counterItens == 50) {
            document.getElementById("addItem").disabled = true;
        }
    }

}

function deletarItem()
{

    var i = sessionStorage.getItem('counterItens');
    if (i == 1) {
    } else {
        var node = document.getElementById("p" + i);
        if (node.parentNode) {
            node.parentNode.removeChild(node);
            i--;
            sessionStorage.setItem("counterItens", i)
        }

        if (i == 1) {
            document.getElementById("removeItem").disabled = true;
        }

        document.getElementById("addItem").disabled = false;
    }
}

function avancar()
{
    //passa os elementos dos itens
    var $wrapper = document.querySelector('.divItens');
    var newInput = document.createElement('input');
    newInput.name = "qtdeItems";
    newInput.value = sessionStorage.getItem('counterItens');
    newInput.hidden = "true";
    $wrapper.insertBefore(newInput, $wrapper.lastChild);

    //passa os elementos das categorias
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

function enableDistancia()
{

    var txtDistanciaIsHidden = document.querySelector(".txtDistancia").hidden;
    if (txtDistanciaIsHidden) {
        document.querySelector(".txtDistancia").hidden = false;
        document.querySelector(".txtDistancia").disabled = false;
    } else {
        document.querySelector(".txtDistancia").hidden = true;
        document.querySelector(".txtDistancia").disabled = true;
    }

}


function adicionarCategoria()
{
    var counterCategorias  = sessionStorage.getItem('counterCategorias');
    document.getElementById("btnRemoverCategoria").disabled = false
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

            if (counterCategorias == 5) {
                document.getElementById("btnAdicionarCategoria").disabled = true;
            }
        } else {
            document.getElementById("btnAdicionarCategoria").disabled = true;
        }
    }

}

function deleteCategoria()
{

    var i = sessionStorage.getItem('counterCategorias');
    document.getElementById("btnAdicionarCategoria").disabled = false
    if (i == 1) {
    } else {
        var node = document.getElementById("selectCategorias" + i);
        if (node.parentNode) {
            node.parentNode.removeChild(node);
            i--;
            document.getElementById("selectCategorias" + i).disabled = false;
            sessionStorage.setItem("counterCategorias", i)
            if (i == 1) {
                document.getElementById("btnRemoverCategoria").disabled = true
            }
        }
    }
}