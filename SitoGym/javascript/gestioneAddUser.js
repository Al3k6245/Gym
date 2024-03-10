function ChangeUserType(){
    let userSelection = document.getElementById("Type").value;

    let sezioneAbbonamento = document.getElementById("abbonamento");
    let sezioneCertificazione = document.getElementById("certificazione");
    
    switch(userSelection){

        case "Cliente":
            sezioneAbbonamento.innerHTML = '<div class="text-block-form">Tipo di Abbonamento</div><select id="AbbonamentoType" name="AbbonamentoType" data-name="AbbonamentoType" class="select-field w-select"><option value="Silver">Silver</option><option value="Gold">Gold</option><option value="Platinum">Platinum</option></select>';
            sezioneCertificazione.innerHTML = "";
            break;

        case "Allenatore":
            sezioneAbbonamento.innerHTML = "";
            sezioneCertificazione.innerHTML = '<div class="text-block-form">Certificazione</div><a href="#" class="addcertificazione w-button" onclick=AddFileToTemp("certificazione", true)>+ Certificazione</a> ';
            break;
    }
    
}

function AddFileToTemp(type) {
    //solamente quando registro l'utente vado a salvare i file nelle rispettive cartelle (che si creeranno da codice)

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
        
        let fileInput = document.getElementById('file').files[0];

        //se è un immagine la mostro nel riquadro immagine profilo
        if(type == "imgProfilo"){
            document.getElementById("imgProfilo").src = URL.createObjectURL(fileInput);
        }

        AjaxAddDocument(type);

        //Rimuovi l'input dopo aver letto il file
        document.body.removeChild(input); 
    });
  }

function AjaxAddDocument(type){  //type è il il tipo di file (Certificato medico, immagine profilo oppure documenti identificativi)

    var formData = new FormData();
    var fileInput = document.getElementById('file');

    if (fileInput.files.length > 0) {
        formData.append('file', fileInput.files[0]);
//        formData.append('temp', temp);
        formData.append('type', type);

        /*
        if(!temp){
            formData.append('nome', document.getElementById("Nome").value);
            formData.append('cognome', document.getElementById("Cognome").value);
            formData.append('userType', document.getElementById("Type").value);
        } */

        $.ajax({
            url: 'gestioneAddUsers.php', // Specifica la pagina di destinazione
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

function AjaxCompilationFormError(field, errorField){  //field serve per sapere nel php cosa si sta andando a controllare (nome, cognome, telefono ecc...)

    let isValid = true;   //true o false

    if(field.value.length > 0){
        if(field.id == "NumeroTel"){
            isValid = /^\d+$/.test(field.value);  //espressione regolare che controlla se ci sono solo numeri nella stringa
        }
        else if(field.id == "Nome" || field.id == "Cognome"){
            isValid = /^[a-zA-Z ]+$/.test(field.value);
        }
        else if(field.id == "Mail"){
            isValid = /@/.test(field.value);
        }
        else if(field.id == "CodiceFiscale"){
            isValid = ValidateFiscalCodeDateBirth(field.value);
        }
    }
    
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function(){   
        if(this.readyState == 4 && this.status == 200){
            document.getElementById(errorField).innerHTML = this.responseText;
            console.log(this.responseText);
        }
    };

    xmlhttp.open("GET", "gestioneAddUsers.php?azione=displayError&isValid=" + isValid, true);
    xmlhttp.send();
}

function ToUpper(field){
    field.value = field.value.toUpperCase();
}

function ValidateFiscalCodeDateBirth(fiscalCode){

    if(fiscalCode.length == 16){
        let anno = fiscalCode.substring(6, 8);
        let mese = fiscalCode[8];
        let giorno = fiscalCode.substring(9, 11);
        
        if(/^\d+$/.test(anno) && /^\d+$/.test(giorno) && /^[ABCDEHLMPRST]+$/.test(mese))
            return true;

        return false;
    }
    
}
