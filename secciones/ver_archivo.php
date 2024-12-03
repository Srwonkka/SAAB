<?php
require_once __DIR__ . '/../db.php';

if (isset($_GET['txtID']) && !empty($_GET['txtID'])) {
    $id_archivo = $_GET['txtID'];

    // Obtener el archivo desde la base de datos
    $query = $conexion->prepare("SELECT a_archivo, a_blob FROM archivos WHERE id_archivo = :id_archivo");
    $query->bindParam(":id_archivo", $id_archivo);
    $query->execute();

    $archivo = $query->fetch(PDO::FETCH_ASSOC);

    if ($archivo) {
        $nombre = $archivo['a_archivo'];
        $contenido = $archivo['a_blob'];
        $tipo_mime = 'application/pdf'; // Ajusta según el tipo de archivo

        // Cabeceras para visualizar en el navegador
        header('Content-Type: ' . $tipo_mime);
        header('Content-Disposition: inline; filename="' . $nombre . '"');

        echo $contenido;
        exit;
    } else {
        echo "Archivo no encontrado.";
    }
} else {
    echo "No se ha especificado un archivo.";
}

?>