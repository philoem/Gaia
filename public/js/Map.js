/**
 * Map 
 * Carte des membres
 * 
 */

// Permet de mettre la 1ère lettre en majuscule
function capitalize (str) {
  return str[0].toUpperCase() + str.slice(1)
}

//let user = document.getElementsByClassName('address')
let address
async function main () {
  L.mapquest.key = '8UdpqosaDre44rrPWLERXinlPeAMLeM0'
  
  address = await fetch('json/Address.json')
    .then(result => result.json())
    .then(json => json)
      
  L.mapquest.geocoding().geocode(address[0].locations, createMap)
  console.log(address[0].locations)
 
}

function createMap(error, response) {
  // Initialize the Map
  let map = L.mapquest.map('map', {
    layers: L.mapquest.tileLayer('map'),
    center: [0, 0],
    zoom: 12
  })
  
  map.addControl(L.mapquest.control());
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
main()
