

<?php

class Funcoes {
    //public $data=null;

    function __construct()
    {
    }


function limpardados(&$data){
    $data = array_map('trim', $_POST);
    $data = array_map('htmlspecialchars', $data);
    $data = array_map('stripslashes', $data);



    
 $filters = array(
     'cpf' => FILTER_UNSAFE_RAW,
     'email' => FILTER_SANITIZE_EMAIL, 
     'senha' => FILTER_UNSAFE_RAW,  
     'nome' => FILTER_UNSAFE_RAW, 
     'sobrenome' => FILTER_UNSAFE_RAW,
     'rm' => FILTER_SANITIZE_NUMBER_INT
 );
        $data = filter_var_array($data, $filters);
   
}
}

?>