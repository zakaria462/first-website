let searchBtn = document.querySelector("#search-btn");
let closeBtn  =document.querySelector("#bar-close");
let searchform = document.querySelector(".search-form");
let loginform = document.querySelector(".login-form");
function showbar() {
  searchform.classList.add("active");
  closeBtn.classList.add("active");
  searchBtn.classList.add("active");
}
function removebar(){
  searchform.classList.remove("active");
  closeBtn.classList.remove("active");
  searchBtn.classList.remove("active");
}
function showform(){
  loginform.classList.add("active")

}
function hideform(){
  loginform.classList.remove("active")

}
let slideIndex = 0;
showSlides();

function showSlides() {
  let i;
  let slides = document.getElementsByClassName("mySlides");
  let dots = document.getElementsByClassName("dot");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}    
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
  setTimeout(showSlides, 10000); // Change image every 2 seconds
}