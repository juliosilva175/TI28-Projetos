<?php
include('conectadb.php');
include('topo.php');
// include('header.php');

// CONSULTA clientes CADASTRADOS
$sql = "SELECT * FROM tb_clientes WHERE cli_status = '1'";
         
$retorno = mysqli_query($link, $sql);
$status = '1';


//enviando para o servidor o seletor
if($_SERVER['REQUEST_METHOD'] == 'post'){
    $status = $_POST['status'];

    if($status
     =="1"){
        $sql = "SELECT * FROM tb_clientes WHERE Cli_status ='1'";
        $retorno = mysqli_query($link, $sql);

     }
     else{
        $sql = "SELECT * FROM tb_clientes WHERE cli_status ='0'";
        $retorno = mysqli_query($link, $sql);
     }
}


?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">
    <title>LISTA DE CLIENTES</title>
</head>
<body>
<a href="backoffice.php"><img src="icons/Navigation-left-01-256.png" width="25" height="25"></a>


    <div class="container-listaclientes">
        <!-- FAZER DEPOIS DO ROLÊ -->
        <form action="cliente-lista.php" method="post">
            <input type="radio" name="status" value="1" requerid onclick="submit()"
            <?= $status== '1' ? "checked" : "" ?>>Ativos
            <br>
            <input type="radio" name="status" value="0" required onclick="submit()"
            <?= $status=='0' ? "cheched" :""?>>INATIVOS
            <br>
        </form>
        <!-- LISTAR A TABELA Dos clientes -->
        <table class="lista">
            <tr>
                <th>CPF</th>
                <th>nome</th>
                <th>EMAIL</th>
                <th>STATUS</th>
                <th>ALTERAR</th>
            </tr>

            <!-- O CHORO É LIVRE! CHOLA MAIS -->
            <!-- BUSCAR NO BANCO OS DADOS Da lista dos clientes -->
             <?php
                while($tbl = mysqli_fetch_array($retorno)){
                 ?>
                 <tr>
                    <td><?=$tbl[1]?></td> <!-- COLETA O CPF DO clientes-->
                    <td><?=$tbl[2]?></td> <!-- COLETA O NOME DO clientes-->
                    <td><?=$tbl[3]?></td> <!-- COLETA O EMAIL DO clientes-->
                    <td><?=$tbl[4]?></td> <!-- coleta o status Do clientes-->
                    <td><?=$tbl[5] == '1'?"ATIVO" : "INATIVO" ?></td>
                    <td><a href="cliente-altera.php?id=<?=$tbl[5]?>">
                            <input type="button" value="ALTERAR">
                        </a>
                    </td>
                 </tr>
                 <?php
                }
                ?>
        </table>

    </div>
    
</body>
</html>