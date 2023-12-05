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
	descricao VARCHAR(255) ,
	datanascimento DATE NOT NULL,
	datacadastro DATE NOT NULL,
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

CREATE TABLE recursos_salvos 
(
	id_fav INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	id_recurso INT NOT NULL,
	id_usuario INT NOT NULL,
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
			SELECT id_usuario, nomeUsuario, id_categoriaUsuario, IFNULL(img_path, "img/imgUsers/foto-perfil.avif") "img_path" FROM users
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
CREATE PROCEDURE proc_BuscarQuatroRecursos(IN codigo INT)
BEGIN
	IF(codigo = 0) THEN
		SELECT r.id_recurso "codigo", r.titulo, r.img_recurso_path "img", IFNULL(AVG(ar.nota), 0) "nota", 0 "favorito"
		FROM recursos r LEFT JOIN avaliacao_recurso ar
		ON(r.id_recurso = ar.id_recurso)
		WHERE r.status <> 0	
		GROUP BY r.id_recurso
		ORDER BY AVG(ar.nota) DESC
		LIMIT 4;
	ELSE
		SELECT r.id_recurso "codigo", r.titulo, r.img_recurso_path "img", IFNULL(AVG(ar.nota), 0) "nota", IFNULL((
			SELECT rs.id_fav 
			FROM recursos_salvos rs
			WHERE r.id_recurso = rs.id_recurso AND codigo = rs.id_usuario
		), 0) "favorito"
		FROM recursos r LEFT JOIN avaliacao_recurso ar
		ON(r.id_recurso = ar.id_recurso)
		WHERE r.status <> 0	
		GROUP BY r.id_recurso
		ORDER BY AVG(ar.nota) DESC
		LIMIT 4;
	END IF;
END//
DELIMITER ;



CALL proc_BuscarQuatroRecursos

DELIMITER $$
DROP PROCEDURE IF EXISTS proc_buscarTodosRecursos $$
CREATE PROCEDURE proc_buscarTodosRecursos (IN codigo INT)
BEGIN
	IF(codigo = 0) THEN
		SELECT r.id_recurso "codigo", r.titulo, r.img_recurso_path "img", IFNULL(AVG(ar.nota), 0) "nota", 0 "favorito"
		FROM recursos r LEFT JOIN avaliacao_recurso ar
		ON(r.id_recurso = ar.id_recurso)
		WHERE r.status <> 0	
		GROUP BY r.id_recurso
		ORDER BY AVG(ar.nota) DESC;
	ELSE
		SELECT r.id_recurso "codigo", r.titulo, r.img_recurso_path "img", IFNULL(AVG(ar.nota), 0) "nota", IFNULL((
			SELECT rs.id_fav 
			FROM recursos_salvos rs
			WHERE r.id_recurso = rs.id_recurso AND codigo = rs.id_usuario
		), 0) "favorito"
		FROM recursos r LEFT JOIN avaliacao_recurso ar
		ON(r.id_recurso = ar.id_recurso)
		WHERE r.status <> 0	
		GROUP BY r.id_recurso
		ORDER BY AVG(ar.nota) DESC;
	END IF;
END $$
DELIMITER ;

CALL proc_buscarTodosRecursos ();
BEGIN

SELECT r.id_recurso "codigo", r.titulo, r.img_recurso_path, IFNULL(AVG(ar.nota), 0) "nota", (
	SELECT rs.id_fav 
	FROM recursos_salvos rs
	WHERE r.id_recurso = rs.id_recurso
) "recurso_salvo"
FROM recursos r LEFT JOIN avaliacao_recurso ar
ON(r.id_recurso = ar.id_recurso)
WHERE r.status <> 0	
GROUP BY r.id_recurso
ORDER BY AVG(ar.nota) DESC;

END 



=======
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

# Procedure para buscar os dados do perfil do usuario

DELIMITER // 
DROP PROCEDURE IF EXISTS proc_BuscarPerfilUsuario //
CREATE PROCEDURE proc_BuscarPerfilUsuario (IN xid_usuario INT)
BEGIN
	IF(EXISTS(SELECT * FROM users WHERE id_usuario = xid_usuario)) THEN
		SELECT nomeUsuario, IFNULL(img_path, "img/imgUsers/foto-perfil.avif") "img_path", descricao
		FROM users
		WHERE id_usuario = xid_usuario;
	END IF;
END //
DELIMITER ;

CALL proc_BuscarPerfilUsuario (2)



# Procedure para adicionar redesocial do usuario

DELIMITER // 
DROP PROCEDURE IF EXISTS proc_AdicionarRedeSocial //
CREATE PROCEDURE proc_AdicionarRedeSocial (IN xid_usuario INT, xid_redesocial INT, link_redesocial VARCHAR(255))
BEGIN
	INSERT INTO user_redesocial (id_redesocial, id_usuario, link_rede)
	VALUES (xid_redesocial, xid_usuario, link_redesocial);
END //
DELIMITER ;

CALL proc_AdicionarRedeSocial(11, 1, "youtube.com");


# Procedure para listar somente as redes sociais que o usuario não tem

DELIMITER // 
DROP PROCEDURE IF EXISTS proc_RedeSocialParaCadastrar //
CREATE PROCEDURE proc_RedeSocialParaCadastrar (IN xid_usuario INT)
BEGIN
	SELECT id_redesocial, descritivo
	FROM redesocial
	WHERE id_redesocial NOT IN (SELECT id_redesocial FROM user_redesocial WHERE id_usuario = xid_usuario);
END //
DELIMITER ;

CALL proc_RedeSocialParaCadastrar(11)

# Procedure para comparar o numero de redes sociais existente e o numero que o usuario tem

DELIMITER // 
DROP PROCEDURE IF EXISTS proc_BuscarNumeroRedeSociasUsuario //
CREATE PROCEDURE proc_BuscarNumeroRedeSociasUsuario (IN xid_usuario INT)
BEGIN
	SELECT (SELECT COUNT(id_redesocial) FROM redesocial) - (SELECT COUNT(id_usuario) FROM user_redesocial WHERE id_usuario = xid_usuario) "RedesDisponiveis";
END //
DELIMITER ;

CALL proc_BuscarNumeroRedeSociasUsuario (11)


DELIMITER $$
DROP PROCEDURE IF EXISTS proc_buscarRecursosNaoPostados $$
CREATE PROCEDURE proc_buscarRecursosNaoPostados ()
BEGIN
	SELECT r.id_recurso "codigo", r.descricao, r.titulo, DATE_FORMAT(r.datacadastro, "%d/%m/%Y") "cadastro", u.nomeUsuario "usuario"
	FROM recursos r INNER JOIN users u
	ON (r.id_usuario = u.id_usuario)
	WHERE r.status = 0; 
END $$
DELIMITER ;

DELIMITER $$
DROP PROCEDURE IF EXISTS proc_ativar_recurso_adm $$
CREATE PROCEDURE proc_ativar_recurso_adm (IN codigo INT)
BEGIN
	UPDATE recursos SET STATUS = 1
	WHERE codigo = id_recurso;
END $$
DELIMITER ;

# Procedure para o adm reprovar o recurso, mas como o recurso tem chaves estrangeiras em outras tabelas é necessário criar uma trigger para tirar elas tbm

DELIMITER $$
DROP PROCEDURE IF EXISTS proc_reprovar_recurso_adm $$
CREATE PROCEDURE proc_reprovar_recurso_adm (IN codigo INT)
BEGIN
	DELETE FROM recursos
	WHERE id_recurso = codigo;
END $$
DELIMITER ;

CALL proc_reprovar_recurso_adm(2)

DELIMITER//
DROP TRIGGER IF EXISTS tr_apagarRecurso //
CREATE TRIGGER tr_apagarRecurso
BEFORE DELETE ON recursos
FOR EACH ROW
BEGIN
	IF(EXISTS(SELECT * FROM recurso_disciplina WHERE id_recurso = old.id_recurso)) THEN
		DELETE FROM recurso_disciplina WHERE id_recurso = old.id_recurso;
	END IF;
	
	IF(EXISTS(SELECT * FROM recurso_curso WHERE id_recurso = old.id_recurso)) THEN
		DELETE FROM recurso_curso WHERE id_recurso = old.id_recurso;
	END IF;
	
	IF(EXISTS(SELECT * FROM recursos_salvos WHERE id_recurso = old.id_recurso)) THEN
		DELETE FROM recursos_salvos WHERE id_recurso = old.id_recurso;
	END IF;
	
	IF(EXISTS(SELECT * FROM comentarios_recursos WHERE id_recurso = old.id_recurso)) THEN
		DELETE FROM comentarios_recursos WHERE id_recurso = old.id_recurso;
	END IF;
	
	IF(EXISTS(SELECT * FROM avaliacao_recurso WHERE id_recurso = old.id_recurso)) THEN
		DELETE FROM avaliacao_recurso WHERE id_recurso = old.id_recurso;
	END IF;
	
	IF(EXISTS(SELECT * FROM recurso_capes WHERE id_recurso = old.id_recurso)) THEN
		DELETE FROM recurso_capes WHERE id_recurso = old.id_recurso;
	END IF;
END//
DELIMITER;

# Procedure para apresentar o recurso
DELIMITER //
DROP PROCEDURE IF EXISTS proc_apresentacaoRecurso //
CREATE PROCEDURE proc_apresentacaoRecurso (IN codRecurso INT, codUsuario INT)
BEGIN
	IF(EXISTS(SELECT * FROM recursos WHERE recursos.id_recurso = codRecurso)) THEN
		IF(codUsuario <> 0) THEN
			SELECT r.id_recurso "codigo", r.titulo, r.descricao, DATE_FORMAT(r.datacadastro, '%d/%m/%Y') "data",
			r.video_path "video", r.img_recurso_path "imgr", IFNULL(AVG(ar.nota), 0) "nota",
			u.nomeUsuario "usuario", img_path "imgu", (SELECT COUNT(id_usuario) FROM recursos_salvos WHERE id_recurso = codRecurso AND id_usuario = codUsuario ) "favorito"
			FROM recursos r INNER JOIN users u
			ON(r.id_usuario = u.id_usuario) LEFT JOIN avaliacao_recurso ar
			ON(u.id_usuario = ar.id_usuario)
			WHERE r.id_recurso = codRecurso;
		ELSE
			SELECT r.id_recurso "codigo", r.titulo, r.descricao, DATE_FORMAT(r.datacadastro, '%d/%m/%Y') "data",
			r.video_path "video", r.img_recurso_path "imgr", IFNULL(AVG(ar.nota), 0) "nota",
			u.nomeUsuario "usuario", img_path "imgu", 0 "favorito"
			FROM recursos r INNER JOIN users u
			ON(r.id_usuario = u.id_usuario) LEFT JOIN avaliacao_recurso ar
			ON(u.id_usuario = ar.id_usuario)
			WHERE r.id_recurso = codRecurso;
		END IF;
	ELSE
		SELECT "Erro" AS msgErro;
	END IF;
END//
DELIMITER ;

CALL proc_apresentacaoRecurso(6,1)

# Procedure para cadastrar um recurso do tipo video


DELIMITER $$

USE `reduc`$$

DROP PROCEDURE IF EXISTS `proc_CadastroRecursoVideo`$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_CadastroRecursoVideo`(IN xtitulo VARCHAR(100), xdescricao VARCHAR(255), xvideo_path TEXT, xid_usuario INT, img_recurso_path TEXT, id_tiporecurso INT, id_ferramenta INT, OUT p_id_inserido INT)
BEGIN
	IF(id_ferramenta = 0)THEN
		SET id_ferramenta = NULL;
	END IF;
	INSERT INTO recursos (titulo, descricao, datacadastro, video_path, id_usuario, img_recurso_path, id_tiporecurso, id_ferramenta, STATUS)
	VALUES	(xtitulo, xdescricao, CURRENT_DATE, xvideo_path, xid_usuario, img_recurso_path, id_tiporecurso, id_ferramenta, 0);
	
	SET p_id_inserido = LAST_INSERT_ID();
END$$

DELIMITER ;

# Criando uma Procedure para buscar usuarios inativos no sistema

DELIMITER //
DROP PROCEDURE IF EXISTS proc_usuariosInativos//
CREATE PROCEDURE proc_usuariosInativos()
BEGIN
	SELECT id_usuario "codigo", nome, sobrenome, nomeUsuario "usuario", link_lattes "lattes", id_categoriaUsuario "categoria", email, DATE_FORMAT(datacadastro, '%d/%m/%Y') "cadastro", img_path "img", i.descritivo "instituicao"
	FROM users u INNER JOIN instituicao i
	ON(u.id_instituicao = i.id_instituicao)
	WHERE STATUS = 0;
END//
DELIMITER;

CALL proc_usuariosInativos();

# Criando procedure para aprovar usuario

DELIMITER //
DROP PROCEDURE IF EXISTS proc_aprovarUsuario//
CREATE PROCEDURE proc_aprovarUsuario(IN codUsuario INT)
BEGIN
	UPDATE users SET STATUS = 1
	WHERE id_usuario = codUsuario;
END//
DELIMITER;

# Criando procedure para banir usuario

DELIMITER //
DROP PROCEDURE IF EXISTS proc_banirUsuario//
CREATE PROCEDURE proc_banirUsuario(IN codUsuario INT)
BEGIN
	DELETE FROM users
	WHERE id_usuario = codUsuario;
END//
DELIMITER;

# Criando trigger para apagar os registros do usuario banido

DELIMITER//
DROP TRIGGER IF EXISTS tr_banirUsuario //
CREATE TRIGGER tr_banirUsuario
BEFORE DELETE ON users
FOR EACH ROW
BEGIN
	IF(EXISTS(SELECT * FROM recursos WHERE id_usuario = old.id_usuario)) THEN
		DELETE FROM recursos WHERE id_usuario = old.id_usuario;
	END IF;
	
	IF(EXISTS(SELECT * FROM user_redesocial WHERE id_usuario = old.id_usuario)) THEN
		DELETE FROM user_redesocial WHERE id_usuario = old.id_usuario;
	END IF;
	
	IF(EXISTS(SELECT * FROM seguir WHERE id_userseguido = old.id_usuario)) THEN
		DELETE FROM seguir WHERE id_userseguido = old.id_usuario;
	END IF;
	
	IF(EXISTS(SELECT * FROM seguir WHERE id_userseguindo = old.id_usuario)) THEN
		DELETE FROM seguir WHERE id_userseguindo = old.id_usuario;
	END IF;
	
	IF(EXISTS(SELECT * FROM recursos_salvos WHERE id_usuario = old.id_usuario)) THEN
		DELETE FROM recursos_salvos WHERE id_usuario = old.id_usuario;
	END IF;
	
	IF(EXISTS(SELECT * FROM comentarios_recursos WHERE id_usuario = old.id_usuario)) THEN
		DELETE FROM comentarios_recursos WHERE id_usuario = old.id_usuario;
	END IF;
	
	IF(EXISTS(SELECT * FROM comentarios_pa WHERE id_usuario = old.id_usuario)) THEN
		DELETE FROM comentarios_pa WHERE id_usuario = old.id_usuario;
	END IF;
	
	IF(EXISTS(SELECT * FROM avaliacao_recurso WHERE id_usuario = old.id_usuario)) THEN
		DELETE FROM avaliacao_recurso WHERE id_usuario = old.id_usuario;
	END IF;
	
	IF(EXISTS(SELECT * FROM avaliacao_pa WHERE id_usuario = old.id_usuario)) THEN
		DELETE FROM avaliacao_pa WHERE id_usuario = old.id_usuario;
	END IF;
END//
DELIMITER;