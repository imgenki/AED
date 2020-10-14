<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sergio Rodriguez Rodriguez</title>
    <link rel="stylesheet" href="formato.css">
</head>

<body>
    
<?php
include("Conexion.php");
    if(isset($_POST["crea"])){

        $id="null";
        $nom=$_POST["nomEquipo"];
        $idL=$_POST["codLiga"];
        $loc=$_POST["localidad"];
        $inter=(isset($_POST["internacional"])) ? 1 : 0;
        
        $sql="INSERT INTO EQUIPOS VALUES (:id, :nom, :idL, :loc, :inter)";
        
        $resultado=$base->prepare($sql);

        $resultado->execute(array(":id"=>$id, ":nom"=>$nom, ":idL"=>$idL, ":loc"=>$loc, ":inter"=>$inter));

        header("Location:tabla.php");

    }else{

    $codigosLiga = $base->query("SELECT nomLiga,codLiga FROM LIGAS")->fetchAll(PDO::FETCH_OBJ);

    }

?>

    <h1>Autor Sergio<br>Equipos</h1>
<div>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
    
    <label for="nomEquipo">Nom. Equipo....</label>
    <input id="nomEquipo" name="nomEquipo" type="text" />

    <br>

    <label for="codLiga">Nom. Liga.... </label>
    <select id="codLiga" name="codLiga">
        <?php foreach($codigosLiga as $codLiga):?>
        <option value="<?php echo $codLiga->codLiga?>"><?php echo $codLiga->nomLiga?></option>
        <?php endforeach?>
    </select>

    <br>

    <label for="localidad">Localidad....</label>
    <input id="localidad" name="localidad" type="text" />

    <br>

    <label for="internacional">Internacional....</label>
    <input id="internacional" name="internacional" type="checkbox" />
    
    <br>

    <button class="button" type="submit" name="crea">Crea Equipo</button>
    </form>

    <br>

    <form action="tabla.php" method="POST">
    <button class="button" type="submit">Cancela Creacion</button>
    </form>
</div>
</body>

</html>