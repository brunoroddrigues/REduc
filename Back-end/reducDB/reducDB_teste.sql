CREATE DATABASE RDteste;

CREATE TABLE Instituicoes
(
	id_instituicao INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	descritivo VARCHAR(100)
);

CREATE TABLE pergunta_seguranca
(
	id_pergunta INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	descritivo VARCHAR(80)
);

CREATE TABLE categoria_usuario
(
	id_categoriaUsuario INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	descritivo VARCHAR(20) NOT NULL
);

CREATE TABLE rede_social
(
	id_rede INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	descritivo VARCHAR(10) NOT NULL
);

CREATE TABLE usuarios
(
	id_usuario INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	nome_completo VARCHAR(50) NOT NULL,
	cpf CHAR(11) NOT NULL,
	nome_usuario VARCHAR(25) NOT NULL, 
	email NVARCHAR(255) NOT NULL UNIQUE,
	senha VARCHAR(255) NOT NULL,
	img_usuario_path VARCHAR(255),
	area_atuacao VARCHAR(25),
	resposta_seguranca VARCHAR(30) NOT NULL,
	link_lattes TEXT,
	id_categoriaUsuario INT NOT NULL,
	id_pergunta INT NOT NULL,
	id_instituicao INT NOT NULL,
	FOREIGN KEY (id_categoriaUsuario) REFERENCES categoria_usuario (id_categoriaUsuario),
	FOREIGN KEY (id_pergunta) REFERENCES pergunta_seguranca (id_pergunta),
	FOREIGN KEY (id_instituicao) REFERENCES Instituicoes (id_instituicao)
);

CREATE TABLE usuario_redesocial
(
	id_user_rede INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	id_usuario INT NOT NULL,
	id_rede INT NOT NULL,
	link_rede_usuario TEXT NOT NULL,
	FOREIGN KEY (id_usuario) REFERENCES usuarios (id_usuario),
	FOREIGN KEY (id_rede) REFERENCES rede_social (id_rede)
);



/* Testando */

/* Inserindo dados */

INSERT INTO instituicoes (descritivo)
VALUE ("Fatec-Jahu");

INSERT INTO categoria_usuario (descritivo)
VALUES ("Aluno"),
       ("Professor"),
       ("Administrador")
       
INSERT INTO pergunta_seguranca (descritivo)
VALUE ("Qual o nome do seu cachorro");    

INSERT INTO usuarios (email, senha, nome_completo, cpf, nome_usuario, id_pergunta, resposta_seguranca,
		      id_instituicao,   id_categoriaUsuario)
		 
VALUES ("derek.nunes@fatec.sp.gov.br", "apenasumteste", "Dérek Anibal Nunes", "46901247786", "DerekNunes", 1, "Tobi", 
	1, 3);


UPDATE usuarios 
SET link_lattes = " http://lattes.cnpq.br/2562967883908634"
WHERE id_usuario = 2

/* Testando- criando um view com informaçoes basicas do user */

CREATE OR REPLACE VIEW vw_user AS
SELECT u.nome_usuario "Usuario", u.email "Email", u.link_lattes "Link Curriculo", c.descritivo "Categoria"
FROM usuarios u INNER JOIN categoria_usuario c
ON(u.id_categoriaUsuario = c.id_categoriaUsuario)

/* Criando as tabelas do recurso */

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

CREATE TABLE categoria_recurso
(
	id_categoria INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	descritivo VARCHAR(15) NOT NULL
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
	id_categoria INT NOT NULL,
	FOREIGN KEY (id_usuario) REFERENCES usuarios (id_usuario),
	FOREIGN KEY (id_ferramenta) REFERENCES ferramentas (id_ferramenta),
	FOREIGN KEY (id_categoria) REFERENCES categoria_recurso (id_categoria)
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

/* inserindo dados */

INSERT INTO disciplinas (descritivo)
VALUE ("Modulagem de banco de dados");

INSERT INTO cursos (descritivo)
VALUE ("Desenvolvimento de Software Multiplataforma");

INSERT INTO ferramentas (descritivo)
VALUE ("Javascript"),
      ("SQL"),
      ("BRmodelo");

INSERT INTO categoria_recurso (descritivo)
VALUE ("Video"),
      ("Artigo");

INSERT INTO area_conhecimento (codcapes, descritivo)
VALUE	("10300007", "Ciência da computação");

INSERT INTO recursos (titulo, descricao, datacadastro, id_usuario, id_ferramenta, id_categoria)
VALUE	("Modelagem de Banco de Dados", "Modelando um banco de dados usando o BRmodelo",
	'2023-09-04', 2, 3, 1);

INSERT INTO recurso_curso (id_recurso, id_curso)
VALUE	(1, 1);

INSERT INTO recurso_disciplina (id_recurso, id_disciplina)
VALUE	(1, 1);

/* Testando */

SELECT r.titulo, r.descricao, DATE_FORMAT(r.datacadastro, '%d/%m/%Y') "dataCadastro", u.nome_usuario, 
	f.descritivo "Ferramenta", c.descritivo "Curso", d.descritivo "Disciplina"
FROM usuarios u INNER JOIN recursos r
ON(u.id_usuario = r.id_usuario) INNER JOIN ferramentas f
ON(r.id_ferramenta = f.id_ferramenta) INNER JOIN recurso_curso rc
ON(r.id_recurso = rc.id_recurso) INNER JOIN cursos c
ON(rc.id_curso = c.id_curso) INNER JOIN recurso_disciplina rd
ON(r.id_recurso = rd.id_recurso) INNER JOIN disciplinas d
ON(rd.id_disciplina = d.id_disciplina)

/* Criando tabelas da PA*/

CREATE TABLE tipos_pa
(
	id_tipo_pa INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	descritivo VARCHAR(25) NOT NULL
);

CREATE TABLE pa
(
	id_pa INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	titulo VARCHAR(100) NOT NULL,
	descricao VARCHAR(255) NOT NULL,
	datacadastro DATE NOT NULL,
	link_arquivo TEXT NOT NULL,
	link_img TEXT,
	id_usuario INT NOT NULL,
	id_tipo_pa INT NOT NULL,
	FOREIGN KEY (id_usuario) REFERENCES usuarios (id_usuario),
	FOREIGN KEY (id_tipo_pa) REFERENCES tipos_pa (id_tipo_pa)
);


 

