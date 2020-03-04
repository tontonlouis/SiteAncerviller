export default class Meteo {

    static init() {

        let meteo = document.querySelector('#meteo');

        if (meteo === null) {
            return
        }
        var ville = 'Ancerviller'
        let token = "e70fdf2125613486983e49595043846b";
        // meteo.textContent = "Ici la météo du jour";
        $.ajax({
            url: "https://api.openweathermap.org/data/2.5/weather?q=" + ville + ",fr&appid=" + token + "&units=metric&mode=html",
        })
            .done(function (data) {
                console.log(data)
                meteo.innerHTML = data;
                // meteo.innerHTML = `
                //     <div class="card-header">
                //           Météo
                //     </div>
                //     <div class="card-body">
                //         <h5 class="card-title">${data.name}</h5>
                //         <h6 class="card-subtitle mb-2 text-muted">${data.main.temp} °C</h6>
                //         <p class="card-text">
                //             Il fera un minimun de ${data.main.temp_min} °C et un maximum de ${data.main.temp_max} dans la journée <br>
                //
                //
                //         </p>
                //      </div>
                // `
            });


    }
}