<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>CRUD</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<!doctype html>
</head>
<body>

<h1 class="text-center">Actualizar tarea</h1>
<?php 

include ("Conexion.php");

if (!isset($_POST["bot_actualizar"])){

$nom=$_GET["nom"];
$des=$_GET["des"];

}else{

$nom=$_POST["nom"];
$des=$_POST["des"];

$sql="UPDATE tarea SET nombre=:miNom, descripcion=:miDes Where nombre=:miNom";
$resultado=$base->prepare($sql);
$resultado->execute(array(":miNom"=>$nom, ":miDes"=>$des));

header("Location:Index.php");
}

?>

<form name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  <table  border="0" align="center">
   
    <tr  class="table-secondary">
      <td>Nombre de la tarea</td>
      <td><label for="nom"></label>
      <input type="text" name="nom" id="nom" value="<?php echo $nom ?>"></td>
    </tr>
    <tr  class="table-secondary">
      <td>Nueva descripcion </td>
      <td><label for="des"></label>
      <input type="text" name="des" id="des" value="<?php echo $des ?>"></td>
    </tr>
 <br>
    <tr>
      <td colspan="2"><input class="btn btn-primary" type="submit" name="bot_actualizar" id="bot_actualizar" value="Actualizar tarea"></td>
    </tr>
  </table>
</form>
<p>&nbsp;</p>
</body>
</html>