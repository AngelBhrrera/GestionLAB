<?php
// Verificar si la solicitud es de tipo POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = $_POST['id'];
    $nuevoEstado = $_POST['nuevoEstado'];

    $estadosPermitidos = ['autorizado', 'pendiente', 'denegado'];
    if (!in_array($nuevoEstado, $estadosPermitidos)) {
        echo json_encode(['error' => 'Estado no válido']);
        exit;
    }

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "gestest2";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Actualizar el estado en la base de datos
    $sql = "UPDATE registros_checkin SET estado = '$nuevoEstado' WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(['success' => 'Actualización exitosa']);
    } else {
        echo json_encode(['error' => 'Error en la actualización: ' . $conn->error]);
    }

    // Cerrar la conexión a la base de datos
    $conn->close();
} else {
    echo json_encode(['error' => 'Método no permitido']);
}
?>
