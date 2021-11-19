function loadCriarOrcamento(){
    sessionStorage.setItem('counterItens', 1);
}

function adicionarItem()
{
   
    var counterItens  = sessionStorage.getItem('counterItens');
    var counterItens2  = sessionStorage.getItem('counterItens');
    var qtdeItens = sessionStorage.getItem("qtdeItens");
    if (counterItens < 50) {
        document.getElementById("removeItem").disabled = false;
        counterItens++;
        var $wrapper = document.querySelector('.divItens');
        var itemParagraph = document.createElement('tr');
        itemParagraph.className = "tr" + counterItens;
        itemParagraph.id = "tr" + counterItens;
        $wrapper.insertBefore(itemParagraph, $wrapper.lastChild);
        var $paragraphWrapper = document.querySelector('.tr' + counterItens);

        //criar input
        var newItem = document.createElement('input');
        newItem.type = "text";
        newItem.placeholder = "Valor (R$)";
        newItem.maxLength = "50";
        newItem.id = "txtValue" + counterItens;
        newItem.name = "txtValue" + counterItens;
        newItem.required = "required";

        //criar textarea
        var newDescricao = document.createElement('textarea');
        newDescricao.id = "txtDesc" + counterItens;
        newDescricao.name = "txtDesc" + counterItens;
        newDescricao.placeholder = "Descrição do modelo";
        newDescricao.rows = "7";
        newDescricao.cols="60";


        //criar options select
        
        var itens = sessionStorage.getItem('itens');
        var itensJson = JSON.parse(itens);

        var elementos = document.getElementById("divItens").getElementsByTagName("select");
        for (var i = 0, max = elementos.length; i < max; i++) {
            var busca = elementos[i].value;
            var b = 0;
            while (itensJson[b]) {
                if (busca == itensJson[b]['cod']) {
                    itensJson.splice(b,1);
                }
                b++;
            }
        }

        if (!(itensJson[0] == null)) {
        //desativa o select anterior
            document.getElementById("selectItem" + counterItens2).disabled = true;
            counterItens2++;
        //seleciona o elemento que vai receber o novo select
            var $wrapper = document.querySelector('.divItens');
        //cria o novo select
            var newSelect = document.createElement('select');
            newSelect.id = "selectItem" + counterItens;
            newSelect.name = "selectItem" + counterItens;

        //preenche o select com os dados filtrados
            var i = 0;
            while (itensJson[i]) {
                var option = document.createElement("option");
                option.value = itensJson[i]['cod'];
                option.text = itensJson[i]['item'];
                newSelect.appendChild(option);
                i++;
            }


        //linkar ambos
        

        //insere td
        let tableRef = document.getElementById('divItens');
        let newRow = tableRef.insertRow(-1);
        newRow.id = "r"+counterItens;
        let newCell = newRow.insertCell(0);
        let newCell1 = newRow.insertCell(1);
        let newCell2 = newRow.insertCell(2);
        newCell1.align = "center";
        newCell2.align = "right";
        newCell2.appendChild(newItem);
        newCell1.appendChild(newDescricao);
        newCell.appendChild(newSelect);       

        sessionStorage.setItem('counterItens', counterItens);

        if (counterItens == sessionStorage.getItem("qtdeItens")) {

        }
    }

}

}

function deleteRow() {
    
    var i = sessionStorage.getItem('counterItens');
    if (i == 1) {
    } else {
            document.getElementById("r"+i).remove();
            i--;
        document.getElementById("selectItem"+i).disabled = false;
    }
    sessionStorage.setItem("counterItens", i)
   
  }

function avancar()
{
    //passa os elementos dos itens
    document.getElementById("txtQtdeItens").value = sessionStorage.getItem('counterItens');


    //passa os elementos das categorias
    var i = sessionStorage.getItem('counterItens');
    while (i >= 1) {
        document.getElementById("selectItem" + i).disabled = false;
        i--;
    }
    
    sessionStorage.clear();
}

    
