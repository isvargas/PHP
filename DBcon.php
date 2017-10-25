<?php
    //Classe base para facilitar o acesso com PDO
    //baseado em: http://php.net/manual/pt_BR/ref.pdo-mysql.php
	//alterado por: Ivan S. Vargas
	//30/08/2017
    class DBcon
	{
        const USERNAME="usuario";
        const PASSWORD="senha";
        const HOST="servidor";
        const DB="database";
		
		var $con = null;
		
		//Observacoes
		//self:: para metodos/atributos estaticos
		//parent:: para metodos/atributos classe pai
		//$this para metodos/atributos nao-estaticos

        public function getConnection()
		{
			if ($this->con == null) {
				$username = self::USERNAME;
				$password = self::PASSWORD;
				$host = self::HOST;
				$db = self::DB;
				$this->con = new PDO("mysql:dbname=$db;host=$host", $username, $password);
			}
            return $this->con;
        }
		
        public function run($sql, $args)
		{
            $connection = $this->getConnection();
            $stmt = $connection->prepare($sql);
            $stmt->execute($args);
            return $stmt;
        }
    }
?>