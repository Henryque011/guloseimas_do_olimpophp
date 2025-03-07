// Carrosel Pag Home
$(document).ready(function () {
    $('.box_carousel').slick({
        dots: true,
        infinite: true,
        slidesToShow: 3, // Número padrão de imagens exibidas
        slidesToScroll: 3,
        autoplay: true,
        autoplaySpeed: 2000,
        responsive: [
            {
                breakpoint: 1024, // Quando a tela for menor que 1024px
                settings: {
                    slidesToShow: 2, // Mostra 2 imagens
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 600, // Quando a tela for menor que 600px
                settings: {
                    slidesToShow: 1, // Mostra 1 imagem
                    slidesToScroll: 1
                }
            }
        ]
    });

    // Carrosel Pag Sobre
    $('.produtos_carrosel').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
    });
});

// Contador da Tela "Reserva"
document.addEventListener("DOMContentLoaded", () => {
    const numberDisplay = document.getElementById("number-display");
    const incrementButton = document.getElementById("increment-button");
    const decrementButton = document.getElementById("decrement-button");

    let currentNumber = parseInt(numberDisplay.textContent.trim(), 10);
    if (isNaN(currentNumber)) {
        currentNumber = 1;
        numberDisplay.textContent = currentNumber;
    }

    incrementButton.addEventListener("click", () => {
        currentNumber += 1;
        numberDisplay.textContent = currentNumber;
    });

    decrementButton.addEventListener("click", () => {
        if (currentNumber > 1) {
            currentNumber -= 1;
            numberDisplay.textContent = currentNumber;
        }
    });
});

// Favoritar Produto
document.addEventListener("DOMContentLoaded", () => {
    const heartIcon = document.getElementById("heart-icon");
    if (heartIcon) {
        heartIcon.addEventListener("click", () => {
            heartIcon.classList.toggle("favorited");
        });
    }
});

// loader
document.addEventListener("DOMContentLoaded", function () {
    const loader = document.querySelector(".loader-container");

    document.addEventListener("click", function (event) {
        if (event.target.tagName === "A" && event.target.href) {
            loader.style.display = "flex"; 
        }
    });

    window.addEventListener("load", function () {
        setTimeout(() => {
            loader.style.display = "none";
        }, 5000); 
    });
});
