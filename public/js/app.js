//document.getElementById('btnPlusVoyages').addEventListener('click', (e) => { e.preventDefault(); alert('clicked'); });

document.getElementById('btnPlusVoyages').addEventListener('click', async (e) => {
    e.preventDefault();
    
    const voyages = await fetch('/voyages/plus', {
        method: "GET",
        headers: {'Accept': 'application/json'}
    });
                    
    const voyagesSupplementaires = await voyages.json();

    if(voyagesSupplementaires.code === 200){
        console.log(voyagesSupplementaires);

        let contenu = '';

        voyagesSupplementaires.donnees.map(voyage => { contenu += '<div class="col-xl-4 col-lg-4 col-md-6"><div class="single-place mb-30"><div class="place-img"><img src="img/service/services1.jpg" alt=""></div><div class="place-cap"><div class="place-cap-top"><span><i class="fas fa-star"></i><span>8.0 Superb</span> </span><h3><a href="#">'+voyage.nomVoyage+'</a></h3><p class="dolor">'+voyage.prix+'$ <span>/ Par Personne</span></p></div><div class="place-cap-bottom"><ul><li><i class="far fa-clock"></i>'+voyage.duree+' jours</li><li><i class="fas fa-map-marker-alt"></i>'+voyage.ville+'</li></ul></div></div></div></div>' });


        document.getElementById('listeVoyages').innerHTML += contenu;
    }
});