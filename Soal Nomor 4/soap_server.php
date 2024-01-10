<?php
// Include file nusoap.php
require_once('lib/nusoap.php');

$server = new nusoap_server();
$server->configureWSDL('server_wsdl', 'urn:server_wsdl');

$server->register(
    'CheckPaymentStatus',
    array('nim' => 'xsd:string', 'password' => 'xsd:string'),
    array('return' => 'xsd:string')
);
$server->register('GetUnpaidStudents', array(), array('return' => 'xsd:string'));

$mahasiswa = array(
    // Punya saya
    '21104045' => array('nama' => 'Rizky Ageng Nugroho', 'password' => 'rizky123', 'status_pembayaran' => true),

    // Mahasiswa bodong
    '21104099' => array('nama' => 'Asep Sutejo', 'password' => 'aseeep', 'status_pembayaran' => false),
    '21104035' => array('nama' => 'Bejo Djanerio', 'password' => 'subejo', 'status_pembayaran' => false),
    '21104010' => array('nama' => 'Master Limbad', 'password' => 'ohyeah', 'status_pembayaran' => false),
    '21104060' => array('nama' => 'Carl Jhonson', 'password' => 'cj', 'status_pembayaran' => false),
);

// Fitur untuk mahasiswa
function CheckPaymentStatus($nim, $password) {
    global $mahasiswa;

    if (isset($mahasiswa[$nim]) && isset($mahasiswa[$nim]['password']) && $mahasiswa[$nim]['password'] === $password) {
        return $mahasiswa[$nim]['status_pembayaran'] ? 'LUNAS, ANDA DAPAT MENGISI KRS' : 'BELUM LUNAS, ANDA TIDAK DAPAT MENGISI KRS, SILAHKAN BAYAR BPP TERLEBIH DAHULU';
    } else {
        return 'MAHASISWA TIDAK DITEMUKAN atau PASSWORD SALAH';
    }    
}

// Fitur untuk akademik/admin
function GetUnpaidStudents() {
    global $mahasiswa;

    $unpaidStudents = array();
    foreach ($mahasiswa as $nim => $data) {
        if (!$data['status_pembayaran']) {
            $unpaidStudents[] = array('nim' => $nim, 'nama' => $data['nama']);
        }
    }

    return json_encode($unpaidStudents);
}

$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$server->service(file_get_contents("php://input"));
$response = json_decode($server);
echo $response;
