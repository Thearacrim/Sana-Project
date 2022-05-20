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
