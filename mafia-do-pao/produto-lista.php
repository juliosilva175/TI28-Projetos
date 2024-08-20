<?php
include("conectadb.php");
include("topo.php");

// A Pagina carregou.... o que vai trazer

//Pesquisando no Banco  Todos os Produtos do banco
$sql ="SELET * FROM tb_produtos";
$retorno = mysqli_query($link, $sql);
$status ='1;'

//FUNÇÃO APÓS CLICK DO RADIO ATIVO E INATIVO
if ($_SERVER['REQUEST_METHOD'] == "POST"){
    $status = $_POST['status'];

    if($status == 1){
        $sql ="SELECT * FROM tb_produtos WHERE pro_status = '1'";
        $retorno = mysqli_query($link, $sql);
    }
    else{
        $sql ="SELECT * FROM tb_produtos WHERE pro_status = '0'";
        $retorno =mysqli_query($link, $sql); 
    }
}


?>




<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">
    <title>LISTA DE Produtos</title>
</head>
<body>


    <div class="container-produto">
        <!-- FAZER DEPOIS DO ROLÊ -->
        <form action="cliente-lista.php" method="post">
            <input type="radio" name="status" value="1" requerid onclick="submit()"
            <?= $status== '1' ? "checked" : "" ?>>Ativos
            <br>
            <input type="radio" name="status" value="0" required onclick="submit()"
            <?= $status=='0' ? "cheched" :""?>>INATIVOS
            <br>
        </form>
        <!-- LISTAR A TABELA Dos Produtos -->
        <table class="lista">
            <tr>
                <th>Nome Produto</th>
                <th>Quantidade</th>
                <th>Unidade</th>
                <th>Preco</th>
                <th>STATUS</th>
                <th>ALTERAR</th>
            </tr>

            <!-- O CHORO É LIVRE! CHOLA MAIS -->
            <!-- BUSCAR NO BANCO OS DADOS Da lista dos clientes -->
             <?php
                while($tbl = mysqli_fetch_array($retorno)){
                 ?>
                 <tr>
                    <td><?=$tbl[1]?></td> <!-- COLETA O CPF DO Produto-->
                    <td><?=$tbl[2]?></td> <!-- COLETA O NOME DO Quantidade-->
                    <td><?=$tbl[3]?></td> <!-- COLETA O EMAIL DO unidade-->
                    <td><?=$tbl[4]?></td> <!-- coleta o status Do Preço-->
                    <td><?=$tbl[5] == '1'?"ATIVO" : "INATIVO" ?></td>
                    <td><?=$tbl[6]?></td> <!-- coleta a ibagem-->
                    <td><img src='data:image/jpeg;base64,<?= $tbl[6]?>' width="200" height="200"></td>
                    <td><a href="produto-altera.php?id=<?=$tbl[0]?>">
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