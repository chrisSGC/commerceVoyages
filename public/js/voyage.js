/**
 * Permet d'ajouter un voyage au panier
 */
const ajouterVoyageAuPanier = async (idVoyage) => {
    let csrfToken = document.getElementById('csrf').childNodes[0].value;
    let data = new FormData();
    data.append("idVoyage", idVoyage);
    
    const ajoutItem = await fetch('/panier/ajouter', {
        method: "POST",
        body: data,
        headers: {'Accept': 'application/json', 'X-CSRF-TOKEN': csrfToken }
    });

    const nouvelItem = await ajoutItem.json();

    if(nouvelItem.code === 200){
        Toastify({ text: "Voyage ajouté au panier.", duration: 3000, style: {background: "rgb(5, 150, 105)"} }).showToast();
    }else{
        Toastify({ text: "Une erreur est survenue.", duration: 3000, style: {background: "linear-gradient(to right, rgb(245, 158, 11), rgb(239, 68, 68))"}}).showToast();
    }
}