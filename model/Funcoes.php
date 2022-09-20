

<?php

class Funcoes {
    public $data=null;

function limpardados(&$data){
    $data = array_map('trim', $_POST);
    $data = array_map('htmlspecialchars', $data);
    $data = array_map('stripslashes', $data);



    
 $filters = array(
     'cpf' => FILTER_UNSAFE_RAW, FILTER_VALIDATE_INT,
     'email' => 'FILTER_SANITIZE_EMAIL', 'FILTER_VALIDATE_EMAIL',
     'senha' => FILTER_UNSAFE_RAW, FILTER_VALIDATE_REGEXP,  
     'nome' => FILTER_UNSAFE_RAW, 
     'sobrenome' => FILTER_UNSAFE_RAW,
    'rm' => FILTER_SANITIZE_NUMBER_INT, FILTER_VALIDATE_INT
 );
}
}

?>