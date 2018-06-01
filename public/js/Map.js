/**
 * Map 
 * Carte des membres
 * 
 */
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
}
