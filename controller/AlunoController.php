<?php
include_once '../conexao/Conexao.php';
include_once '../model/Pessoa.php';
include_once '../model/Aluno.php';
include_once '../dao/AlunoDAO.php';
include_once '../model/Funcoes.php';

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


//Load Composer's autoloader
require 'lib\vendor\autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);



// Retirando espaços no início e final de uma string

/* function trimValue(&$value) {
    $value = trim($value); 
}

array_walk($_POST, 'trimValue'); */
//$data = array_map('trim', $_POST);

$data = new Funcoes();
$data->limpardados($data);


//$data = array_map('htmlspecialchars', $data);


//function limpardados($data){};


// $filters = array(
//     'cpf' => FILTER_UNSAFE_RAW,
//     'email' => FILTER_SANITIZE_EMAIL,
//     'senha' => FILTER_UNSAFE_RAW,  
//     'nome' => FILTER_UNSAFE_RAW,
//     'sobrenome' => FILTER_UNSAFE_RAW,
//     'rm' => FILTER_SANITIZE_NUMBER_INT
// );

// $data = filter_var_array($data, $filters);

echo '<pre>', var_dump($data), '</pre>';

if (isset($_POST['cadastrar'])) {

    $aluno = new Aluno(($data['cpf']), $data['email'], $data['senha'], $data['nome'], $data['sobrenome'], $data['rm']);

    /*
    $aluno->setCpf($d['cpf']);
    $aluno->setEmail($d['email']);
    $aluno->setSenha($d['senha']);
    $aluno->setNome($d['nome']);
    $aluno->setSobrenome($d['sobrenome']);
    $aluno->setRm($d['rm']);
    */
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.mailtrap.io';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = '2035db56a5dcf7';                     //SMTP username
        $mail->Password   = '1b0f4eac90c936';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
        $mail->Port       = 2525;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('erickguimaraes10@hotmail.com', 'Erick');
        $mail->addAddress($data['email'], $data['nome']);     //Add a recipient
       

        //Attachments
        $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Confirmar email';
        $mail->Body    = "Prezado(a)" . $data['nome'] . "<br><br> Confirme seu cadastro teste <br><br> 
        <a href='http://localhost/Funcoes-PHP-PDO-POO-MVC-DAO/view/cadastro.php?chave='>Clique Aqui</a>";

        $mail->AltBody = "Prezado(a)" . $data['nome'] . "\n\n Confirme seu cadastro teste \n\n 
        <a href='http://localhost/Funcoes-PHP-PDO-POO-MVC-DAO/view/cadastro.php?chave='>Clique Aqui</a>";

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }


    $alunodao = new AlunoDAO();
    $alunodao->create($aluno);

    //header('Location: ../');
}
