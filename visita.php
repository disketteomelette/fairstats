<?php 
function pseudoanonimizarIP($ip) { 
    $hash_ip = hash('sha256', hash('sha256', $ip) . hash('md5', ($tamano_archivo = filesize('visita.php'))) . ($pepper = hash('sha256', $tamano_archivo)));
    for ($i = 0; $i < 5; $i++) {$hash_ip = hash('sha256', $hash_ip . $salt . $pepper);} 
    return $hash_ip; 
}
 
function sanitizeInput($input) { 
    $input = str_replace(array('/', ';', '(', ')'), '#', $input); 
    $input = preg_replace('/[^a-zA-Z0-9_.#]/', '', $input);
    return $input;
}

function sanitizeURL($url) { 
    return preg_replace('/[^a-zA-Z0-9\/.?=&]/', '', $url);
}
 
function logVisita($datos) {
    $archivoVisitas = "visitas/visitas_" . date("d-m-Y") . ".txt";
    $archivoFallos = "fallos/visitas_" . date("d-m-Y") . ".txt";
    $visita = $datos['ip'] . ';' . $datos['hora'] . ';' . $datos['url'] . ';' . $datos['userAgent'] . ';' . $datos['dispositivo'] . PHP_EOL;

    if (!file_exists($archivoVisitas)) {
        file_put_contents($archivoVisitas, '');
    }

    if (file_put_contents($archivoVisitas, $visita, FILE_APPEND | LOCK_EX) === false) {
        $log = date("Y-m-d H:i:s") . " - Error al escribir en archivo de visitas." . PHP_EOL;
        file_put_contents("log.txt", $log, FILE_APPEND | LOCK_EX);
        if (file_put_contents($archivoFallos, $visita, FILE_APPEND | LOCK_EX) === false) {
            $log = date("Y-m-d H:i:s") . " - Error al escribir en archivo de fallos." . PHP_EOL;
            file_put_contents("log.txt", $log, FILE_APPEND | LOCK_EX);
        }
    }
}

function sanitizeVisita($datos) { 
    $datos['url'] = sanitizeURL($datos['url']); 
    $datos['userAgent'] = sanitizeInput($datos['userAgent']);
    return $datos;
}

function obtenerDatosVisita() {
    $datos['ip'] = $_SERVER['REMOTE_ADDR'];
    $datos['hora'] = date("H:i:s");
    $datos['url'] = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $datos['userAgent'] = $_SERVER['HTTP_USER_AGENT'];
    $datos['dispositivo'] = (strpos($datos['userAgent'], 'Mobile') !== false) ? 'Móvil' : 'PC';
    return $datos;
}

$datos = obtenerDatosVisita();
$datos = sanitizeVisita($datos);
$datos['ip'] = pseudoanonimizarIP($datos['ip']); 
logVisita($datos);
?>