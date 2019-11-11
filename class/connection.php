<?php
Class Connection{
    var $server = "localhost";
    var $username = "root";
    var $password = "";
    var $database = "projeto_apsoo";

    function __construct(){}

    function Conectar(){
        $conectar = mysqli_connect($this->server,$this->username,$this->password,$this->database);
        if(!($conectar)){
                echo "Erro ao tentar conectar ao banco de dados";
        }
        return $conectar;
    }
}
?>