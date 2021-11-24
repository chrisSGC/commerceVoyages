const connexion = async () => {
    let courriel = document.getElementById('email').value;
    let motDePasse = document.getElementById('identifiant').value;
    let csrfToken = document.getElementById('csrfConnexion').childNodes[0].value;

    let data = new FormData();
    data.append("courriel", courriel);
    data.append("motDePasse", motDePasse);
    
    const verificationCompte = await fetch('/connexion/verifierCompte', {
        method: "POST",
        body: data,
        headers: {'Accept': 'application/json', 'X-CSRF-TOKEN': csrfToken }
    });

    const compteVerifie = await verificationCompte.json();

    console.log(compteVerifie);
}