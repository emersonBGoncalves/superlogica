<?php

Class Queries extends Conectadb
{
	public function getCadastro($username)
	{
		$query = "SELECT * FROM cadastro WHERE username = '" . $username . "';";
		$ret = $this->connect()->query($query);
		return $ret->rowCount();
	}

	public function setCadastro($name, $username, $zipcode, $email, $pass)
	{
		$query = "INSERT INTO cadastro
					(
						name, username, zipcode, 
						email, password
					) 
				VALUES
					(
						'" . $name . "' ,  '" . $username . "' , '" . $zipcode . "',
						'" . $email . "' , MD5('" . $pass . "')
					) ";
		$conn = $this->connect();
		$ret = $conn->prepare($query);
		$ret->execute();
		return $conn->lastInsertId();
	}
}

?>