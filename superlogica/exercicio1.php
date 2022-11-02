<?php
// CRIAÇÃO DA TABELA
// CREATE DATABASE `SUPERLOGICA` CHARACTER SET utf8 COLLATE utf8_general_ci;
// CREATE TABLE `superlogica`.`cadastro`( `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT, `name` VARCHAR(255) NOT NULL, `username` VARCHAR(255) NOT NULL, `zipcode` VARCHAR(50) NOT NULL, `email` VARCHAR(100) NOT NULL, `password` VARCHAR(255) NOT NULL, PRIMARY KEY (`id`) ) ENGINE=INNODB CHARSET=utf8 COLLATE=utf8_general_ci;
require_once('functions/conectadb.class.php');
require_once('functions/queries.class.php');

$name 		= isset($_REQUEST['name']) 		? $_REQUEST['name'] 		: "";
$username 	= isset($_REQUEST['userName']) 	? $_REQUEST['userName']		: "";
$zipcode 	= isset($_REQUEST['zipCode']) 	? $_REQUEST['zipCode'] 		: "";
$email 		= isset($_REQUEST['email']) 	? $_REQUEST['email'] 		: "";
$password 	= isset($_REQUEST['password']) 	? $_REQUEST['password'] 	: "";
$action 	= isset($_REQUEST['action']) 	? $_REQUEST['action'] 		: "";

$erro = 0;
$msg = "";
$campo_erro = "";
$exibe_aviso = false;
switch($action)
{
	case "Cadastrar":
		$exibe_aviso = true;
		$cadastro = new Queries;

		if(empty($name))
		{
			$erro = 1;
			$msg = "Nome vazio!";
			$campo_erro = "name";
		}
		else if(empty($username))
		{
			$erro = 1;
			$msg = "Login vazio!";
			$campo_erro = "userName";
		}
		else if(empty($email))
		{
			$erro = 1;
			$msg = "Email vazio!";
			$campo_erro = "email";
		}
		else if(!filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			$erro = 1;
			$msg = "Formato de email incorreto!";
			$campo_erro = "email";
		}
		else if(empty($zipcode))
		{
			$erro = 1;
			$msg = "CEP vazio!";
			$campo_erro = "zipCode";
			header("Location: exercicio1.php");
		}
		else if(!preg_match("/\d{2}[.\s]?\d{3}[-.\s]?\d{3}/",$zipcode))
		{
			$erro = 1;
			$msg = "Formato de cep incorreto!";
			$campo_erro = "zipCode";
		}
		else if(empty($password))
		{
			$erro = 1;
			$msg = "Senha vazia!";
			$campo_erro = "password";
		}
		else if(!preg_match("/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/",$password))
		{
			$erro = 1;
			$msg = "A senha deve conter 8 caracteres mínimo, contendo pelo menos 1 letra e 1 número!";
			$campo_erro = "password";
		}
		else if($cadastro->getCadastro($username) > 0)
		{
			$erro = 1;
			$msg = "Usuário ja existe!";
		}
		else
		{
			$id = $cadastro->setCadastro($name, $username, $zipcode, $email, $password);
			if($id > 0)
			{
				$erro = 0;
				$msg = "Usuário cadastrado com sucesso!";
			}
			else
			{
				$erro = 1;
				$msg = "Falha ao inserir usuário!";
			}
		}

	break;
}

?>
<html>
	<head>
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/bootstrap.min.css">

		<script type="text/javascript" src="src/jquery-1.2.6.pack.js"></script>
		<script type="text/javascript" src="src/jquery.maskedinput-1.1.4.pack.js"></script>

		<script>
		$(document).ready(function()
		{
			$("#zipCode").mask("99.999-999");
		});
		</script>
	</head>
	<body>
		<form method="post">
			<div class="form-group">
				<div class="<?php echo !$exibe_aviso ? "oculto " : ""; ?><?php echo $erro == 1 ? 'div_red' : 'div_verde'; ?>"><?php echo !empty($msg) ? $msg : ''; ?></div>
			</div>
			<div class="form-group">
				<label for="name">Nome completo:</label>
				<input type="text" id="name" class="form-control" <?php echo $erro == 1 && $campo_erro == 'name' ? 'style="border-color: red"' : ''; ?> name="name" value="<?php echo $name; ?>">
			</div>
			<div class="form-group">
				<label for="userName">Nome de login:</label>
				<input type="text" id="userName" class="form-control" <?php echo $erro == 1 && $campo_erro == 'userName' ? 'style="border-color: red"' : ''; ?> name="userName" value="<?php echo $username; ?>">
			</div>
			<div class="form-group">
				<label for="zipCode">CEP</label>
				<input type="text" id="zipCode" class="form-control" <?php echo $erro == 1 && $campo_erro == 'zipCode' ? 'style="border-color: red"' : ''; ?> name="zipCode" value="<?php echo $zipcode; ?>">
			</div>
			<div class="form-group">
				<label for="email">Email:</label>
				<input type="text" id="email" class="form-control" <?php echo $erro == 1 && $campo_erro == 'email' ? 'style="border-color: red"' : ''; ?> name="email" value="<?php echo $email; ?>">
			</div>
			<div class="form-group">
				<label for="password">Senha (8 caracteres mínimo, contendo pelo menos 1 letra e 1 número):</label>
				<input type="password" class="form-control" id="password" <?php echo $erro == 1 && $campo_erro == 'password' ? 'style="border-color: red"' : ''; ?> name="password">
			</div>
			<input type="submit" name="action" class="btn btn-primary" value="Cadastrar">
		</form>
	</body>
</html>