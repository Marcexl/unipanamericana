<?php
ini_set('error_reporting', E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'vendor/php-mailer/Exception.php';
require 'vendor/php-mailer/PHPMailer.php';
require 'vendor/php-mailer/SMTP.php';


$to = 'jmartinezro@up.edu.mx';  
//$to = 'mxlgallardo@gmail.com';  
//$to = 'esdaigdl@up.edu.mx'; 
//$to = 'leandro@orange.sc';

$mail = new PHPMailer(true); // Passing `true` enables exceptions
$mail->setFrom($to, 'Universidad Panamericana - ESDAI Inscripciones');
$mail->addAddress($to, $to);
$mail->addReplyTo($to, $to);
//$mail->addCc("leandro@orange.sc");
$mail->isHTML(true);

$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'esdaigdl@up.edu.mx';
$mail->Password = 'Universidad123';
//$mail->Port = 587;
//$mail->SMTPSecure = "tls";

$mail->Port = 465;
$mail->SMTPSecure = "ssl";



function validator($formInputs, $data){
	$errors = array('list' => array(),'fields' => array());
	foreach($formInputs as $name => $config){
		$rules = $config['validations'];

		if (in_array('names',$rules)){
			preg_match("#[^a-zA-Z0-9\.,\"\s']+#Usi",$data[$name],$matches);
			if (count($matches) > 0){
				$errors['fields'][$name] = 'Invalid characters';
				$errors['list'][] = $name.': '.$errors['fields'][$name];
				continue;
			}
		}

		if (in_array('numeric',$rules)){
			preg_match("#[^0-9']+#Usi",$data[$name],$matches);
			if (count($matches) > 0){
				$errors['fields'][$name] = 'Only numbers';
				$errors['list'][] = $name.': '.$errors['fields'][$name];
				continue;
			}
		}

		if (in_array('tel',$rules)){
			preg_match("#[^0-9\s\(\)\+']+#Usi",$data[$name],$matches);
			if (count($matches) > 0){
				$errors['fields'][$name] = 'Only numbers';
				$errors['list'][] = $name.': '.$errors['fields'][$name];
				continue;
			}
		}


		if (in_array('notEmpty',$rules)){
			if (trim($data[$name]) == ''){
				$errors['fields'][$name] = 'Debe ingresar un valor';
				$errors['list'][] = $name.': '.$errors['fields'][$name];
				continue;
			}
		}

		if (in_array('email',$rules)){
			if (!filter_var($data[$name], FILTER_VALIDATE_EMAIL)){
				$errors['fields'][$name] = 'Ingrese un mail valido';
				$errors['list'][] = $name.': '.$errors['fields'][$name];
				continue;
			}
		}

		if (in_array('maestria',$rules)){
			$servicios = array(
				"22 y 23 de noviembre",
				"6 y 7 de noviembre",
				"13 y 14 de diciembre",
				"10 y 11 de enero",
				"24 y 25 de enero",
				"7 y 8 de febrero",
				"21 y 22 de febrero",
				"6 y 7 de marzo",
				"20 y 21 de marzo",
				"3 y 4 de abril",
				"17 y 18 de abril",
				"8 y 9 de mayo",
				"22 y 23 de mayo",
				"5 y 6 de junio",
				"19 y 20 de junio",
				"3 y 4 de julio",
				"17 y 18 de julio",
				"24 y 25 de julio",
				"31 de julio y 1 de agosto"
			);
			if (!in_array($data[$name], $servicios)){
				$errors['fields'][$name] = 'No es una maestria valida';
				$errors['list'][] = $name.': '.$errors['fields'][$name];
				continue;
			}
		}

	}
	return $errors;
}

session_start();

/* -----------------------------------------------------------------------------------------------------------------
	CONTACTO
----------------------------------------------------------------------------------------------------------------- */
if ($_POST['action'] == 'contact'){
	$timeout = 60;

	$formInputs = array(
		'name' => ['name' => 'Nombre', 'validations' => ['notEmpty','names']],
		'tel' => ['name' => 'Teléfono', 'validations' => ['notEmpty','tel']],
		'email' => ['name' => 'Email', 'validations' => ['notEmpty','email']],
		'maestria' => ['name' => 'Fecha de examen', 'validations' => ['notEmpty','maestria']],
		'message' => ['name' => 'Mensaje', 'validations' => []]
	);

	$errors = validator($formInputs,$_POST);
	if (count($errors['list']) > 0){
		die(json_encode(array('result' => 0,'field' => array_keys($errors['fields'])[0],'message' => $errors['list'][0])));
	}

	if ($_SESSION['last_rd']+60 > time()){
		die(json_encode(array('result' => 0,'message' => 'Debe esperar antes de volver a intentar')));
	}

	$subject = 'Contacto landing maestrias';
	$message = '';
	foreach($formInputs as $input => $config){
		$message.="<strong>".$config['name']."</strong>: ".nl2br($_POST[$input])."<BR>";
	}


	try {
	    $mail->Subject = $subject;
	    $mail->Body = $message;
	    $mail->AltBody = $message;
	    $mail->send();

		$_SESSION['last_rd'] = time();

		$mail->clearAddresses();
		$mail->setFrom($to, 'Universidad Panamericana - ESDAI Inscripciones');
		$mail->addAddress($_POST['email'], $_POST['email']);
		$mail->addReplyTo($to, $to);
		$mail->isHTML(true);

	    $mail->Subject = 'Muchas gracias por contactarnos';
	    $mail->Body = 'Muchas gracias por contactarnos. Nos comunicaremos contigo a la brevedad para dar seguimiento a tu solicitud.';
	    $mail->AltBody = 'Muchas gracias por contactarnos. Nos comunicaremos contigo a la brevedad para dar seguimiento a tu solicitud.';
	    $mail->send();


		die(json_encode(array('result' => 1)));

	} catch (Exception $e) {
		die(json_encode(array('result' => 0,'message' => 'Error enviando el formulario','debug' => $mail->ErrorInfo)));
	}
	die();
}



?>



















