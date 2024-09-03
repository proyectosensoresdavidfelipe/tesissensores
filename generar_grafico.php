<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="60" />
    <title>Gráficos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h2>Gráficos de los sensores</h2>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <canvas id="sensor1-a"></canvas>
            </div>
            <div class="col-md-6">
                <canvas id="sensor1-b"></canvas>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <canvas id="sensor2-a"></canvas>
            </div>
            <div class="col-md-6">
                <canvas id="sensor2-b"></canvas>
            </div>
        </div>

         <div class="row">
            <div class="col-md-6">
                <canvas id="sensor3-a"></canvas>
            </div>
            <div class="col-md-6">
                <canvas id="sensor3-b"></canvas>
            </div>
        </div>        

        <div class="row">
            <div class="col-md-6">
                <canvas id="sensor4-a"></canvas>
            </div>
            <div class="col-md-6">
                <canvas id="sensor4-b"></canvas>
            </div>
        </div>    
       
        <div class="row">
            <div class="col-md-6">
                <canvas id="sensor5-a"></canvas>
            </div>
            <div class="col-md-6">
                <canvas id="sensor5-b"></canvas>
            </div>
        </div>          
        
    </div>


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

    /* realizamos las consultas a la bd */
        $sql1 = "SELECT sensor1 FROM lecturas ORDER BY id";
        $result1 = $conn->query($sql1);
        $sql2 = "SELECT sensor2 FROM lecturas ORDER BY id";
        $result2 = $conn->query($sql2);
        $sql3 = "SELECT sensor3 FROM lecturas ORDER BY id";
        $result3 = $conn->query($sql3);
        $sql4 = "SELECT sensor4 FROM lecturas ORDER BY id";
        $result4 = $conn->query($sql4);
        $sql5 = "SELECT sensor5 FROM lecturas ORDER BY id";
        $result5 = $conn->query($sql5);
    
    // Array para almacenar datos grafico1
        $datos1 = array();
        $labels1 = array();
        $contador1 = 0;

    // Array para almacenar datos grafico2
        $datos2 = array();
        $labels2 = array();
        $contador2 = 0;

    // Array para almacenar datos grafico3
        $datos3 = array();
        $labels3 = array();
        $contador3 = 0;
    
    // Array para almacenar datos grafico4
        $datos4 = array();
        $labels4 = array();
        $contador4 = 0;
    
    // Array para almacenar datos grafico5
        $datos5 = array();
        $labels5 = array();
        $contador5 = 0;    

    // Obtener datos de la consulta y guardarlos en el array para sensor1
        if ($result1->num_rows > 0) {
            while($row = $result1->fetch_assoc()) {
                $datos1[] = $row['sensor1'];  // llenamos arreglo con los datos de sensor1
                $labels1[] = $contador1;
                $contador1 = $contador1 + 1;   // llenamos arreglo con los labels
            }
        }

    // Obtener datos de la consulta y guardarlos en el array para sensor2
        if ($result2->num_rows > 0) {
            while($row = $result2->fetch_assoc()) {
                $datos2[] = $row['sensor2'];  // llenamos arreglo con los datos de sensor2
                $labels2[] = $contador2;
                $contador2 = $contador2 + 1;   // llenamos arreglo con los labels
            }
        }    

    // Obtener datos de la consulta y guardarlos en el array para sensor3
        if ($result3->num_rows > 0) {
            while($row = $result3->fetch_assoc()) {
                $datos3[] = $row['sensor3'];  // llenamos arreglo con los datos de sensor3
                $labels3[] = $contador3;
                $contador3 = $contador3 + 1;   // llenamos arreglo con los labels
            }
        }

    // Obtener datos de la consulta y guardarlos en el array para sensor4
        if ($result4->num_rows > 0) {
            while($row = $result4->fetch_assoc()) {
                $datos4[] = $row['sensor4'];  // llenamos arreglo con los datos de sensor4
                $labels4[] = $contador4;
                $contador4 = $contador4 + 1;   // llenamos arreglo con los labels
            }
        }

    // Obtener datos de la consulta y guardarlos en el array para sensor5
        if ($result5->num_rows > 0) {
            while($row = $result5->fetch_assoc()) {
                $datos5[] = $row['sensor5'];  // llenamos arreglo con los datos de sensor5
                $labels5[] = $contador5;
                $contador5 = $contador5 + 1;   // llenamos arreglo con los labels
            }
        }


    // Cerrar conexión
        $conn->close();
 
    // Convertir datos a formato JSON para JavaScript grafico sensor1
        $labels_json1 = json_encode($labels1);
        $datos_json1 = json_encode($datos1);

    // Convertir datos a formato JSON para JavaScript grafico sensor2
        $labels_json2 = json_encode($labels2);
        $datos_json2 = json_encode($datos2);

    // Convertir datos a formato JSON para JavaScript grafico sensor3
        $labels_json3 = json_encode($labels3);
        $datos_json3 = json_encode($datos3);
    
    // Convertir datos a formato JSON para JavaScript grafico sensor4
        $labels_json4 = json_encode($labels4);
        $datos_json4 = json_encode($datos4);
    
    // Convertir datos a formato JSON para JavaScript grafico sensor5
        $labels_json5 = json_encode($labels5);
        $datos_json5 = json_encode($datos5);    

    ?>

    <script>
    /* Configurar gráfico sensor1 barras */
        var ctx1 = document.getElementById('sensor1-a').getContext('2d');
            var myChart = new Chart(ctx1, {
                type: 'bar',
                data: {
                    labels: <?php echo $labels_json1; ?>,
                    datasets: [{
                        label: 'Sensor1',
                        data: <?php echo $datos_json1; ?>,
                        backgroundColor: [
                            'rgba(54, 162, 235, 0.5)',
                            'rgba(255, 99, 132, 0.5)'
                        ],
                        borderColor: [
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 99, 132, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            }); 


    /* Configurar gráfico sensor1 lineas */
        var ctx1a = document.getElementById('sensor1-b').getContext('2d');
                    var myChart2 = new Chart(ctx1a, {
                        type: 'line',
                        data: {
                            labels: <?php echo $labels_json1; ?>,
                            datasets: [{
                                label: 'Sensor1',
                                data: <?php echo $datos_json1; ?>,
                                borderColor: 'rgb(75, 192, 192)',
                                tension: 0.4
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });


    /* Configurar gráfico sensor2 barras */
        var ctx2 = document.getElementById('sensor2-a').getContext('2d');
            var myChart2 = new Chart(ctx2, {
                type: 'bar',
                data: {
                    labels: <?php echo $labels_json2; ?>,
                    datasets: [{
                        label: 'Sensor2',
                        data: <?php echo $datos_json2; ?>,
                        backgroundColor: [
                            'rgba(54, 162, 235, 0.5)',
                            'rgba(255, 99, 132, 0.5)'
                        ],
                        borderColor: [
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 99, 132, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            }); 


    /* Configurar gráfico sensor2 lineas */
        var ctx2 = document.getElementById('sensor2-b').getContext('2d');
                    var myChart2 = new Chart(ctx2, {
                        type: 'line',
                        data: {
                            labels: <?php echo $labels_json2; ?>,
                            datasets: [{
                                label: 'Sensor2',
                                data: <?php echo $datos_json2; ?>,
                                borderColor: 'rgb(75, 192, 192)',
                                tension: 0.4
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });


    /* Configurar gráfico sensor3 barras */
        var ctx3 = document.getElementById('sensor3-a').getContext('2d');
            var myChart3 = new Chart(ctx3, {
                type: 'bar',
                data: {
                    labels: <?php echo $labels_json3; ?>,
                    datasets: [{
                        label: 'Sensor3',
                        data: <?php echo $datos_json3; ?>,
                        backgroundColor: [
                            'rgba(54, 162, 235, 0.5)',
                            'rgba(255, 99, 132, 0.5)'
                        ],
                        borderColor: [
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 99, 132, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            }); 


    /* Configurar gráfico sensor3 lineas */
        var ctx3 = document.getElementById('sensor3-b').getContext('2d');
                    var myChart3 = new Chart(ctx3, {
                        type: 'line',
                        data: {
                            labels: <?php echo $labels_json3; ?>,
                            datasets: [{
                                label: 'Sensor3',
                                data: <?php echo $datos_json3; ?>,
                                borderColor: 'rgb(75, 192, 192)',
                                tension: 0.4
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });                
      

    /* Configurar gráfico sensor4 barras */
        var ctx4 = document.getElementById('sensor4-a').getContext('2d');
                var myChart4 = new Chart(ctx4, {
                    type: 'bar',
                    data: {
                        labels: <?php echo $labels_json4; ?>,
                        datasets: [{
                            label: 'Sensor4',
                            data: <?php echo $datos_json4; ?>,
                            backgroundColor: [
                                'rgba(54, 162, 235, 0.5)',
                                'rgba(255, 99, 132, 0.5)'
                            ],
                            borderColor: [
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 99, 132, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                }); 


    /* Configurar gráfico sensor4 lineas */
        var ctx4 = document.getElementById('sensor4-b').getContext('2d');
                    var myChart4 = new Chart(ctx4, {
                        type: 'line',
                        data: {
                            labels: <?php echo $labels_json4; ?>,
                            datasets: [{
                                label: 'Sensor4',
                                data: <?php echo $datos_json4; ?>,
                                borderColor: 'rgb(75, 192, 192)',
                                tension: 0.4
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });                

    /* Configurar gráfico sensor5 barras */
        var ctx5 = document.getElementById('sensor5-a').getContext('2d');
                var myChart5 = new Chart(ctx5, {
                    type: 'bar',
                    data: {
                        labels: <?php echo $labels_json5; ?>,
                        datasets: [{
                            label: 'Sensor5',
                            data: <?php echo $datos_json5; ?>,
                            backgroundColor: [
                                'rgba(54, 162, 235, 0.5)',
                                'rgba(255, 99, 132, 0.5)'
                            ],
                            borderColor: [
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 99, 132, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                }); 


    /* Configurar gráfico sensor5 lineas */
        var ctx5 = document.getElementById('sensor5-b').getContext('2d');
                    var myChart5 = new Chart(ctx5, {
                        type: 'line',
                        data: {
                            labels: <?php echo $labels_json5; ?>,
                            datasets: [{
                                label: 'Sensor5',
                                data: <?php echo $datos_json5; ?>,
                                borderColor: 'rgb(75, 192, 192)',
                                tension: 0.4
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });                


    </script>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>
