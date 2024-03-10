function ChangeUserType(){
    let userSelection = document.getElementById("Type").value;

    let sezionePagamento = document.getElementById("metodoPagamento");
    
    switch(userSelection){

        case "Cliente":
            sezionePagamento.innerHTML = '<div class="text-block-form">Metodo di Pagamento</div><div class="sezioneform"><div class="input"><div class="intestazione-form">Coordinate Bancarie</div><input class="input-iban w-input" minlength="27" maxlength="27" name="Nome-3" data-name="Nome 3" placeholder="IBAN" type="text" id="Nome-3" required="" onkeyup="ToUpper(this)"></div></div><div class="text-block-form">Tipo di Abbonamento</div><select id="AbbonamentoType" name="AbbonamentoType" data-name="AbbonamentoType" class="select-field w-select"><option value="Silver">Silver</option><option value="Gold">Gold</option><option value="Platinum">Platinum</option></select>';
            sezioneAzienda.innerHTML = "";
            break;

        case "Allenatore":
            sezionePagamento.innerHTML = "";
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
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function(){   
        if(this.readyState == 4 && this.status == 200){
            document.getElementById(errorField).innerHTML = this.responseText;
        }
    };

    xmlhttp.open("GET", "gestioneAddUsers.php?azione=displayError&field=" + field.id + "&fieldValue=" + field.value, true);
    xmlhttp.send();
}

function ToUpper(field){
    field.value = field.value.toUpperCase();
}
