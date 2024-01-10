<?php
// Include file nusoap.php
require_once('lib/nusoap.php');

// Get the raw POST data
$postData = file_get_contents("php://input");

// Parse the JSON data
$requestData = json_decode($postData, true);

// Check if the required parameters are present
if (isset($requestData['nim']) && isset($requestData['password'])) {
    // Extract values from the request data
    $nim = $requestData['nim'];
    $password = $requestData['password'];

    // Create a new soap client
    $client = new nusoap_client("http://localhost/ittelkom/soap_server.php?wsdl", true);

    // Call the functions
    $response = $client->call('CheckPaymentStatus', array('nim' => $nim, 'password' => $password));

    $err = $client->getError();
    if ($err) {
        echo "Gagal " . $err;
    } else {
        echo "$response";
    }
} else {
    echo "nim dan password harus disertakan dalam body request.";
}
?>
