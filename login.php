<?php
    require_once(dirname(__FILE__)."/class/login.php");

    $objConnection = new Connection();
    $objLogin = new Login();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Acesso Restrito</title>
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>
    <div class="container-geral">
        <div class="container login">
            <h3>Acesso restrito</h3>
            <br />
            <form action="" method="post">
                <label for="email">Nome de usuário:</label>
                <br>
                <input type="text" name="usuario" id="email" required>
                <br><br>
                <label for="senha">Senha:</label>
                <br>
                <input type="password" name="senha" id="senha" required>
                <br><br>
                <input type="submit" name="Logar" value="Logar">
            </form>
        </div>
        <br>
<?php
if(isset($_POST["Logar"]) && $_POST["Logar"] = "Logar"){
    $logar = $objLogin->Logar($_POST["usuario"], $_POST["senha"]);
}
?>

        <?php
if(isset($logar)){
    ?>
        <div class="container-erro">
            <?php echo $logar ?>
        </div>
<?php } ?>
        </div>
</body>
</html>