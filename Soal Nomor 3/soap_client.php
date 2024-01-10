<?php
// Include file nusoap.php
require_once('lib/nusoap.php');

// Get the raw POST data
$postData = file_get_contents("php://input");

// Parse the JSON data
$requestData = json_decode($postData, true);

// Check if the required parameters are present
if (isset($requestData['bil1']) && isset($requestData['bil2'])) {
    // Extract values from the request data
    $bil1 = $requestData['bil1'];
    $bil2 = $requestData['bil2'];

    // Create a new soap client
    $client = new nusoap_client("http://localhost/nusoap/soap_server.php?wsdl", true);

    // Call the 'jumlah' and 'kurang' functions
    $result = $client->call('jumlah', array('x' => $bil1, 'y' => $bil2));
    $results = $client->call('kurang', array('a' => $bil1, 'b' => $bil2));

    $err = $client->getError();
    if ($err) {
        echo "Gagal" . $err;
    } else {
        echo "Hasil Penjumlahan " . $bil1 . " dan " . $bil2 . " = " . $result. "\n";
        echo "Hasil Pengurangan " . $bil1 . " dan " . $bil2 . " = " . $results;
    }
} else {
    echo "Bil1 dan Bil2 harus disertakan dalam body request.";
}
?>
