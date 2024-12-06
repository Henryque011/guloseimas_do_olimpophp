<?php

class Core
{

    public function executar()
    {
        $url = '/';

        if (isset($_GET['url'])) {
            $url .= $_GET['url'];
        }

        $parametro = array();

        if (!empty($utl) && $url != '/') {
            $url = explode('/', $url);
            array_shift($url);
            $controladorAtual = ucfirst($url[0]) . 'Controller';
            array_shift($url);
            if (isset($url[0]) && !empty($url[0])) {
                $acaoAtual = $url[0];
                array_shift($url);
            } else {
                $acaoAtual = 'index';
            }
            if (count($url) > 0) {
                $parametro = $url;
            }
        } else {
            $controladorAtual = 'HomeController';
            $acaoAtual = 'index';
        }
        if (!file_exists('../app/controllers/' . $controladorAtual . '.php') || !method_exists($controladorAtual, $acaoAtual)) {

            // Se não existir defina o controller como ErroController
            $controladorAtual = 'ErroController';
            $acaoAtual = 'index';

            // var_dump('Controlador Atual: '. $controladorAtual);
            // var_dump('Ação atual: '. $acaoAtual);
        }

        $controller = new $controladorAtual();

        call_user_func_array(array($controller, $acaoAtual), $parametro);
    }
}
