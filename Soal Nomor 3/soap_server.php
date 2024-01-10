<?php
// Include file nusoap.php
require_once('lib/nusoap.php');

$server = new nusoap_server();
$server -> configureWSDL('server_wsdl', 'urn:server_wsdl');

$server->register('jumlah', array('x' => 'xsd:integer', 'y' => 'xsd:integer'), array('return' => 'xsd:integer'));
$server->register('kurang', array('a' => 'xsd:integer', 'b' => 'xsd:integer'), array('return' => 'xsd:integer'));

function jumlah($x, $y){
    $hasil_jumlah = $x + $y;
    return $hasil_jumlah;
}

function kurang($a, $b){
    $hasil_kurang = $a - $b;
    return $hasil_kurang;
}

$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA: '';
$server -> service(file_get_contents("php://input"));
$hasil = json_decode($server);
echo $hasil;

exit();
?>
