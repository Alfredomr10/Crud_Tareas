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

<body class="">
<?php include("Conexion.php");
$registros=$base->query("SELECT * FROM tarea")->fetchAll(PDO::FETCH_OBJ);

if (isset ($_POST["cr"])){
$nombre=$_POST["Nom"];
$descripcion=$_POST["Des"];
$sql="INSERT INTO tarea (nombre, descripcion) VALUES(:nom, :des)";
$resultado=$base->prepare($sql);
$resultado->execute(array(":nom"=>$nombre, ":des"=>$descripcion));
header("Location:index.php");
}
?>

<h1 class="text-center">Tareas Pendientes</h1>
<form action="<?php echo $_SERVER['PHP_SELF'];?>"method="post" ?>
  <table  border="0" align="center">
    <tr class="table-primary">
      <td >Nombre</td>
      <td >Descripcion</td>
      
    </tr> 
   <?php foreach($registros as $tareas): ?>
		
   	<tr class="table-secondary">
      <td><?php echo $tareas->nombre?> </td>
      <td><?php echo $tareas->descripcion?></td>
     
 
      <td><a href="borrar.php?nombre=<?php echo $tareas->nombre ?>"><input  class="btn btn-success" type='button' name='del' id='del' value='Terminada!!'></a></td>
      <td ><input class="btn btn-secondary" type='button' name='up' id='up' value='Actualizar'></a></td>
    </tr>   
    <?php endforeach ?>    
	<tr>
	
      <td><input type='text' name='Nom' size='10' class='centrado'></td>
      <td><input type='text' name=' Des' size='10' class='centrado'></td>
      <td ><input class="btn btn-primary" type='submit' name='cr' id='cr' value='Nueva tarea'></td></tr> 
         
  </table>
</form>
<p>&nbsp;</p>
</body>
</html>