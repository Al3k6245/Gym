function changeUserType(){
    let userSelection = document.getElementById("Type").value;
    let sezionePagamento = document.getElementById("metodoPagamento");
    let sezioneAzienda = document.getElementById("Azienda");
    
    switch(userSelection){

        case "Cliente":
            sezionePagamento.innerHTML = '<div class="text-block-form">Metodo di Pagamento</div><div class="sezioneform"><div class="input"><div class="intestazione-form">Coordinate Bancarie</div><input class="input-iban w-input" maxlength="256" name="Nome-3" data-name="Nome 3" placeholder="IBAN" type="text" id="Nome-3" required=""></div></div>';
            
            sezioneAzienda.innerHTML = "";
            break;

        case "Allenatore":
            sezionePagamento.innerHTML = "";
            sezioneAzienda.innerHTML = "";
            break;

        case "Tecnico":
            sezionePagamento.innerHTML = "";
            sezioneAzienda.innerHTML = '<div class="text-block-form">Azienda Patner</div><div class="sezioneform"><div class="input"><div class="intestazione-form">Nome Azienda</div><input class="input-azienda w-input" maxlength="256" name="Nome-3" data-name="Nome 3" placeholder="TecnoGym" type="text" id="Nome-3" required=""></div></div>';
            break;
    }
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

function AjaxAddDocument(userType, index){

    var formData = new FormData();
    var fileInput = document.getElementById('file');

    if (fileInput.files.length > 0) {
        formData.append('file', fileInput.files[0]);
        formData.append('index', index);
        formData.append('userType', userType);

        $.ajax({
            url: 'php/gestioneAddUsers.php', // Specifica la pagina di destinazione
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
