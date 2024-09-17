<?php
include("conectadb.php");
include("topo.php");
#PESQUISA DA VENDA GERAL

#Pesquisa a data minima e maxima para os filtors

$selectdatamin = "SELECT MIN(ven_datavenda) FROM tb_venda";
$selectdatamax = "SELECT MAX(ven_datavenda) FROM tb_venda";

$resultado_data_min = mysqli_query($link,$selectdatamin);
$resultado_data_max = mysqli_query($link,$selectdatamax);

$data_min = mysqli_fetch_array($resultado_data_min);
$data_max = mysqli_fetch_array($resultado_data_max);

//Configurando a data para que o html mostre bonitinho

$data_min_string = date("Y-m-d", strtotime($data_min[0]));
$data_min_string = date("Y-m-d", strtotime($data_max[0]));

#Pesquisa os Clientes para o filtors
$sqlcli = "SELECT cli_id, cli_nome FROM tb_clientes";
$retornocli = mysqli_query($link,$sqlcli);

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $idcliente = $_POST['idcliente'];
    $datainicial = $_POST['datainicial'];
    $datafinal = $_POST['datafinal'];

#Pesquisa da Venda Geral
if($datainicial <0){
    $datainicial = $data_min_string;
}
if ($datafinal <0){
    $datafinal = $data_max_string;
}

$sql = "SELECT  v.ven_id, v.ven_datavenda, v.ven_totalvenda, v.fk_iv_cod_iv, v.fk_cli_id, v.fk_usu_id, C.CLI_nome, u.usu_login
        FROM 
        tb_venda V
        JOIN 
        tb_clientes c ON v.fk_cli_id = c.cli_id
        JOIN 
        tb_usuarios u ON v.fk_usu_id = u.usu_id
        WHERE
        ven_datavenda BETWEEN '$datainicial 0:0:0' AND '$datafinal 23:59:59'";

        #PESQUISA VALOR TOTAL
      //  $retorno = mysqli_query($link ,$sql. "ORDER BY v.ven_id");
        $valortotal = "SELECT SUM(ven_totalvenda) FROM tb_venda WHERE
        ven_datavenda BETWEEN '$datainicial 0:0:0' AND '$datafinal 23:59:59'";
      //  $retornonovalortotal = mysql_query($link, $valortotal);

      if ($idcliente == 'todos'){
          $retorno = mysqli_query($link, $valortotal. "ORDER BY v.ven_id");
          $retornovalortotal =mysqli_query($link, $valortotal . "ORDER BY v.ven_id");

      }else{
            //adicionar ao 'sql' a condição de pesquisa ao nome
            $sql =" AND c.cli_id = ". $idcliente ."ORDER BY ven_id";
            $retorno =mysqli_query($link,$valortotal);

            $valortotal = "AND fk.cli_id =". $idcliente ." ORDER BY ven_id";
            $retornovalortotal = mysqli_query($link, $valortotal);
        } 

    }else{
            $sql = "SELECT  v.ven_id, v.ven_datavenda, v.ven_totalvenda, v.fk_iv_cod_iv, v.fk_cli_id, v.fk_usu_id, C.CLI_nome, u.usu_login
            FROM 
            tb_venda V
            JOIN 
            tb_clientes c ON v.fk_cli_id = c.cli_id
            JOIN 
            tb_usuarios u ON v.fk_usu_id = u.usu_id";
            $retorno = mysqli_query($link, $sql. " ORDER BY ven_id");
             $valortotal = "SELECT SUM(ven_totalvenda) FROM tb_venda";
             $retornovalortotal =mysqli_query($link, $valortotal);




    }
?>
    
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">

    <title>Venda-Lista</title>
</head>
<body>
    
    <div class="container-global">
        <!-- LISTAR ATIVOS E INATIVOS -->
        <form class="formulario" action="venda-lista.php" methhod = "post">
                <label>VALOR TOTAL BRUTO</label>
                 <!-- PHP PARA RETORNAR A SOMA DO VALOR TOTAL -->
                <?php
                while ($tblvalortotal = mysqli_fetch_array($retornovalortotal)){
                    echo "R$". $tblvalortotal[0];

                }?>
                <br>
                <br>
                <label>FILTROS</label>
                <br>
                <!-- FILTRO DE DATA MINIMA E MAXIMA -->
                <label for="data">SELECIONE A DATA INICIAL:</label>
                <input id="datainicial" name="datainicial" min="<?=$data_min_string?>" max="<?=$data_max_string?>" type="data">
                <label for="data">SELECIONE A DATA FINAL:<label>
                <input id="datafinal" nome="datafinal" min="<?=$data_min_string?>" max="<?=$data_max_string?>" type="date">
                 
                <!-- <-- FILTRO PARA PEASQUISA DE CLIENTE -->
                <label>SELECIONE O CLIENTE:</label>
                
                <select name='idcliente'>
                    <option value="todos">TODOS</option>
                    <?php WHILE ($tblcli = mysqli_fetch_array($retornocli)){
                    ?>
                    <option value="<?= $tblcli[0]?>"><?=strtoupper($tblcli[1])?></option>
               <?php    
                } ?>
                </select>
                <br>
                <input type="submit" value="PESQUISAR">
                </form>
                </div>
            <br>
            <!-- listar a tebela de produtos -->
             <div class="container-listaproduto">
                <table class="lista">    
                 <tr>
                   <th>ID</th>
                   <th>DATA e HORA</th>
                   <th>VALOR</th>
                   <th>CLIENTE</th>
                   <th>VENDEDOR</th>
                   <th>VISUALIZAR</th>
                </tr>
                <!-- buscar no banco os dados de todos os usuarioas -->

            <?php
            while($tbl = mysqli_fetch_array($retorno)){
                ?>
            <tr>
                <td><?=$tbl[0]?></td> <!-- coleta o id-->
                 <?php $data_formatada = date("d/m/y h:i", strtotime($tbl[1]));?>
                 <!-- formatar a data para formato pt.br-->
                 <td><?=$data_formatada?></td> <!--coleta o data-->
                 <td>R$: <?=$tbl[2]?></td> <!-- coleta o tota-->
                 <td><?=$tbl[6]?></td> <!-- coleta o cliente-->
                 <td><?=$tbl[7]?></td> <!-- coleta o usuario-->
                 <td><a href="venda-visualizar.php?id=<?=$tbl[3]?>">
                    <input type="button" value="VISUALIZAR">
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
                
                

        
        
        

        
        

            
        
       

    
    
</body>
</html>

