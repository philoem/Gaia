/**
 * Géocoding de l'adresse rentrée dans le formulaire d'inscription via le geocoder autocomplete de Google Map
 */

// Ici pour le formulaire de la page inscription 'Register'
google.maps.event.addDomListener(window, 'load', geoRegister)

function geoRegister() {

    let autocomplete = new google.maps.places.Autocomplete(document.getElementById('register_locations'))

    google.maps.event.addListener(autocomplete, 'place_changed', function() {
       
        let place = autocomplete.getPlace()
       
        let lat = place.geometry.viewport.f
        let lng = place.geometry.viewport.b

        document.getElementById('register_lat').value = (lat.f+lat.b)/2
        document.getElementById('register_lng').value = (lng.f+lng.b)/2
        
    })
}
// Ici pour le formulaire de la page admin 'Admin'
google.maps.event.addDomListener(window, 'load', geoAdmin)

function geoAdmin() {

    let autocomplete = new google.maps.places.Autocomplete(document.getElementById('admin_locations'))

    google.maps.event.addListener(autocomplete, 'place_changed', function() {
       
        let place = autocomplete.getPlace()
       
        let lat = place.geometry.viewport.f
        let lng = place.geometry.viewport.b

        document.getElementById('admin_lat').value = (lat.f+lat.b)/2
        document.getElementById('admin_lng').value = (lng.f+lng.b)/2
        
        
    })
}