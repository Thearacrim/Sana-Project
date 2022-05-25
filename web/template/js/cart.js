$(document).ready(function () {
  $("#header").scrollToFixed({
    opacity: 1,
  });
});
function filterFunction() {
  var input, filter, ul, li, a, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  div = document.getElementById("myDropdown");
  a = document.getElementsByClassName("search_link");
  for (i = 0; i < a.length; i++) {
    txtValue = a[i].textContent || a[i].innerText;
    if (txtValue.toUpperCase().indexOf(filter) > -1) {
      a[i].style.display = "block";
    } else {
      a[i].style.display = "none";
    }
  }
}
function file_changed() {
  var selectedFile = document.getElementById("user-image_url").files[0];
  var img = document.getElementById("img");
  var reader = new FileReader();
  reader.onload = function () {
    img.src = this.result;
  };
  reader.readAsDataURL(selectedFile);
}
