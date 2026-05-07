function toggleNav() { var sidenav = document.getElementById("mySidenav");
  var content = document.querySelector(".content");
  
  
  sidenav.classList.toggle("open");
  content.classList.toggle("open");
}