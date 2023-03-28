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
        header("Location:indexAJAX.php");
    } else {
        echo "<script>alert('No se a podido agregar la tarea, ingrese un nombre para la tarea para poder añadirla');</script>";
    }
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
    </td>
      <td><a href="actualizar.php?nom=<?php echo $tareas->nombre?>& des=<?php echo $tareas->descripcion?>"><input id="actualizar-btn" class="btn-secondary" type='button' name='up' value='Actualizar descripcion'></a></td>
    </tr>   
    <?php endforeach ?>    
	<tr>
	
      <td><input type='text' name='Nom' size='10' ></td>
      <td><input type='text' name=' Des' size='10'></td>
      <td ><input class="btn btn-primary" type='submit' name='cr' id='cr' value='Nueva tarea'></td></tr> 
  </table>
</form>
<script>
    var form = document.querySelector('form');
form.addEventListener('submit', function(event) {
    // Evitar que se envíe el formulario de forma predeterminada
    event.preventDefault();

    // Obtener los datos del formulario
    var nombre = document.querySelector('input[name="Nom"]').value;
    var descripcion = document.querySelector('input[name="Des"]').value;

    // Enviar los datos del formulario a través de AJAX
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // Actualizar la tabla con los nuevos datos
            var table = document.querySelector('table');
            var newRow = table.insertRow(-1);
            newRow.classList.add('table-secondary');
            newRow.innerHTML = '<td>' + nombre + '</td><td>' + descripcion + '</td><td><a href="borrar.php?nombre=' + nombre + '"><input class="btn btn-success" type="button" name="del" id="del" value="Terminada!!"></a></td><td><a href="actualizar.php?nom=' + nombre + '&des=' + descripcion + '"><input id="actualizar-btn" class="btn-secondary" type="button" name="up" value="Actualizar descripcion"></a></td>';

            // Limpiar los campos del formulario
            document.querySelector('input[name="Nom"]').value = '';
            document.querySelector('input[name="Des"]').value = '';

            // Mostrar una alerta si la tarea se agregó exitosamente
            alert('Tarea agregada');
        }
    };
    xhttp.open('POST', 'agregar.php', true);
    xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhttp.send('Nom=' + nombre + '&Des=' + descripcion);
});

// Obtener los botones para eliminar tareas terminadas
var deleteButtons = document.querySelectorAll('a[href^="borrar.php"]');
for (var i = 0; i < deleteButtons.length; i++) {
    deleteButtons[i].addEventListener('click', function(event) {
        // Evitar que se abra la página de borrar.php
        event.preventDefault();

        // Obtener el enlace del botón y eliminar la tarea correspondiente
        var link = this.getAttribute('href');
        var row = this.parentNode.parentNode;
        row.parentNode.removeChild(row);

        // Mostrar una alerta cuando se elimine una tarea terminada
        alert('Tarea terminada');
        
        // Enviar una solicitud de eliminación a través de AJAX
        var xhttp = new XMLHttpRequest();
        xhttp.open('GET', link, true);
        xhttp.send();
    });
}

// Obtener los botones para actualizar la descripción de una tarea
var actualizarButtons = document.querySelectorAll('input[name="up"]');
for (var i = 0; i < actualizarButtons.length; i++) {
    actualizarButtons[i].addEventListener('click', function(event) {
        // Mostrar una alerta cuando se intente actualizar la descripción de una tarea
        alert('¡ATENCIÓN!: No se puede cambiar el nombre al actualizar ya que es su id');
    });
}
</script>
</body>
</html>