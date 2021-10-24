function adicionarItem()
{
    var counterItens  = sessionStorage.getItem('counterItens');
    if (counterItens < 50) {

        counterItens++;
        var $wrapper = document.querySelector('.divItens');
        var itemParagraph = document.createElement('p');
        itemParagraph.className = "p"+counterItens;
        itemParagraph.id = "p"+counterItens;
        $wrapper.insertBefore(itemParagraph, $wrapper.lastChild);
        var $paragraphWrapper = document.querySelector('.p'+counterItens);

        //criar input
        var newItem = document.createElement('input');
        newItem.type = "text";
        newItem.placeholder = "Item #" + counterItens;
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
    }
}