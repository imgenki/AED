<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sergio Rodriguez Rodriguez</title>
    <link rel="stylesheet" href="formato.css">
</head>
<body>

<?php
    $id = $_POST['codEquipo'];
    
    include("Conexion.php");

    if(isset($_POST["borra"])){ 
    
    $Id=$_POST["codEquipo"];
    $base->query("DELETE FROM EQUIPOS WHERE codEquipo='$id'");

    header("Location:tabla.php");

    }else{
    $registros = $base->query("SELECT codEquipo, nomEquipo, codLiga, localidad, internacional FROM EQUIPOS WHERE codEquipo='$id' ");
    $registros->setFetchMode(PDO::FETCH_OBJ);
    }
?>

<h1>Autor Sergio<br>Equipos</h1>
<div>
<?php while ($row = $registros->fetch()):?>

    <p>Cod. Equipo.... <?php echo $row->codEquipo ?></p>

    <p>Nom. Equipo.... <?php echo $row->nomEquipo ?></p>

    <p>Cod. Liga.... <?php echo $row->codLiga ?></p>

    <p>Localidad....<?php echo $row->localidad ?></p>

    <p>Internacional....<?php echo $row->internacional ?></p>

<?php
endwhile;
?>

    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
    <input type="hidden" name="codEquipo" value="<?php echo $id?>">
    <button class="button" type="submit" name="borra">Elimina Equipo</button>
    </form>

    <br>

    <form action="tabla.php"><button class="button" type="submit">Cancela Eliminar</button></form>
</div>
</body>
</html>