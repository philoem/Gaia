L.mapquest.key = '8UdpqosaDre44rrPWLERXinlPeAMLeM0'


let element = document.getElementById('btn_submit_register')
let address = document.getElementById('address')

element.addEventListener('click', (e) => {
    L.mapquest.map('map', {
        center: [0, 0],
        layers: L.mapquest.tileLayer('map'),
        zoom: 14
      })
    L.mapquest.geocoding().geocode(`${address}`)
      console.log(address)
})
