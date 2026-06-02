<?php
require_once __DIR__ . '/../vendor/autoload.php';

class Database {
    // Conexión a PostgreSQL mediante PDO
    public static function connectPostgres() {
        try {
            // Render proporciona una variable llamada DATABASE_URL
            $dbUrl = getenv('DATABASE_URL');
            
            if ($dbUrl) {
                // Parsear la URL de Render para extraer credenciales
                $dbopts = parse_url($dbUrl);
                $dsn = sprintf("pgsql:host=%s;port=%d;dbname=%s", 
                    $dbopts["host"], 
                    $dbopts["port"], 
                    ltrim($dbopts["path"], '/')
                );
                $user = $dbopts["user"];
                $password = $dbopts["pass"];
            } else {
                // Configuración local por si acaso
                $dsn = "pgsql:host=localhost;port=5432;dbname=colegio";
                $user = "postgres";
                $password = "admin";
            }

            $pdo = new PDO($dsn, $user, $password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
            return $pdo;
        } catch (PDOException $e) {
            die("Error en PostgreSQL: " . $e->getMessage());
        }
    }

    // Conexión a MongoDB Atlas usando Composer
    public static function connectMongo() {
        try {
            // Variable de entorno personalizada en Render
            $mongoUri = getenv('MONGO_URI');
            if (!$mongoUri) {
                // URI local de prueba
                $mongoUri = "mongodb://localhost:27017";
            }
            
            $client = new MongoDB\Client($mongoUri);
            // Selecciona la base de datos y la colección
           // Como lo tienes en la imagen image_b9cedf.png:
          // Como lo tienes en la imagen image_b9cedf.png:
           return $client->selectCollection('colegio', 'estudiantes');
        } catch (Exception $e) {
            die("Error en MongoDB: " . $e->getMessage());
        }
    }
}