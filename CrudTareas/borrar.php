<?php
include("conexion.php");
$nombre=$_GET["nombre"];
$base->query("DELETE FROM tarea WHERE nombre='$nombre'");
header("Location: Index.php");
?>