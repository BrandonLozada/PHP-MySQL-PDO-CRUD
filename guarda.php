<?php 
require 'config/database.php';

$db = new Database();
$con = $db->conectar();

$nuevo = false;
$modificado = false;

if (isset($_POST['id'])) {
    
    $id = $_POST['id'];
    $codigo = $_POST['codigo'];
    $descripcion = $_POST['descripcion'];
    $stock = $_POST['stock'];
    $inventariable = isset($_POST['inventariable']) ? $_POST['inventariable'] : 0;
    
    if ($stock == '') {
        $stock = 0;
    }

    $query = $con->prepare("UPDATE productos SET codigo=?, descripcion=?, inventariable=?, stock=? WHERE id=?");
    $resultado = $query->execute(array($codigo, $descripcion, $inventariable, $stock, $id));

    if ($resultado) {
        $modificado = true;
    }

} else {
    $codigo = $_POST['codigo'];
    $descripcion = $_POST['descripcion'];
    $stock = $_POST['stock'];
    $inventariable = isset($_POST['inventariable']) ? $_POST['inventariable'] : 0;

    if ($stock == '') {
        $stock = 0;
    }

    $query = $con->prepare("INSERT INTO productos (codigo, descripcion, inventariable, stock, activo) VALUES (:cod, :descr, :inv, :sto, 1)");
    $resultado = $query->execute(array('cod' => $codigo,
                                        'descr' => $descripcion,
                                        'inv' => $inventariable ,
                                        'sto' => $stock));

    if ($resultado) {
        $nuevo = true;
    }                                   
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
</head>

<body class="py-3">
    <main class="container contenedor">
        <div class="p-3 rounded">
            <div class="row">
                <div class="col">
                    <?php if ($nuevo) { ?>
                        <h3>Registro guardado</h3>
                    <?php } elseif ($modificado) { ?>
                        <h3>Registro modificado</h3>
                    <?php } else { ?>
                        <h3>Error al guardar</h3>
                    <?php } ?>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <a class="btn btn-primary" href="index.php">Regresar</a>
                </div>
            </div>

        </div>
    </main>
</body>
</html>