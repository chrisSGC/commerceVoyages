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

    console.log(el.previousSibling.value);
    let data = new FormData();
    data.append("idPanier", idPanier);
    
    const retraitQte = await fetch('/panier/moins', {
        method: "POST",
        body: data,
        headers: {'Accept': 'application/json', 'X-CSRF-TOKEN': csrfToken }
    });

    const retourRetrait = await retraitQte.json();

    if(retourRetrait.code === 200){
        // affiche la qte retournee
        el.nextSibling.innerText = retourRetrait.donnees.quantite;

        // cqlcul nouveau prix, calcul nouvelles taxes, calcul nouveua total
        let a = document.getElementById("pu"+idPanier).innerText.slice(0, -2).replace(",",".") * retourRetrait.donnees.quantite;
        console.log(document.getElementById("pu"+idPanier).innerText.slice(0, -2) * retourRetrait.donnees.quantite);
        document.getElementById("prix"+idPanier).innerText = a+" $"
        document.getElementById('montantSousTotal').innerText = retourRetrait.donnees.montant;

        calculerTaxes();
    } // sinon on ne change rien
}

const ajouterUn = async (el) => {
    let idPanier = el.parentNode.parentNode.getAttribute("data-idPanier");
    let csrfToken = el.previousSibling.previousSibling.previousSibling.value;

    console.log(el.previousSibling.previousSibling.previousSibling.value);
    let data = new FormData();
    data.append("idPanier", idPanier);
    
    const retraitQte = await fetch('/panier/plus', {
        method: "POST",
        body: data,
        headers: {'Accept': 'application/json', 'X-CSRF-TOKEN': csrfToken }
    });

    const retourAjout = await retraitQte.json();

    if(retourAjout.code === 200){
        // affiche la qte retournee
        el.previousSibling.innerText = retourAjout.donnees.quantite;

        // cqlcul nouveau prix, calcul nouvelles taxes, calcul nouveua total
        let a = document.getElementById("pu"+idPanier).innerText.slice(0, -2).replace(",",".") * retourAjout.donnees.quantite;
        console.log(document.getElementById("pu"+idPanier).innerText.slice(0, -2) * retourAjout.donnees.quantite);
        document.getElementById("prix"+idPanier).innerText = a+" $"
        document.getElementById('montantSousTotal').innerText = retourAjout.donnees.montant;

        calculerTaxes();
    }
}

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

    const retourSuppression = await retraitItem.json();

    if(retourSuppression.code === 200){
        // on retire la ligne en question
        document.getElementById("ligne"+idPanier).parentElement.removeChild(document.getElementById("ligne"+idPanier));

        // cqlcul nouveau prix, calcul nouvelles taxes, calcul nouveua total
        document.getElementById('montantSousTotal').innerText = retourSuppression.donnees.montant;

        calculerTaxes();
    }
}