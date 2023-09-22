CREATE DATABASE rductest

CREATE TABLE categoriaUsuario
(
	id_categoriaUsuario INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	descritivo VARCHAR(15) NOT NULL UNIQUE
);

CREATE TABLE perguntaSeguranca
(
	id_pergunta INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	descritivo VARCHAR(80) NOT NULL UNIQUE
);

CREATE TABLE instituicao
(
	id_instituicao INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	descritivo VARCHAR(100) NOT NULL UNIQUE
);

CREATE TABLE redeSocial
(
	id_redesocial INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	descritivo VARCHAR(10) NOT NULL
);

CREATE TABLE users
(
	id_usuario INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	nome VARCHAR(25) NOT NULL,
	sobrenome VARCHAR(25)NOT NULL,
	nomeUsuario VARCHAR(35) NOT NULL UNIQUE,
	cpf CHAR(11) NOT NULL UNIQUE,
	email NVARCHAR(255) NOT NULL UNIQUE,
	senha VARCHAR(255) NOT NULL,
	img_path VARCHAR(255),
	area_atuacao VARCHAR(25),
	resposta_seguranca VARCHAR(30) NOT NULL,
	link_lattes TEXT,
	id_categoriaUsuario INT NOT NULL,
	id_pergunta INT NOT NULL,
	id_instituicao INT NOT NULL,
	FOREIGN KEY (id_categoriaUsuario) REFERENCES categoriaUsuario (id_categoriaUsuario),
	FOREIGN KEY (id_pergunta) REFERENCES perguntaSeguranca (id_pergunta),
	FOREIGN KEY (id_instituicao) REFERENCES instituicao (id_instituicao)
);

CREATE TABLE seguir
(
	id_seguir INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	id_userseguido INT NOT NULL,
	id_userseguindo INT NOT NULL,
	FOREIGN KEY (id_userseguido) REFERENCES users (id_usuario),
	FOREIGN KEY (id_userseguindo) REFERENCES users (id_usuario)
);

CREATE TABLE user_redesocial
(
	id_userrede INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	link_rede VARCHAR(255) NOT NULL,
	id_redesocial INT NOT NULL,
	id_usuario INT NOT NULL,
	FOREIGN KEY (id_redesocial) REFERENCES redeSocial (id_redesocial),
	FOREIGN KEY (id_usuario) REFERENCES users (id_usuario)
);

/* Testando */

INSERT INTO instituicao (descritivo)
VALUES	('Fatec-Jahu');

INSERT INTO perguntaseguranca (descritivo)
VALUES	('Qual o nome do seu cachorro?');

INSERT INTO categoriausuario (descritivo)
VALUES  ('Administrador'),
	('Aluno'),
	('Professor');

INSERT INTO users (nome, sobrenome, nomeUsuario, cpf, email, senha, id_pergunta, resposta_seguranca, id_instituicao, id_categoriaUsuario)
VALUES	('Dérek', 'Anibal Nunes', 'Derek Nunes', '45320148879', 'derek.nunes@fatec.sp.gov.br', 'testandosenha', 1, 'tobi', 1, 1);

INSERT INTO users (nome, sobrenome, nomeUsuario, cpf, email, senha, id_pergunta, resposta_seguranca, id_instituicao, id_categoriaUsuario)
VALUES	('Nicolas', 'Rissi', 'Nicolas Rissi', '45211378548', 'nicolas.rissi@fatec.sp.gov.br', 'testandosenha', 1, 'nao tenho', 1, 1);

INSERT INTO users (nome, sobrenome, nomeUsuario, cpf, email, senha, id_pergunta, resposta_seguranca, id_instituicao, id_categoriaUsuario) 
VALUES	('Pedro', 'Domingos', 'Pedro Domingos', '45211378848', 'pedro.domingos@fatec.sp.gov.br', 'testandosenha', 1, 'macaco', 1, 1);

INSERT INTO users (nome, sobrenome, nomeUsuario, cpf, email, senha, id_pergunta, resposta_seguranca, id_instituicao, id_categoriaUsuario) 
VALUES	('Aparecida Maria', 'Zem Lopes', 'Cida Zem', '41024571184', 'aparecida.lopes01@fatec.sp.gov.br', 'testandosenha', 1, 'sei la', 1, 1);

INSERT INTO seguir (id_userseguindo, id_userseguido)
VALUES	(2,1);

INSERT INTO seguir (id_userseguindo, id_userseguido)
VALUES	(6,1);

/* Criando uma query para mostrar todos os seguidores do usuario Dérek */

SELECT u.nomeUsuario "Seguidores"
FROM users u INNER JOIN seguir s
ON(u.id_usuario = s.id_userseguindo)
WHERE s.id_userseguido = 1;


# RECURSOS

CREATE TABLE categoriarecurso
(
	id_categoriarecurso INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	descritivo VARCHAR(10) NOT NULL UNIQUE
);

CREATE TABLE disciplinas
(
	id_disciplina INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	descritivo VARCHAR(50) NOT NULL
);

CREATE TABLE cursos
(
	id_curso INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	descritivo VARCHAR(50) NOT NULL
);

CREATE TABLE ferramentas
(
	id_ferramenta INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	descritivo VARCHAR(25) NOT NULL
);

CREATE TABLE area_conhecimento
(
	id_areaconhecimento INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	codcapes VARCHAR(15) NOT NULL,
	descritivo VARCHAR(60) NOT NULL
);

CREATE TABLE recursos
(
	id_recurso INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	titulo VARCHAR(100) NOT NULL,
	descricao VARCHAR(255) NOT NULL,
	datacadastro DATE NOT NULL,
	video_path TEXT,
	artigo_path TEXT,
	img_recurso_path TEXT,
	id_usuario INT NOT NULL,
	id_ferramenta INT,
	id_categoriarecurso INT NOT NULL,
	FOREIGN KEY (id_usuario) REFERENCES users (id_usuario),
	FOREIGN KEY (id_ferramenta) REFERENCES ferramentas (id_ferramenta),
	FOREIGN KEY (id_categoriarecurso) REFERENCES categoriarecurso (id_categoriarecurso)
);










