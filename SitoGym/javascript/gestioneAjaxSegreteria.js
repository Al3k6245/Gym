function AjaxAddDocument(userType, index){

    var formData = new FormData();
    var fileInput = document.getElementById('file');

    if (fileInput.files.length > 0) {
        formData.append('file', fileInput.files[0]);
        formData.append('index', index);
        formData.append('userType', userType);

        $.ajax({
            url: 'gestioneSegreteria.php', // Specifica la pagina di destinazione
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

function AjaxViewDescription(userType, index){   // userType ========>  0 => Cliente   1 => Allenatore    2 => Personale
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function(){   
        if(this.readyState == 4 && this.status == 200){
            console.log(this.responseText);
            document.getElementById("info").innerHTML = this.responseText;
        }
    };

    xmlhttp.open("GET", "gestioneSegreteria.php?azione=viewUserInfo&index=" + index + "&userType=" + userType, true);
    xmlhttp.send();
}

function AjaxCloseDescription(){
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function(){   
        if(this.readyState == 4 && this.status == 200){
            document.getElementById("info").innerHTML = this.responseText;
        }
    };

    xmlhttp.open("GET", "gestioneSegreteria.php?azione=closeUserInfo", true);
    xmlhttp.send();
}

function AjaxChangeSection(section){
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function(){   
        if(this.readyState == 4 && this.status == 200){
            let clientiSection = document.getElementById("clientiSection");
            let allenatoriSection = document.getElementById("allenatoriSection");

            if(section == 'Clienti'){
                clientiSection.className = "container-sezioni selected clienti w-button";
                allenatoriSection.className = "container-sezioni allenatori w-button";
            }
            else{
                clientiSection.className = "container-sezioni clienti w-button";
                allenatoriSection.className = "container-sezioni selected allenatori w-button";
            }

            document.getElementById("tabella-membri").innerHTML = this.responseText;
        }
    };

    xmlhttp.open("GET", "gestioneSegreteria.php?azione=changeSection&section=" + section, true);
    xmlhttp.send();
}

function AjaxViewTrainerShifts(index){    //chiamata per visualizzare i turni di lavoro degli allenatori 
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function(){   
        if(this.readyState == 4 && this.status == 200){
            document.getElementById("info").innerHTML = this.responseText;
        }
    };

    xmlhttp.open("GET", "gestioneSegreteria.php?azione=viewShifts&index=" + index, true);
    xmlhttp.send();
}

function AjaxDeleteShift(day, trainerIndex){
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function(){   
        if(this.readyState == 4 && this.status == 200){
            document.getElementById("info").innerHTML = this.responseText;
        }
    };

    xmlhttp.open("GET", "gestioneSegreteria.php?azione=deleteShift&shiftDay=" + day + "&trainerIndex=" + trainerIndex, true);
    xmlhttp.send();
}

function AjaxAddShift(trainerIndex){   //per mostrare l'hoversection di aggiunta turni
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function(){   
        if(this.readyState == 4 && this.status == 200){
            document.getElementById("info").innerHTML = this.responseText;
        }
    };

    xmlhttp.open("GET", "gestioneSegreteria.php?azione=addShift&trainerIndex=" + trainerIndex, true);
    xmlhttp.send();
}

function AjaxResearch(inputId){
    let inputValue = document.getElementById(inputId).value;

    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function(){   
        if(this.readyState == 4 && this.status == 200){
            document.getElementById("tabella-membri").innerHTML = this.responseText;
        }
    };

    xmlhttp.open("GET", "gestioneSegreteria.php?azione=search&input=" + inputValue, true);
    xmlhttp.send();
}

function addFile(userType, index) {
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
    
        AjaxAddDocument(userType, index);

        //Rimuovi l'input dopo aver letto il file
        document.body.removeChild(input);
    });
  }

  function changeSection(sectionName, userLoggedType){
    let columns;
    
    if(userLoggedType == 'Segreteria')
        switch(sectionName){

            case 'Clienti':
                columns = ['Nome','Data di Prossimo Pagamento','Certificato Medico','Nascita','','Azioni'];
                break;

            case 'Allenatori':
                columns = ['Nome','','Certificato Medico','Turni','','Azioni'];
                break;
        }
    else if(userLoggedType == 'Allenatore')
        switch(sectionName){

            case 'Clienti':
                columns = ['Nome','Data di Prossimo Pagamento','','Nascita','','Azioni'];
                break;

            case 'Allenatori':
                columns = ['Nome','','','Turni','','Azioni'];
                break;
        }
    
    //cambia le intestazioni delle varie sezioni
    document.getElementById("firstCol").innerHTML = columns[0];
    document.getElementById("secondCol").innerHTML = columns[1];
    document.getElementById("thirdCol").innerHTML = columns[2];
    document.getElementById("fourthCol").innerHTML = columns[3];
    document.getElementById("fifthCol").innerHTML = columns[4];
    document.getElementById("sixthCol").innerHTML = columns[5];

    //chiamata Ajax per mostrare gli utenti rispettivi delle sezioni
    AjaxChangeSection(sectionName);
  }

  function displayRinnovaAbbonamento(index){
        let hoversectionRinnovo = document.getElementById("rinnovaAbbonamento");
        let indexField = document.getElementById("customerId");

        hoversectionRinnovo.style.display = "";
        indexField.value = index;
  }

function closeRinnovaAbbonamento(){
    document.getElementById("rinnovaAbbonamento").style.display = 'none';
}

function displayNuovoAllenamento(index){
    let hoversectionAllenamento = document.getElementById("nuovoAllenamento");
    let indexField = document.getElementById("customerIdForA");

    hoversectionAllenamento.style.display = "";
    indexField.value = index;
}

function closeNuovoAllenamento(){
    document.getElementById("nuovoAllenamento").style.display = 'none';
}