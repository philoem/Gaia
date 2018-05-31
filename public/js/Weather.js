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

}
/**
 * Permet de mettre la 1ère lettre en majuscule
 */
 function capitalize (str) {

    return str[0].toUppercase() + str.slice(1)

}
 async function main () {

    const ip = await fetch('https://api.ipify.org?format=json')
        .then(result => result.json())
        .then(json => json.ip)

    const town = await fetch('http://freegeoip.net/json/' + ip)
        .then(result => result.json())
        .then(json => json.city)

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
    const conditions = data.weather[0].main
    const description = data.weather[0].description

    document.querySelector('#town').textContent = name
    document.querySelector('#temperature').textContent = math.round(temp)
    document.querySelector('#conditions').textContent = capitalize(description)
    document.querySelector('#town').textContent = name
    document.querySelector('i.wi').className = icons[conditions]


}


main();