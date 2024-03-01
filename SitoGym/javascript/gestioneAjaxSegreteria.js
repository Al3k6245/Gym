function AjaxRequest(index){
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function(){   
        if(this.readyState == 4 && this.status == 200){
            document.getElementById("tabella-membri").innerHTML = this.responseText;
        }
    };

    xmlhttp.open("GET", "php/gestioneSegreteria.php?azione=deleteMember&index=" + index, true);
    xmlhttp.send();
}