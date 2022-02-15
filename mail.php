<?php
//require 'vendor/autoload.php';
require_once 'lib/vendor/autoload.php';
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
	$today    = date("d-m-Y H:i:s");

	//$school   = utf8_decode($_POST['escolaridad']);

	//$to = 'mxlgallardo@gmail.com'; // note the comma
	$to = 'To: JMartinez <jmartinezro@up.edu.mx>, Jose Gallo Ruiz <jose@orange.sc>, Marcexl <mxlgallardo@gmail.com>';  

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

	$client = getClient();
	$service = new Google_Service_Sheets($client);

	// Prints the names and majors of students in a sample spreadsheet:
	// https://docs.google.com/spreadsheets/d/1BxiMVs0XRA5nFMdKvBdBZjgmUUqptlbs74OgvE2upms/edit
	$spreadsheetId = '1D9wDhVO7xAD-p0677OsIW7l9sqVm_T6mDGsVrZwBPNQ';
	$range = 'results!A2:H';
	
	$posgrado = utf8_encode($posgrado);
	$expe     = utf8_encode($expe);
	
	$values = [
		["{$today}","{$fname}","{$lname}","{$email}","{$phone}","{$empresa}","{$posgrado}","{$expe}"]
	];

	/*$values = [
		["{$fname}","{$lname}","{$email}","{$phone}","{$empresa}","{$posgrado}","{$expe}"]
	];*/


	$body = new Google_Service_Sheets_ValueRange([
		'values' => $values
	]);

	$params = [
		'valueInputOption' => 'RAW'
	];

	$result = $service->spreadsheets_values->append(
		$spreadsheetId,
		$range,
		$body,
		$params
	);


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

function getClient() {
    $client = new Google_Client();
    $client->setApplicationName('google sheets with PHP');
    $client->setScopes(Google_Service_Sheets::SPREADSHEETS);
    $client->setAccessType('offline');
    $client->setAuthConfig('secret.json');
    $client->setPrompt('select_account consent');

    // Load previously authorized token from a file, if it exists.
    // The file token.json stores the user's access and refresh tokens, and is
    // created automatically when the authorization flow completes for the first
    // time.
    $tokenPath = 'token.json';
    if (file_exists($tokenPath)) {
        $accessToken = json_decode(file_get_contents($tokenPath), true);
        $client->setAccessToken($accessToken);
    }

    // If there is no previous token or it's expired.
    if ($client->isAccessTokenExpired()) {
        // Refresh the token if possible, else fetch a new one.
        if ($client->getRefreshToken()) {
            $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
        } else {
            // Request authorization from the user.
            $authUrl = $client->createAuthUrl();
            printf("Open the following link in your browser:\n%s\n", $authUrl);
            print 'Enter verification code: ';
            $authCode = trim(fgets(STDIN));

            // Exchange authorization code for an access token.
            $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
            $client->setAccessToken($accessToken);

            // Check to see if there was an error.
            if (array_key_exists('error', $accessToken)) {
                throw new Exception(join(', ', $accessToken));
            }
        }
        // Save the token to a file.
        if (!file_exists(dirname($tokenPath))) {
            mkdir(dirname($tokenPath), 0700, true);
        }
        file_put_contents($tokenPath, json_encode($client->getAccessToken()));
    }
    return $client;
}
  
?>