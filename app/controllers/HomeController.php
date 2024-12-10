<?php 
class HomeController extends Controller{

    public function index(){
        $dados = array();

        $dados['mensagem'] = 'Bem-vindo a guloseimas do olimpo';

        $this->carregarViews('home',$dados);

    }
}