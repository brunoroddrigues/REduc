CREATE DATABASE rductest

CREATE TABLE categoriausuario
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
	id_categoriaUsuario INT NOT NULL,
	nomeUsuario VARCHAR(35) NOT NULL UNIQUE,
	nome VARCHAR(25) NOT NULL,
	sobrenome VARCHAR(25)NOT NULL,
	email VARCHAR(300) NOT NULL UNIQUE,
	cpf CHAR(11) NOT NULL UNIQUE,
	datanascimento DATE NOT NULL,
	id_instituicao INT NOT NULL,
	link_lattes TEXT,
	area_atuacao VARCHAR(25),
	senha VARCHAR(255) NOT NULL,
	id_pergunta INT NOT NULL,
	resposta_seguranca VARCHAR(30) NOT NULL,
	img_path VARCHAR(255),
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
	link_rede VARCHAR(255) NOT NULL UNIQUE,
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
VALUES	(3,1);

INSERT INTO seguir (id_userseguindo, id_userseguido)
VALUES	(1,2),
	(1,3),
	(1,4),
	(4,1),
	(4,2),
	(4,3),
	(10,1);

INSERT INTO redesocial (descritivo)
VALUES	('Twitter'),
	('Instagram'),
	('GitHub');
	
INSERT INTO user_redesocial (id_usuario, id_redesocial, link_rede)
VALUES	(1, 1, 
'https://www.google.com/url?sa=t&rct=j&q=&esrc=s&source=web&cd=&cad=rja&uact=8&ved=2ahUKEwigrM3NusaBAxUwpJUCHWRTClEQFnoECBMQAQ&url=https%3A%2F%2Ftwitter.com%2Felonmusk&usg=AOvVaw22rnIkEEG1QYDP93hHTtUL&opi=89978449');

/* Criando uma procedure para mostrar todos os seguidores do usuario Dérek */

DELIMITER //
DROP PROCEDURE IF EXISTS proc_Seguidores//
CREATE PROCEDURE proc_Seguidores (IN id_usuarioA INT)
BEGIN
	IF (EXISTS(SELECT id_userseguido FROM seguir WHERE id_userseguido = id_usuarioA)) THEN
		SELECT nomeUsuario "Seguidores"
		FROM seguir s INNER JOIN users u
		ON(s.id_userseguindo = u.id_usuario)
		WHERE id_userseguido = id_usuarioA;
	ELSE
		SELECT "Este usuario não possui seguidores" AS msg;
	END IF;
END
//
DELIMITER ; 

CALL proc_Seguidores(1);

# RECURSOS

CREATE TABLE tiporecurso
(
	id_tiporecurso INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	descritivo VARCHAR(10) NOT NULL UNIQUE
);

CREATE TABLE disciplinas
(
	id_disciplina INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	descritivo VARCHAR(50) NOT NULL UNIQUE
);

CREATE TABLE cursos
(
	id_curso INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	descritivo VARCHAR(50) NOT NULL UNIQUE
);

CREATE TABLE ferramentas
(
	id_ferramenta INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	descritivo VARCHAR(25) NOT NULL UNIQUE
);

CREATE TABLE area_conhecimento
(
	id_areaconhecimento INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	codcapes VARCHAR(15) NOT NULL UNIQUE,
	descritivo VARCHAR(60) NOT NULL UNIQUE
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
	id_tiporecurso INT NOT NULL,
	FOREIGN KEY (id_usuario) REFERENCES users (id_usuario),
	FOREIGN KEY (id_ferramenta) REFERENCES ferramentas (id_ferramenta),
	FOREIGN KEY (id_tiporecurso) REFERENCES tiporecurso (id_tiporecurso)
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

CREATE TABLE avaliacao_recurso
(
	id_avaliacao INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	id_usuario INT NOT NULL,
	id_recurso INT NOT NULL,
	nota INT NOT NULL,
	FOREIGN KEY (id_usuario) REFERENCES users (id_usuario),
	FOREIGN KEY (id_recurso) REFERENCES recursos (id_recurso)
);

/* Criando tabela de comentarios */

CREATE TABLE comentarios_recursos
(
	id_comentario INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	id_usuario INT NOT NULL,
	id_recurso INT NOT NULL,
	descritivo VARCHAR(480) NOT NULL,
	datacomentario DATE NOT NULL,
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

INSERT INTO tiporecurso (descritivo)
VALUES	('Vídeo'),
	('Artigo');
	
INSERT INTO recursos (titulo, descricao, datacadastro, id_usuario, id_ferramenta, id_tiporecurso)
VALUES	('Sessão e cookie', 'Aula basica sobre sessão e cookie', '2023-09-25', 1, 1, 1);
	
INSERT INTO recurso_curso (id_recurso, id_curso)
VALUES	(1, 1);

INSERT INTO recurso_disciplina (id_recurso, id_disciplina)
VALUES	(1, 1);
	
INSERT INTO recurso_capes (id_recurso, id_areaconhecimento)
VALUES	(1, 1);

/* Avaliando recurso */

INSERT INTO avaliacao_recurso (id_usuario, id_recurso, nota)
VALUES	(2, 1, 5),
	(3, 1, 4),
	(4, 1, 2);

/* Pegando a média de avaliação de um recurso*/

SELECT AVG(nota)
FROM avaliacao_recurso
WHERE id_recurso = 1
	
/* Populando comentario comentario */
	
INSERT INTO comentarios_recursos (id_usuario, id_recurso, descritivo, datacomentario)
VALUES	(2, 1, 'Conteúdo sensasional, sou seu fãn!!', '2023-10-11');


INSERT INTO comentarios_recursos (id_usuario, id_recurso, descritivo, datacomentario)
VALUES	(3, 1, 'Brabo', '2023-10-11');	

/* Mostrando os comentarios */

SELECT 	cr.id_recurso "Codigo", u.nomeUsuario "Usuario", cr.descritivo "Comentario"
FROM comentarios_recursos cr INNER JOIN users u
ON(cr.id_usuario = u.id_usuario)
WHERE cr.id_recurso = 1
	
	
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
	datacomentario DATE NOT NULL,
	FOREIGN KEY (id_usuario) REFERENCES users (id_usuario),
	FOREIGN KEY (id_pa) REFERENCES pa (id_pa)
	
);	

CREATE TABLE avaliacao_pa
(
	id_avaliacao INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	id_usuario INT NOT NULL,
	id_pa INT NOT NULL,
	nota INT NOT NULL,
	FOREIGN KEY (id_usuario) REFERENCES users (id_usuario),
	FOREIGN KEY (id_pa) REFERENCES pa (id_pa)
);
	
/* Populando pa */	
	
INSERT INTO tipos_pa (descritivo)
VALUES	('Rubrica');

INSERT INTO pa (id_usuario, titulo, descricao, datacadastro, id_tipo)
VALUES	(1, 'Avaliação por Rubrica', 'Método de avaliação por rubrica para utilizar em turmas do ensino médio', '2023-09-25', 1);

INSERT INTO comentarios_pa (id_usuario, id_pa, descritivo, datacomentario)
VALUES	(4, 1, 'Adorei! vou usar com minha turma, eles vão gostar também.', '2023-09-25');
	

	
	
	
# CRIANDO UMA PROCEDURE PARA CADASTRAR ALUNOS
DELIMITER //
DROP PROCEDURE IF EXISTS proc_CadastroAluno//
CREATE PROCEDURE proc_CadastroAluno (IN nomeU VARCHAR(25), sobrenomeU VARCHAR(25), nomeUsuarioU VARCHAR(35), cpfU CHAR(11), datanascimentoU DATE, emailU VARCHAR(300), senhaU VARCHAR(255), id_perguntaU INT, resposta_segurancaU VARCHAR(30), id_instituicaoU INT, id_categoriaUsuarioU INT, statusU BOOLEAN)
BEGIN
	DECLARE username_exists INT;
	DECLARE email_exists INT;
	DECLARE cpf_exists INT;
	
	SELECT COUNT(*) INTO username_exists FROM users WHERE nomeUsuario = nomeUsuarioU;

	SELECT COUNT(*) INTO email_exists FROM users WHERE email = emailU;

	SELECT COUNT(*) INTO cpf_exists FROM users WHERE cpf = cpfU;
	
	IF (username_exists > 0 OR email_exists > 0 OR cpf_exists > 0) THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'ERRO: Nome de usuário, email ou CPF já cadastrados';
	ELSE
		INSERT INTO users (nome, sobrenome, nomeUsuario, cpf, datanascimento, email, senha, id_pergunta, resposta_seguranca, id_instituicao, id_categoriaUsuario, STATUS)
		VALUES	(nomeU, sobrenomeU, nomeUsuarioU, cpfU, datanascimentoU, emailU, senhaU, id_perguntaU, resposta_segurancaU, id_instituicaoU, id_categoriaUsuarioU, statusU);
	END IF;
END
//
DELIMITER ; 



CALL proc_CadastroAluno('Miguel', 'Souza', 'MSouza', '42101474413', '2004-05-20', 'miguelsouza.brabo@gmail.com', 'testandoprocedure', 1, 'tamandua', 1, 1,1);


#CRIANDO UMA PROCEDURE PARA CADASTRAR PROFESSORES
DELIMITER //
DROP PROCEDURE IF EXISTS proc_CadastroProfessor//
CREATE PROCEDURE proc_CadastroProfessor (IN nomeU VARCHAR(25), sobrenomeU VARCHAR(25), nomeUsuarioU VARCHAR(35), cpfU CHAR(11), datanascimentoU DATE, emailU VARCHAR(300), senhaU VARCHAR(255), link_lattesU TEXT, area_atuacaoU VARCHAR(25), id_perguntaU INT, resposta_segurancaU VARCHAR(30), id_instituicaoU INT, id_categoriaUsuarioU INT, statusU BOOLEAN)
BEGIN
	INSERT INTO users (nome, sobrenome, nomeUsuario, cpf, datanascimento, email, senha, link_lattes, area_atuacao, id_pergunta, resposta_seguranca, id_instituicao, id_categoriaUsuario, STATUS)
	VALUES	(nomeU, sobrenomeU, nomeUsuarioU, cpfU, datanascimentoU, emailU, senhaU, link_lattesU, area_atuacaoU, id_perguntaU, resposta_segurancaU, id_instituicaoU, id_categoriaUsuarioU, statusU);
END
//
DELIMITER ; 

CALL proc_CadastroProfessor('Mateus', 'Oliveira', 'Moliveira', '42145523365', '2004-05-20', 'matoliveira.prof@gmail.com', 'testandoprocedureprofessor', 'https://www.twitch.tv/yoda', 'Streamer', 1, 'tamandua', 1, 2);


DELETE FROM users WHERE id_usuario = 7

#CRIANDO UMA QUERY PARA VERIFICAR USUARIO

DELIMITER //
DROP PROCEDURE IF EXISTS proc_VerificarUsuario//
CREATE PROCEDURE proc_VerificarUsuario (IN xemail VARCHAR(255), xsenha VARCHAR(255))
BEGIN
		IF(EXISTS(SELECT * FROM users WHERE email = xemail AND senha = xsenha)) THEN
			SELECT id_usuario, nomeUsuario, id_categoriaUsuario, IFNULL(img_path, "img/imgUsers/foto-perfil.avif") FROM users
			WHERE email = xemail AND senha = xsenha;
		END IF;
END//
DELIMITER ; 

CALL proc_VerificarUsuario('romao.prof@gmail.com', '$2y$10$6.Q68wmxMURVphx4TGpA1OKz3jkeKTsNayqD27sPMFIxbyNKMjS0a');

#CRIANDO PROCEDURE PARA LISTAR TODOS OS RECURSOS CADASTRADOS PELO USUARIO

DELIMITER //
DROP PROCEDURE IF EXISTS proc_TodosRecursos //
CREATE PROCEDURE proc_TodosRecursos (IN id_usuarioA INT)
BEGIN
	IF (EXISTS(SELECT id_usuario FROM recursos WHERE id_usuario = id_usuarioA)) THEN 
		SELECT r.id_recurso, titulo, descricao, datacadastro, (SELECT AVG(nota) FROM avaliacao_recurso WHERE id_recurso = r.id_recurso) "avaliacao"
		FROM recursos r INNER JOIN avaliacao_recurso ar
		ON(r.id_recurso = ar.id_recurso)
		WHERE r.id_usuario = id_usuarioA
		GROUP BY r.id_recurso;
	ELSE
		SELECT "Usuario não possui recursos cadastrados..." AS msg;
	END IF;
END
//
DELIMITER ;

CALL proc_TodosRecursos(1);


#CRIANDO PROCEDURE PARA INATIVAR UM RECURSO DO USUARIO

DELIMITER //
DROP PROCEDURE IF EXISTS proc_InativarRecurso //
CREATE PROCEDURE proc_InativarRecurso (IN id_usuarioA INT, id_recursoA INT)
BEGIN
	IF (id_usuarioA = (SELECT id_usuario FROM recursos WHERE id_recurso = id_recursoA) OR EXISTS(SELECT id_usuario FROM users WHERE id_categoriaUsuario = 3 AND id_usuario = id_usuarioA)) THEN 
		UPDATE recursos SET STATUS = 0 WHERE id_recurso = id_recursoA;
	ELSE
		SELECT "Impossível..." AS msg;
	END IF;
END
//
DELIMITER ;

CALL proc_InativarRecurso(1,1);


#CRIANDO PROCEDURE PARA ATIVAR UM RECURSO DO USUARIO

DELIMITER //
DROP PROCEDURE IF EXISTS proc_AtivarRecurso //
CREATE PROCEDURE proc_AtivarRecurso (IN id_usuarioA INT, id_recursoA INT)
BEGIN
	IF (id_usuarioA = (SELECT id_usuario FROM recursos WHERE id_recurso = id_recursoA) OR EXISTS(SELECT id_usuario FROM users WHERE id_categoriaUsuario = 3 AND id_usuario = id_usuarioA)) THEN 
		UPDATE recursos SET STATUS = 1 WHERE id_recurso = id_recursoA;
	ELSE
		SELECT "Impossível..." AS msg;
	END IF;
END
//
DELIMITER ;
	

CALL proc_AtivarRecurso(10,1);


# Criando uma procedure para buscar os 4 recursos mais bem avaliados

DELIMITER //
DROP PROCEDURE IF EXISTS proc_BuscarQuatroRecursos //
CREATE PROCEDURE proc_BuscarQuatroRecursos()
BEGIN
	SELECT r.titulo, r.img_recurso_path, IFNULL(AVG(ar.nota), 0) "nota"
	FROM recursos r LEFT JOIN avaliacao_recurso ar
	ON(r.id_recurso = ar.id_recurso)	
	WHERE r.status <> 0	
	GROUP BY r.id_recurso
	ORDER BY AVG(ar.nota) DESC
	LIMIT 4;
END//
DELIMITER ;



CALL proc_BuscarQuatroRecursos

#criando uma procedure para buscar as redes socias do usuario

DELIMITER // 
DROP PROCEDURE IF EXISTS proc_BuscarRedeSocial //
CREATE PROCEDURE proc_BuscarRedeSocial(IN xid_usuario INT)
BEGIN
	IF(EXISTS(SELECT * FROM user_redesocial WHERE id_usuario = xid_usuario)) THEN
		SELECT id_redesocial, link_rede 
		FROM user_redesocial
		WHERE id_usuario = xid_usuario;
	END IF;
END //
DELIMITER ;

CALL proc_BuscarRedeSocial()



SELECT * FROM redesocial ORDER BY id_redesocial




