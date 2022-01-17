<?php

$data = new \stdClass();

if(isset($_POST))
{
	$fname    = utf8_decode($_POST['firstname']);
	$lname    = utf8_decode($_POST['lastname']);
	$email    = $_POST['email'];
	$phone    = $_POST['mobilephone'];
	$empresa  = utf8_decode($_POST['empresa']);
	$posgrado = utf8_decode($_POST['posgrado']);
	$expe     = utf8_decode($_POST['experiencia']);
	//$school   = utf8_decode($_POST['escolaridad']);

	//$to = 'mxlgallardo@gmail.com'; // note the comma
	$to = 'To: JMartinez <jmartinezro@up.edu.mx>, José Gallo Ruiz <jose@orange.sc>';  

	// Subject
	$subject = 'Nuevo registro en Posgrados de Ingenierias';

	// Message
	$message = '
	<html>
	<head>
	  <title>'.$subject.'</title>
	</head>
	<body>
	  <p>Hola se ha registrado una nueva persona:</p>
	  <p><b>Nombre:</b> '.$fname.' '.$lname.'</p>
	  <p><b>Email: </b>'.$email.'</p>
	  <p><b>Telefono: </b>'.$phone.'</p>
	  <p><b>Empresa: </b>'.$empresa.'</p>
	  <p><b>Posgrado: </b>'.$posgrado.'</p>
	  <p><b>Experiencia laboral: </b>'.$expe.'</p>
	</body>
	</html>
	';

	// To send HTML mail, the Content-type header must be set
	$headers[] = 'MIME-Version: 1.0';
	$headers[] = 'Content-type: text/html; charset=iso-8859-1';

	// Additional headers
	$headers[] = $to;
	$headers[] = 'From: no-reply <no-reply@up.edu.mx>';

	// Mail it
	if(mail($to, $subject, $message, implode("\r\n", $headers)))
	{
		$data->send = true;
		echo json_encode($data);
		die();
	}
	else
	{
		$data->msj = 'Lo sentimos. Por el momento no se ha podido enviar el mensaje. Por favor intente mas tarde.';		
		echo json_encode($result);
	}
}
else
{
	echo 'ups hello world';
	exit();
}
?>