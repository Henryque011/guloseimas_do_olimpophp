<?php

class DashboardController extends Controller
{
    public function index(){
        // Inicia a sessão se ainda não estiver iniciada
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Verifica se o usuário está logado
        if (!isset($_SESSION['userId']) || !isset($_SESSION['userTipo'])) {
            header('Location: ' . BASE_URL);
            exit();
        }

        // Determina o modelo correto com base no tipo de usuário
        $userModel = $_SESSION['userTipo'] === 'Funcionario' ? new Funcionario() : new Cliente();

        // Busca os dados do usuário no banco de dados pelo ID
        $user = $userModel->buscarPorId($_SESSION['userId']);

        if (!$user) {
            header('Location: ' . BASE_URL . 'login/sair');
            exit();
        }

        // Atualiza os dados de sessão
        $_SESSION['userNome'] = $user['nome_funcionario'] ?? $user['nome_cliente'];
        $_SESSION['userFoto'] = $user['foto_funcionario'] ?? $user['foto_cliente'];
        $_SESSION['userEndereco'] = $user['endereco_funcionario'] ?? $user['endereco_cliente'] ?? 'Endereço não disponível';

        // Prepara os dados para passar para a view
        $dados = array();
        $dados['titulo'] = 'Dashboard - Ki Oficina';
        $dados['nomeUser'] = $_SESSION['userNome'];
        $dados['idUser'] = $_SESSION['userId'];
        $dados['tipoUser'] = $_SESSION['userTipo'];
        $dados['userEndereco'] = $_SESSION['userEndereco'];
        $dados['fotoUser'] = !empty($_SESSION['userFoto'])
            ? BASE_URL . $_SESSION['userFoto']
            : BASE_URL . 'uploads/funcionario/default.svg';

        // Carrega a view
        $this->carregarViews('dash/dashboard', $dados);
    }
}
