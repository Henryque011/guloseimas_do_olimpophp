<div class="site">
    <div class="lado_a_lado">
        <div>

        </div>
        <div class="logo_footer">
            <a href="index.php"><img src="http://localhost/guloseimas_do_olimpophp/public/assets/img/logo_header.svg"
                    alt="logo Guloseimas do Olimpo"></a>
        </div>
        <div class="contato">
            <h2>CONTATO</h2>

            <h3>Localização: Itaim Paulista – SP <img src="http://localhost/guloseimas_do_olimpophp/public/assets/img/localizacao.svg"
                    alt="localizacao">
            </h3>

            <h3>Email: guloseimasolimpo@gmail.com
                <img src="http://localhost/guloseimas_do_olimpophp/public/assets/img/email.svg" alt="email">
            </h3>

            <h3>WhatsApp: (11)98056-3192 <img src="http://localhost/guloseimas_do_olimpophp/public/assets/img/telefone.svg" alt="telefone">
            </h3>
        </div>
        <nav class="nav_footer">
            <h2>MENU</h2>
            <ul>
                <li><a href="http://localhost/guloseimas_do_olimpophp/public/home">HOME</a></li>
                <li><a href="http://localhost/guloseimas_do_olimpophp/public/sobre">SOBRE</a></li>
                <li><a href="http://localhost/guloseimas_do_olimpophp/public/produtos">PRODUTOS</a></li>
                <li><a href="http://localhost/guloseimas_do_olimpophp/public/compras">RESERVA</a></li>
                <li><a href="http://localhost/guloseimas_do_olimpophp/public/galeria">GALERIA</a></li>
                <li><a href="http://localhost/guloseimas_do_olimpophp/public/contato">CONTATO</a></li>
            </ul>
        </nav>

        <div class="newsletter">
            <h2>NEWSLETTER</h2>
            <p>Cadastre seu e-mail para receber novas
                informações sobre produtos e promoções.</p>
            <div class="forms_contato">
                <form id="formContato" action="newsletter/enviarNewsletter" method="POST">
                    <label for="email"></label>
                    <input type="email" placeholder="Digite seu email" required id="email_newsletter" class="email" name="email_newsletter"
                        aria-label="email">
                    <button class="enviar" type="submit" value="ENVIAR" class="btn btn-primary">ENVIAR</button>

                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Status do Envio</h1>
                                    <button style="background-color: transparent;" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    
                                    🎉 O Email foi enviado com sucesso! <br> Obrigado por se inscrever! Em breve, você receberá nossas novidades. 😉
                                </div>
                                <div class="modal-footer">
                                <button style="display: flex; align-items: center; justify-content: center;" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>

                                </div>
                            </div>
                        </div>
                    </div>
                </form>

            </div>

        </div>

    </div>
    <div class="redes_footer">
        <div>
            <a href="https://www.instagram.com/guloseimas_olimpo?igsh=MTZsZjV1aXU0MWQxNQ==" target="_blank"><img src="http://localhost/guloseimas_do_olimpophp/public/assets/img/instagram_footer.svg" alt="instagram"></a>
        </div>
        <div>
            <a href="https://www.ifood.com.br/delivery/sao-paulo-sp/guloseimas-do-olimpo---trufas-brownies-e-bolos-jardim-camargo-novo/a2723d73-19f8-4a51-baec-cf38223b122f?utm_medium=share" target="_blank"><img src="http://localhost/guloseimas_do_olimpophp/public/assets/img/ifood_footer.svg" alt="ifood"></a>
        </div>
        <div>
            <!-- <a href="#"><img src="http://localhost/guloseimas_do_olimpophp/public/assets/img/youtube_footer.svg" alt="youtube"></a> -->
        </div>

        <div>
            <a href="https://w.app/ladvkq" target="_blank"><img src="http://localhost/guloseimas_do_olimpophp/public/assets/img/wpp_footer.svg" alt="whatsapp"></a>
        </div>
    </div>

    <div class="hr_footer">
        <hr>
        <h2>© 2025 Senacria. Todos os direitos reservados.</h2>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const form = document.getElementById('formContato');
        const modal = new bootstrap.Modal(document.getElementById('exampleModal'));

        form.addEventListener('submit', (e) => {
            e.preventDefault(); // Evita o envio tradicional do formulário
            modal.show(); // Exibe o modal

            // Se necessário, envie os dados via AJAX (opcional)
            form.submit(); // Remove o `e.preventDefault` se quiser o envio direto.
        });
    });
</script>