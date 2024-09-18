function initCarousel({
    carouselSelector,
    itemSelector,
    prevArrowSelector,
    nextArrowSelector,
    interval = 5000,
}) {
    const carousel = document.querySelector(carouselSelector);
    const sliders = document.querySelectorAll(itemSelector);
    const arrowPrev = document.querySelector(prevArrowSelector);
    const arrowNext = document.querySelector(nextArrowSelector);

    let operacion = 0;
    let counter = 0;
    let widthSlider = 100 / sliders.length;

    // Mueve el carrusel hacia la derecha automáticamente cada 'interval' milisegundos
    const autoSlide = setInterval(() => {
        toRight();
    }, interval);

    // Listeners para las flechas de navegación
    arrowNext.addEventListener("click", toRight);
    arrowPrev.addEventListener("click", toLeft);

    function toRight() {
        if (counter >= sliders.length - 1) {
            counter = 0;
            operacion = 0;
            carousel.style.transform = `translateX(-${operacion}%)`;
            carousel.style.transition = "none";
            return;
        }

        counter++;
        operacion = operacion + widthSlider;
        carousel.style.transform = `translateX(-${operacion}%)`;
        carousel.style.transition = "all ease .6s";
    }

    function toLeft() {
        counter--;

        if (counter < 0) {
            counter = sliders.length - 1;
            operacion = widthSlider * (sliders.length - 1);
            carousel.style.transform = `translate(-${operacion}%)`;
            carousel.style.transition = "none";
            return;
        }

        operacion = operacion - widthSlider;
        carousel.style.transform = `translateX(-${operacion}%)`;
        carousel.style.transition = "all ease .6s";
    }
}

initCarousel({
    carouselSelector: ".carousel",
    itemSelector: ".carousel-item",
    prevArrowSelector: ".arrow-prev",
    nextArrowSelector: ".arrow-next",
    interval: 5000, // Opcional: puedes cambiar el intervalo de tiempo
});

initCarousel({
    carouselSelector: ".list-carousel",
    itemSelector: ".list-carousel-item",
    prevArrowSelector: ".list-arrow-prev",
    nextArrowSelector: ".list-arrow-next",
    interval: 3000, // Opcional: puedes cambiar el intervalo de tiempo
});

initCarousel({
    carouselSelector: ".last-carousel",
    itemSelector: ".last-carousel-item",
    prevArrowSelector: ".arrow-prev",
    nextArrowSelector: ".arrow-next",
    interval: 3000, // Opcional: puedes cambiar el intervalo de tiempo
});

initCarousel({
    carouselSelector: ".mb-last-carousel",
    itemSelector: ".mb-last-carousel-item",
    prevArrowSelector: ".arrow-prev",
    nextArrowSelector: ".arrow-next",
    interval: 5000, // Opcional: puedes cambiar el intervalo de tiempo
});
