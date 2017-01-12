<?php
/**
 * Created by PhpStorm.
 * User: PLLARENA
 * Date: 07/01/2017
 * Time: 9:27
 */
include_once ("../Modelos/cat_clientes.php");
$oCliente = new cat_clientes();
$arrCli =  $oCliente->buscarTodos();
?>
<html>
<head>
    <title>Prueba de Consulta</title>
</head>
<body>
    <table>
        <tr>
            <td>
                Id Cliente
            </td>
            <td>
                Nombre
            </td>
        </tr>
        <?php
            foreach ($arrCli as $vRow){
                ?>
                <td><?php echo $vRow->getIdCliente();?></td>
                <td><?php echo $vRow->getNom1();?></td>
        <?php
            }
        ?>
    </table>
</body>
</html>
