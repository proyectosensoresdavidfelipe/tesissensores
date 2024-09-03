<?php
// Datos a enviar
$data = array(
    'sensor1' => $_POST['sensor1'],
    'sensor2' => $_POST['sensor2'],
    'sensor3' => $_POST['sensor3'],
    'sensor4' => $_POST['sensor4'],
    'sensor5' => $_POST['sensor5'],
    'fechalec' => $_POST['fechalec']
);

// URL destino donde se enviarán los datos
$url = 'http://192.168.0.40/desarrollosensores/grabarpost.php'; 

// Configuración de la petición
$options = array(
    'http' => array(
        'method'  => 'POST',
        'header'  => 'Content-type: application/x-www-form-urlencoded',
        'content' => http_build_query($data)
    )
);

// Crear contexto de la petición
$context  = stream_context_create($options);

// Realizar la petición
$result = file_get_contents($url, false, $context);

// Verificar si la petición fue exitosa
if ($result === FALSE) {
    // Si hay un error en la petición
    echo "Error al enviar los datos.";
} else {
    // Si la petición fue exitosa
    echo "Datos enviados correctamente.";
    // Opcional: Mostrar la respuesta del servidor destino
    echo "<br>Respuesta del servidor: <pre>$result</pre>";
}
?>