<?php
include('conectadb.php');
include('topo.php');
// include('header.php');

// CONSULTA USUARIOS CADASTRADOS
$sql = "SELECT  usu_login, usu_email, usu_status, usu_id 
        FROM tb_usuarios WHERE usu_status = '1'";
$retorno = mysqli_query($link, $sql);
$status = '1';

// ENVIANDO PARA O SERVIDOR O SELETOR RADIO EM 0 OU 1
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $status = $_POST['status'];

    if($status == '1'){
        $sql = "SELECT usu_login, usu_email, usu_status, usu_id  FROM tb_usuarios WHERE usu_status = '1'";
        $retorno = mysqli_query($link, $sql);
    }
    else{
        $sql = "SELECT usu_login, usu_email, usu_status, usu_id  FROM tb_usuarios WHERE usu_status = '0'";
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
    <title>LISTA DE USUARIOS</title>
</head>
<body>
<a href="backoffice.php"><img src="icons/Navigation-left-01-256.png" width="25" height="25"></a>

    <div class="container-listausuarios">
        <!-- LISTAR ATIVOS E INATIVOS -->
        <form action="usuario-lista.php" method="post">
                <input type="radio" name="status" value="1" required onclick="submit()"
                <?= $status=='1' ? "checked":""?>>ATIVOS
                <br>
                <input type="radio" name="status" value="0" required onclick="submit()"
                <?= $status=='0' ? "checked":""?>>INATIVOS
                <br>
        </form>
        
        

        
        <!-- LISTAR A TABELA DE USUARIOS -->
        <table class="lista">
            <tr>
                <th>LOGIN</th>
                <th>EMAIL</th>
                <th>STATUS</th>
                <th>ALTERAR</th>
            </tr>

            <!-- O CHORO É LIVRE! CHOLA MAIS -->
            <!-- BUSCAR NO BANCO OS DADOS DE TODOS OS USUARIOS -->
             <?php
                while($tbl = mysqli_fetch_array($retorno)){
                 ?>
                 <tr>
                    <td><?=$tbl[0]?></td> <!-- COLETA O NOME DO USUARIO-->
                    <td><?=$tbl[1]?></td> <!-- COLETA O EMAIL DO USUARIO-->
                    <td><?=$tbl[2]?></td> <!-- COLETA O STATUS DO USUARIO-->
                    <td><a href="usuario-altera.php?id=<?=$tbl[3]?>">
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