<?php
require_once(dirname(__FILE__)."/class/login.php");
$objLogin = new Login();
$objLogin->verificarLogado();
?>
<!DOCTYPE html>
    <html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Bem vindo - Sistema de Caixa - v0.1</title>
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>
<div class="container welcome">
    <h3>Bem Vindo <?php echo $idUsuario = $objLogin->getIdUsuario(); ?></h3>
</div>
<br><br>
<div class="container-geral">
<div class="container gerar">
	<a href="./registrar.php" class="btn">Registrar conta</a><br><br><br><a href="./gerar.php" class="btn">Gerar relatório</a>
	</div>
	</div>
<br/>
<a href="logout.php" class="sair">Sair</a>
</body>
</html>