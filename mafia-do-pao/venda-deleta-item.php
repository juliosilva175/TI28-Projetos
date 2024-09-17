<?php
iclude ("conectadb.php");

$idiv =$_GET['id'];
$sqldeleta = "DELETE FROM tb_item_ WHERE iv_id = $idiv";
$resultado = mysqli_query($link,$sqldelete);

header("location: vendas.php");