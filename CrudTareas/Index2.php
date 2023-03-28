<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>CRUD</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
<?php 
include("Conexion.php");

$registros=$base->query("SELECT * FROM tarea")->fetchAll(PDO::FETCH_OBJ);

if (isset($_POST["cr"])){
    $nombre=$_POST["Nom"];
    $descripcion=$_POST["Des"];
    if (!empty($nombre)) {
        $sql="INSERT INTO tarea (nombre, descripcion) VALUES(:nom, :des)";
        $resultado=$base->prepare($sql);
        $resultado->execute(array(":nom"=>$nombre, ":des"=>$descripcion));
        header("Location:index2.php");
    } else {
        echo "<script>alert('No se a podido agregar la tarea, ingrese un nombre para la tarea para poder añadirla');</script>";
    }
}

if (isset($_POST["terminar"])){
    $nombre=$_POST["Nom"];
    $sql="DELETE FROM tarea WHERE nombre=:nom";
    $resultado=$base->prepare($sql);
    $resultado->execute(array(":nom"=>$nombre));
}

if (isset($_POST["actualizar"])){
    $nombre=$_POST["Nom"];
    $descripcion=$_POST["Des"];
    $sql="UPDATE tarea SET descripcion=:des WHERE nombre=:nom";
    $resultado=$base->prepare($sql);
    $resultado->execute(array(":nom"=>$nombre, ":des"=>$descripcion));
}

?>

<h1 class="text-center">Tareas Pendientes</h1>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" id="form-tarea">
    <table border="0" align="center">
        <tr class="table-primary">
            <td>Nombre</td>
            <td>Descripcion</td>
            <td></td>
            <td></td>
        </tr>
        <?php foreach($registros as $tareas): ?>
        <tr class="table-secondary">
            <td><?php echo $tareas->nombre?></td>
            <td><span id="descripcion_<?php echo $tareas->nombre ?>"><?php echo $tareas->descripcion?></span></td>
            <td>
                <button class="btn btn-success btn-terminar" data-nombre="<?php echo $tareas->nombre ?>">Terminada!!</button>
            </td>
            <td>
                <button class="btn btn-secondary btn-actualizar" data-nombre="<?php echo $tareas->nombre ?>" data-descripcion="<?php echo $tareas->descripcion ?>">Actualizar descripcion</button>
            </td>
        </tr>
        <?php endforeach ?>
        <tr>
            <td><input type='text' name='Nom' size='10' ></td>
            <td><input type='text' name='Des' size='10'></td>
            <td><button class="btn btn-primary" type='submit' name='cr' id='cr' value='Nueva tarea'>Nueva tarea</button></td>
            <td></td>
        </tr>
    </table>
        </form>
</body></html>