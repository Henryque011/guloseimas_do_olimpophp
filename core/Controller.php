<?php
// criando uma classe
class Controller
{

public function carregarViews($view, $dados = array()){

  

// Codigo do metodo

extract($dados);





require '../app/views/' . $view . '.php';


}

}