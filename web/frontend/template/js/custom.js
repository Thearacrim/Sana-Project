let map;

function initMap() {
  map = new google.maps.Map(document.getElementById("map"), {
    center: { lat: -34.397, lng: 150.644 },
    zoom: 8,
  });
}

window.initMap = initMap;

$(document).on("click", ".trigggerModal", function () {
  $("#modal").modal("show").find("#modalContent").load($(this).attr("value"));
});

$("#themeMode").toggleClass(localStorage.toggled);

// });
function darkLight() {
  /*DARK CLASS*/
  if (localStorage.toggled != "back-dark") {
    $("#themeMode, body, h1").toggleClass("back-dark", true);
    localStorage.toggled = "back-dark";
  } else {
    $("#themeMode, body").toggleClass("back-dark", false);
    localStorage.toggled = "";
  }
}

if ($("#themeMode").hasClass("back-dark")) {
  $("#chk").prop("checked", true);
} else {
  $("#chk").prop("checked", false);
}
