<?php
// Include file nusoap.php
require_once('lib/nusoap.php');

// Create a new soap client
$client = new nusoap_client("http://localhost/ittelkom/soap_server.php?wsdl", true);

// Call the GetUnpaidStudents function without any parameters
$response = $client->call('GetUnpaidStudents');

$err = $client->getError();
if ($err) {
    echo "Gagal " . $err;
} else {
    echo "$response";
}
?>
