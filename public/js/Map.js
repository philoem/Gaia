/**
 * Map 
 * Carte des membres
 * 
 */

// Permet de mettre la 1ère lettre en majuscule
//function capitalize (str) {
//  return str[0].toUpperCase() + str.slice(1)
//}

//L.mapquest.key = '8UdpqosaDre44rrPWLERXinlPeAMLeM0'

async function main () {
  const address = await fetch('json/Address.json')
    .then(response => response.json())
    .then(json => json)
  
  const add = await fetch(`http://www.mapquestapi.com/geocoding/v1/batch?key=8UdpqosaDre44rrPWLERXinlPeAMLeM0&location=paris`)
    .then(results => results.json())
    .then(json => json)
  
  console.log(address[0])
  console.log(add)
  //let usernameAddress = JSON.stringify(address)
  //let split = usernameAddress.split(',')
 
  //for (let i in address) {
  //  
  //  user = address[i].address
  //  console.log(user)
  //  
  //}
  //console.log(user)
  L.mapquest.geocoding().geocode(user, createMap)
}

function createMap(error, address) {
  // Initialize the Map
  let map = L.mapquest.map('map', {
    layers: L.mapquest.tileLayer('map'),
    center: [0, 0],
    zoom: 12
  })
  
  map.addControl(L.mapquest.control());
    // Generate the feature group containing markers from the geocoded locations
    let featureGroup = generateMarkersFeatureGroup(address);

    // Add markers to the map and zoom to the features
    featureGroup.addTo(map);
    map.fitBounds(featureGroup.getBounds());
}

function generateMarkersFeatureGroup(address) {
  let group = []
  for (let i = 0; i < address.results.length; i++) {
    let location = address.results[i].locations[0]
    let locationLatLng = location.latLng

    // Create a marker for each location
    let marker = L.marker(locationLatLng, {icon: L.mapquest.icons.marker()})
      .bindPopup(location.adminArea5 + ', ' + location.adminArea3)

    group.push(marker)
  }
  return L.featureGroup(group)
}
main()

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

//window.onload = function() {
//  L.mapquest.key = '8UdpqosaDre44rrPWLERXinlPeAMLeM0';
//
//  var map = L.mapquest.map('map', {
//    center: [48.856506, 2.352133],
//    layers: L.mapquest.tileLayer('map'),
//    zoom: 14
//  });
//
//  L.mapquest.geocoding().geocode('le port-marly');
//  L.mapquest.control().addTo(map);
//  L.mapquest.geocodingControl().addTo(map);
//}