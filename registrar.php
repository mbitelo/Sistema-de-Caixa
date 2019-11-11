<?php
require_once(dirname(__FILE__)."/class/login.php");
$objLogin = new Login();
$objLogin->verificarLogado();
?>
<!DOCTYPE html>
    <html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Registrar - Sistema de Caixa - v0.1</title>
    <link rel="stylesheet" href="css/style.css" />
	<link rel="stylesheet" href="css/jquery-ui.css">
	<script src="js/jquery-1.10.2.js"></script>
	<script src="js/jquery-ui.js"></script>
	<link rel="stylesheet" href="css/style2.css">
</head>
<body>
<?php if(empty($_POST["registrar"])){ ?>
<div class="container-geral">
<div class="container gerar">
	<form method="post">
		<label>Modalidade</label><br>
		<select name="tipo" id="selecao">
		    <option value="nada">** Selecione **</option>
			<option value="1">A pagar</option>
			<option value="2">A receber</option>
		</select>
		<br><br>
		
		<div id="receber" style="display:none">
		<label>Categoria</label><br>
		<select name="catrec" class="receber">
		    <option value="nada">** Selecione **</option>
			<option value="servico">Serviço</option>
		</select>
		<br><br>
		
		<label>Sub-categoria</label>
		<select name="subcatrec">
		    <option value="nada">** Selecione **</option>
			<option value="eletrica">Elétrica</option>
			<option value="ar_cond">Ar Condicionado</option>
		</select>
		<br><br>
		</div>
				
		<div id="pagar" style="display:none">
		<label>Categoria</label><br>
		<select name="catpag" class="receber">
		    <option value="nada">** Selecione **</option>
			<option value="material">Material</option>
			<option value="ferramenta">Ferramenta</option>
			<option value="outros">Outros</option>
		</select>
		<br><br>

		</div>
		
		<div id="resto" style="display:none">
		<label>Descrição</label>
		<textarea name="descricao"></textarea>
		<br><br>
		
		<label>Valor</label><br>
		<input type="number" name="valor">
		<br><br>
		
		<label>Data</label><br>
		<input id="calendario"><br><input type="text" name="data" id="alternativo" style="display:none"><br><br><br>
		</div>
		
		<input type="submit" name="registrar" value="Salvar" id="registrar" style="display:none">
	</form>
	
</div>
</div>
<?php } else { ?>

<?php
if(isset($_POST["registrar"]) && $_POST["registrar"] = "Salvar"){
	if($_POST["tipo"] == 1){
		$cat = $_POST["catpag"];
		$subcat = NULL;
	} else {
		$cat = $_POST["catrec"];
		$subcat = $_POST["subcatrec"];
	}
    $salvar = $objLogin->salvar($_POST["tipo"], $_POST["descricao"], $_POST["valor"], $_POST["data"], $cat, $subcat);
}
?>

        <?php
if(isset($salvar)){
    ?>
        <div class="container-erro">
            <?php echo $salvar ?>
        </div>
<?php } ?>

<?php } ?>

<br/>
<a href="./index.php" class="sair">Início</a>&nbsp;
<a href="./logout.php" class="sair">Sair</a>
</body>
</html>

<script>
// select
var select = document.getElementById("selecao");

// quando o select muda
select.onchange = function () {
    var valor = select.options[select.selectedIndex].value;

    if (select.options[0].value == "nada") select.removeChild(select.options[0]);
    
    var habilitar = valor == '1' ? false : true;
    document.getElementById("pagar").style.display = !habilitar ? 'block' : 'none';
    document.getElementById("receber").style.display = !habilitar ? 'none' : 'block';
    document.getElementById("resto").style.display = !habilitar ? 'block' : 'block';
    document.getElementById("registrar").style.display = !habilitar ? 'block' : 'block';
}
</script>
<script>

$(function() {
	$("#calendario").datepicker({
	showOn: "button",
	buttonImage: "img/calendar.gif",
	buttonImageOnly: true,
	buttonText: "Selecione o dia",
	dateFormat: "DD, d 'de' MM",
	altField: '#alternativo',
	altFormat: 'yy-mm-dd',
	minDate: "-2000M -30D", maxDate: 0,
	dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
	dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
	dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
	monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
	monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
    });
});
</script>
<body>


</body>
</html>