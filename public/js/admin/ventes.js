/**
 * Permet de lister les paiements recus pour une vente
 * 
 * @param {*} idVente
 */
const afficherPaiements = async (idVente) => {
    if(document.getElementById("paiements_"+idVente).classList.contains("d-none")){
        if(!isNaN(idVente)){
            const detailsPaiements = await fetch('/gestion/ventes/details/'+idVente, {
                method: "GET",
                headers: {'Accept': 'application/json' }
            });

            if(detailsPaiements.status === 422){
                Toastify({ text: "Une erreur est survenue.", duration: 3000, style: {background: "linear-gradient(to right, rgb(245, 158, 11), rgb(239, 68, 68))"}}).showToast();
            }else{
                const paiementsTrouves = await detailsPaiements.json();

                if(paiementsTrouves.code === 200){
                    if(paiementsTrouves.donnees.length > 0){
                        let contenu = '';

                        paiementsTrouves.donnees.map(paiement => { contenu += "<tr><td>&nbsp;&nbsp;</td><td>"+paiement.id+"</td><td>"+paiement.datePaiement+"</td><td>"+paiement.montantPaiement+"$</td><td><span class='badge bg-danger' onClick='supprimerPaiement(this, "+paiement.id+")'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16'><path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z'/></svg></span></td></tr>" });

                        document.getElementById("listePaiements_"+idVente).innerHTML = contenu;
                    }else{
                        document.getElementById("listePaiements_"+idVente).innerHTML = "<tr><th colspan='5' class='text-center'>Aucun paiement pour cette vente.</th></tr>";
                    }
                }else{
                    document.getElementById("listePaiements_"+idVente).innerHTML = "<tr><th colspan='5' class='text-center'>Aucun paiement ne peut etre affiche.</th></tr>";
                }
                document.getElementById("paiements_"+idVente).classList.remove("d-none");
            }
        }
    }else{
        document.getElementById("paiements_"+idVente).classList.add("d-none");
    }
}

/**
 * Permet d'envoyer l'id de la vente vers le modal bootstrap
 *
 * @param {*} idVente
 */
const ajouterPaiement = (idVente) => {
    document.getElementById("idVenteAssociee").value = idVente;
}

/**
 * Permet d'ajouter un paiement ?? la vente
 */
document.getElementById('validerAjout').addEventListener("click", async (event) => {
    event.preventDefault();
    let form = new FormData(document.getElementById("formAjoutPaiement"));

    const ajoutPaiement = await fetch('/gestion/ventes/ajouterPaiement', {
        method: "POST", body: form,
        headers: {'Accept': 'application/json' }
    });

    if(ajoutPaiement.status === 422){
        Toastify({ text: "Une erreur est survenue.", duration: 3000, style: {background: "linear-gradient(to right, rgb(245, 158, 11), rgb(239, 68, 68))"}}).showToast();
    }else{
        const paiementResultat = await ajoutPaiement.json();

        if(paiementResultat.code === 200){
            document.getElementById("erreurAjout").classList.remove("d-none");
            document.getElementById("erreurAjout").classList.add("alert-success");
            document.getElementById("erreurAjoutTitre").innerText = "Succes!";
            document.getElementById("erreurAjoutContenu").innerText = "Le paiement a bien ??t?? ajout??.";
            window.removeEventListener("click", document.getElementById("validerAjout"));
            document.getElementById("validerAjout").setAttribute("disabled", "disabled");
            document.getElementById("annulerAjout").innerText = "Quitter!";
            
            Toastify({ text: "Paiement ajout??.", duration: 3000, style: {background: "rgb(5, 150, 105)"} }).showToast();

            // settimeout reload
            setTimeout(() => { location.reload(); }, 2000);
        }else{
            document.getElementById("erreurAjout").classList.remove("d-none");
            document.getElementById("erreurAjout").classList.add("alert-danger");
            document.getElementById("erreurAjoutTitre").innerText = "Erreur!";
            document.getElementById("erreurAjoutContenu").innerText = "Une erreur est survenue durant l'ajout. Merci de recommencer.";
        }
    }
});

/**
 * Permet de valider l'ajout d'une vente
 */
document.getElementById("validerAjoutVente").addEventListener("click", async (event) => {
    event.preventDefault();
    let form = new FormData(document.getElementById("formAjoutVente"));

    const ajoutVente = await fetch('/gestion/ventes/ajouterVente', {
        method: "POST", body: form,
        headers: {'Accept': 'application/json' }
    });

    if(ajoutVente.status === 422){
        Toastify({ text: "Une erreur est survenue.", duration: 3000, style: {background: "linear-gradient(to right, rgb(245, 158, 11), rgb(239, 68, 68))"}}).showToast();
    }else{
        const ajoutVenteResultat = await ajoutVente.json();

        if(ajoutVenteResultat.code === 200){
            document.getElementById("erreurAjoutVente").classList.remove("d-none");
            document.getElementById("erreurAjoutVente").classList.add("alert-success");
            document.getElementById("erreurAjoutVenteTitre").innerText = "Succes!";
            document.getElementById("erreurAjoutVenteContenu").innerText = "La vente a bien ??t?? ajout??e.";
            window.removeEventListener("click", document.getElementById("validerAjoutVente"));
            document.getElementById("validerAjoutVente").setAttribute("disabled", true);
            document.getElementById("annulerAjoutVente").innerText = "Quitter!";

            Toastify({ text: "Vente ajout??e.", duration: 3000, style: {background: "rgb(5, 150, 105)"} }).showToast();

            // settimeout reload
            setTimeout(() => { location.reload(); }, 2000);
        }else{
            document.getElementById("erreurAjoutVente").classList.remove("d-none");
            document.getElementById("erreurAjoutVente").classList.add("alert-danger");
            document.getElementById("erreurAjoutVenteTitre").innerText = "Erreur!";
            document.getElementById("erreurAjoutVenteContenu").innerText = "Une erreur est survenue durant l'ajout. Merci de recommencer.";
        }
    }
});

/**
 * Retrait des submit sur les formulaires de la page
 */
window.removeEventListener("submit", document.getElementById("formAjoutVente"));
window.removeEventListener("submit", document.getElementById("formAjoutPaiement"));

/**
 * Permet de recalculer le prix du voyage quand on change quelque chose dans la vente afin d'avoir le prix juste en tout temps
 */
document.getElementById("formAjoutVente").addEventListener("change", () => {
    let idVoyageSelectionne = document.getElementById("voyage").value;

    if(!isNaN(idVoyageSelectionne)){
        let prixVoyage = 0;
    
        window.listeVoyages.map(voyage => { prixVoyage = (voyage.id == idVoyageSelectionne) ? voyage.prix : prixVoyage });
    
        document.getElementById("prixTotalVoyageHT").value = prixVoyage * document.getElementById("nbrPassagers").value;
    }

    // on verifie les champs
    if((!isNaN(idVoyageSelectionne)) && (!isNaN(document.getElementById("client").value)) && (!isNaN(document.getElementById("nbrPassagers").value)) && (document.getElementById("nbrPassagers").value >= 1) && (document.getElementById("dateAchat").value !== '')){
        document.getElementById("validerAjoutVente").innerText = "Ajouter la vente";
        document.getElementById("validerAjoutVente").removeAttribute("disabled");
    }
});

/**
 * Permet de supprimer un paiement sur un voyage
 * @param {*} el 
 * @param {*} idPaiement 
 */
const supprimerPaiement = async (el, idPaiement) => {
    const retraitPaiement = await fetch('/gestion/ventes/supprimerPaiement/'+idPaiement, {
        method: "GET", 
        headers: {'Accept': 'application/json' }
    });

    if(retraitPaiement.status === 422){
        Toastify({ text: "Une erreur est survenue.", duration: 3000, style: {background: "linear-gradient(to right, rgb(245, 158, 11), rgb(239, 68, 68))"}}).showToast();
    }else{
        const retraitPaiementResultat = await retraitPaiement.json();

        if(retraitPaiementResultat.code === 200){
            el.parentNode.parentNode.remove();
            Toastify({ text: "Paiement supprim??.", duration: 3000, style: {background: "rgb(5, 150, 105)"} }).showToast();
        }
    }
}

/**
 * Permet d'annuler une vente
 *
 * @param {*} el
 * @param {*} idvente
 */
const annulerVente = async (el, idvente) => {
    const retraitVente = await fetch('/gestion/ventes/annulerVente/'+idvente, {
        method: "GET", 
        headers: {'Accept': 'application/json' }
    });

    if(retraitVente.status === 422){
        Toastify({ text: "Une erreur est survenue.", duration: 3000, style: {background: "linear-gradient(to right, rgb(245, 158, 11), rgb(239, 68, 68))"}}).showToast();
    }else{
        const retraitVenteResultat = await retraitVente.json();

        if(retraitVenteResultat.code === 200){
            el.parentNode.parentNode.remove();
            Toastify({ text: "Vente annul??e.", duration: 3000, style: {background: "rgb(5, 150, 105)"} }).showToast();
        }
    }
}