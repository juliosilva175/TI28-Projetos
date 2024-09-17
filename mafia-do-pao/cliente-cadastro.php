<?php
include("conectadb.php");
include('topo.php');
// include("header.php");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $nome = $_POST['txtnome'];
    $cpf = $_POST['txtcpf'];
    $email = $_POST['txtemail'];
    $telefone = $_POST['txttelefone'];
    // VALIDA SE cliente A CADASTRAR EXISTE
    $sql = "SELECT COUNT(cli_id) FROM tb_clientes
    WHERE cli_nome = '$nome' OR cli_cpf = '$cpf' OR cli_email = '$email' OR cli_cel = '$telefone'";
    // RETORNO DO BANCO

   
    $retorno = mysqli_query($link, $sql);
    $contagem = mysqli_fetch_array($retorno) [0];

    // VERIFICA SE CLIENTE EXISTE
    if($contagem == 0){
        $sql = "INSERT INTO `tb_clientes`(`cli_cpf`, `cli_nome`, `cli_email`, `cli_cel`, `cli_status`) VALUES ('$cpf', '$nome',  '$email', '$telefone', '1')";
         echo $sql;
        mysqli_query($link, $sql);
        echo"<script>window.alert('CLIENTE CADASTRADO COM SUCESSO');</script>";
        echo"<script>window.location.href='backoffice.php';</script>";
    }
    else if($contagem >= 1){
        echo"<script>window.alert('CLIENTE JÁ EXISTENTE');</script>";
    }

}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">
    <link href="https://fonts.cdnfonts.com/css/curely" rel="stylesheet">
                
    <title>CADASTRO DE CLIENTES</title>
</head>
<body>
<a href="backoffice.php"><img src="icons/Navigation-left-01-256.png" width="25" height="25"></a>

    <div class="container-global">
        
        <form class="formulario" action="cliente-cadastro.php" method="post">

            <label>NOME DO CLIENTE</label>
            <input type="text" name="txtnome" placeholder="digite seu nome clinte" required>
            
            <br>
            <label>CPF</label>
            <input type="text" id="txtcpf"  name="txtcpf" placeholder="000.000.000-00" maxlength="14" oninput="formatarCPF(this)">
            
            <br>
            <label>EMAIL</label>
            <input type="email" name="txtemail" placeholder="Digite seu email" required>
            <br>
            <label>TELEFONE</label>
            <input type="text" id="txttelefone" name= "txttelefone" placeholder="(00) 00000-0000" maxlength="15" required>
            <br>
         
            <input type="submit" value="Cadastrar Cliente">
        </form>


    </div>
    <script src="scripts/script.js"></script>
</body>
</html>