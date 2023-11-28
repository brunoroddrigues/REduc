

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
	id_instituicao INT NOT NULL,
	link_lattes TEXT,
	area_atuacao VARCHAR(25),
	senha VARCHAR(255) NOT NULL,
	id_pergunta INT NOT NULL,
	resposta_seguranca VARCHAR(30) NOT NULL,
	img_path VARCHAR(255),
	STATUS INT NOT NULL,
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
END//
DELIMITER ;

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
END//
DELIMITER ; 

DELIMITER //
DROP PROCEDURE IF EXISTS proc_CadastroProfessor//
CREATE PROCEDURE proc_CadastroProfessor (IN nomeU VARCHAR(25), sobrenomeU VARCHAR(25), nomeUsuarioU VARCHAR(35), cpfU CHAR(11), datanascimentoU DATE, emailU VARCHAR(300), senhaU VARCHAR(255), link_lattesU TEXT, area_atuacaoU VARCHAR(25), id_perguntaU INT, resposta_segurancaU VARCHAR(30), id_instituicaoU INT, id_categoriaUsuarioU INT, statusU BOOLEAN)
BEGIN
	INSERT INTO users (nome, sobrenome, nomeUsuario, cpf, datanascimento, email, senha, link_lattes, area_atuacao, id_pergunta, resposta_seguranca, id_instituicao, id_categoriaUsuario, STATUS)
	VALUES	(nomeU, sobrenomeU, nomeUsuarioU, cpfU, datanascimentoU, emailU, senhaU, link_lattesU, area_atuacaoU, id_perguntaU, resposta_segurancaU, id_instituicaoU, id_categoriaUsuarioU, statusU);
END//
DELIMITER ; 

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
END//
DELIMITER ;

DELIMITER //
DROP PROCEDURE IF EXISTS proc_InativarRecurso //
CREATE PROCEDURE proc_InativarRecurso (IN id_usuarioA INT, id_recursoA INT)
BEGIN
	IF (id_usuarioA = (SELECT id_usuario FROM recursos WHERE id_recurso = id_recursoA) OR EXISTS(SELECT id_usuario FROM users WHERE id_categoriaUsuario = 3 AND id_usuario = id_usuarioA)) THEN 
		UPDATE recursos SET STATUS = 0 WHERE id_recurso = id_recursoA;
	ELSE
		SELECT "Impossível..." AS msg;
	END IF;
END//
DELIMITER ;

DELIMITER //
DROP PROCEDURE IF EXISTS proc_AtivarRecursoUsuario //
CREATE PROCEDURE proc_AtivarRecursoUsuario (IN id_usuarioA INT, id_recursoA INT)
BEGIN
	IF (id_usuarioA = (SELECT id_usuario FROM recursos WHERE id_recurso = id_recursoA) OR EXISTS(SELECT id_usuario FROM users WHERE id_categoriaUsuario = 3 AND id_usuario = id_usuarioA)) THEN 
		UPDATE recursos SET STATUS = 1 WHERE id_recurso = id_recursoA;
	END IF;
END//
DELIMITER ;

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

DELIMITER $$
DROP PROCEDURE IF EXISTS proc_buscarTodosRecursos $$
CREATE PROCEDURE proc_buscarTodosRecursos (IN codigo INT)
BEGIN
	SELECT r.id_recurso "codigo", r.titulo, r.img_recurso_path, IFNULL(AVG(ar.nota), 0) "nota", IFNULL((
		SELECT rs.id_fav 
		FROM recursos_salvos rs
		WHERE r.id_recurso = rs.id_recurso AND codigo = rs.id_usuario
	), 0) "favorito"
	FROM recursos r LEFT JOIN avaliacao_recurso ar
	ON(r.id_recurso = ar.id_recurso)
	WHERE r.status <> 0	
	GROUP BY r.id_recurso
	ORDER BY AVG(ar.nota) DESC;
END $$
DELIMITER ;

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

DELIMITER // 
DROP PROCEDURE IF EXISTS proc_AdicionarRedeSocial //
CREATE PROCEDURE proc_AdicionarRedeSocial (IN xid_usuario INT, xid_redesocial INT, link_redesocial VARCHAR(255))
BEGIN
	INSERT INTO user_redesocial (id_redesocial, id_usuario, link_rede)
	VALUES (xid_redesocial, xid_usuario, link_redesocial);
END //
DELIMITER ;

DELIMITER // 
DROP PROCEDURE IF EXISTS proc_RedeSocialParaCadastrar //
CREATE PROCEDURE proc_RedeSocialParaCadastrar (IN xid_usuario INT)
BEGIN
	SELECT id_redesocial, descritivo
	FROM redesocial
	WHERE id_redesocial NOT IN (SELECT id_redesocial FROM user_redesocial WHERE id_usuario = xid_usuario);
END //
DELIMITER ;

DELIMITER // 
DROP PROCEDURE IF EXISTS proc_BuscarNumeroRedeSociasUsuario //
CREATE PROCEDURE proc_BuscarNumeroRedeSociasUsuario (IN xid_usuario INT)
BEGIN
	SELECT (SELECT COUNT(id_redesocial) FROM redesocial) - (SELECT COUNT(id_usuario) FROM user_redesocial WHERE id_usuario = xid_usuario) "RedesDisponiveis";
END //
DELIMITER ;

DELIMITER $$
DROP PROCEDURE IF EXISTS buscarRecursosNaoPostados $$
CREATE PROCEDURE buscarRecursosNaoPostados ()
BEGIN
	SELECT r.id_recurso "codigo", r.descricao, r.titulo, r.datacadastro "cadastro", u.nome "usuario"
	FROM recursos r INNER JOIN users u
	ON (r.id_usuario = u.id_usuario)
	WHERE r.status = 0; 
END $$
DELIMITER ;

DELIMITER // 
DROP PROCEDURE IF EXISTS proc_ativar_recursos_adm //
CREATE PROCEDURE proc_ativar_recursos_adm (IN codigo INT)
BEGIN
	UPDATE recursos SET STATUS = 1
	WHERE codigo = id_recurso;
END //
DELIMITER ;
























































