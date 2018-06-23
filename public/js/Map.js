/**
 * Map 
 * Carte des membres
 * 
 */

// Permet de mettre la 1ère lettre en majuscule
//function capitalize (str) {
//  return str[0].toUpperCase() + str.slice(1)
//}

//let user = document.getElementsByClassName('address')
//let address
//async function main () {
//  L.mapquest.key = '8UdpqosaDre44rrPWLERXinlPeAMLeM0'
//  
//  address = await fetch('json/Address.json')
//    .then(result => result.json())
//    .then(json => json)
//      
//  let geocoder = L.mapquest.geocoding()
//
//  geocoder.geocode('paris', createMap)
//  console.log(address)
// 
//}
//
//function createMap(error, response) {
//  // Initialize the Map
//  let map = L.mapquest.map('map', {
//    layers: L.mapquest.tileLayer('map'),
//    center: [0, 0],
//    zoom: 12
//  })
//  
//  map.addControl(L.mapquest.control());
//    // Generate the feature group containing markers from the geocoded locations
//    let featureGroup = generateMarkersFeatureGroup(response);
//
//    // Add markers to the map and zoom to the features
//    featureGroup.addTo(map);
//    map.fitBounds(featureGroup.getBounds());
//}
//
//function generateMarkersFeatureGroup(response) {
//  let group = []
//  for (let i = 0; i < response.results.length; i++) {
//    let location = response.results[i].locations[0]
//    let locationLatLng = location.latLng
//
//    // Create a marker for each location
//    let marker = L.marker(locationLatLng, {icon: L.mapquest.icons.marker()})
//      .bindPopup(location.adminArea5 + ', ' + location.adminArea3)
//
//    group.push(marker)
//  }
//  return L.featureGroup(group)
//}
//main()

/**
 * Utilisation de Leaflet avec Openstreetmap
 */
//class Map {
//	constructor() {
//    let map = document.querySelector('#map')
//		this.initMap()
//	}
//	initMap() {
//    if (map != null) {
//      this.map = L.map('map').setView([48.866667, 2.333333], 13);
//      this.map.addLayer(new L.StamenTileLayer("terrain", {
//        detectRetina: true
//      }))
//    }
//    
//	}
//}
//
//class Marker extends Map {
//	constructor() {
//    super()
//    this.popup
//    this.latLng = [48.866667, 2.333333]
//    this.addMarker()
//  }
//  addMarker() {
//    this.popup = L.popup()
//    .setLatLng(this.latlng)
//    .setContent('<p>Hello world!<br />This is a nice popup.</p>')
//    .openOn(map)
//  }
//}
const address = document.getElementsByClassName('address')

let map = L.map('map').setView([48.866667, 2.333333], 12)
// replace "toner" here with "terrain" or "watercolor"
map.addLayer(new L.StamenTileLayer("terrain", {
  detectRetina: true
}))
console.log(address)
let markers = new L.layerGroup();
for (let i = 0; i < address.length; i++) {
  let lat = address[i].children[1].textContent
  let lng = address[i].children[2].textContent
  let user = address[i].children[0].textContent
  console.log(lat, lng, user)
  marker = new L.marker([lat, lng]).bindPopup(user)
  markers.addLayer(marker)
  
}
map.addLayer(markers)
map.fitBounds(markers.getBounds())



