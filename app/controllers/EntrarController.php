<?php

class EntrarController extends Controller
{
    public function index(){
        $dados = array();

        $banner_entrar = new Banner();

        $entrar_banner = $banner_entrar->getBanner_entrar();

        $dados['banner'] = $entrar_banner;
        // Carrega a view de login
        $this->carregarViews('entrar', $dados);
    }

    public function entrar(){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = filter_input(INPUT_POST, 'email_entrar', FILTER_VALIDATE_EMAIL);
            $senha = filter_input(INPUT_POST, 'senha_entrar');
    
            if ($email && $senha) {
                $funcionarioModel = new Funcionario();
                $funcionario = $funcionarioModel->buscarFunc($email);
    
                if ($funcionario && $funcionario['senha_funcionario'] === $senha) {
                    $_SESSION['userId'] = $funcionario['id_funcionario'];
                    $_SESSION['userTipo'] = 'Funcionario';
                    $_SESSION['userNome'] = $funcionario['nome_funcionario'];
                    $_SESSION['userFoto'] = $funcionario['foto_funcionario'] ?? 'funcionario/default.svg';
                    $_SESSION['userEndereco'] = $funcionario['endereco_funcionario'];
    
                    header('Location: ' . BASE_URL . 'dashboard');
                    exit;
                }
    
                $clienteModel = new Cliente();
                $cliente = $clienteModel->buscarCliente($email);
    
                if ($cliente && $cliente['senha_cliente'] === $senha) {
                    $_SESSION['userId'] = $cliente['id_cliente'];
                    $_SESSION['userTipo'] = 'Cliente';
                    $_SESSION['userNome'] = $cliente['nome_cliente'];
                    $_SESSION['userFoto'] = $cliente['foto_cliente'] ?? 'cliente/default.svg';
                    $_SESSION['userEndereco'] = $cliente['endereco_cliente'];
    
                    header('Location: ' . BASE_URL . 'home');
                    exit;
                }
    
                $_SESSION['login-erro'] = 'Email ou senha incorretos.';
            } else {
                $_SESSION['login-erro'] = 'Preencha todos os campos.';
            }
        }
    
        $this->carregarViews('entrar');
    }
    

    public function sair(){
        // Destrói a sessão para logout
        session_unset();
        session_destroy();

        // Redireciona para a página inicial após o logout
        header('Location: ' . BASE_URL);
        exit;
    }
}
