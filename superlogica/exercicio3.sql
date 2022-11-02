CREATE DATABASE `SUPERLOGICA` CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE `SUPERLOGICA`.`USUARIO`( `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Identificador do usuario', `cpf` BIGINT UNSIGNED NOT NULL COMMENT 'CPF do usuário', `nome` VARCHAR(255) NOT NULL COMMENT 'Nome do usuário', PRIMARY KEY (`id`), UNIQUE INDEX `UNIQUE` (`cpf`, `nome`) ) ENGINE=INNODB CHARSET=utf8 COLLATE=utf8_general_ci; 

CREATE TABLE `SUPERLOGICA`.`INFO`( `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Identificador das informações do usuário', `cpf` BIGINT UNSIGNED NOT NULL COMMENT 'CPF do usuário', `genero` CHAR NOT NULL COMMENT 'Genero do usuário', `ano_nascimento` YEAR NOT NULL COMMENT 'Ano de nascimento do usuário', PRIMARY KEY (`id`), CONSTRAINT `FK_cpf` FOREIGN KEY (`cpf`) REFERENCES `superlogica`.`usuario`(`cpf`) ) ENGINE=INNODB CHARSET=utf8 COLLATE=utf8_general_ci; 

INSERT INTO `superlogica`.`usuario` (`cpf`, `nome`) VALUES ('16798125050', 'Luke Skywalker'); 
INSERT INTO `superlogica`.`usuario` (`cpf`, `nome`) VALUES ('59875804045', 'Bruce Wayne'); 
INSERT INTO `superlogica`.`usuario` (`cpf`, `nome`) VALUES ('04707649025', 'Diane Prince'); 
INSERT INTO `superlogica`.`usuario` (`cpf`, `nome`) VALUES ('21142450040', 'Bruce Banner'); 
INSERT INTO `superlogica`.`usuario` (`cpf`, `nome`) VALUES ('83257946074', 'Harley Quinn'); 
INSERT INTO `superlogica`.`usuario` (`cpf`, `nome`) VALUES ('07583509025', 'Peter Parker');

INSERT INTO `superlogica`.`info` (`cpf`, `genero`, `ano_nascimento`) VALUES ('16798125050', 'M', '1976'); 
INSERT INTO `superlogica`.`info` (`cpf`, `genero`, `ano_nascimento`) VALUES ('59875804045', 'M', '1960'); 
INSERT INTO `superlogica`.`info` (`cpf`, `genero`, `ano_nascimento`) VALUES ('04707649025', 'F', '1988'); 
INSERT INTO `superlogica`.`info` (`cpf`, `genero`, `ano_nascimento`) VALUES ('21142450040', 'M', '1954'); 
INSERT INTO `superlogica`.`info` (`cpf`, `genero`, `ano_nascimento`) VALUES ('83257946074', 'F', '1970'); 
INSERT INTO `superlogica`.`info` (`cpf`, `genero`, `ano_nascimento`) VALUES ('07583509025', 'M', '1972'); 

SELECT 
  CONCAT(
    USUARIO.`nome`,
    " - ",
    INFO.`genero`
  ) AS usuario,
  IF(
    (2022 - INFO.`ano_nascimento`) > 50,
    'SIM',
    'NÃO'
  ) AS maior_50_anos 
FROM
  USUARIO 
  INNER JOIN INFO 
    ON USUARIO.`cpf` = INFO.`cpf` 
WHERE INFO.`genero` = 'M' 
  AND USUARIO.`nome` <> 'Bruce Wayne' 
ORDER BY USUARIO.`nome` DESC ;