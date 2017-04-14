
function cargarComboPais(){

    var arrayPaises = ["Costa Rica","US","Canada","Mexico","Brasil","Argentina","España","Francia","Inglaterra","Japon","Rusia","Australia"];
    var selector = document.getElementById('cbopaises');


    for (var i = 0; i < arrayPaises.length; i++) {
      selector.options[i] = new Option(arrayPaises[i],arrayPaises[i]);
    }

}
