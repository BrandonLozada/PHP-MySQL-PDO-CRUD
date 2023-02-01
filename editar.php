<?php
require 'config/database.php';

$db = new Database();
$con = $db->conectar();
$id = $_GET['id'];

$sql = "SELECT codigo, descripcion, inventariable, stock FROM productos WHERE id = :id";
$query = $con->prepare($sql);
$query->execute(array(':id' => $id));

//$resultado = $query->fetchAll();
$resultado = $query->fetch(PDO::FETCH_ASSOC);

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
                    <h4>Modificar producto</h4>

                    <form class="row g-3" method="POST" action="guarda.php" autocomplete="off">
                        <input type="hidden" id="id" name="id" value="<?php echo $id; ?>">

                        <div class="col-md-12">
                            <label for="codigo" class="form-label">Código</label>
                            <input type="text" id="codigo" name="codigo" class="form-control"
                                value="<?php echo $resultado['codigo']; ?>" required autofocus>
                        </div>

                        <div class="col-md-12">
                            <label for="descripcion" class="form-label">Descripción: </label>
                            <input type="text" id="descripcion" name="descripcion" class="form-control"
                                value="<?php echo $resultado['descripcion']; ?>" required>
                        </div>

                        <h5>Inventario</h5>
                        <div class="col-md-12">

                            <label for="inventariable" class="form-check-label">¿Usa inventario?</label>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="inventariable" name="inventariable"
                                    value="1" <?php if ($resultado['inventariable']) {echo 'checked';}?>>
                            </div>

                        </div>

                        <div class="col-md-12">
                            <label for="stock" class="form-label">Existencias</label>
                            <input type="number" id="stock" name="stock" class="form-control"
                                value="<?php echo $resultado['stock']; ?>">
                        </div>

                        <div class="col-md-12 d-flex justify-content-sm-between pt-3">
                            <a class="btn btn-secondary" href="index.php">Regresar</a>
                            <button type="submit" class="btn btn-primary" name="registro">Modificar</button>
                        </div>
                    </form>

                </div>
            </div>
</body>

</html>