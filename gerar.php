<?php
require_once(dirname(__FILE__)."/class/login.php");
$objLogin = new Login();
$objLogin->verificarLogado();
?>
<!DOCTYPE html>
    <html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Gerar - Sistema de Caixa - v0.1</title>
    <link rel="stylesheet" href="css/style.css" />
	<link rel="stylesheet" href="css/tabela.css" type="text/css" id="" media="print, projection, screen" />
	<link rel="stylesheet" href="css/style.css" />
	<link rel="stylesheet" href="css/jquery-ui.css">
	<script src="js/jquery-1.10.2.js"></script>
	<script src="js/jquery-ui.js"></script>
	<link rel="stylesheet" href="css/style2.css">
	<script>

</script>
</head>
<body>
<?php
$hoje = date('Y-m-d');
$ontem = date('Y-m-d', strtotime('-1 day'));
$semana = date('Y-m-d', strtotime('-7 day')); 
$mes = date('Y-m-d', strtotime('-1 month'));
$trimestre = date('Y-m-d', strtotime('-3 month')); 
$semestre = date('Y-m-d', strtotime('-6 month'));
$anual = date('Y-m-d', strtotime('-1 year')); 

if(empty($_POST["gerar"])){ ?>
<div class="container-geral">
<div class="container gerar">
	<form method="post">
		<label>Modalidade</label>
		<br>
		<select name="tipo">
			<option value="1">A pagar</option>
			<option value="2">A receber</option>
		</select>
		<br><br>
		<label>Periodicidade</label>
		<br>
		<select name="periodo" id="selecao">
		    <option value="nada">** Selecione **</option>
			<option value="ontem">Ontem</option>
			<option value="semana">Semana</option>
			<option value="mes">Mês</option>
			<option value="trimestre">Trimestre</option>
			<option value="anual">Anual</option>
			<option value="personal">Personalizavel</option>
		</select>
		<br><br>
		<div id="resto" style="display:none">

<input id="inicial" placeholder="Data inicial (mais antiga)"><br><input type="text" name="dtinicial" id="dtinicial" style="display:none">
<input id="final" placeholder="Data final (mais nova)"><br><input type="text" name="dtfinal" id="dtfinal" style="display:none">		
		</div>
		<br><input type="submit" name="gerar" value="Gerar" id="gerar" style="display:none">

	</form>
	
</div>
</div>
<?php } else { 
//echo "<pre>"; print_r($objLogin->listar()); echo "</pre>";
?>


<table class="tablesorter" cellspacing="1">             
    <thead>
        <tr> 
            <th>Conta nº</th> 
            <th>Data</th>
            <th>Categoria</th>
            <th>Sub-categoria</th>
            <th>Valor</th>
            <th>Descrição</th>
            <th>Tipo</th>
        </tr> 
    </thead> 
    <tbody> 
<?php 
$converte = $_POST["periodo"];
if($converte == "personal"){
	$hoje = $_POST["dtfinal"];
	$personal = $_POST["dtinicial"];
}
$pikachu = $objLogin->listar($hoje,$$converte, $_POST["tipo"]);

if($pikachu != "nada"){
foreach($pikachu as $tst){ ?>
		<tr>
			<td><?php echo htmlspecialchars($tst['id_conta']) ?></td>
			<td><?php echo htmlspecialchars($tst['data']) ?></td>
			<td><?php echo htmlspecialchars($tst['categoria']) ?></td>
			<td><?php echo htmlspecialchars($tst['sub_categoria']) ?></td>
			<td><?php echo htmlspecialchars($tst['valor']) ?></td>
			<td><?php echo htmlspecialchars($tst['descricao']) ?></td>
			<td><?php echo htmlspecialchars($tst['nome']) ?></td>
		</tr>
<?php }}else{ echo "<tr><td colspan=7>Nenhum registro encontrado no período</td></td>";}?>
    </tbody> 
</table>

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
    
    var habilitar = valor == 'personal' ? false : true;
    document.getElementById("resto").style.display = !habilitar ? 'block' : 'none';
	document.getElementById("gerar").style.display = !habilitar ? 'block' : 'block';
}
</script>
<script>

$(function() {
	$("#inicial").datepicker({
	showOn: "button",
	buttonImage: "img/calendar.gif",
	buttonImageOnly: true,
	buttonText: "Selecione o dia",
	dateFormat: "DD, d 'de' MM",
	altField: '#dtinicial',
	altFormat: 'yy-mm-dd',
	minDate: "-2000M -30D", maxDate: 0,
	dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
	dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
	dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
	monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
	monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
    });
});
$(function() {
	$("#final").datepicker({
	showOn: "button",
	buttonImage: "img/calendar.gif",
	buttonImageOnly: true,
	buttonText: "Selecione o dia",
	dateFormat: "DD, d 'de' MM",
	altField: '#dtfinal',
	altFormat: 'yy-mm-dd',
	minDate: "-2M -30D", maxDate: 0,
	dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
	dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
	dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
	monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
	monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
    });
});
</script>