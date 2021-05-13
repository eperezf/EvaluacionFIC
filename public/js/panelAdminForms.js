$(document).ready(function() {
    // Obtenemos el ID de la actividad desde la URL
    var pageURL = $(location).attr("href").split("/")
    var activityId = pageURL[pageURL.length - 1]
    console.log(activityId)
})
