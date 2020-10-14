<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="formato.css">
</head>

<body>

<?php

    include 'Conexion.php';

    $registros = $base->query("SELECT codEquipo, nomEquipo, codLiga, localidad, internacional FROM EQUIPOS")->fetchAll(PDO::FETCH_OBJ);

?>
    <h1>Autor Sergio<br>Equipos</h1>
    <table>
        <tr>
            <th>codEquipo</th>
            <th>nomEquipo</th>
            <th>codLiga</th>
            <th>localidad</th>
            <th>internacional</th>
            <th>Borrado</th>
            <th>Modificación</th>
        </tr>

<?php foreach($registros as $equipos):?>
    
    <tr>
    <td class="Fila1"><?php echo $equipos->codEquipo ?></td>
    <td class="Fila1"><?php echo $equipos->nomEquipo ?></td>
    <td class="Fila1"><?php echo $equipos->codLiga ?></td>
    <td class="Fila1"><?php echo $equipos->localidad ?></td>
    <td class="Fila1"><?php echo $equipos->internacional ?></td>
    
    <td class="bot">
        <form action="delete.php" method="POST" >
        <input type="hidden" name="codEquipo" id="codEquipo" value="<?php echo htmlspecialchars($equipos->codEquipo);?>"/>
        <button type="sumbit" name="Borrar" id="borrar">Borrar</button>
        </form>
    </td>
    <td class="bot">
        <form action="update.php" method="POST">
        <input type="hidden" value="<?php echo htmlspecialchars($equipos->codEquipo);?>" name="codEquipo">
        <button type="sumbit" id="borrar">Modificar</button>
        </form>
    </td>
</tr>
<?php

endforeach;

?>
    </table>

    <p class=num>Número de Equipos: <?php echo sizeof($registros)?></p>
    <div class="bot">
    <form action="insertProc.php" method="POST">
        <button type="sumbit">Alta Equipos</button>
    </form>

    </div>

</body>

</html>