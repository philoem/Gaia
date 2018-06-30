/**
 * Map 
 * Carte des membres actifs
 * 
 */

// Permet de mettre la 1ère lettre en majuscule
function capitalize (str) {
  return str[0].toUpperCase() + str.slice(1)
}

const address = document.getElementsByClassName('address') // Pour récupérer les membres
const adress = document.getElementsByClassName('adress') // Pour récupérer le membre
let lat
let lng
let markers = new L.layerGroup()

// Création de la classe de icône violette, positionnant l'utilisateur par rapport aux autres membres
let LeafIcon2 = L.Icon.extend({
  options: {
      
      shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
     
      iconSize: [25, 41],
      iconAnchor: [12, 41],
      popupAnchor: [1, -34],
      shadowSize: [41, 41]
  }
})
 
// Création de la classe des icônes vertes
let LeafIcon = L.Icon.extend({
  options: {
      
      shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
     
      iconSize: [25, 41],
      iconAnchor: [12, 41],
      popupAnchor: [1, -34],
      shadowSize: [41, 41]
  }
})
for (let i = 0; i < address.length; i++) {

  lat = address[i].children[1].textContent
  lng = address[i].children[2].textContent
  let user = address[i].children[0].textContent
  // Récupération des annonces des membres
  let link = address[i].children[3].innerHTML
 
  // Instanciation de la classe des icônes vertes
  let greenIcon = new LeafIcon({iconUrl: 'https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-green.png'})
  
  let marker = new L.marker([lat, lng], {icon: greenIcon}).bindPopup("<p class='name_popup'>" + capitalize(user) +'</p>' + '<p>Sa dernière annonce : '+ link +'</p>')
  markers.addLayer(marker)
  
}
// Création du marker du membre actif
let latMemberActive = document.querySelector('.adress_lat').textContent
let lngMemberActive = document.querySelector('.adress_lng').textContent

  
// Instanciation de la classe de l'icône violette pour indiquer le membre connecté parmi les autres membres
let violetIcon = new LeafIcon2({iconUrl: 'https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-violet.png'})
marker2 = L.marker([latMemberActive, lngMemberActive], {icon: violetIcon}).bindPopup("Là c'est moi !!")
markers.addLayer(marker2)
// Création de la carte Openstreetmap
let map = L.map('map', {
  zoom: 11,
  touchZoom: 'center',
  center: [lat, lng]
})

// replace "toner" here with "terrain" or "watercolor"
map.addLayer(new L.StamenTileLayer("terrain", {
  detectRetina: true
}))

map.addLayer(markers)




