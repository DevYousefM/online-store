// to get current year
// function getYear() {
//     var currentDate = new Date();
//     var currentYear = currentDate.getFullYear();
//     document.querySelector("#displayYear").innerHTML = currentYear;
// }

// getYear();

/** google_map js **/
function myMap() {
    var mapProp = {
        center: new google.maps.LatLng(40.712775, -74.005973),
        zoom: 18,
    };
    var map = new google.maps.Map(
        document.getElementById("googleMap"),
        mapProp
    );
}

// Show and Hide Login and Registeration Buttons
let user_icon = document.getElementById("user_icon"),
    menu = document.getElementById("lo-re"),
    search_icon = document.getElementById("search_icon"),
    div_search = document.getElementById("div_search");

if (user_icon) {
    user_icon.addEventListener("click", () => {
        menu.classList.contains("show")
            ? menu.classList.remove("show")
            : menu.classList.add("show");
        if (div_search.classList.contains("show")) {
            div_search.classList.remove("show");
        }
    });
}
if (search_icon) {
    search_icon.addEventListener("click", () => {
        div_search.classList.contains("show")
            ? div_search.classList.remove("show")
            : div_search.classList.add("show");
        if (menu.classList.contains("show")) {
            menu.classList.remove("show");
        }
    });
}
