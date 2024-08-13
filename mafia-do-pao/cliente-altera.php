<?php
include('conectadb.php');
include('topo.php');
//coleta o valor id lá da url
$id = $_GET['id'];
$sql = "SELECT * FROM tb_clientes WHERE cli_id = '$id'";
$retorno = mysqli_query($link, $sql);
  while($tbl = mysqli_fetch_array($retorno)){
    $cpf = $tbl[1];
    $nome = $tbl[2];
    $email = $tbl[3];
    $cel   = $tbl[4]
    $status = $tbl[5];
  }

  // BORA FAZER UPDATE
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id = $_POST['id'];
    $cpf = $_POST['txtcpf'];
    $nome = $_POST['txtnome'];
    $email = $_POST['txtemail'];
    $cel = $_POST['txtcel'];
    $status = $_POST['status'];

    $sql = "UPDATE tb_clientes set cli_nome = '$nome', cli_cpf = '$cpf', cli_email = '$email', cli_ WHERE cli_id = $id";

    mysqli_query($link, $sql);
    echo"<script>window.alert('CLIENTE ALTERADO COM SUCESSO!');</script>";
    echo"<script>window.location.href='cliente-lista.php';</script>";
    exit();

}


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">
    <link href="https://fonts.cdnfonts.com/css/curely" rel="stylesheet">
                
    <title>ALTERAÇÃO DE Cliente</title>
</head>
<body>
    <div class="container-global">
    <a href="backoffice.php"><img src="icons/Navigation-left-01-256.png" width="25" height="25"></a>

    

    <form class="formulario" action="cliente-altera.php" method="post">
         
        
                <label>NOME</label>
                <input type="text" name="txtnome" placeholder="<?= id?>">
                <br>
                
                <label>CPF</label>
                <input type="cpf" name="txtcpf" placeholder="Digite seu cpf" value=" <?= $cpf?>" required>
                <label>EMAIL</label>
                <input type="email" name="txtemail" placeholder="Digite seu email" value=" <?= $email?>" required>
                
                <label>CELULAR</label>
                <input type="celular" name="txtcel" placeholder="Digite seu celular" value=" <?= $celular?>" required>

                <!-- seletoe de ativo e inativo-->
                <div class ="bullets">
                <input type="radio" names="status" <?$status value= '1'?"checked" : ""?>>ATIVO
                <input type="radio" names="status" <?$status == '2'?"checked" : ""?>>inativo
                </div>
                <br>
                <br>
                <input type="submit" value="CONFIRMAR">
        </form>

    </div>
    
</body>
</html>