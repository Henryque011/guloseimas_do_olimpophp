    <style>
        .carrinho-vazio {
            text-align: center;
            padding: 50px 20px;
            background-color: #f9f9f9;
            /* Fundo suave */
            border: 1px solid #ddd;
            /* Borda leve */
            border-radius: 5px;
            /* Bordas arredondadas */
            max-width: 600px;
            /* Largura máxima */
            margin: 0 auto;
        }

        .carrinho-vazio h3 {
            font-size: 24px;
            color: #333;
        }

        .carrinho-vazio p {
            font-size: 16px;
            color: #555;
        }

        .carrinho-vazio a {
            color: #0066cc;
            text-decoration: none;
        }

        .carrinho-vazio a:hover {
            text-decoration: underline;
        }

        .esvaziar-btn {
            border: none;
            background-color: transparent;
            margin-right: 50px;
        }


        .pedido-confirmado {
            text-align: center;
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            padding: 15px;
            margin: 20px auto;
            border-radius: 5px;
            max-width: 600px;
        }
    </style>

    <?php if (isset($_POST['esvaziar_carrinho'])) {
        $_SESSION['carrinho'] = []; // Limpa a sessão corretamente

        // Atualiza a página para refletir a mudança
        header("Location: " . BASE_URL . "Cliente/historico_reserva?pedido=sucesso");
        exit;
    }

    if (isset($_POST['reservar_pedido']) && isset($_SESSION['carrinho']) && !empty($_SESSION['carrinho'])) {
        $numeroWhatsApp = '5511968812993'; // Número do WhatsApp no formato internacional
        $mensagem = "Olá, gostaria de reservar os seguintes produtos:\n\n";

        foreach ($_SESSION['carrinho'] as $produto) {
            $mensagem .= "- " . $produto['nome'] . ": " . $produto['quantidade'] . " x R$" . number_format($produto['preco'], 2, ',', '.') . "\n";
        }

        $total = array_sum(array_map(function ($produto) {
            return $produto['quantidade'] * $produto['preco'];
        }, $_SESSION['carrinho']));

        $mensagem .= "\nTotal: R$" . number_format($total, 2, ',', '.');
        $mensagemCodificada = urlencode($mensagem);

        // Esvazia o carrinho ANTES de redirecionar
        unset($_SESSION['carrinho']);

        // Gera o link do WhatsApp
        $linkWhatsApp = "https://wa.me/$numeroWhatsApp?text=$mensagemCodificada";

        // Força a atualização da sessão
        session_write_close();

        // Redireciona para a página de histórico de reservas
        header("Location: " . BASE_URL . "Cliente/historico_reserva?pedido=sucesso");
        exit;
    }


    ?>
    <!DOCTYPE html>
    <html lang="pt-br">

    <head>
        <?php
        // Inclui o head
        require('head_geral/head.php');
        ?>
    </head>

    <body>
        <header>
            <?php
            // loader
            require('template/loader.php');

            // Inclui o cabeçalho
            require('template/header.php');
            ?>
        </header>

        <?php
        if (isset($_GET['pedido']) && $_GET['pedido'] === 'sucesso') {
            echo '<div class="pedido-confirmado">Pedido feito com sucesso! Obrigado por comprar conosco.</div>';
        }
        ?>

        <?php
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        // Verifica se há itens no carrinho
        if (isset($_SESSION['carrinho']) && !empty($_SESSION['carrinho'])):
            $total = 0; // Inicializa o total fora do loop
        ?>

            <main>
                <section class="compras">
                    <article class="site">
                        <div>
                            <h3>Carrinho de Compras</h3>
                        </div>
                        <div class="lado_a_lado">

                            <?php
                            foreach ($_SESSION['carrinho'] as $idProduto => $produto):
                                $subtotal = $produto['quantidade'] * $produto['preco']; // Calcula o subtotal
                                $total += $subtotal; // Soma o subtotal ao total
                            ?>

                                <div class="compras_box">
                                    <div>
                                        <a href="#">

                                            <img src="<?php echo BASE_URL . 'uploads/' . $produto['foto']; ?>" alt="<?php echo $produto['nome']; ?>">




                                        </a>
                                    </div>
                                    <div class="desc_compras">
                                        <p><?php echo $produto['nome']; ?></p>
                                        <p>500g</p>
                                        <h6>
                                            <!-- Formulário para remover um produto -->
                                            <form method="POST" action="<?php echo BASE_URL . 'compras/removerItemCarrinho'; ?>" style="display: inline;">
                                                <input type="hidden" name="idProduto" value="<?php echo $idProduto; ?>">
                                                <button type="submit" class="remove-button" style="border: none; background: none; color: red; cursor: pointer;">
                                                    REMOVER <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                        </h6>
                                    </div>
                                    <div class="compras_preco">
                                        <p>PREÇO UNITÁRIO</p>
                                        <h6>R$<?php echo number_format($produto['preco'], 2, ',', '.'); ?></h6>
                                    </div>

                                    <div class="qtd_compras">
                                        <p>QUANTIDADE</p>
                                        <div class="qtd_box">
                                            <div>
                                                <button class="decrement-button">-</button>
                                            </div>
                                            <div class="number">
                                                <p class="number-display" data-preco="<?php echo $produto['preco']; ?>">
                                                    <?php echo $produto['quantidade']; ?>
                                                </p>
                                            </div>
                                            <div>
                                                <button class="increment-button">+</button>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="subtotal">
                                        <p>Subtotal</p>
                                        <h6>R$<?php echo number_format($subtotal, 2, ',', '.'); ?></h6>
                                    </div>
                                </div>
                            <?php endforeach; ?>

                            <div class="resumo_compras">
                                <h3>Resumo do pedido</h3>
                                <div class="resumo_pedido">
                                    <p><?php echo count($_SESSION['carrinho']); ?> Produto(s)</p>
                                    <h6>R$<?php echo number_format($total, 2, ',', '.'); ?></h6>
                                </div>
                                <hr>
                                <div class="total_compras">
                                    <p>TOTAL</p>
                                    <p>R$<?php echo number_format($total, 2, ',', '.'); ?></p>
                                </div>
                                <div class="finalizar">
                                    <a href="javascript:void(0);" onclick="abrirWhatsApp(event)">Reservar Pedido</a>
                                </div>


                            </div>
                        </div>

                        <div class="acoes_compras">
                            <form method="POST" action="<?php echo BASE_URL . 'cliente/esvaziar_carrinho'; ?>">
                                <button type="submit" name="esvaziar_carrinho" class="esvaziar-btn">Esvaziar Carrinho</button>
                            </form>
                            <div>
                                <a href="http://localhost/guloseimas_do_olimpophp/public/produtos">Continuar Comprando</a>
                            </div>
                        </div>
                    </article>
                </section>

            </main>

        <?php
        else:
        ?>

            <section class="compras">
                <article class="site">
                    <div class="carrinho-vazio">
                        <h3>Seu carrinho está vazio</h3>
                        <p>Que tal dar uma olhada nos nossos <a href="<?php echo BASE_URL; ?>produtos">produtos?</a></p>
                    </div>
                </article>
            </section>

        <?php
        endif;
        ?>


        <footer>
            <?php
            // Inclui o cabeçalho
            require('template/footer.php');
            ?>
        </footer>

        <?php
        // Inclui o script
        require('script_geral/script.php');
        ?>
    </body>

    <!-- Adicione esse script no final do seu arquivo compras.php -->
    <script>
        // Função para esvaziar o carrinho visualmente
        function esvaziarCarrinhoVisual() {
            const itensCarrinho = document.querySelectorAll('.lado_a_lado');
            itensCarrinho.forEach(item => {
                item.remove(); // Remove cada item do DOM
            });
        }

        // Verifica se a URL contém um parâmetro indicando que o carrinho foi esvaziado
        window.onload = function() {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('carrinho_esvaziado') && urlParams.get('carrinho_esvaziado') === 'true') {
                // Se o carrinho foi esvaziado, chama a função para limpar os itens visualmente
                esvaziarCarrinhoVisual();
            }
        }
    </script>


    <script>
        function abrirWhatsApp(event) {
            // Previne o comportamento padrão do link
            event.preventDefault();

            const numeroWhatsApp = '5511968812993'; // Número do WhatsApp no formato internacional
            let mensagem = "Olá, gostaria de reservar os seguintes produtos:\n\n";
            let total = 0;
            let numProdutos = 0;

            // Seleciona o carrinho
            const carrinhoElement = document.querySelector('.compras');
            if (!carrinhoElement) {
                alert("Erro: Carrinho não encontrado.");
                return;
            }

            // Captura os produtos no carrinho
            const produtosNoCarrinho = document.querySelectorAll('.compras_box');

            // Se não houver produtos, exibir alerta e não prosseguir
            if (produtosNoCarrinho.length === 0) {
                alert("Seu carrinho está vazio.");
                return;
            }

            // Percorre os produtos do carrinho
            produtosNoCarrinho.forEach(function(box) {
                const nomeProduto = box.querySelector('.desc_compras p').textContent;
                const quantidade = parseInt(box.querySelector('.number-display').textContent);
                const preco = parseFloat(box.querySelector('.number-display').dataset.preco);

                if (quantidade > 0) {
                    total += quantidade * preco;
                    numProdutos += quantidade;
                    mensagem += `- ${nomeProduto}: ${quantidade} x R$${preco.toFixed(2).replace('.', ',')}\n`;
                }
            });

            // Se nenhum produto foi adicionado corretamente, exibir alerta e não prosseguir
            if (numProdutos === 0) {
                alert("Adicione produtos ao carrinho antes de reservar.");
                return;
            }

            // Adiciona o total ao final da mensagem
            mensagem += `\nTotal: R$${total.toFixed(2).replace('.', ',')}`;

            // Captura a data do pedido
            const dataPedido = new Date().toLocaleString(); // Data e hora atual

            // Adiciona a data ao histórico de pedidos no localStorage
            let historicoPedidos = JSON.parse(localStorage.getItem('historicoPedidos')) || [];
            historicoPedidos.push({
                data: dataPedido,
                total: total,
                mensagem: mensagem
            });
            localStorage.setItem('historicoPedidos', JSON.stringify(historicoPedidos));

            // Codifica a mensagem para a URL
            const mensagemCodificada = encodeURIComponent(mensagem);
            const linkWhatsApp = `https://wa.me/${numeroWhatsApp}?text=${mensagemCodificada}`;

            // Abre o WhatsApp em uma nova aba
            window.open(linkWhatsApp, '_blank');


            fetch('http://localhost/guloseimas_do_olimpophp/public/cliente/limpar_carrinho', {
                    method: 'POST',
                })
                .then(response => response.json())
                .then(data => {
                    console.log("Resposta do servidor:", data.message); // Verifica se a resposta foi recebida corretamente
                })
                .catch(error => console.error('Erro ao limpar carrinho:', error));




            // Remove os itens do carrinho após um pequeno tempo
            setTimeout(() => {
                // Limpa o carrinho na sessão do navegador também
                localStorage.removeItem('carrinho');
                sessionStorage.removeItem('carrinho');

                document.querySelector('.compras').innerHTML = `  
            <div class="carrinho-vazio">
                <h3>Seu carrinho está vazio</h3>
                <p>Que tal dar uma olhada nos nossos <a href="${BASE_URL}produtos">produtos?</a></p>
            </div>
        `;
            }, 500);


            // Aguarda um tempo e redireciona para a página de histórico
            setTimeout(() => {
                window.location.href = "http://localhost/guloseimas_do_olimpophp/public/Cliente/historico_reserva?pedido=sucesso";
            }, 2000); // Redireciona após 2 segundos

            // Exibe a mensagem de pedido confirmado
            const mensagemConfirmacao = document.createElement('div');
            mensagemConfirmacao.className = 'pedido-confirmado';
            mensagemConfirmacao.textContent = 'Pedido feito com sucesso! Obrigado por comprar conosco.';
            document.body.insertBefore(mensagemConfirmacao, document.body.firstChild);
        }


        document.querySelectorAll('.qtd_box').forEach(function(qtdBox) {
            const decrementButton = qtdBox.querySelector('.decrement-button');
            const incrementButton = qtdBox.querySelector('.increment-button');
            const numberDisplay = qtdBox.querySelector('.number-display');
            const subtotalDisplay = qtdBox.closest('.compras_box').querySelector('.subtotal h6');

            // Seletores do resumo e total
            const totalDisplay = document.querySelector('.total_compras p:last-child');
            const resumoPedido = document.querySelector('.resumo_pedido h6');
            const numProdutosDisplay = document.querySelector('.resumo_pedido p');
            const linkWhatsAppButton = document.querySelector('.finalizar a'); // Link do botão de WhatsApp





            // Função para atualizar o resumo e a URL do WhatsApp
            const atualizarResumoEUrlWhatsApp = () => {
                let total = 0; // Inicializa o total
                let numProdutos = 0; // Número total de produtos
                let mensagem = "Olá, gostaria de reservar os seguintes produtos:\n\n"; // Início da mensagem

                // Atualiza os subtotais e recalcula o total
                document.querySelectorAll('.compras_box').forEach(function(box) {
                    const quantidade = parseInt(box.querySelector('.number-display').textContent);
                    const preco = parseFloat(box.querySelector('.number-display').dataset.preco);
                    const produtoNome = box.querySelector('.desc_compras p').textContent;

                    const subtotal = quantidade * preco;
                    total += subtotal; // Soma o subtotal ao total geral
                    numProdutos += quantidade; // Soma a quantidade total de produtos

                    // Adiciona o produto à mensagem
                    mensagem += `- ${produtoNome}: ${quantidade} x R$${preco.toFixed(2).replace('.', ',')}\n`;
                });

                // Adiciona o total final à mensagem
                mensagem += `\nTotal: R$${total.toFixed(2).replace('.', ',')}`;

                // Codifica a mensagem para a URL do WhatsApp
                const mensagemCodificada = encodeURIComponent(mensagem);
                const numeroWhatsApp = '5511968812993'; // Número do WhatsApp
                const linkWhatsApp = `https://wa.me/${numeroWhatsApp}?text=${mensagemCodificada}`;

                // Atualiza o link do botão de WhatsApp
                if (linkWhatsAppButton) {
                    linkWhatsAppButton.setAttribute('href', linkWhatsApp);
                }

                // Atualiza os valores exibidos no resumo do pedido
                totalDisplay.textContent = `R$ ${total.toFixed(2).replace('.', ',')}`;
                resumoPedido.textContent = `R$ ${total.toFixed(2).replace('.', ',')}`;
                numProdutosDisplay.textContent = `${numProdutos} Produto(s)`;
            };

            // Evento para incrementar quantidade
            incrementButton.addEventListener('click', function() {
                let quantidade = parseInt(numberDisplay.textContent);
                const preco = parseFloat(numberDisplay.dataset.preco);

                quantidade++;
                numberDisplay.textContent = quantidade;

                const subtotal = quantidade * preco;
                subtotalDisplay.textContent = `R$ ${subtotal.toFixed(2).replace('.', ',')}`;

                atualizarResumoEUrlWhatsApp();
            });

            // Evento para decrementar quantidade
            decrementButton.addEventListener('click', function() {
                let quantidade = parseInt(numberDisplay.textContent);
                const preco = parseFloat(numberDisplay.dataset.preco);

                if (quantidade > 1) {
                    quantidade--;
                    numberDisplay.textContent = quantidade;

                    const subtotal = quantidade * preco;
                    subtotalDisplay.textContent = `R$ ${subtotal.toFixed(2).replace('.', ',')}`;

                    atualizarResumoEUrlWhatsApp();
                }
            });
        });

        // Chama a função para garantir que o link seja gerado no carregamento inicial
        document.addEventListener('DOMContentLoaded', () => {
            const atualizarResumoEUrlWhatsApp = () => {
                // Lógica já definida no evento anterior
            };
            atualizarResumoEUrlWhatsApp();
        });
    </script>



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
    </body>




    </html>