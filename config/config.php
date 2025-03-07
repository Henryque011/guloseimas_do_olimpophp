<?php

// session_start();
if(session_status() == PHP_SESSION_NONE) {
    session_start();
}


// Definir URL  da aplicação 
// define("BASE_URL" ,"https://kioficina.smpsistema.com.br/");
define("BASE_URL" ,"http://localhost/guloseimas_do_olimpophp/public/");


//  Configuração do Data Base para desenvolvimento local
 define("DB_HOST", "193.203.175.197"); // Ou 127.0.0.1
 define("DB_NAME", "u230564252_olimpo"); // Substitua pelo nome do banco local
 define("DB_USER", "u230564252_olimpo"); // Usuário padrão do MySQL local
 define("DB_PASS", "21566647aA#"); // Geralmente a senha do root está em branco


// define("DB_HOST", "smpsistema.com.br");
// define("DB_NAME", "u283879542_alex");
// define("DB_USER", "u283879542_alex");
// define("DB_PASS", "Alex@tipi02");


// EMAIIL  // EMAIIL // EMAIIL


define('HOTS_EMAIL', 'smtp.gmail.com');
define('PORT_EMAIL', '465');
define('USER_EMAIL', 'desenvolvedorweb21@gmail.com');
define('PASS_EMAIL', 'fgip hdva gvep mdso');






// define('HOTS_EMAIL', 'smtp.gmail.com');
// define('PORT_EMAIL', '465');
// define('USER_EMAIL', 'desenvolvedorweb21@gmail.com');
// define('PASS_EMAIL', 'dqay vqmc xpjd yosa');







// EMAIIL // EMAIIL // EMAIIL // EMAIIL



// Sistema de autoload  das class 
spl_autoload_register(function ($classe) {
    // Caminho para Controllers
    if (file_exists('../app/controllers/' . $classe . '.php')) {
        require_once '../app/controllers/' . $classe . '.php';
    }

    // Caminho para Models
    if (file_exists('../app/models/' . $classe . '.php')) {
        require_once '../app/models/' . $classe . '.php';
    }

    // Caminho para Core
    if (file_exists('../core/' . $classe . '.php')) {
        require_once '../Core/' . $classe . '.php';
    }
    
});
