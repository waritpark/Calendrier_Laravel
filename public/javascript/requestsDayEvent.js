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
        var datePlus = new Date();
        formated_datePlus = datePlus.getFullYear() + "-" + (datePlus.getMonth()+1) + "-" + datePlus.getDate();
        var var_date = document.getElementById("var_date").value;
        if (var_date == formated_datePlus) {
            var iconcurrent = data.weather[0].icon;
            var desccurrent = data.weather[0].description;
            var tempcurrent = data.main.temp;
            document.getElementById("tempcurrent").innerHTML = 'Max : '+''+tempcurrent+''+'°C <br> '+desccurrent+'';
            document.getElementById("meteocurrent").innerHTML = '<img class="meteo-img-event" src="http://openweathermap.org/img/wn/'+iconcurrent+'@2x.png" alt="meteo today">'
        }
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
        formated_bis_datePlus1 = datePlus1.getFullYear() + "-" + (datePlus1.getMonth()+1) + "-" + datePlus1.getDate();
        // console.log(formated_bis_datePlus1);
        // console.log(datePlus1);
        // console.log(formated_datePlus1);
        var var_date = document.getElementById("var_date").value;
        if (formated_bis_datePlus1 == var_date) {
            data.list.forEach(function each(item1) {
                // console.log(item1);
                if (formated_datePlus1 == item1.dt_txt) {
                    // console.log(item1);
                    var iconTomorrow1 = item1.weather[0].icon;
                    var descTomorrow1 = item1.weather[0].description;
                    var temp1 = item1.main.temp;
                    document.getElementById("temp1").innerHTML = 'Max : '+''+temp1+''+'°C <br> '+descTomorrow1+'';
                    document.getElementById("meteoTomorrow1").innerHTML = '<img class="meteo-img-event" src="http://openweathermap.org/img/wn/'+iconTomorrow1+'@2x.png" alt="meteo tomorrow">'
                }
            })
        };

        // Meteo d'apres demain
        var datePlus2 = new Date();
        datePlus2.setDate(datePlus2.getDate() + 2);
        datePlus2.setHours(12);
        datePlus2.setMinutes(0);
        datePlus2.setSeconds(0);
        datePlus2.setMilliseconds(0);
        formated_datePlus2 = datePlus2.getFullYear() + "-" + (datePlus2.getMonth()+1) + "-" + datePlus2.getDate() +' '+ "12:00:00";
        formated_bis_datePlus2 = datePlus2.getFullYear() + "-" + (datePlus2.getMonth()+1) + "-" + datePlus2.getDate();
        // console.log(formated_bis_datePlus2);
        // console.log(datePlus2);
        // console.log(formated_datePlus2);
        if (formated_bis_datePlus2 == var_date) {
            data.list.forEach(function each(item2) {
                // console.log(item2);
                if (formated_datePlus2 == item2.dt_txt) {
                    // console.log(item2);
                    var iconTomorrow2 = item2.weather[0].icon;
                    var descTomorrow2 = item2.weather[0].description;
                    var temp2 = item2.main.temp;
                    document.getElementById("temp2").innerHTML = 'Max : '+''+temp2+''+'°C <br> '+descTomorrow2+'';
                    document.getElementById("meteoTomorrow2").innerHTML = '<img class="meteo-img-event" src="http://openweathermap.org/img/wn/'+iconTomorrow2+'@2x.png" alt="meteo after tomorrow">'
                }
            })
        };

        // Meteo d'apres d'apres demain
        var datePlus3 = new Date();
        datePlus3.setDate(datePlus3.getDate() + 3);
        datePlus3.setHours(12);
        datePlus3.setMinutes(0);
        datePlus3.setSeconds(0);
        datePlus3.setMilliseconds(0);
        formated_datePlus3 = datePlus3.getFullYear() + "-" + (datePlus3.getMonth()+1) + "-" + datePlus3.getDate() +' '+ "12:00:00";
        formated_bis_datePlus3 = datePlus3.getFullYear() + "-" + (datePlus3.getMonth()+1) + "-" + datePlus3.getDate();
        // console.log(formated_bis_datePlus3);
        // console.log(datePlus3);
        // console.log(formated_datePlus3);
        if (formated_bis_datePlus3 == var_date) {
            data.list.forEach(function each(item3) {
                console.log(item3);
                if (formated_datePlus3 == item3.dt_txt) {
                    // console.log(item3);
                    var iconTomorrow3 = item3.weather[0].icon;
                    var descTomorrow3 = item3.weather[0].description;
                    var temp3 = item3.main.temp;
                    document.getElementById("temp3").innerHTML = 'Max : '+''+temp3+''+'°C <br> '+descTomorrow3+'';
                    document.getElementById("meteoTomorrow3").innerHTML = '<img class="meteo-img-event" src="http://openweathermap.org/img/wn/'+iconTomorrow3+'@2x.png" alt="meteo after after tomorrow">'
                }
            })
        }
    }

    function tomorrowErreur(textStatus, errorThrown) {
        alert("Erreur " + errorThrown + " : " + textStatus);
    }
});