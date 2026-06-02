<?php
require_once 'config/database.php';

$mensaje = "";
$tipo_alerta = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST['nombre']);
    $correo = trim($_POST['correo']);

    if (!empty($nombre) && !empty($correo)) {
        $statusPostgres = false;
        $statusMongo = false;

        // 1. Insertar en PostgreSQL
        try {
            $pdo = Database::connectPostgres();
            $stmt = $pdo->prepare("INSERT INTO estudiantes (nombre, correo) VALUES (:nombre, :correo)");
            $statusPostgres = $stmt->execute([
                ':nombre' => $nombre,
                ':correo' => $correo
            ]);
        } catch (PDOException $e) {
            $mensaje .= "❌ Error en PostgreSQL: " . $e->getMessage() . " ";
        }

        // 2. Insertar en MongoDB Atlas (Respaldo)
        try {
            $collection = Database::connectMongo();
            $insertResult = $collection->insertOne([
                'nombre' => $nombre,
                'correo' => $correo,
                'fecha_respaldo' => new MongoDB\BSON\UTCDateTime()
            ]);
            if ($insertResult->getInsertedCount() > 0) {
                $statusMongo = true;
            }
        } catch (Exception $e) {
            $mensaje .= "❌ Error en MongoDB Atlas: " . $e->getMessage() . " ";
        }

        // 3. Evaluar el doble soporte
        if ($statusPostgres && $statusMongo) {
            $mensaje = "✅ ¡Estudiante registrado con éxito en AMBOS soportes (PostgreSQL y MongoDB Atlas)!";
            $tipo_alerta = "success";
        } elseif ($statusPostgres || $statusMongo) {
            $mensaje .= "⚠️ Registro parcial. No se pudo guardar en ambos sistemas.";
            $tipo_alerta = "warning";
        } else {
            $mensaje = "❌ Error crítico: El registro falló en ambos sistemas.";
            $tipo_alerta = "danger";
        }
    } else {
        $mensaje = "⚠️ Por favor, rellene todos los campos.";
        $tipo_alerta = "warning";
    }
    
    // Redirigir de vuelta con el mensaje
    header("Location: index.php?mensaje=" . urlencode($mensaje) . "&tipo=" . $tipo_alerta);
    exit();
}