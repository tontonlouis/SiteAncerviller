import L from 'leaflet'
import 'leaflet/dist/leaflet.css'

export default class Map {

    static init() {

        let map = document.querySelector('#map')

        if (map === null) {
            return
        }
        var lat = 48.535783;
        var lng = 6.835897;

        let center = [48.5380, 6.8325];
        let icon = L.icon({
            iconUrl: '/images/marker-icon.png'
        });

        map = L.map('map').setView(center, 13)
        let token = 'pk.eyJ1IjoidG9udG9ubG91aXM1OSIsImEiOiJjanYyMWMyZ3MwNWdtM3pwZnE3OTcwam42In0.a1_SmEZsu49f6q9GRicIGw';

        L.tileLayer(`https://api.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=${token}`, {
            maxZoom: 18,
            minZoom: 12,
            // attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            id: 'mapbox.streets',
            // accessToken: token
        }).addTo(map);

        L.marker(center, {
            icon: icon
        }).addTo(map);

    }
}