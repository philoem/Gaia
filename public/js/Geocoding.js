/**
 * Géocoding de l'adresse rentrée dans le formulaire d'inscription
 */
//const town = document.getElementById('register_locations').value
//document.getElementById('register_locations').addEventListener('click', geo)
//let lng
//let lat
//let address
//console.log(town)
//geo()

//async function geo() {
//
//    try {
//
//        const address = await fetch(`http://www.mapquestapi.com/geocoding/v1/address?key=8UdpqosaDre44rrPWLERXinlPeAMLeM0&location=${town}`)
//            .then(results => results.json())
//            .then(json => json.results[0].locations[0].displayLatLng)
//
//        console.log(address)
//        const lat = JSON.parse(address.lat)
//        const lng = JSON.parse(address.lng)
//        
//        console.log(lat, lng)
//        display(lat, lng)
//        
//    } catch(e) {
//        console.log('il y eu un problème de type : ', e)
//    }
//    
//}
/**
 * Affichage des coordonnées (lat et lng) dans les champs input hidden du formulaire 
 */
//document.getElementById('register_locations').addEventListener('click', function display() {

    //if (town != null) {
//function display(data) {
//
//    const lat = data.lat
//    const lng = data.lng
//    console.log(lat, lng)
//    document.getElementById('register_lat').textContent = lat
//    document.getElementById('register_lng').textContent = lng
//
//}       
        
    //}
    
//})
//document.getElementById('register_locations').addEventListener('click', geo)

//geo()
google.maps.event.addDomListener(window, 'load', geo)
function geo() {
    let autocomplete = new google.maps.places.Autocomplete(document.getElementById('register_locations'))
    google.maps.event.addListener(autocomplete, 'place_changed', function() {
        let place = autocomplete.getPlace()
        //let location = place.formatted_address
        let lat = place.geometry.viewport.f
        let lng = place.geometry.viewport.b
        document.getElementById('register_lat').value = (lat.f+lat.b)/2
        document.getElementById('register_lng').value = (lng.f+lng.b)/2
        console.log(place)
        console.log((lat.f+lat.b)/2, (lng.f+lng.b)/2)
    })
}