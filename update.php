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
    $id = $_POST["codEquipo"];

    include("Conexion.php");
    
    if(!isset($_POST["modifica"])){

        $eqEditar = $base->query("SELECT * FROM EQUIPOS WHERE codEquipo='$id'");
        $eqEditar->setFetchMode(PDO::FETCH_OBJ);

        $codigosLiga = $base->query("SELECT codLiga,nomLiga FROM LIGAS")->fetchAll(PDO::FETCH_OBJ);

    }else{

        $nom=$_POST["nomEquipo"];
        $idL=$_POST["codLiga"];
        $loc=$_POST["localidad"];
        $inter=(isset($_POST["internacional"])) ? 1 : 0;

        $sql="UPDATE EQUIPOS set codEquipo=:id, nomEquipo=:nom, codLiga=:idL, localidad=:loc, internacional=:inter WHERE codEquipo=:id";
        
        $resultado=$base->prepare($sql);

        $resultado->execute(array(":id"=>$id, ":nom"=>$nom, ":idL"=>$idL, ":loc"=>$loc, ":inter"=>$inter));

        header("Location:tabla.php");
    }
?>

    <h1>Autor Sergio<br>Equipos</h1>

<div>
    
    <?php while ($row = $eqEditar->fetch()):?>

    <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">

    <label for="codEquipo">Cod. Equipo.... <?php echo $row->codEquipo ?></label>
    <input type="hidden" name="codEquipo" id="codEquipo" value="<?php echo $row->codEquipo ?>">

    <br>

    <label for="nomEquipo">Nom. Equipo....</label>
    <input id="nomEquipo" name="nomEquipo" type="text" value="<?php echo $row->nomEquipo ?>"></input>

    <br>

    <label for="codLiga">Cod. Liga.... </label>
    <select id="codLiga" name="codLiga">
        <?php foreach($codigosLiga as $codLiga):?>
        <option value="<?php echo $codLiga->codLiga?>"><?php echo $codLiga->nomLiga?></option>
        <?php endforeach?>
    </select>

    <br>

    <label for="localidad">Localidad....</label>
    <input id="localidad" name="localidad" type="text" value="<?php echo $row->localidad ?>"></input>

    <br>

    <label for="internacional">Internacional....</label>
    <input id="internacional" name="internacional" type="checkbox" <?php echo ($row->internacional == 1) ? "checked" : "";?>>
    </input>
    
    <br>

    <?php
    endwhile;
    ?>

    <button class="button" type="submit" name="modifica">Modifica Equipo</button>
    </form>

    <br>

    <form action="tabla.php" method="POST">
    <button class="button" type="submit">Cancela Modificacion</button>
    </form>

</div>

</body>

</html>