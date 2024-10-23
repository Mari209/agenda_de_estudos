let menu = document.querySelector('#menu');
let navbar = document.querySelector('.navbar');

menu.onclick = () =>{
  menu.classList.toggle('fa-times');
  navbar.classList.toggle('active');
}

window.onscroll = () =>{
  menu.classList.remove('fa-times');
  navbar.classList.remove('active');
}

// código do carrossel

const prevButton = document.querySelector('.prev');
const nextButton = document.querySelector('.next');
const carouselContainer = document.querySelector('.carousel-container');
const items = document.querySelectorAll('.carousel-item');
let index = 0;

function updateCarousel() {
  const offset = -index * 100;
  carouselContainer.style.transform = `translateX(${offset}%)`;
}

prevButton.addEventListener('click', () => {
  if (index > 0) {
    index--;
  } else {
    index = items.length - 1;
  }
  updateCarousel();
});

nextButton.addEventListener('click', () => {
  if (index < items.length - 1) {
    index++;
  } else {
    index = 0;
  }
  updateCarousel();
});

// Inicializa o carrossel na primeira posição
updateCarousel();
