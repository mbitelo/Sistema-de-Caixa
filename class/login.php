<?php
session_start();
require_once("connection.php");
Class Login {
	private $conexaoSQL;
    function __construct(){
        $this->conexaoSQL = new Connection();
    }
    function verificarLogado(){
        if(!isset($_SESSION["logado"])){
            header("Location: dirname(__FILE__)/../login.php");
            exit();
        }
    }
    function Logar($usuario,$senha){
		$sql = $this->conexaoSQL->Conectar()->query("SELECT count(*) as contado FROM  usuario");
		$consulta = mysqli_fetch_array($sql);
		if ($consulta["contado"] == 0){
			$Erro = "Sistema sem usuário, vamos se cadatastrar?\n";
			$Erro .= "<br><br><a href='./cadastrar.php'>Registrar-se</a>";
					
            return $Erro;

		} else {
        $sql = $this->conexaoSQL->Conectar()->query("SELECT * FROM usuario WHERE nome_usuario = '$usuario'");
        if (mysqli_num_rows($sql) == 1) {

            $d_usuario = mysqli_fetch_array($sql);
            if (($d_usuario["senha_usuario"]) == $senha) {
                $_SESSION["id_usuario"] = $d_usuario["nome_usuario"];
                $_SESSION["logado"] = "sim";
                header("Location: dirname(__FILE__)/../index.php");
            } else {
                $Erro = "Senha incorreta!";
                return $Erro;
            }
            } else {
            $Erro = "Nome de usuário incorreto!";
            return $Erro;
        }
		}
    }

    function getIdUsuario(){
        return $_SESSION["id_usuario"];
    }

    function deslogar(){
        session_destroy();
        header("Location: dirname(__FILE)/../login.php");
    }
	
	function listar($inicio, $fim, $tipo){
		$sql = $this->conexaoSQL->Conectar()->query("SELECT * FROM conta c inner join tipo t on c.id_tipo = t.id_tipo where c.data BETWEEN ('$fim') AND ('$inicio') and c.id_tipo = $tipo");
		if (mysqli_num_rows($sql) >= 1) {
		while($row = $sql->fetch_assoc()) {
        $rows[] = array_map("utf8_encode", $row);
		}
		return $rows;
		} else {
			return $rows[0] = "nada";
		}
	}
	
	function salvar($tipo,$descr,$valor,$data,$cat,$subcat){
	$sql = $this->conexaoSQL->Conectar()->query("INSERT INTO conta VALUES(NULL, '$cat','$subcat','$descr',$valor,'$data',$tipo);");
	if($sql == 1){
            return "Cadastrado efetuado com sucesso!";
        } else { // senão, volta para tela inicial
            return "Erro na inclusão<br><a href='./index.php'>Voltar ao menu</a>";
        }	
	}
	
	function Cadastrar($nome,$senha){
	$sql = $this->conexaoSQL->Conectar()->query("INSERT INTO usuario VALUES('$nome','$senha');");
	if($sql == 1){
            return "Usuario cadastrado efetuado com sucesso!<br><br><a href='./index.php' class='sair'>Início</a>";
        } else { // senão, volta para tela inicial
            return "Erro na inclusão<br><a href='./index.php'>Voltar ao menu</a>";
        }	
	}
}
?>