<?php
session_start();
$nomeusuario = $_SESSION['nomeusuario'];
?>
<div class="topo">
            <?php
                if ($nomeusuario != null) {
                ?>
                <li class="perfil"><label>BEM VINDO <?= strtoupper($nomeusuario)?></label></li>
            <?php
                }
                else {
                    echo"<script>window.alert('USUARIO NÃO LOGADO');window.location.href='login.php';</script>";
                }
            ?>
            <a href="logout.php"><img src='icons/Navigtion-left-01-256.png'width="50" height="50"></a>
        </div>