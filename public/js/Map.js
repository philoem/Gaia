/**
 * Map 
 * Carte des membres
 * 
 */
/*let town = [];
class Map {


	constructor() {
		this.initMap();
	}
	initMap() {
		this.map = new google.maps.Map(document.querySelector('#map'), { 
			zoom: 12,
			center:{lat: 48.8671, lng: 2.09941 }
		});
	}
}*/

L.mapquest.key = '8UdpqosaDre44rrPWLERXinlPeAMLeM0';
let town = 'le vesinet';
let resp = [];

async function main(){
    resp = await fetch(`http://www.mapquestapi.com/geocoding/v1/address?key=8UdpqosaDre44rrPWLERXinlPeAMLeM0&location=${town}`)
                .then(results => results.json())
                /*.then(json => json.results[0].providedLocation)*/
                .then(json => json.results[0].locations[0].displayLatLng)

    console.log(resp)

    let map = L.mapquest.map('map', {
        center: resp,
        layers: L.mapquest.tileLayer('map'),
        zoom: 12
    });

    L.marker(resp, {
        icon: L.mapquest.icons.marker(),
        draggable: false
      }).bindPopup(`${town}`).addTo(map);

    

   
}
main();