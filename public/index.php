<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// CARREGA MINHAS CONFIGURAÇÕES INICIAS 
 require_once('../config/config.php');
   require_once('../core/Core.php'); // Inclui a classe Core
//    echo "Core.php carregado com sucesso!<br>";
// NUCLEO DA APLICÃO

$nucleo = new Core();
$nucleo->executar();