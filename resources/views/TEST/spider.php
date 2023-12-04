<!DOCTYPE html>
<html>
<head>
    <title>Diagrama de Telaraña</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

    <canvas id="radarChart" width="500" height="500"></canvas>
    <?php
    // Conexión a la base de datos
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "laravel";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificación de la conexión
    if($conn->connect_error) {
        die("Conexión fallida: " + $conn->connect_error);
    }

    // Consulta a la base de datos para obtener los datos necesarios
    $sql = "SELECT etiqueta, valor FROM datos";
    $result = $conn->query($sql);

    // Crear arrays para etiquetas y valores
    $labels = array();
    $values = array();

    // Obtener los datos de la consulta y almacenarlos en los arrays
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            array_push($labels, $row["etiqueta"]);
            array_push($values, $row["valor"]);
        }
    }

    // Cerrar la conexión a la base de datos
    $conn->close();
    ?>

    <script>
        var ctx = document.getElementById('radarChart').getContext('2d');
        var myRadarChart = new Chart(ctx, {
            type: 'radar',
            data: {
                labels: <?php echo json_encode($labels); ?>,
                datasets: [{
                    label: 'Datos',
                    data: <?php echo json_encode($values); ?>,
                    backgroundColor: 'rgba(192, 192, 192, 0.2)',
                    borderColor: 'blue',
                    borderWidth: 1
                }]
            },
            options: {
                maintainAspectRatio: false, // Desactivar el mantenimiento del aspect ratio
                responsive: true,
                width: 100, // Definir el ancho deseado del gráfico
                height: 100, // Definir la altura deseada del gráfico
                pointLabels: {
                            display: false // Ocultar los números de visibilidad en los puntos
                        },
                
                elements: {
                    point: {
                        radius: 0, // Tamaño de los puntos
                        hitRadius: 5,
                        hoverRadius: 4,
                        hoverBorderWidth: 2
                    }
                },
                scales: {
                    r: {
                        pointLabels: {
                            display: false
                        },
                        grid: {
                            color: 'gray' // Cambiar el color de las líneas del gráfico
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>