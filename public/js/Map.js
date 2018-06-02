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

/*let town = ['le port-marly', 'le vesinet', 'le pecq','marly-le-roi' ]
let town = L.mapquest.geocoding().geocode(['le port-marly', 'le vesinet', 'le pecq','marly-le-roi', 'saint-germain-en-laye', 'maisons-laffitte', 'sartrouville', 'le mesnil-le-roi']);*/

/*let resp = []*/

L.mapquest.key = '8UdpqosaDre44rrPWLERXinlPeAMLeM0'
L.mapquest.geocoding().geocode(['le port-marly', 'le vesinet', 'le pecq','marly-le-roi', 'saint-germain-en-laye', 'maisons-laffitte', 'sartrouville', 'le mesnil-le-roi'], createMap)

function createMap(error, response) {
    // Initialize the Map
    let map = L.mapquest.map('map', {
      layers: L.mapquest.tileLayer('map'),
      center: [0, 0],
      zoom: 12
    })

    // Generate the feature group containing markers from the geocoded locations
    let featureGroup = generateMarkersFeatureGroup(response);

    // Add markers to the map and zoom to the features
    featureGroup.addTo(map);
    map.fitBounds(featureGroup.getBounds());
  }

  function generateMarkersFeatureGroup(response) {
    let group = []
    for (let i = 0; i < response.results.length; i++) {
      let location = response.results[i].locations[0]
      let locationLatLng = location.latLng

      // Create a marker for each location
      let marker = L.marker(locationLatLng, {icon: L.mapquest.icons.marker()})
        .bindPopup(location.adminArea5 + ', ' + location.adminArea3)

      group.push(marker)
    }
    return L.featureGroup(group)
  }
/*function main(){
    /*resp = await fetch(`http://www.mapquestapi.com/geocoding/v1/address?key=8UdpqosaDre44rrPWLERXinlPeAMLeM0&location=${town}`)
                .then(results => results.json())
                /*.then(json => json.results[0].providedLocation)
                .then(json => json.results[0].locations[0].displayLatLng)*/

    /*console.log(resp)*/
    /* Initialise la carte 
    let map = L.mapquest.map('map', {
        center: [0, 0],
        layers: L.mapquest.tileLayer('map'),
        zoom: 12
    })
   
}
main();*/