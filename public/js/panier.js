const calculerTaxes = () => {
    let montant = Number(document.getElementById("montantSousTotal").innerText.replace(",", "."));
    let montantTPS = parseFloat(montant * 5 / 100);
    let montantTVQ =  parseFloat(montant * 9.975 / 100);
    let total = Number(montant + montantTVQ + montantTPS).toFixed(2);

    document.getElementById("montantTPS").innerText = montantTPS;
    document.getElementById("montantTVQ").innerText = montantTVQ;
    document.getElementById("grandTotal").innerText = total;
}

const retirerUn = async (el) => {
    let idPanier = el.parentNode.parentNode.getAttribute("data-idPanier");
    let csrfToken = el.previousSibling.value;

    let data = new FormData();
    data.append("idPanier", idPanier);
    
    const modificationQte = await fetch('/panier/moins', {
        method: "POST",
        body: data,
        headers: {'Accept': 'application/json', 'X-CSRF-TOKEN': csrfToken }
    });

    if(modificationQte.status === 422){
        Toastify({ text: "Une erreur est survenue.", duration: 3000, style: {background: "linear-gradient(to right, rgb(245, 158, 11), rgb(239, 68, 68))"} }).showToast();
    }else{
        const retourRetrait = await modificationQte.json();

        if(retourRetrait.code === 200){
            // affiche la qte retournee
            el.nextSibling.innerText = retourRetrait.donnees.quantite;

            if(retourRetrait.donnees.quantite == 0){
                document.getElementById("ligne"+idPanier).parentElement.removeChild(document.getElementById("ligne"+idPanier));
            }

            // calcul nouveau prix, calcul nouvelles taxes, calcul nouveua total
            let a = document.getElementById("pu"+idPanier).innerText.slice(0, -2).replace(",",".").replace(" ","") * retourRetrait.donnees.quantite;
            document.getElementById("prix"+idPanier).innerText = a+" $"
            document.getElementById('montantSousTotal').innerText = retourRetrait.donnees.montant;

            calculerTaxes();
            Toastify({ text: "Quantité modifée.", duration: 3000, style: {background: "rgb(5, 150, 105)"} }).showToast();
        } // sinon on ne change rien
    }
}

const ajouterUn = async (el) => {
    let idPanier = el.parentNode.parentNode.getAttribute("data-idPanier");
    let csrfToken = el.previousSibling.previousSibling.previousSibling.value;

    let data = new FormData();
    data.append("idPanier", idPanier);
    
    const modificationQte = await fetch('/panier/plus', {
        method: "POST",
        body: data,
        headers: {'Accept': 'application/json', 'X-CSRF-TOKEN': csrfToken }
    });

    if(modificationQte.status === 422){
        Toastify({ text: "Une erreur est survenue.", duration: 3000, style: {background: "linear-gradient(to right, rgb(245, 158, 11), rgb(239, 68, 68))"}}).showToast();
    }else{
        const retourAjout = await modificationQte.json();

        if(retourAjout.code === 200){
            // affiche la qte retournee
            el.previousSibling.innerText = retourAjout.donnees.quantite;

            // cqlcul nouveau prix, calcul nouvelles taxes, calcul nouveua total
            let a = document.getElementById("pu"+idPanier).innerText.slice(0, -2).replace(",",".").replace(" ","") * retourAjout.donnees.quantite;
            document.getElementById("prix"+idPanier).innerText = a+" $"
            document.getElementById('montantSousTotal').innerText = retourAjout.donnees.montant;

            calculerTaxes();
            Toastify({ text: "Quantité modifée.", duration: 3000, style: {background: "rgb(5, 150, 105)"} }).showToast();
        }
    }
}

/**
 * Permet de supprimer un item du panier
 */
const supprimer = async (el) => {
    let idPanier = el.parentNode.parentNode.getAttribute("data-idPanier");
    let csrfToken = document.getElementsByName("_token")[0].value;

    let data = new FormData();
    data.append("idPanier", idPanier);
    
    const retraitItem = await fetch('/panier/supprimer', {
        method: "POST",
        body: data,
        headers: {'Accept': 'application/json', 'X-CSRF-TOKEN': csrfToken }
    });
    
    if(retraitItem.status === 422){
        Toastify({ text: "Une erreur est survenue.", duration: 3000, style: {background: "linear-gradient(to right, rgb(245, 158, 11), rgb(239, 68, 68))"} }).showToast();
    }else{
        const retourSuppression = await retraitItem.json();

        if(retourSuppression.code === 200){
            // on retire la ligne en question
            document.getElementById("ligne"+idPanier).parentElement.removeChild(document.getElementById("ligne"+idPanier));

            // cqlcul nouveau prix, calcul nouvelles taxes, calcul nouveua total
            document.getElementById('montantSousTotal').innerText = retourSuppression.donnees.montant;

            calculerTaxes();
            Toastify({ text: "Voyage supprimé.", duration: 3000, style: {background: "rgb(5, 150, 105)"} }).showToast();
        }
    }
}