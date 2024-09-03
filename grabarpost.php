<?php
    /* conexiona a la bd mysql */
    $servername = "localhost";
    $username = "proyecto";
    $password = "123";
    $dbname = "sensores";

    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Recibir datos enviados por POST
    $caja = isset($_POST['caja']) ? $_POST['caja'] : '0';
    $sensor1 = isset($_POST['sensor1']) ? (double)$_POST['sensor1'] : 0;
    $sensor2 = isset($_POST['sensor2']) ? (double)$_POST['sensor2'] : 0;
    $sensor3 = isset($_POST['sensor3']) ? (double)$_POST['sensor3'] : 0;
    $sensor4 = isset($_POST['sensor4']) ? (double)$_POST['sensor4'] : 0;
    $sensor5 = isset($_POST['sensor5']) ? (double)$_POST['sensor5'] : 0;
    //$fechalec = isset($_POST['fechalec']) ? (int)$_POST['fechalec'] : 0;

        // Insertar lecturas en la tabla
        $sql = "INSERT INTO lecturas (caja,sensor1, sensor2, sensor3, sensor4, sensor5, fechabd) VALUES ($caja,$sensor1, $sensor2, $sensor3, $sensor4, $sensor5, NOW())";

        if ($conn->query($sql) === TRUE) {
            echo "lecturas insertados correctamente";
        } else {
            echo "Error al insertar lecturas: " . $conn->error;
        }
    
        // Cerrar conexión
        $conn->close();

