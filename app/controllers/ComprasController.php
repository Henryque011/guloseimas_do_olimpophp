<?php

class ComprasController extends Controller
{
    private $CarrinhoModel;
    private $reservaModel;

    public function __construct()
    {
        // Inicializa a sessão se ainda não estiver iniciada
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Cria uma instância do modelo Produto e atribui à propriedade $CarrinhoModel
        $this->CarrinhoModel = new Produto();

        // Cria uma instância do modelo Reserva para manipular a reserva
        $this->reservaModel = new Reserva();
    }

    public function index()
    {
        $dados = array();
        $dados['nome'] = 'cheguei aqui';
        $this->carregarViews('compras', $dados);
    }

    public function removerItemCarrinho()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idProduto = filter_input(INPUT_POST, 'idProduto', FILTER_VALIDATE_INT);
            $id_cliente = $_SESSION['userId'];

            if ($idProduto && $id_cliente) {
                $this->CarrinhoModel->remover($idProduto, $id_cliente);
            } else {
                $_SESSION['erro'] = 'Não foi possível remover o item do carrinho.';
                header('Location: ' . BASE_URL . 'compras');
                exit();
            }
        } else {
            header('Location: ' . BASE_URL . 'compras');
            exit();
        }
    }

    public function finalizarReserva()
    {
        // Chama o método que realiza a reserva
        $this->reservaModel->finalizarReserva();
    }
}
