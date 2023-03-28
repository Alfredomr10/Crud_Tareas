<?php
include ("conexion.php");
$Id=$_GET["Id"];
$base->query("DELETE FROM DATOS_USUARIOS WHERE ID='$Id'");
HEADER("Location:index.php");
?>