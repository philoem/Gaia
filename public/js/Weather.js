/**
 * Weather, API pour afficher la météo de notre ville 
 * 
 * 
 */

const icons  = {
    "Rain": "wi wi-day-rain",
    "Clouds": "wi wi-day-cloudy",
    "Clear": "wi wi-day-sunny",
    "Snow": "wi wi-day-snow",
    "Mist": "wi wi-day-fog",
    "Drizzle": "wi wi-day-sleet",
    "Thunderstorm": "wi wi-day-thunderstorm",
    
    
}
/**
 * Permet de mettre la 1ère lettre en majuscule
 */
 function capitalize (str) {

    return str[0].toUpperCase() + str.slice(1)

}
 async function main (withIp = true) {
    let town
    if (withIp) {

        const ip = await fetch('https://api.ipify.org?format=json')
            .then(result => result.json())
            .then(json => json.ip)

        town = await fetch('http://api.ipstack.com/' + ip +'?access_key=dafc20a95432ed90332dc5befd774585')
            .then(result => result.json())
            .then(json => json.city)
    } else {
        town = document.querySelector('#town').textContent;
    }

    

    const weather = await fetch(`http://api.openweathermap.org/data/2.5/weather?q=${town}&APPID=aae6a97a81d3f58554d00f5292788a79&lang=fr&units=metric`)
        .then(result => result.json())
        .then(json => json)

    console.log(weather)

    show (weather)
}

/**
 * Affichage des données récupérées 
 * 
 */
function show (data) {

    const name = data.name
    const temp = data.main.temp
    const description = data.weather[0].description
    const conditions = data.weather[0].main

    document.querySelector('#town').textContent = name
    document.querySelector('#temp').textContent = Math.round(temp)
    document.querySelector('#conditions').textContent = capitalize(description)
    
    document.querySelector('i.wi').className = icons[conditions]
    document.querySelector('#aside_weather').classList = conditions.toLowerCase()


}

const town = document.querySelector('#town')
town.addEventListener('click', (e) => {
    town.contentEditable = true
})
town.addEventListener('keydown', (e) => {
    if(e.keyCode ===13) {
        e.preventDefault()
        town.contentEditable = false
        main(false);
    }
})


main();