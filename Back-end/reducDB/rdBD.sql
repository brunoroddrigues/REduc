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
	descritivo VARCHAR(10) NOT NULL UNIQUE
);

CREATE TABLE users
(
	id_usuario INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	nome VARCHAR(25) NOT NULL,
	sobrenome VARCHAR(25)NOT NULL,
	nomeUsuario VARCHAR(35) NOT NULL UNIQUE,
	cpf CHAR(11) NOT NULL UNIQUE,
	email VARCHAR(300) NOT NULL UNIQUE,
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

/* Populando users */

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

INSERT INTO redesocial (descritivo)
VALUES	('Twitter'),
	('Instagram'),
	('GitHub');
	
INSERT INTO user_redesocial (id_usuario, id_redesocial, link_rede)
VALUES	(1, 1, 
'https://www.google.com/url?sa=t&rct=j&q=&esrc=s&source=web&cd=&cad=rja&uact=8&ved=2ahUKEwigrM3NusaBAxUwpJUCHWRTClEQFnoECBMQAQ&url=https%3A%2F%2Ftwitter.com%2Felonmusk&usg=AOvVaw22rnIkEEG1QYDP93hHTtUL&opi=89978449');

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
	notas INT,
	id_ferramenta INT,
	id_categoriarecurso INT NOT NULL,
	FOREIGN KEY (id_usuario) REFERENCES users (id_usuario),
	FOREIGN KEY (id_ferramenta) REFERENCES ferramentas (id_ferramenta),
	FOREIGN KEY (id_categoriarecurso) REFERENCES categoriarecurso (id_categoriarecurso)
);

CREATE TABLE recurso_disciplina
(
	id_rec_disci INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	id_recurso INT NOT NULL,
	id_disciplina INT NOT NULL,
	FOREIGN KEY (id_recurso) REFERENCES recursos (id_recurso),
	FOREIGN KEY (id_disciplina) REFERENCES disciplinas (id_disciplina)
);

CREATE TABLE recurso_curso
(
	id_rec_curs INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	id_recurso INT NOT NULL,
	id_curso INT NOT NULL,
	FOREIGN KEY (id_recurso) REFERENCES recursos (id_recurso),
	FOREIGN KEY (id_curso) REFERENCES cursos (id_curso)
);

CREATE TABLE recurso_capes
(
	id_rec_capes INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	id_recurso INT NOT NULL,
	id_areaconhecimento INT NOT NULL,
	FOREIGN KEY (id_recurso) REFERENCES recursos (id_recurso),
	FOREIGN KEY (id_areaconhecimento) REFERENCES area_conhecimento (id_areaconhecimento)
);

/* Criando tabela de comentarios */

CREATE TABLE comentarios_recursos
(
	id_comentario INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	id_usuario INT NOT NULL,
	id_recurso INT NOT NULL,
	descritivo VARCHAR(480) NOT NULL,
	datacomentario INT NOT NULL,
	FOREIGN KEY (id_usuario) REFERENCES users (id_usuario),
	FOREIGN KEY (id_recurso) REFERENCES recursos (id_recurso)
	
);



/* Populando a parte de recursos */

INSERT INTO cursos (descritivo)
VALUES	('Sistemas para internet'),
	('Desenvolvimento de sistemas multiplataforma');
	
INSERT INTO ferramentas (descritivo)
VALUES	('PHP'),
	('Javascript');
	
INSERT INTO disciplinas (descritivo)
VALUES	('Desenvolvimento para servidores'),
	('Programação web');
	
INSERT INTO area_conhecimento (codcapes, descritivo)
VALUES	("10300007", "Ciência da computação");

INSERT INTO categoriarecurso (descritivo)
VALUES	('Vídeo'),
	('Artigo');
	
INSERT INTO recursos (titulo, descricao, datacadastro, id_usuario, id_ferramenta, id_categoriarecurso)
VALUES	('Sessão e cookie', 'Aula basica sobre sessão e cookie', '2023-09-25', 1, 1, 1);
	
INSERT INTO recurso_curso (id_recurso, id_curso)
VALUES	(1, 1);

INSERT INTO recurso_disciplina (id_recurso, id_disciplina)
VALUES	(1, 1);
	
INSERT INTO recurso_capes (id_recurso, id_areaconhecimento)
VALUES	(1, 1);
	
/* Populando comentario comentario */
	
INSERT INTO comentarios_recursos (id_usuario, id_recurso, descritivo)
VALUES	(2, 1, 'Conteúdo sensasional, sou seu fãn!!');
	
	
# PA's

CREATE TABLE tipos_pa
(
	id_tipo INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	descritivo VARCHAR(25) NOT NULL UNIQUE
);

CREATE TABLE pa
(
	id_pa INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	titulo VARCHAR(100) NOT NULL,
	descricao VARCHAR(255) NOT NULL,
	datacadastro DATE NOT NULL,
	arquivo_path TEXT,
	img_pa_path TEXT,
	nota INT NOT NULL,
	id_usuario INT NOT NULL,
	id_tipo INT NOT NULL,
	FOREIGN KEY (id_tipo) REFERENCES tipos_pa (id_tipo),
	FOREIGN KEY (id_usuario) REFERENCES users (id_usuario)
);
	
CREATE TABLE comentarios_pa
(
	id_comentario INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	id_usuario INT NOT NULL,
	id_pa INT NOT NULL,
	descritivo VARCHAR(480) NOT NULL,
	datacomentario INT NOT NULL,
	FOREIGN KEY (id_usuario) REFERENCES users (id_usuario),
	FOREIGN KEY (id_pa) REFERENCES pa (id_pa)
	
);	
	
/* Populando pa */	
	
INSERT INTO tipos_pa (descritivo)
VALUES	('Rubrica');

INSERT INTO pa (id_usuario, titulo, descricao, datacadastro, id_tipo)
VALUES	(1, 'Avaliação por Rubrica', 'Método de avaliação por rubrica para utilizar em turmas do ensino médio', '2023-09-25', 1);

INSERT INTO comentarios_pa (id_usuario, id_pa, descritivo, datacomentario)
VALUES	(7, 2, 'Adorei! vou usar com minha turma, eles vão gostar também.', '2023-09-25');
	
	
	
	
	
	
	
	
	
	





