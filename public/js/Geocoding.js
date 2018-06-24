/**
 * Géocoding de l'adresse rentrée dans le formulaire d'inscription
 */
const town = document.getElementById('register_locations').value
let lat
let lng
let address
console.log(town)

async function geocoding() {

    if (town != null) {

        address = await fetch(`http://www.mapquestapi.com/geocoding/v1/address?key=8UdpqosaDre44rrPWLERXinlPeAMLeM0&location=${town}`)
            .then(results => results.json())
            .then(json => json.results[0].locations[0].displayLatLng)

            console.log(address)
            lat = JSON.parse(address.lat)
            lng = JSON.parse(address.lng)
            console.log(lat, lng)

    }    

    display(address)
    
}
/**
 * Affichage des coordonnées (lat et lng) dans les champs input hidden du formulaire 
 */
function display() {

    if (town != null) {
        
        document.getElementById('register_lat').value = lat
        document.getElementById('register_lng').value = lng
    }
    
}
geocoding()

//document.getElementById('register_locations').addEventListener('change', (e) => {
//    return address()
//})