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

        echo ($row['InsercionCorrecta'] == 1) ? "La Insercion es Correcta" : "No se ha realizado la insercion"; 

        //header("Location:tabla.php");
    }

?>

    <h1>Autor Sergio<br>Equipos</h1>
<div>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
    
    <label for="nomEquipo">Nom. Equipo....</label>
    <input id="nomEquipo" name="nomEquipo" type="text" />

    <br>

    <label for="codLiga">Cod. Liga.... </label>
    <input type="text" id="codLiga" name="codLiga">
    </input>

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