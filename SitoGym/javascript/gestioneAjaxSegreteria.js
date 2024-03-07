function AjaxDeleteMember(index){
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function(){   
        if(this.readyState == 4 && this.status == 200){
            document.getElementById("tabella-membri").innerHTML = this.responseText;
        }
    };

    xmlhttp.open("GET", "php/gestioneSegreteria.php?azione=delMem&index=" + index, true);
    xmlhttp.send();
}

function AjaxAddDocument(index){

    var formData = new FormData();
    var fileInput = document.getElementById('file');

    if (fileInput.files.length > 0) {
        formData.append('file', fileInput.files[0]);
        formData.append('index', index);

        $.ajax({
            url: 'php/gestioneSegreteria.php', // Specifica la pagina di destinazione
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            enctype: "multipart/form-data",
            success: function(response) {
                console.log(response);
                // Puoi gestire la risposta qui
            },
            error: function(error) {
                console.error('Errore durante la richiesta AJAX:', error);
            }
        });
    }
}


function AjaxViewDescription(index){
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function(){   
        if(this.readyState == 4 && this.status == 200){
            console.log(this.responseText);
            document.getElementById("info").innerHTML = this.responseText;
        }
    };

    xmlhttp.open("GET", "php/gestioneSegreteria.php?azione=viewUserInfo&index=" + index, true);
    xmlhttp.send();
}

function AjaxCloseDescription(){
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function(){   
        if(this.readyState == 4 && this.status == 200){
            document.getElementById("info").innerHTML = this.responseText;
        }
    };

    xmlhttp.open("GET", "php/gestioneSegreteria.php?azione=closeUserInfo", true);
    xmlhttp.send();
}

function AjaxChangeSection(section){
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function(){   
        if(this.readyState == 4 && this.status == 200){
            document.getElementById("tabella-membri").innerHTML = this.responseText;
        }
    };

    xmlhttp.open("GET", "php/gestioneSegreteria.php?azione=changeSection&section=" + section, true);
    xmlhttp.send();
}


function addFile(index) {
    // Crea un input di tipo file nascosto
    var input = document.createElement('input');
    input.type = 'file';
    input.name = 'images';
    input.id = 'file';
    input.style.display = 'none';

    document.body.appendChild(input);

    // Simula un clic sull'input
    input.click();
  
    // Aggiungi un gestore di eventi per leggere il file dopo la selezione
    input.addEventListener('change', function() {
    
        AjaxAddDocument(index);

        //Rimuovi l'input dopo aver letto il file
        document.body.removeChild(input);
    });
  }

  function changeSection(sectionName, header1, header2, header3, header4, header5, header6){
    //cambia le intestazioni delle varie sezioni
    document.getElementById("firstCol").innerHTML = header1;
    document.getElementById("secondCol").innerHTML = header2;
    document.getElementById("thirdCol").innerHTML = header3;
    document.getElementById("fourthCol").innerHTML = header4;
    document.getElementById("fifthCol").innerHTML = header5;
    document.getElementById("sixthCol").innerHTML = header6;

    //chiamata Ajax per mostrare gli utenti rispettivi delle sezioni
    AjaxChangeSection(sectionName);
  }