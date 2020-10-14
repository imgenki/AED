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
$codigosLiga = $base->query("SELECT codLiga FROM LIGAS")->fetchAll(PDO::FETCH_OBJ);

?>

    <h1>Autor Sergio<br>Equipos</h1>
<div>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
    
    <label for="nomEquipo">Nom. Equipo....</label>
    <input id="nomEquipo" name="nomEquipo" type="text" />

    <br>

    <label for="codLiga">Cod. Liga.... </label>
    <select id="codLiga" name="codLiga">
        <?php foreach($codigosLiga as $codLiga):?>
        <option value="<?php echo $codLiga->codLiga?>"><?php echo $codLiga->codLiga?></option>
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
    <button class="button" type="submit">Volver a la página principal</button>
    </form>
<?php
    if(isset($_POST["crea"])){

        $nomEquipo=$_POST["nomEquipo"];
        $codLiga=$_POST["codLiga"];
        $localidad=$_POST["localidad"];
        $internacional=(isset($_POST["internacional"])) ? 1 : 0;

        $sql="CALL ejerc_2(:nomEquipo, :codLiga, :localidad, :internacional, @LigaExiste, @InsercionCorrecta)";

        $result=$base->prepare($sql);

        $result->execute(array(':nomEquipo'=>$nomEquipo, ':codLiga'=>$codLiga, ':localidad'=>$localidad, ':internacional'=>$internacional));

        $result=$base->query("SELECT @LigaExiste as LigaExiste, @InsercionCorrecta as InsercionCorrecta");

        $row = $result->fetch();

        echo ($row['LigaExiste'] == 1) ? "La liga existe" : "La liga no existe; no se puede insertar";

        echo "<br>";

        echo ($row['InsercionCorrecta'] == 1) ? "La Inserción es Correcta" : "No se ha realizado la inserción"; 
    }
?>
</div>

</body>

</html>