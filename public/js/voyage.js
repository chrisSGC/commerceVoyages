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
        alert('SUCCESS');
    }else{
        alert('DANGER');
    }
}