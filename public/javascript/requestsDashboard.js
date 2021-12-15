function domReady(current, tomorrow) {
    if (document.readyState === 'complete') {
        current();
        tomorrow();

    } else {
        document.addEventListener('DOMContentLoaded', current);
        document.addEventListener('DOMContentLoaded', tomorrow);
    }
}

domReady(function() {
    $.ajax({
        url : 'http://api.openweathermap.org/data/2.5/weather',
        data : { id : "2969562", units : "metric", lang : "fr", appid : "f4d090607714c839e119246f24a205f1", mode : "json" },
        dataType:'json',
        success : current,
        error : currentErreur
    });

    function current(data) {
        var iconcurrent = data.weather[0].icon;
        document.getElementById("meteocurrent").innerHTML = '<img class="position-absolute meteo-img top-0 right-0" src="http://openweathermap.org/img/wn/'+iconcurrent+'@2x.png" alt="meteo today">'
    }

    function currentErreur(textStatus, errorThrown) {
        alert("Erreur " + errorThrown + " : " + textStatus);
    }
});

domReady(function() {
    $.ajax({
        url : 'http://api.openweathermap.org/data/2.5/forecast',
        data : { id : "2969562", units : "metric", lang : "fr", appid : "f4d090607714c839e119246f24a205f1", mode : "json" },
        dataType:'json',
        success : tomorrow,
        error : tomorrowErreur
    });

    function tomorrow(data) {
        // Meteo de demain
        var datePlus1 = new Date();
        datePlus1.setDate(datePlus1.getDate() + 1);
        datePlus1.setHours(12);
        datePlus1.setMinutes(0);
        datePlus1.setSeconds(0);
        datePlus1.setMilliseconds(0);
        // getMonth affiche -1 mois car il commence à 0 pour janvier
        formated_datePlus1 = datePlus1.getFullYear() + "-" + (datePlus1.getMonth()+1) + "-" + datePlus1.getDate() +' '+ "12:00:00";
        // console.log(datePlus1);
        // console.log(formated_datePlus1);
        // console.log(data.list[0].dt_txt);
        data.list.forEach(function each(item1) {
            // console.log(item1);
            if (formated_datePlus1 == item1.dt_txt) {
                var iconTomorrow1 = item1.weather[0].icon;
                document.getElementById("meteoTomorrow1").innerHTML = '<img class="position-absolute meteo-img top-0 right-0" src="http://openweathermap.org/img/wn/'+iconTomorrow1+'@2x.png" alt="meteo tomorrow">'
            }
        });

        // Meteo d'apres demain
        var datePlus2 = new Date();
        datePlus2.setDate(datePlus2.getDate() + 2);
        datePlus2.setHours(12);
        datePlus2.setMinutes(0);
        datePlus2.setSeconds(0);
        datePlus2.setMilliseconds(0);
        formated_datePlus2 = datePlus2.getFullYear() + "-" + (datePlus2.getMonth()+1) + "-" + datePlus2.getDate() +' '+ "12:00:00";
        // console.log(datePlus2);
        // console.log(formated_datePlus2);
        data.list.forEach(function each(item2) {
            // console.log(item2);
            if (formated_datePlus2 == item2.dt_txt) {
                var iconTomorrow2 = item2.weather[0].icon;
                document.getElementById("meteoTomorrow2").innerHTML = '<img class="position-absolute meteo-img top-0 right-0" src="http://openweathermap.org/img/wn/'+iconTomorrow2+'@2x.png" alt="meteo tomorrow">'
            }
        });

        // Meteo d'apres demain
        var datePlus3 = new Date();
        datePlus3.setDate(datePlus3.getDate() + 3);
        datePlus3.setHours(12);
        datePlus3.setMinutes(0);
        datePlus3.setSeconds(0);
        datePlus3.setMilliseconds(0);
        formated_datePlus3 = datePlus3.getFullYear() + "-" + (datePlus3.getMonth()+1) + "-" + datePlus3.getDate() +' '+ "12:00:00";
        // console.log(datePlus3);
        // console.log(formated_datePlus3);
        data.list.forEach(function each(item3) {
            // console.log(item3);
            if (formated_datePlus3 == item3.dt_txt) {
                var iconTomorrow3 = item3.weather[0].icon;
                document.getElementById("meteoTomorrow3").innerHTML = '<img class="position-absolute meteo-img top-0 right-0" src="http://openweathermap.org/img/wn/'+iconTomorrow3+'@2x.png" alt="meteo tomorrow">'
            }
        });
    }

    function tomorrowErreur(textStatus, errorThrown) {
        alert("Erreur " + errorThrown + " : " + textStatus);
    }
});