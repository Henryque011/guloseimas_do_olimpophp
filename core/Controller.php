<?php
// criando uma classe
class Controller
{

    public function carregarViews($view, $dados = array())
    {

        // Codigo do metodo

        extract($dados);
        echo "Tentando carregar: " . __DIR__ . '/../app/views/' . $view . '.php';
        exit;

        require __DIR__ . '/../app/views/' . $view . '.php';
    }
}
