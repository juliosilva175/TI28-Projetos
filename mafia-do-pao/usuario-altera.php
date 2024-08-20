<?php
include('conectadb.php');
include('topo.php');
//coleta o valor id lá da url
$id = $_GET['id'];
$sql = "SELECT * FROM tb_usuarios WHERE use_id = '$id'";
$retorno = mysqli_query($link, $sql);
  while($tbl = mysqli_fetch_array($retorno)){
    $id = $tbl[0];
    $login = $tbl[1];
    $email = $tbl[2];
    $senha = $tbl[3];
    $status = $tbl[4];
  }

  // BORA FAZER UPDATE
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id = $_POST['id'];
    $senha = $_POST['txtsenha'];
    $email = $_POST['txtemail'];
    $status = $_POST['status'];

    $sql = "UPDATE tb_usuarios set use_senha = '$senha', use_email = '$email', use_status = '$status' WHERE usu_id = $id";

    mysqli_query($link, $sql);
    echo"<script>window.alert('USUARIO ALTERADO COM SUCESSO!');</script>";
    echo"<script>window.location.href='usuario-lista.php';</script>";
    exit();

}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">
    <link href="https://fonts.cdnfonts.com/css/curely" rel="stylesheet">
                
    <title>ALTERAÇÃO DE USUARIO</title>
</head>
<body>
    <div class="container-global">
    

    <form class="formulario" action="usuario-altera.php" method="post">
         
        
                <label>LOGIN</label>
                <input type="text" name="txtlogin" placeholder="<?= id?>">
                <br>
                
                <label>EMAIL</label>
                <input type="email" name="txtemail" placeholder="Digite seu email" value=" <?= $email?>" required>
                <label>SENHA</label>
                <input type="senha" name="txtsenha" placeholder="Digite sua senha" value=" <?= $senha?>" required>
                
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