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

    // Carrosel pag Sobre
    $('.produtos_carrosel').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
    });

    // Funções para aumentar e diminuir
    incrementButton.addEventListener('click', () => {
        number++;
        numberElement.textContent = number;
    });
});

// Contator da tela "reserva"
document.addEventListener("DOMContentLoaded", () => {
    const numberDisplay = document.getElementById("number-display");
    const incrementButton = document.getElementById("increment-button");
    const decrementButton = document.getElementById("decrement-button");

    let currentNumber = parseInt(numberDisplay.textContent.trim(), 10);
    if (isNaN(currentNumber)) {
        currentNumber = 1;
        numberDisplay.textContent = currentNumber;
    }

    // Func.addNumber
    incrementButton.addEventListener("click", () => {
        currentNumber += 1;
        numberDisplay.textContent = currentNumber;
    });

    // Fun.dimuirNumber(valor minimo = 1)
    decrementButton.addEventListener("click", () => {
        if (currentNumber > 1) {
            currentNumber -= 1;
            numberDisplay.textContent = currentNumber;
        }
    });
});

// favoritar produto
document.addEventListener("DOMContentLoaded", () => {
    const heartIcon = document.getElementById("heart-icon");

    heartIcon.addEventListener("click", () => {
        heartIcon.classList.toggle("favorited"); 
    });
});