<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<?php

if (isset($_SESSION['mensagem'])) {
    echo $_SESSION['mensagem'];
    unset($_SESSION['mensagem']); // Limpar a mensagem após exibi-la
}
?>

<style>
    .cliente_logado {
        display: flex;
        align-items: center;
        gap: 10px;
    }


    .lado_cliente {
        display: flex;
        align-items: center;

    }

    .cliente_logado .foto_cliente {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
    }

    .cliente_logado p {
        margin: 0;
        font-size: 16px;
        font-weight: bold;
        color: black;
    }

    .cliente_logado .logout {
        margin-left: 10px;
        color: #f00;
        text-decoration: none;
        font-size: 14px;
    }

    .cliente_logado .logout:hover {
        text-decoration: underline;
    }

    .login_header {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 15px;
    }

    .foto_cliente {
        display: none;
    }

    .fa-regular {
        font-size: 20pt;
        color: #985C41;

    }

    .nome_cliente {
        margin-left: 10px !important;
    }
</style>

<div class="site">
    <div class="logo_header">
        <h1>
            <a href="http://localhost/guloseimas_do_olimpophp/public/home">
                <img src="http://localhost/guloseimas_do_olimpophp/public/assets/img/logo_header.svg"
                    alt="Logo da Empresa - Guloseimas do Olimpo">
            </a>
        </h1>
    </div>

    <nav>
        <div class="mobile-menu">
            <div class="line1"></div>
            <div class="line2"></div>
            <div class="line3"></div>
        </div>

        <ul class="nav-list">
            <div class="login_header">
                <?php if (isset($_SESSION['userId'])): ?> <!-- Aqui começa PHP, sem espaços -->
                    <div class="cliente_logado">
                        <!-- Foto do cliente -->

                        <a href="http://localhost/guloseimas_do_olimpophp/public/cliente">
                            <div class="lado_cliente">
                                <i class="fa-regular fa-user"></i>
                                <img src="<?php echo BASE_URL . 'uploads/' . $_SESSION['userFoto']; ?>" alt="Foto de <?php echo $_SESSION['userNome']; ?>" class="foto_cliente">
                                <p class="nome_cliente"><?php echo explode(' ', $_SESSION['userNome'])[0]; ?></p>
                            </div>
                        </a>


                        <!-- Nome do cliente -->

                        <!-- Botão de logout -->

                    </div>
                <?php else: ?>
                    <!-- Link para login se não estiver logado -->
                    <a href="<?php echo BASE_URL; ?>login">
                        <img src="http://localhost/guloseimas_do_olimpophp/public/assets/img/login.svg" alt="Login">
                    </a>
                <?php endif; ?> <!-- Aqui termina PHP, sem espaços -->

            </div>

            <li><a href="http://localhost/guloseimas_do_olimpophp/public/home" class="nav-link">HOME</a></li>
            <li><a href="http://localhost/guloseimas_do_olimpophp/public/sobre" class="nav-link">SOBRE</a></li>
            <li><a href="http://localhost/guloseimas_do_olimpophp/public/produtos" class="nav-link">PRODUTOS</a></li>
            <li><a href="http://localhost/guloseimas_do_olimpophp/public/compras" class="nav-link">RESERVA</a></li>
            <li><a href="http://localhost/guloseimas_do_olimpophp/public/galeria" class="nav-link">GALERIA</a></li>
            <li><a href="http://localhost/guloseimas_do_olimpophp/public/contato" class="nav-link">CONTATO</a></li>
            <li class="close-btn"><a href="#"><img class="x_mobile" src="http://localhost/guloseimas_do_olimpophp/public/assets/img/fechar.svg" alt="fechar"></a></li>

        </ul>
    </nav>

    <div class="login_header" id="mobilie_none">
        <?php if (isset($_SESSION['userId'])): ?> <!-- Aqui começa PHP, sem espaços -->
            <div class="cliente_logado">
                <!-- Foto do cliente -->

                <a href="http://localhost/guloseimas_do_olimpophp/public/cliente">
                    <div class="lado_cliente">
                        <i class="fa-regular fa-user"></i>
                        <img src="<?php echo BASE_URL . 'uploads/' . $_SESSION['userFoto']; ?>" alt="Foto de <?php echo $_SESSION['userNome']; ?>" class="foto_cliente">
                        <p class="nome_cliente"><?php echo explode(' ', $_SESSION['userNome'])[0]; ?></p>
                    </div>
                </a>


                <!-- Nome do cliente -->

                <!-- Botão de logout -->

            </div>
        <?php else: ?>
            <!-- Link para login se não estiver logado -->
            <a href="<?php echo BASE_URL; ?>login">
                <img src="http://localhost/guloseimas_do_olimpophp/public/assets/img/login.svg" alt="Login">
            </a>
        <?php endif; ?> <!-- Aqui termina PHP, sem espaços -->

    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let links = document.querySelectorAll(".nav-link");
            let currentUrl = window.location.href;

            links.forEach(link => {
                if (link.href === currentUrl) {
                    link.classList.add("ativo");
                }
            });
        });
    </script>