const afficherPaiements = async (idVente) => {
    
    if(document.getElementById("paiements_"+idVente).classList.contains("d-none")){
        if(!isNaN(idVente)){
            const detailsPaiements = await fetch('/ventes/details/'+idVente, {
                method: "GET",
                headers: {'Accept': 'application/json' }
            });

            const paiementsTrouves = await detailsPaiements.json();

            if(paiementsTrouves.code === 200){
                if(paiementsTrouves.donnees.length > 0){
                    let contenu = '';

                    paiementsTrouves.donnees.map(paiement => { contenu += "<tr><td>&nbsp;&nbsp;</td><td>"+paiement.id+"</td><td>"+paiement.date+"</td><td>"+paiement.prix+"$</td></tr>"});

                    document.getElementById("listePaiements_"+idVente).innerHTML = contenu;
                }else{
                    document.getElementById("listePaiements_"+idVente).innerHTML = "<tr><th colspan='4' class='text-center'>Aucun paiement pour cette vente.</th></tr>";
                }
            }else{
                document.getElementById("listePaiements_"+idVente).innerHTML = "<tr><th colspan='4' class='text-center'>Aucun paiement ne peut etre affiche.</th></tr>";
            }
            document.getElementById("paiements_"+idVente).classList.remove("d-none");
        }
        
    }else{
        document.getElementById("paiements_"+idVente).classList.add("d-none");
    }
}