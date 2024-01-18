var fornitori = document.querySelectorAll(".btn-light");
var fornitori2 = document.querySelectorAll(".btn-secondary");

function mostraCheck() {
    fornitori.forEach(element => {
        if (element.style.display == "block")
            element.style.display = "none";
        else
            element.style.display = "block";
    });

    fornitori2.forEach(element => {
        if (element.style.display == "none")
            element.style.display = "block";
        else
            element.style.display = "none";
    });

}

function deleteFornitore(codice) {
    if(confirm("Sicuro di voler procedere con l'eliminazione?")==true){
        var xhr = new XMLHttpRequest();
        xhr.open("POST", '/corso/fornitori/delete/', true);
    
        //Send the proper header information along with the request
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    
        xhr.onreadystatechange = function () { // Call a function when the state changes.
            if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                alert("Eliminato");
            }
        }
        xhr.send("codFornitore="+codice+"");
        location.reload();
        // xhr.send(new Int8Array());
        // xhr.send(document);
    }

}

function viewOrdini(codice) {
    window.location.href="/corso/ordini/"+codice+"";
}

function addFornitore() {
    var descrizione;
    var note;
    var mail;
    
    descrizione=prompt("Inserisci la descrizione del nuovo fornitore");
    note=prompt("Inserisci note relative al nuovo fornitore ");
    mail=prompt("Inserisci la mail del nuovo fornitore ");

    if(descrizione.length==0 || note.length==0 || mail.length==0){
        alert("Compilare tutti i campi richiesti!");
    }else{
        var xhr = new XMLHttpRequest();
        xhr.open("POST", '/corso/fornitori/add/', true);
        
        //Send the proper header information along with the request
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        
        xhr.onreadystatechange = function () { // Call a function when the state changes.
            if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                alert("Aggiunto");
            }
        }
        xhr.send("descrizione="+descrizione+"&note="+note+"&mail="+mail+"");
        location.reload();
    }
}