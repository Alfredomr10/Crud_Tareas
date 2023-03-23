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
     
 
      <td><a href="borrar.php?nombre=<?php echo $tareas->nombre ?>"><input  class="btn btn-success" type='button' name='del' id='del' value='Terminada!!'></a>
      
</script>
    </td>
      <td><a href="actualizar.php?nom=<?php echo $tareas->nombre?>& des=<?php echo $tareas->descripcion?>"><input class="btn-secondary" type='button' name='up' id='up' value='Actualizar'></a></td>
    </tr>   
    <?php endforeach ?>    
	<tr>
	
      <td><input type='text' name='Nom' size='10' ></td>
      <td><input type='text' name=' Des' size='10'></td>
      <td ><input class="btn btn-primary" type='submit' name='cr' id='cr' value='Nueva tarea'></td></tr> 
         
  </table>
</form>
<script>
    // Obtener el formulario y añadir un listener para el evento "submit"
    var form = document.querySelector('form');
    form.addEventListener('submit', function(event) {
        // Mostrar una alerta si la tarea se agregó exitosamente
        alert('Tarea agregada correctamente');
    });
    
    // Obtener los botones para eliminar tareas terminadas
    var deleteButtons = document.querySelectorAll('a[href^="borrar.php"]');
    for (var i = 0; i < deleteButtons.length; i++) {
        deleteButtons[i].addEventListener('click', function(event) {
            // Mostrar una alerta cuando se elimine una tarea terminada
            if (!confirm('¿Está seguro de que desea dar por terminada esta tarea?')) {
                event.preventDefault();
            }
        });
    }
</script>
</script>
<p>&nbsp;</p>
</body>
</html>