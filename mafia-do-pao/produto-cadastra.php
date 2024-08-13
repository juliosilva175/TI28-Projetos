<?php
include("conectadb");
include("topo.php");
// vamos cadastrar o produto
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $nomeproduto = $_POST['txtnome'];
    $quantidade = $_POST['txtquantidade'];
    $unidade = $_POST['txtunidade'];
    $preco = $_POST['txtpreco'];
}

//ajustando imagem para o banco
if(isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_err_OK){
 $imagem_temp = $_FILES['imagem']['tmp_name'];
 $imagem_file-
 // criptografia imagem em base64
 $imagem_base64 = base64_encode($imagem);
};

//verificaa se Pão de queijo existe
$sql = "SELECT COUNT(pro_id) FROM TB_PRODUTOS WHERE pro_nome = '$nomeproduto'";
$retorno = mysqli_query($link, $sql);
$contagem = mysqli_fetch_array($retorno) [0];

if($contagem == 0){
    sql = "INSERT INTO
     tb_produtos(pro_nome, pro_quantidade, pro_unidade, pro_preco, pro_status, pro_image)
     VALUES ('$nomeproduto', $quantidade, '$unidade', $preco, '1', '$imagem_base64')"
     $retorno = mysqli_query(&link, $sql);

     echo"<script>window.alert('PRODUTO CADASTRADO');</script>";
     echo"<script>window.location.href='produto-lista.php';</script>";
}
else{
    echo"<script>window.</script>"
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">

    <title>CADASTRA PRODUTOS</title>
</head>
<body>
    <div class="container-global">
        <form action="fomulario" action="produto-cadastro.php" methood="post>
        <input type="decimal" name="txtqtd placeholder="DIGITE QUANTIDADE" requered>
</select>
        <br>

        <label>UNIDADE</lebel>
        <option value="kl">KL</option>
        <option value="lt">LT</option>
        <option value="un">UN</option>

        <label >PREÇO</label>
        <input type="decimal" name="txtpreco" placeholder="Digite PREÇO" required>
        <br>
        <input type="" name="txtpreco" placeholder="Digite " required>
        <br>
        <input type="" name="txt" placeholder="Digite " required>


    
        </form>

    </div>
    
</body>
</html>