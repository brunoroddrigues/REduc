/*
SQLyog Enterprise - MySQL GUI v8.12 
MySQL - 5.5.5-10.4.32-MariaDB : Database - reduc
*********************************************************************
*/


/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE = ''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS = @@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS = 0 */;
/*!40101 SET @OLD_SQL_MODE = @@SQL_MODE, SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO' */;

CREATE DATABASE /*!32312 IF NOT EXISTS */`reduc` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `reduc`;

/*Table structure for table `area_conhecimento` */

DROP TABLE IF EXISTS `area_conhecimento`;

CREATE TABLE `area_conhecimento`
(
    `id_areaconhecimento` int(11)     NOT NULL AUTO_INCREMENT,
    `codcapes`            varchar(15) NOT NULL,
    `descritivo`          varchar(60) NOT NULL,
    PRIMARY KEY (`id_areaconhecimento`),
    UNIQUE KEY `codcapes` (`codcapes`),
    UNIQUE KEY `descritivo` (`descritivo`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

/*Data for the table `area_conhecimento` */

/*Table structure for table `avaliacao_pa` */

DROP TABLE IF EXISTS `avaliacao_pa`;

CREATE TABLE `avaliacao_pa`
(
    `id_avaliacao` int(11) NOT NULL AUTO_INCREMENT,
    `id_usuario`   int(11) NOT NULL,
    `id_pa`        int(11) NOT NULL,
    `nota`         int(11) NOT NULL,
    PRIMARY KEY (`id_avaliacao`),
    KEY `id_usuario` (`id_usuario`),
    KEY `id_pa` (`id_pa`),
    CONSTRAINT `avaliacao_pa_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `users` (`id_usuario`),
    CONSTRAINT `avaliacao_pa_ibfk_2` FOREIGN KEY (`id_pa`) REFERENCES `pa` (`id_pa`)
) ENGINE = InnoDB
  AUTO_INCREMENT = 2
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

/*Data for the table `avaliacao_pa` */

insert into `avaliacao_pa`(`id_avaliacao`, `id_usuario`, `id_pa`, `nota`)
values (1, 1, 4, 3);

/*Table structure for table `avaliacao_recurso` */

DROP TABLE IF EXISTS `avaliacao_recurso`;

CREATE TABLE `avaliacao_recurso`
(
    `id_avaliacao` int(11) NOT NULL AUTO_INCREMENT,
    `id_usuario`   int(11) NOT NULL,
    `id_recurso`   int(11) NOT NULL,
    `nota`         int(11) NOT NULL,
    PRIMARY KEY (`id_avaliacao`),
    KEY `id_usuario` (`id_usuario`),
    KEY `id_recurso` (`id_recurso`),
    CONSTRAINT `avaliacao_recurso_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `users` (`id_usuario`),
    CONSTRAINT `avaliacao_recurso_ibfk_2` FOREIGN KEY (`id_recurso`) REFERENCES `recursos` (`id_recurso`)
) ENGINE = InnoDB
  AUTO_INCREMENT = 11
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

/*Data for the table `avaliacao_recurso` */

insert into `avaliacao_recurso`(`id_avaliacao`, `id_usuario`, `id_recurso`, `nota`)
values (5, 1, 16, 5),
       (8, 1, 23, 2);

/*Table structure for table `categoriausuario` */

DROP TABLE IF EXISTS `categoriausuario`;

CREATE TABLE `categoriausuario`
(
    `id_categoriaUsuario` int(11)     NOT NULL AUTO_INCREMENT,
    `descritivo`          varchar(15) NOT NULL,
    PRIMARY KEY (`id_categoriaUsuario`),
    UNIQUE KEY `descritivo` (`descritivo`)
) ENGINE = InnoDB
  AUTO_INCREMENT = 4
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

/*Data for the table `categoriausuario` */

insert into `categoriausuario`(`id_categoriaUsuario`, `descritivo`)
values (3, 'Administrador'),
       (1, 'Aluno'),
       (2, 'Professor');

/*Table structure for table `comentarios_recursos` */

DROP TABLE IF EXISTS `comentarios_recursos`;

CREATE TABLE `comentarios_recursos`
(
    `id_comentario`  int(11)      NOT NULL AUTO_INCREMENT,
    `id_usuario`     int(11)      NOT NULL,
    `id_recurso`     int(11)      NOT NULL,
    `descritivo`     varchar(480) NOT NULL,
    `datacomentario` date         NOT NULL,
    PRIMARY KEY (`id_comentario`),
    KEY `id_usuario` (`id_usuario`),
    KEY `id_recurso` (`id_recurso`),
    CONSTRAINT `comentarios_recursos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `users` (`id_usuario`),
    CONSTRAINT `comentarios_recursos_ibfk_2` FOREIGN KEY (`id_recurso`) REFERENCES `recursos` (`id_recurso`)
) ENGINE = InnoDB
  AUTO_INCREMENT = 14
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

/*Data for the table `comentarios_recursos` */

insert into `comentarios_recursos`(`id_comentario`, `id_usuario`, `id_recurso`, `descritivo`, `datacomentario`)
values (4, 1, 16, 'Recurso realmente bem explicativo, adorei. ', '2023-12-05'),
       (12, 1, 16, 'Gostei do vídeo', '2023-12-15');

/*Table structure for table `cursos` */

DROP TABLE IF EXISTS `cursos`;

CREATE TABLE `cursos`
(
    `id_curso`   int(11)     NOT NULL AUTO_INCREMENT,
    `descritivo` varchar(50) NOT NULL,
    PRIMARY KEY (`id_curso`),
    UNIQUE KEY `descritivo` (`descritivo`)
) ENGINE = InnoDB
  AUTO_INCREMENT = 5
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

/*Data for the table `cursos` */

insert into `cursos`(`id_curso`, `descritivo`)
values (3, 'Construção Naval'),
       (4, 'Recursos Hídricos'),
       (2, 'Sistemas Navais'),
       (1, 'Sistemas para Internet');

/*Table structure for table `denuncia_comentario` */

DROP TABLE IF EXISTS `denuncia_comentario`;

CREATE TABLE `denuncia_comentario`
(
    `id_denuncia`   int(11) NOT NULL AUTO_INCREMENT,
    `id_usuario`    int(11) NOT NULL,
    `id_comentario` int(11) NOT NULL,
    PRIMARY KEY (`id_denuncia`),
    KEY `id_usuario` (`id_usuario`),
    KEY `id_comentario` (`id_comentario`),
    CONSTRAINT `denuncia_comentario_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `users` (`id_usuario`),
    CONSTRAINT `denuncia_comentario_ibfk_2` FOREIGN KEY (`id_comentario`) REFERENCES `comentarios_recursos` (`id_comentario`)
) ENGINE = InnoDB
  AUTO_INCREMENT = 4
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

/*Data for the table `denuncia_comentario` */

/*Table structure for table `disciplinas` */

DROP TABLE IF EXISTS `disciplinas`;

CREATE TABLE `disciplinas`
(
    `id_disciplina` int(11)     NOT NULL AUTO_INCREMENT,
    `descritivo`    varchar(50) NOT NULL,
    PRIMARY KEY (`id_disciplina`),
    UNIQUE KEY `descritivo` (`descritivo`)
) ENGINE = InnoDB
  AUTO_INCREMENT = 5
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

/*Data for the table `disciplinas` */

insert into `disciplinas`(`id_disciplina`, `descritivo`)
values (2, 'Algorítmos e lógica de programação'),
       (3, 'Cálculo I'),
       (4, 'Cálculo II'),
       (1, 'Programação de servidores');

/*Table structure for table `ferramentas` */

DROP TABLE IF EXISTS `ferramentas`;

CREATE TABLE `ferramentas`
(
    `id_ferramenta` int(11)     NOT NULL AUTO_INCREMENT,
    `descritivo`    varchar(25) NOT NULL,
    PRIMARY KEY (`id_ferramenta`),
    UNIQUE KEY `descritivo` (`descritivo`)
) ENGINE = InnoDB
  AUTO_INCREMENT = 6
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

/*Data for the table `ferramentas` */

insert into `ferramentas`(`id_ferramenta`, `descritivo`)
values (3, 'AutoCAD'),
       (4, 'C'),
       (2, 'JavaScript'),
       (1, 'PHP'),
       (5, 'Python');

/*Table structure for table `instituicao` */

DROP TABLE IF EXISTS `instituicao`;

CREATE TABLE `instituicao`
(
    `id_instituicao` int(11)      NOT NULL AUTO_INCREMENT,
    `descritivo`     varchar(100) NOT NULL,
    PRIMARY KEY (`id_instituicao`),
    UNIQUE KEY `descritivo` (`descritivo`)
) ENGINE = InnoDB
  AUTO_INCREMENT = 3
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

/*Data for the table `instituicao` */

insert into `instituicao`(`id_instituicao`, `descritivo`)
values (1, 'Fatec-Jahu'),
       (2, 'USP-Bauru');

/*Table structure for table `pa` */

DROP TABLE IF EXISTS `pa`;

CREATE TABLE `pa`
(
    `id_pa`        int(11)      NOT NULL AUTO_INCREMENT,
    `titulo`       varchar(100) NOT NULL,
    `descricao`    varchar(255) NOT NULL,
    `datacadastro` date         NOT NULL,
    `arquivo_path` text DEFAULT NULL,
    `img_pa_path`  text DEFAULT NULL,
    `id_usuario`   int(11)      NOT NULL,
    `id_tipo`      int(11)      NOT NULL,
    `status`       int(11)      NOT NULL,
    PRIMARY KEY (`id_pa`),
    KEY `id_tipo` (`id_tipo`),
    KEY `id_usuario` (`id_usuario`),
    CONSTRAINT `pa_ibfk_1` FOREIGN KEY (`id_tipo`) REFERENCES `tipos_pa` (`id_tipo`),
    CONSTRAINT `pa_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `users` (`id_usuario`)
) ENGINE = InnoDB
  AUTO_INCREMENT = 6
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

/*Data for the table `pa` */

insert into `pa`(`id_pa`, `titulo`, `descricao`, `datacadastro`, `arquivo_path`, `img_pa_path`, `id_usuario`, `id_tipo`,
                 `status`)
values (4, 'apenas um teste novo', 'testando', '2023-12-16', 'PA/arquivos/9a2f82d001bf8b94a4364951fed7df8c08e9737d.pdf',
        'img/imgPA/img_pa_padrao.jpg', 1, 1, 1);

/*Table structure for table `perguntaseguranca` */

DROP TABLE IF EXISTS `perguntaseguranca`;

CREATE TABLE `perguntaseguranca`
(
    `id_pergunta` int(11)     NOT NULL AUTO_INCREMENT,
    `descritivo`  varchar(80) NOT NULL,
    PRIMARY KEY (`id_pergunta`),
    UNIQUE KEY `descritivo` (`descritivo`)
) ENGINE = InnoDB
  AUTO_INCREMENT = 4
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

/*Data for the table `perguntaseguranca` */

insert into `perguntaseguranca`(`id_pergunta`, `descritivo`)
values (2, 'Onde você nasceu?'),
       (1, 'Qual o nome do seu cachorro?'),
       (3, 'Quantos irmãos você tem?');

/*Table structure for table `recurso_capes` */

DROP TABLE IF EXISTS `recurso_capes`;

CREATE TABLE `recurso_capes`
(
    `id_rec_capes`        int(11) NOT NULL AUTO_INCREMENT,
    `id_recurso`          int(11) NOT NULL,
    `id_areaconhecimento` int(11) NOT NULL,
    PRIMARY KEY (`id_rec_capes`),
    KEY `id_recurso` (`id_recurso`),
    KEY `id_areaconhecimento` (`id_areaconhecimento`),
    CONSTRAINT `recurso_capes_ibfk_1` FOREIGN KEY (`id_recurso`) REFERENCES `recursos` (`id_recurso`),
    CONSTRAINT `recurso_capes_ibfk_2` FOREIGN KEY (`id_areaconhecimento`) REFERENCES `area_conhecimento` (`id_areaconhecimento`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

/*Data for the table `recurso_capes` */

/*Table structure for table `recurso_curso` */

DROP TABLE IF EXISTS `recurso_curso`;

CREATE TABLE `recurso_curso`
(
    `id_rec_curs` int(11) NOT NULL AUTO_INCREMENT,
    `id_recurso`  int(11) NOT NULL,
    `id_curso`    int(11) NOT NULL,
    PRIMARY KEY (`id_rec_curs`),
    KEY `id_recurso` (`id_recurso`),
    KEY `id_curso` (`id_curso`),
    CONSTRAINT `recurso_curso_ibfk_1` FOREIGN KEY (`id_recurso`) REFERENCES `recursos` (`id_recurso`),
    CONSTRAINT `recurso_curso_ibfk_2` FOREIGN KEY (`id_curso`) REFERENCES `cursos` (`id_curso`)
) ENGINE = InnoDB
  AUTO_INCREMENT = 10
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

/*Data for the table `recurso_curso` */

insert into `recurso_curso`(`id_rec_curs`, `id_recurso`, `id_curso`)
values (9, 16, 4);

/*Table structure for table `recurso_disciplina` */

DROP TABLE IF EXISTS `recurso_disciplina`;

CREATE TABLE `recurso_disciplina`
(
    `id_rec_disci`  int(11) NOT NULL AUTO_INCREMENT,
    `id_recurso`    int(11) NOT NULL,
    `id_disciplina` int(11) NOT NULL,
    PRIMARY KEY (`id_rec_disci`),
    KEY `id_recurso` (`id_recurso`),
    KEY `id_disciplina` (`id_disciplina`),
    CONSTRAINT `recurso_disciplina_ibfk_1` FOREIGN KEY (`id_recurso`) REFERENCES `recursos` (`id_recurso`),
    CONSTRAINT `recurso_disciplina_ibfk_2` FOREIGN KEY (`id_disciplina`) REFERENCES `disciplinas` (`id_disciplina`)
) ENGINE = InnoDB
  AUTO_INCREMENT = 6
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

/*Data for the table `recurso_disciplina` */

/*Table structure for table `recursos` */

DROP TABLE IF EXISTS `recursos`;

CREATE TABLE `recursos`
(
    `id_recurso`       int(11)      NOT NULL AUTO_INCREMENT,
    `titulo`           varchar(100) NOT NULL,
    `descricao`        varchar(255) NOT NULL,
    `datacadastro`     date         NOT NULL,
    `video_path`       text    DEFAULT NULL,
    `artigo_path`      text    DEFAULT NULL,
    `img_recurso_path` text    DEFAULT NULL,
    `id_usuario`       int(11)      NOT NULL,
    `id_ferramenta`    int(11) DEFAULT NULL,
    `id_tiporecurso`   int(11)      NOT NULL,
    `status`           int(11)      NOT NULL,
    PRIMARY KEY (`id_recurso`),
    KEY `id_usuario` (`id_usuario`),
    KEY `id_ferramenta` (`id_ferramenta`),
    KEY `id_tiporecurso` (`id_tiporecurso`),
    CONSTRAINT `recursos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `users` (`id_usuario`),
    CONSTRAINT `recursos_ibfk_2` FOREIGN KEY (`id_ferramenta`) REFERENCES `ferramentas` (`id_ferramenta`),
    CONSTRAINT `recursos_ibfk_3` FOREIGN KEY (`id_tiporecurso`) REFERENCES `tiporecurso` (`id_tiporecurso`)
) ENGINE = InnoDB
  AUTO_INCREMENT = 24
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

/*Data for the table `recursos` */

insert into `recursos`(`id_recurso`, `titulo`, `descricao`, `datacadastro`, `video_path`, `artigo_path`,
                       `img_recurso_path`, `id_usuario`, `id_ferramenta`, `id_tiporecurso`, `status`)
values (16, 'Aula de como tomar vinho', 'CR7 ensinando a tomar vinho', '2023-12-04',
        'Recursos/videos/f99268123e81044e5af916e6f80c5b6fe0128522.mp4', NULL,
        'img/imgRecursos/490513ee9e5c035203f8ef77fe990a1b9146ea79.jpeg', 11, NULL, 1, 1),
       (23, 'teste pdf', 'teste', '2023-12-11', NULL, 'Recursos/arquivos/bd80c30bd84cb07420cc44411901b4e135774ce5.pdf',
        'img/imgRecursos/img_recursos_padrao.jpg', 1, NULL, 2, 1);

/*Table structure for table `recursos_salvos` */

DROP TABLE IF EXISTS `recursos_salvos`;

CREATE TABLE `recursos_salvos`
(
    `id_fav`     int(11) NOT NULL AUTO_INCREMENT,
    `id_recurso` int(11) NOT NULL,
    `id_usuario` int(11) NOT NULL,
    PRIMARY KEY (`id_fav`),
    KEY `id_usuario` (`id_usuario`),
    KEY `id_recurso` (`id_recurso`),
    CONSTRAINT `recursos_salvos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `users` (`id_usuario`),
    CONSTRAINT `recursos_salvos_ibfk_2` FOREIGN KEY (`id_recurso`) REFERENCES `recursos` (`id_recurso`)
) ENGINE = InnoDB
  AUTO_INCREMENT = 15
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

/*Data for the table `recursos_salvos` */

insert into `recursos_salvos`(`id_fav`, `id_recurso`, `id_usuario`)
values (13, 16, 1);

/*Table structure for table `redesocial` */

DROP TABLE IF EXISTS `redesocial`;

CREATE TABLE `redesocial`
(
    `id_redesocial` int(11)     NOT NULL AUTO_INCREMENT,
    `descritivo`    varchar(10) NOT NULL,
    PRIMARY KEY (`id_redesocial`),
    UNIQUE KEY `descritivo` (`descritivo`)
) ENGINE = InnoDB
  AUTO_INCREMENT = 6
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

/*Data for the table `redesocial` */

insert into `redesocial`(`id_redesocial`, `descritivo`)
values (4, 'Facebook'),
       (3, 'GitHub'),
       (2, 'Instagram'),
       (5, 'Linkedin'),
       (1, 'Twitter');

/*Table structure for table `seguir` */

DROP TABLE IF EXISTS `seguir`;

CREATE TABLE `seguir`
(
    `id_seguir`       int(11) NOT NULL AUTO_INCREMENT,
    `id_userseguido`  int(11) NOT NULL,
    `id_userseguindo` int(11) NOT NULL,
    PRIMARY KEY (`id_seguir`),
    KEY `id_userseguido` (`id_userseguido`),
    KEY `id_userseguindo` (`id_userseguindo`),
    CONSTRAINT `seguir_ibfk_1` FOREIGN KEY (`id_userseguido`) REFERENCES `users` (`id_usuario`),
    CONSTRAINT `seguir_ibfk_2` FOREIGN KEY (`id_userseguindo`) REFERENCES `users` (`id_usuario`)
) ENGINE = InnoDB
  AUTO_INCREMENT = 7
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

/*Data for the table `seguir` */

insert into `seguir`(`id_seguir`, `id_userseguido`, `id_userseguindo`)
values (1, 13, 1),
       (5, 11, 1),
       (6, 11, 12);

/*Table structure for table `tiporecurso` */

DROP TABLE IF EXISTS `tiporecurso`;

CREATE TABLE `tiporecurso`
(
    `id_tiporecurso` int(11)     NOT NULL AUTO_INCREMENT,
    `descritivo`     varchar(10) NOT NULL,
    PRIMARY KEY (`id_tiporecurso`),
    UNIQUE KEY `descritivo` (`descritivo`)
) ENGINE = InnoDB
  AUTO_INCREMENT = 3
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

/*Data for the table `tiporecurso` */

insert into `tiporecurso`(`id_tiporecurso`, `descritivo`)
values (2, 'Artigo'),
       (1, 'Vídeo');

/*Table structure for table `tipos_pa` */

DROP TABLE IF EXISTS `tipos_pa`;

CREATE TABLE `tipos_pa`
(
    `id_tipo`    int(11)     NOT NULL AUTO_INCREMENT,
    `descritivo` varchar(25) NOT NULL,
    PRIMARY KEY (`id_tipo`),
    UNIQUE KEY `descritivo` (`descritivo`)
) ENGINE = InnoDB
  AUTO_INCREMENT = 2
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

/*Data for the table `tipos_pa` */

insert into `tipos_pa`(`id_tipo`, `descritivo`)
values (1, 'Rubrica');

/*Table structure for table `user_redesocial` */

DROP TABLE IF EXISTS `user_redesocial`;

CREATE TABLE `user_redesocial`
(
    `id_userrede`   int(11)      NOT NULL AUTO_INCREMENT,
    `link_rede`     varchar(255) NOT NULL,
    `id_redesocial` int(11)      NOT NULL,
    `id_usuario`    int(11)      NOT NULL,
    PRIMARY KEY (`id_userrede`),
    UNIQUE KEY `link_rede` (`link_rede`),
    KEY `id_redesocial` (`id_redesocial`),
    KEY `id_usuario` (`id_usuario`),
    CONSTRAINT `user_redesocial_ibfk_1` FOREIGN KEY (`id_redesocial`) REFERENCES `redesocial` (`id_redesocial`),
    CONSTRAINT `user_redesocial_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `users` (`id_usuario`)
) ENGINE = InnoDB
  AUTO_INCREMENT = 3
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

/*Data for the table `user_redesocial` */

insert into `user_redesocial`(`id_userrede`, `link_rede`, `id_redesocial`, `id_usuario`)
values (1,
        'https://www.google.com/url?sa=t&rct=j&q=&esrc=s&source=web&cd=&cad=rja&uact=8&ved=2ahUKEwidspWo3_WCAxWepZUCHVjWBgEQFnoECBIQAQ&url=https%3A%2F%2Fwww.facebook.com%2FCristiano%2F%3Flocale%3Dpt_BR&usg=AOvVaw0UQSlf1kyQf8GyHiWp0T0v&opi=89978449',
        4, 1),
       (2,
        'https://www.google.com/url?sa=t&rct=j&q=&esrc=s&source=web&cd=&cad=rja&uact=8&ved=2ahUKEwi1xKur7PWCAxU_rJUCHbMjCuwQFnoECA4QAQ&url=https%3A%2F%2Fwww.instagram.com%2Fneymarjr%2F&usg=AOvVaw3kx_9Frkp1OyqIPLCtoGsJ&opi=89978449',
        2, 1);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users`
(
    `id_usuario`          int(11)      NOT NULL AUTO_INCREMENT,
    `id_categoriaUsuario` int(11)      NOT NULL,
    `nomeUsuario`         varchar(35)  NOT NULL,
    `nome`                varchar(25)  NOT NULL,
    `sobrenome`           varchar(25)  NOT NULL,
    `email`               varchar(300) NOT NULL,
    `cpf`                 char(11)     NOT NULL,
    `descricao`           varchar(255) DEFAULT NULL,
    `datanascimento`      date         NOT NULL,
    `id_instituicao`      int(11)      NOT NULL,
    `link_lattes`         text         DEFAULT NULL,
    `area_atuacao`        varchar(25)  DEFAULT NULL,
    `senha`               varchar(255) NOT NULL,
    `id_pergunta`         int(11)      NOT NULL,
    `resposta_seguranca`  varchar(30)  NOT NULL,
    `img_path`            varchar(255) DEFAULT NULL,
    `status`              int(11)      NOT NULL,
    `datacadastro`        date         NOT NULL,
    PRIMARY KEY (`id_usuario`),
    UNIQUE KEY `nomeUsuario` (`nomeUsuario`),
    UNIQUE KEY `email` (`email`),
    UNIQUE KEY `cpf` (`cpf`),
    KEY `id_categoriaUsuario` (`id_categoriaUsuario`),
    KEY `id_pergunta` (`id_pergunta`),
    KEY `id_instituicao` (`id_instituicao`),
    CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_categoriaUsuario`) REFERENCES `categoriausuario` (`id_categoriaUsuario`),
    CONSTRAINT `users_ibfk_2` FOREIGN KEY (`id_pergunta`) REFERENCES `perguntaseguranca` (`id_pergunta`),
    CONSTRAINT `users_ibfk_3` FOREIGN KEY (`id_instituicao`) REFERENCES `instituicao` (`id_instituicao`)
) ENGINE = InnoDB
  AUTO_INCREMENT = 14
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

/*Data for the table `users` */

insert into `users`(`id_usuario`, `id_categoriaUsuario`, `nomeUsuario`, `nome`, `sobrenome`, `email`, `cpf`,
                    `descricao`, `datanascimento`, `id_instituicao`, `link_lattes`, `area_atuacao`, `senha`,
                    `id_pergunta`, `resposta_seguranca`, `img_path`, `status`, `datacadastro`)
values (1, 3, 'Derek Nunes', 'Dérek', 'Nunes', 'derek.nunes@fatec.sp.gov.br', '77777777777', 'Apenas o administrador',
        '2002-12-04', 1, NULL, NULL, '769f2b8a75180c1e8c9b37ccbcf9e049', 1, 'maumau',
        'img/imgUsers/4f26ebf05cc79b940138269c19305970.jpg', 1, '2023-10-04'),
       (10, 1, 'Brunão', 'Bruno', 'Rodrigues', 'brunaospfc@email.com', '46801348876', NULL, '2002-12-04', 1, NULL, NULL,
        '112cb04f8ddf9c7e695f7b896e33b22f', 1, 'Rodrigo Nestor', 'img/imgUsers/img_padrao_user.jpg', 1, '2023-12-04'),
       (11, 2, 'ProfGirafales', 'Professor', 'Girafales', 'girafales@email.com', '43941428810', NULL, '2004-03-05', 1,
        'isdfaksjdhf.com', 'exatas', '1b0b539f722fa757130aba4217927784', 2, 'pederneiras',
        'img/imgUsers/img_padrao_user.jpg', 0, '2023-12-04'),
       (12, 1, 'Bruno ', 'Bruno', 'Rodrigues', 'bruno.rodrigues@email.com', '45377870824', NULL, '1997-05-14', 1, NULL,
        NULL, 'e3928a3bc4be46516aa33a79bbdfdb08', 2, 'jau', 'img/imgUsers/img_padrao_user.jpg', 1, '2023-12-04'),
       (13, 2, 'cidazem', 'Aparecida Maria', 'Zem Lopes', 'cida.zem@gmail.com', '10301050813', NULL, '1964-10-26', 1,
        'http://lattes.cnpq.br/6123540746643830', 'Educação e Tecnologias', 'e10adc3949ba59abbe56e057f20f883e', 2,
        'Jaú', 'img/imgUsers/img_padrao_user.jpg', 1, '2023-12-06');

/* Trigger structure for table `pa` */

DELIMITER $$

/*!50003 DROP TRIGGER *//*!50032 IF EXISTS */ /*!50003 `tr_apagarPa` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'reduc'@'%' */ /*!50003 TRIGGER `tr_apagarPa`
    BEFORE DELETE
    ON `pa`
    FOR EACH ROW
BEGIN
    IF (EXISTS(SELECT * FROM avaliacao_pa WHERE id_pa = old.id_pa)) THEN
        DELETE FROM avaliacao_pa WHERE id_pa = old.id_pa;
    END IF;

    IF (EXISTS(SELECT * FROM comentarios_pa WHERE id_pa = old.id_pa)) THEN
        DELETE FROM comentarios_pa WHERE id_pa = old.id_pa;
    END IF;
END */$$


DELIMITER ;

/* Trigger structure for table `recursos` */

DELIMITER $$

/*!50003 DROP TRIGGER *//*!50032 IF EXISTS */ /*!50003 `tr_apagarRecurso` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'reduc'@'%' */ /*!50003 TRIGGER `tr_apagarRecurso`
    BEFORE DELETE
    ON `recursos`
    FOR EACH ROW
begin
    if (exists(select * from recurso_disciplina where id_recurso = old.id_recurso)) then
        delete from recurso_disciplina where id_recurso = old.id_recurso;
    end if;

    if (exists(select * from recurso_curso where id_recurso = old.id_recurso)) then
        DELETE FROM recurso_curso WHERE id_recurso = old.id_recurso;
    end if;

    IF (EXISTS(SELECT * FROM recursos_salvos WHERE id_recurso = old.id_recurso)) THEN
        DELETE FROM recursos_salvos WHERE id_recurso = old.id_recurso;
    END IF;

    IF (EXISTS(SELECT * FROM comentarios_recursos WHERE id_recurso = old.id_recurso)) THEN
        DELETE FROM comentarios_recursos WHERE id_recurso = old.id_recurso;
    END IF;

    IF (EXISTS(SELECT * FROM avaliacao_recurso WHERE id_recurso = old.id_recurso)) THEN
        DELETE FROM avaliacao_recurso WHERE id_recurso = old.id_recurso;
    END IF;

    IF (EXISTS(SELECT * FROM recurso_capes WHERE id_recurso = old.id_recurso)) THEN
        DELETE FROM recurso_capes WHERE id_recurso = old.id_recurso;
    END IF;
end */$$


DELIMITER ;

/* Trigger structure for table `users` */

DELIMITER $$

/*!50003 DROP TRIGGER *//*!50032 IF EXISTS */ /*!50003 `tr_banirUsuario` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'reduc'@'%' */ /*!50003 TRIGGER `tr_banirUsuario`
    BEFORE DELETE
    ON `users`
    FOR EACH ROW
BEGIN
    IF (EXISTS(SELECT * FROM recursos WHERE id_usuario = old.id_usuario)) THEN
        DELETE FROM recursos WHERE id_usuario = old.id_usuario;
    END IF;

    IF (EXISTS(SELECT * FROM user_redesocial WHERE id_usuario = old.id_usuario)) THEN
        DELETE FROM user_redesocial WHERE id_usuario = old.id_usuario;
    END IF;

    IF (EXISTS(SELECT * FROM seguir WHERE id_userseguido = old.id_usuario)) THEN
        DELETE FROM seguir WHERE id_userseguido = old.id_usuario;
    END IF;

    IF (EXISTS(SELECT * FROM seguir WHERE id_userseguindo = old.id_usuario)) THEN
        DELETE FROM seguir WHERE id_userseguindo = old.id_usuario;
    END IF;

    IF (EXISTS(SELECT * FROM recursos_salvos WHERE id_usuario = old.id_usuario)) THEN
        DELETE FROM recursos_salvos WHERE id_usuario = old.id_usuario;
    END IF;

    IF (EXISTS(SELECT * FROM comentarios_recursos WHERE id_usuario = old.id_usuario)) THEN
        DELETE FROM comentarios_recursos WHERE id_usuario = old.id_usuario;
    END IF;

    IF (EXISTS(SELECT * FROM comentarios_pa WHERE id_usuario = old.id_usuario)) THEN
        DELETE FROM comentarios_pa WHERE id_usuario = old.id_usuario;
    END IF;

    IF (EXISTS(SELECT * FROM avaliacao_recurso WHERE id_usuario = old.id_usuario)) THEN
        DELETE FROM avaliacao_recurso WHERE id_usuario = old.id_usuario;
    END IF;

    IF (EXISTS(SELECT * FROM avaliacao_pa WHERE id_usuario = old.id_usuario)) THEN
        DELETE FROM avaliacao_pa WHERE id_usuario = old.id_usuario;
    END IF;
END */$$


DELIMITER ;

/* Procedure structure for procedure `buscarRecursosNaoPostados` */

/*!50003 DROP PROCEDURE IF EXISTS `buscarRecursosNaoPostados` */;

DELIMITER $$

/*!50003 CREATE
    DEFINER = `reduc`@`%` PROCEDURE `buscarRecursosNaoPostados`()
BEGIN
    SELECT r.id_recurso "codigo", r.descricao, r.titulo, r.datacadastro "cadastro", u.nome "usuario"
    FROM recursos r
             INNER JOIN users u
                        ON (r.id_usuario = u.id_usuario)
    WHERE r.status = 0;
END */$$
DELIMITER ;

/* Procedure structure for procedure `proc_adicionarComentario` */

/*!50003 DROP PROCEDURE IF EXISTS `proc_adicionarComentario` */;

DELIMITER $$

/*!50003 CREATE
    DEFINER = `reduc`@`%` PROCEDURE `proc_adicionarComentario`(in codRecurso int, codUsuario int, comentario varchar(480))
begin
    insert into comentarios_recursos (id_usuario, id_recurso, descritivo, datacomentario)
    values (codUsuario, codRecurso, comentario, current_date);
end */$$
DELIMITER ;

/* Procedure structure for procedure `proc_AdicionarRedeSocial` */

/*!50003 DROP PROCEDURE IF EXISTS `proc_AdicionarRedeSocial` */;

DELIMITER $$

/*!50003 CREATE
    DEFINER = `reduc`@`%` PROCEDURE `proc_AdicionarRedeSocial`(IN xid_usuario INT, xid_redesocial INT, link_redesocial VARCHAR(255))
BEGIN
    INSERT INTO user_redesocial (id_redesocial, id_usuario, link_rede)
    VALUES (xid_redesocial, xid_usuario, link_redesocial);
END */$$
DELIMITER ;

/* Procedure structure for procedure `proc_apresentacaoPa` */

/*!50003 DROP PROCEDURE IF EXISTS `proc_apresentacaoPa` */;

DELIMITER $$

/*!50003 CREATE
    DEFINER = `reduc`@`%` PROCEDURE `proc_apresentacaoPa`(IN codPa INT, codUsuario INT)
BEGIN
    IF (EXISTS(SELECT * FROM pa WHERE id_pa = codPa)) THEN
        IF (codUsuario <> 0) THEN
            SELECT p.id_pa                                                                                    "codigo",
                   p.titulo,
                   p.descricao,
                   DATE_FORMAT(p.datacadastro, '%d/%m/%Y')                                                    "data",
                   p.arquivo_path                                                                             "arquivo",
                   p.img_pa_path                                                                              "imgp",
                   IFNULL((SELECT nota FROM avaliacao_pa WHERE id_usuario = codUsuario AND id_pa = codPa), 0) "nota",
                   u.nomeUsuario                                                                              "usuario",
                   p.id_usuario                                                                               "id_usuario",
                   u.img_path                                                                                 "imgu"
            FROM pa p
                     INNER JOIN users u
                                ON (p.id_usuario = u.id_usuario)
            WHERE p.id_pa = codPa;
        ELSE
            SELECT p.id_pa                                 "codigo",
                   p.titulo,
                   p.descricao,
                   DATE_FORMAT(p.datacadastro, '%d/%m/%Y') "data",
                   p.arquivo_path                          "arquivo",
                   p.img_pa_path                           "imgp",
                   u.nomeUsuario                           "usuario",
                   p.id_usuario                            "id_usuario",
                   u.img_path                              "imgu"
            FROM pa p
                     INNER JOIN users u
                                ON (p.id_usuario = u.id_usuario)
            WHERE p.id_pa = codPa;
        END IF;
    ELSE
        SELECT "Erro" AS msgErro;
    END IF;
END */$$
DELIMITER ;

/* Procedure structure for procedure `proc_apresentacaoRecurso` */

/*!50003 DROP PROCEDURE IF EXISTS `proc_apresentacaoRecurso` */;

DELIMITER $$

/*!50003 CREATE
    DEFINER = `reduc`@`%` PROCEDURE `proc_apresentacaoRecurso`(in codRecurso int, codUsuario int)
begin
    if (exists(select * from recursos where recursos.id_recurso = codRecurso)) then
        if (codUsuario <> 0) then
            select r.id_recurso                                                           "codigo",
                   r.titulo,
                   r.descricao,
                   DATE_FORMAT(r.datacadastro, '%d/%m/%Y')                                "data",
                   r.video_path                                                           "video",
                   artigo_path                                                            "arquivo",
                   r.img_recurso_path                                                     "imgr",
                   IFNULL((select nota
                           from avaliacao_recurso
                           where id_usuario = codUsuario AND id_recurso = codRecurso), 0) "nota",
                   u.nomeUsuario                                                          "usuario",
                   r.id_usuario                                                           "id_usuario",
                   img_path                                                               "imgu",
                   (select count(id_usuario)
                    from recursos_salvos
                    where id_recurso = codRecurso and id_usuario = codUsuario)            "favorito"
            from recursos r
                     inner join users u
                                on (r.id_usuario = u.id_usuario)
                     left join avaliacao_recurso ar
                               on (u.id_usuario = ar.id_usuario)
            where r.id_recurso = codRecurso;
        else
            SELECT r.id_recurso                            "codigo",
                   r.titulo,
                   r.descricao,
                   DATE_FORMAT(r.datacadastro, '%d/%m/%Y') "data",
                   r.video_path                            "video",
                   artigo_path                             "arquivo",
                   r.img_recurso_path                      "imgr",
                   0                                       "nota",
                   u.nomeUsuario                           "usuario",
                   r.id_usuario                            "id_usuario",
                   img_path                                "imgu",
                   0                                       "favorito"
            FROM recursos r
                     INNER JOIN users u
                                ON (r.id_usuario = u.id_usuario)
                     left JOIN avaliacao_recurso ar
                               ON (u.id_usuario = ar.id_usuario)
            WHERE r.id_recurso = codRecurso;
        end if;
    else
        select "Erro" as msgErro;
    end if;
end */$$
DELIMITER ;

/* Procedure structure for procedure `proc_aprovarUsuario` */

/*!50003 DROP PROCEDURE IF EXISTS `proc_aprovarUsuario` */;

DELIMITER $$

/*!50003 CREATE
    DEFINER = `reduc`@`%` PROCEDURE `proc_aprovarUsuario`(in codUsuario int)
BEGIN
    update users
    set status = 1
    where id_usuario = codUsuario;
END */$$
DELIMITER ;

/* Procedure structure for procedure `proc_AtivarRecursoUsuario` */

/*!50003 DROP PROCEDURE IF EXISTS `proc_AtivarRecursoUsuario` */;

DELIMITER $$

/*!50003 CREATE
    DEFINER = `reduc`@`%` PROCEDURE `proc_AtivarRecursoUsuario`(IN id_usuarioA INT, id_recursoA INT)
BEGIN
    IF (id_usuarioA = (SELECT id_usuario FROM recursos WHERE id_recurso = id_recursoA) OR
        EXISTS(SELECT id_usuario FROM users WHERE id_categoriaUsuario = 3 AND id_usuario = id_usuarioA)) THEN
        UPDATE recursos SET STATUS = 1 WHERE id_recurso = id_recursoA;
    END IF;
END */$$
DELIMITER ;

/* Procedure structure for procedure `proc_ativar_recursos_adm` */

/*!50003 DROP PROCEDURE IF EXISTS `proc_ativar_recursos_adm` */;

DELIMITER $$

/*!50003 CREATE
    DEFINER = `reduc`@`%` PROCEDURE `proc_ativar_recursos_adm`(IN codigo INT)
BEGIN
    update recursos
    set status = 1
    where codigo = id_recurso;
END */$$
DELIMITER ;

/* Procedure structure for procedure `proc_ativar_recurso_adm` */

/*!50003 DROP PROCEDURE IF EXISTS `proc_ativar_recurso_adm` */;

DELIMITER $$

/*!50003 CREATE
    DEFINER = `reduc`@`%` PROCEDURE `proc_ativar_recurso_adm`(IN codigo INT)
BEGIN
    UPDATE recursos
    SET STATUS = 1
    WHERE codigo = id_recurso;
END */$$
DELIMITER ;

/* Procedure structure for procedure `proc_banirUsuario` */

/*!50003 DROP PROCEDURE IF EXISTS `proc_banirUsuario` */;

DELIMITER $$

/*!50003 CREATE
    DEFINER = `reduc`@`%` PROCEDURE `proc_banirUsuario`(IN codUsuario INT)
BEGIN
    delete
    from users
    where id_usuario = codUsuario;
END */$$
DELIMITER ;

/* Procedure structure for procedure `proc_BuscarMeusRecursos` */

/*!50003 DROP PROCEDURE IF EXISTS `proc_BuscarMeusRecursos` */;

DELIMITER $$

/*!50003 CREATE
    DEFINER = `reduc`@`%` PROCEDURE `proc_BuscarMeusRecursos`(in xid_usuario int)
begin
    SELECT r.id_recurso "codigo", r.titulo, r.img_recurso_path "img", IFNULL(AVG(ar.nota), 0) "nota", 0 "favorito"
    FROM recursos r
             LEFT JOIN avaliacao_recurso ar
                       ON (r.id_recurso = ar.id_recurso)
    WHERE r.id_usuario = xid_usuario
      and r.status <> 0
    GROUP BY r.id_recurso
    ORDER BY AVG(ar.nota) DESC
    LIMIT 4;

end */$$
DELIMITER ;

/* Procedure structure for procedure `proc_BuscarMinhasPa` */

/*!50003 DROP PROCEDURE IF EXISTS `proc_BuscarMinhasPa` */;

DELIMITER $$

/*!50003 CREATE
    DEFINER = `reduc`@`%` PROCEDURE `proc_BuscarMinhasPa`(IN xid_usuario INT)
BEGIN
    SELECT p.id_pa "codigo", p.titulo, p.img_pa_path "img", IFNULL(AVG(ap.nota), 0) "nota"
    FROM pa p
             LEFT JOIN avaliacao_pa ap
                       ON (p.id_pa = ap.id_pa)
    WHERE p.id_usuario = xid_usuario
      AND p.status <> 0
    GROUP BY p.id_pa
    ORDER BY AVG(ap.nota) DESC
    LIMIT 4;

END */$$
DELIMITER ;

/* Procedure structure for procedure `proc_BuscarNumeroRedeSociasUsuario` */

/*!50003 DROP PROCEDURE IF EXISTS `proc_BuscarNumeroRedeSociasUsuario` */;

DELIMITER $$

/*!50003 CREATE
    DEFINER = `reduc`@`%` PROCEDURE `proc_BuscarNumeroRedeSociasUsuario`(IN xid_usuario INT)
BEGIN
    SELECT (SELECT COUNT(id_redesocial) FROM redesocial) -
           (SELECT COUNT(id_usuario) FROM user_redesocial WHERE id_usuario = xid_usuario) "RedesDisponiveis";
END */$$
DELIMITER ;

/* Procedure structure for procedure `proc_buscarPaNaoPostados` */

/*!50003 DROP PROCEDURE IF EXISTS `proc_buscarPaNaoPostados` */;

DELIMITER $$

/*!50003 CREATE
    DEFINER = `reduc`@`%` PROCEDURE `proc_buscarPaNaoPostados`()
begin
    select p.id_pa,
           p.titulo,
           p.descricao,
           DATE_FORMAT(p.datacadastro, "%d/%m/%Y") "cadastro",
           u.nomeUsuario                           "usuario"
    from pa p
             inner join users u
                        on (p.id_usuario = u.id_usuario)
    where p.status = 0;
end */$$
DELIMITER ;

/* Procedure structure for procedure `proc_BuscarPerfilUsuario` */

/*!50003 DROP PROCEDURE IF EXISTS `proc_BuscarPerfilUsuario` */;

DELIMITER $$

/*!50003 CREATE
    DEFINER = `reduc`@`%` PROCEDURE `proc_BuscarPerfilUsuario`(IN xid_usuario INT)
BEGIN
    IF (EXISTS(SELECT * FROM users WHERE id_usuario = xid_usuario)) THEN
        SELECT nomeUsuario, IFNULL(img_path, "img/imgUsers/foto-perfil.avif") "img_path", descricao
        FROM users
        WHERE id_usuario = xid_usuario;
    END IF;
END */$$
DELIMITER ;

/* Procedure structure for procedure `proc_BuscarQuatroRecursos` */

/*!50003 DROP PROCEDURE IF EXISTS `proc_BuscarQuatroRecursos` */;

DELIMITER $$

/*!50003 CREATE
    DEFINER = `reduc`@`%` PROCEDURE `proc_BuscarQuatroRecursos`(IN codigo INT)
BEGIN
    IF (codigo = 0) THEN
        SELECT r.id_recurso "codigo", r.titulo, r.img_recurso_path "img", IFNULL(AVG(ar.nota), 0) "nota", 0 "favorito"
        FROM recursos r
                 LEFT JOIN avaliacao_recurso ar
                           ON (r.id_recurso = ar.id_recurso)
        WHERE r.status <> 0
        GROUP BY r.id_recurso
        ORDER BY AVG(ar.nota) DESC
        LIMIT 4;
    ELSE
        SELECT r.id_recurso                              "codigo",
               r.titulo,
               r.img_recurso_path                        "img",
               IFNULL(AVG(ar.nota), 0)                   "nota",
               IFNULL((SELECT rs.id_fav
                       FROM recursos_salvos rs
                       WHERE r.id_recurso = rs.id_recurso
                         AND codigo = rs.id_usuario), 0) "favorito"
        FROM recursos r
                 LEFT JOIN avaliacao_recurso ar
                           ON (r.id_recurso = ar.id_recurso)
        WHERE r.status <> 0
        GROUP BY r.id_recurso
        ORDER BY AVG(ar.nota) DESC
        LIMIT 4;
    END IF;
END */$$
DELIMITER ;

/* Procedure structure for procedure `proc_buscarRecursosNaoPostados` */

/*!50003 DROP PROCEDURE IF EXISTS `proc_buscarRecursosNaoPostados` */;

DELIMITER $$

/*!50003 CREATE
    DEFINER = `reduc`@`%` PROCEDURE `proc_buscarRecursosNaoPostados`()
BEGIN
    SELECT r.id_recurso                            "codigo",
           r.descricao,
           r.titulo,
           DATE_FORMAT(r.datacadastro, "%d/%m/%Y") "cadastro",
           u.nomeUsuario                           "usuario"
    FROM recursos r
             INNER JOIN users u
                        ON (r.id_usuario = u.id_usuario)
    WHERE r.status = 0;
END */$$
DELIMITER ;

/* Procedure structure for procedure `proc_BuscarRecursosSalvos` */

/*!50003 DROP PROCEDURE IF EXISTS `proc_BuscarRecursosSalvos` */;

DELIMITER $$

/*!50003 CREATE
    DEFINER = `reduc`@`%` PROCEDURE `proc_BuscarRecursosSalvos`(in xid_usuario INT)
BEGIN
    SELECT r.id_recurso "codigo", r.titulo, r.img_recurso_path "img", IFNULL(AVG(ar.nota), 0) "nota", 1 "favorito"
    FROM recursos r
             LEFT JOIN avaliacao_recurso ar
                       ON (r.id_recurso = ar.id_recurso)
             inner join recursos_salvos rs
                        on (r.id_recurso = rs.id_recurso)
    WHERE rs.id_usuario = xid_usuario
      AND r.status <> 0
    GROUP BY r.id_recurso
    ORDER BY AVG(ar.nota) DESC
    LIMIT 4;

END */$$
DELIMITER ;

/* Procedure structure for procedure `proc_BuscarRecursosUsuarioVisita` */

/*!50003 DROP PROCEDURE IF EXISTS `proc_BuscarRecursosUsuarioVisita` */;

DELIMITER $$

/*!50003 CREATE
    DEFINER = `reduc`@`%` PROCEDURE `proc_BuscarRecursosUsuarioVisita`(in xid_usuario int, codigo int)
begin
    IF (codigo = 0) THEN
        SELECT r.id_recurso "codigo", r.titulo, r.img_recurso_path "img", IFNULL(AVG(ar.nota), 0) "nota", 0 "favorito"
        FROM recursos r
                 LEFT JOIN avaliacao_recurso ar
                           ON (r.id_recurso = ar.id_recurso)
        WHERE r.status <> 0
        GROUP BY r.id_recurso
        ORDER BY AVG(ar.nota) DESC
        LIMIT 4;
    ELSE
        SELECT r.id_recurso                              "codigo",
               r.titulo,
               r.img_recurso_path                        "img",
               IFNULL(AVG(ar.nota), 0)                   "nota",
               IFNULL((SELECT rs.id_fav
                       FROM recursos_salvos rs
                       WHERE r.id_recurso = rs.id_recurso
                         AND codigo = rs.id_usuario), 0) "favorito"
        FROM recursos r
                 LEFT JOIN avaliacao_recurso ar
                           ON (r.id_recurso = ar.id_recurso)
        WHERE r.id_usuario = xid_usuario
          and r.status <> 0
        GROUP BY r.id_recurso
        ORDER BY AVG(ar.nota) DESC
        LIMIT 4;
    END IF;
end */$$
DELIMITER ;

/* Procedure structure for procedure `proc_BuscarRedeSocial` */

/*!50003 DROP PROCEDURE IF EXISTS `proc_BuscarRedeSocial` */;

DELIMITER $$

/*!50003 CREATE
    DEFINER = `reduc`@`%` PROCEDURE `proc_BuscarRedeSocial`(IN xid_usuario INT)
BEGIN
    IF (EXISTS(SELECT * FROM user_redesocial WHERE id_usuario = xid_usuario)) THEN
        SELECT id_redesocial, link_rede
        FROM user_redesocial
        WHERE id_usuario = xid_usuario;

    END IF;
END */$$
DELIMITER ;

/* Procedure structure for procedure `proc_buscarTodosRecursos` */

/*!50003 DROP PROCEDURE IF EXISTS `proc_buscarTodosRecursos` */;

DELIMITER $$

/*!50003 CREATE
    DEFINER = `reduc`@`%` PROCEDURE `proc_buscarTodosRecursos`(IN codigo INT)
BEGIN
    SELECT r.id_recurso                              "codigo",
           r.titulo,
           r.img_recurso_path                        "img",
           IFNULL(AVG(ar.nota), 0)                   "nota",
           IFNULL((SELECT rs.id_fav
                   FROM recursos_salvos rs
                   WHERE r.id_recurso = rs.id_recurso
                     AND codigo = rs.id_usuario), 0) "favorito"
    FROM recursos r
             LEFT JOIN avaliacao_recurso ar
                       ON (r.id_recurso = ar.id_recurso)
    WHERE r.status <> 0
    GROUP BY r.id_recurso
    ORDER BY AVG(ar.nota) DESC;
END */$$
DELIMITER ;

/* Procedure structure for procedure `proc_CadastroAluno` */

/*!50003 DROP PROCEDURE IF EXISTS `proc_CadastroAluno` */;

DELIMITER $$

/*!50003 CREATE
    DEFINER = `reduc`@`%` PROCEDURE `proc_CadastroAluno`(IN nomeU VARCHAR(25), sobrenomeU VARCHAR(25),
                                                         nomeUsuarioU VARCHAR(35), cpfU CHAR(11), datanascimentoU DATE,
                                                         emailU VARCHAR(300), senhaU VARCHAR(255), id_perguntaU INT,
                                                         resposta_segurancaU VARCHAR(30), id_instituicaoU INT,
                                                         id_categoriaUsuarioU INT, statusU BOOLEAN)
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
        INSERT INTO users (nome, sobrenome, nomeUsuario, cpf, datanascimento, email, senha, id_pergunta,
                           resposta_seguranca, id_instituicao, id_categoriaUsuario, datacadastro, STATUS, img_path)
        VALUES (nomeU, sobrenomeU, nomeUsuarioU, cpfU, datanascimentoU, emailU, senhaU, id_perguntaU,
                resposta_segurancaU, id_instituicaoU, id_categoriaUsuarioU, current_date, statusU,
                'img/imgUsers/img_padrao_user.jpg');
    END IF;
END */$$
DELIMITER ;

/* Procedure structure for procedure `proc_CadastroProfessor` */

/*!50003 DROP PROCEDURE IF EXISTS `proc_CadastroProfessor` */;

DELIMITER $$

/*!50003 CREATE
    DEFINER = `reduc`@`%` PROCEDURE `proc_CadastroProfessor`(IN nomeU VARCHAR(25), sobrenomeU VARCHAR(25),
                                                             nomeUsuarioU VARCHAR(35), cpfU CHAR(11),
                                                             datanascimentoU DATE, emailU VARCHAR(300),
                                                             senhaU VARCHAR(255), link_lattesU TEXT,
                                                             area_atuacaoU VARCHAR(25), id_perguntaU INT,
                                                             resposta_segurancaU VARCHAR(30), id_instituicaoU INT,
                                                             id_categoriaUsuarioU INT, statusU BOOLEAN)
BEGIN
    INSERT INTO users (nome, sobrenome, nomeUsuario, cpf, datanascimento, email, senha, link_lattes, area_atuacao,
                       id_pergunta, resposta_seguranca, id_instituicao, id_categoriaUsuario, datacadastro, STATUS,
                       img_path)
    VALUES (nomeU, sobrenomeU, nomeUsuarioU, cpfU, datanascimentoU, emailU, senhaU, link_lattesU, area_atuacaoU,
            id_perguntaU, resposta_segurancaU, id_instituicaoU, id_categoriaUsuarioU, current_date, statusU,
            'img/imgUsers/img_padrao_user.jpg');
END */$$
DELIMITER ;

/* Procedure structure for procedure `proc_CadastroRecursoArtigo` */

/*!50003 DROP PROCEDURE IF EXISTS `proc_CadastroRecursoArtigo` */;

DELIMITER $$

/*!50003 CREATE
    DEFINER = `reduc`@`%` PROCEDURE `proc_CadastroRecursoArtigo`(IN xtitulo VARCHAR(100), xdescricao VARCHAR(255),
                                                                 xartigo_path TEXT, xid_usuario INT,
                                                                 img_recurso_path TEXT, id_tiporecurso INT,
                                                                 id_ferramenta INT, OUT p_id_inserido INT)
begin
    IF (id_ferramenta = 0) THEN
        SET id_ferramenta = NULL;
    END IF;
    INSERT INTO recursos (titulo, descricao, datacadastro, artigo_path, id_usuario, img_recurso_path, id_tiporecurso,
                          id_ferramenta, STATUS)
    VALUES (xtitulo, xdescricao, CURRENT_DATE, xartigo_path, xid_usuario, img_recurso_path, id_tiporecurso,
            id_ferramenta, 0);

    SET p_id_inserido = LAST_INSERT_ID();
end */$$
DELIMITER ;

/* Procedure structure for procedure `proc_CadastroRecursoVideo` */

/*!50003 DROP PROCEDURE IF EXISTS `proc_CadastroRecursoVideo` */;

DELIMITER $$

/*!50003 CREATE
    DEFINER = `reduc`@`%` PROCEDURE `proc_CadastroRecursoVideo`(IN xtitulo VARCHAR(100), xdescricao VARCHAR(255),
                                                                xvideo_path TEXT, xid_usuario INT,
                                                                img_recurso_path TEXT, id_tiporecurso INT,
                                                                id_ferramenta INT, OUT p_id_inserido INT)
BEGIN
    IF (id_ferramenta = 0) THEN
        SET id_ferramenta = NULL;
    END IF;
    INSERT INTO recursos (titulo, descricao, datacadastro, video_path, id_usuario, img_recurso_path, id_tiporecurso,
                          id_ferramenta, STATUS)
    VALUES (xtitulo, xdescricao, CURRENT_DATE, xvideo_path, xid_usuario, img_recurso_path, id_tiporecurso,
            id_ferramenta, 0);

    SET p_id_inserido = LAST_INSERT_ID();
END */$$
DELIMITER ;

/* Procedure structure for procedure `proc_InativarRecurso` */

/*!50003 DROP PROCEDURE IF EXISTS `proc_InativarRecurso` */;

DELIMITER $$

/*!50003 CREATE
    DEFINER = `reduc`@`%` PROCEDURE `proc_InativarRecurso`(IN id_usuarioA INT, id_recursoA INT)
BEGIN
    IF (id_usuarioA = (SELECT id_usuario FROM recursos WHERE id_recurso = id_recursoA) OR
        EXISTS(SELECT id_usuario FROM users WHERE id_categoriaUsuario = 3 AND id_usuario = id_usuarioA)) THEN
        UPDATE recursos SET STATUS = 0 WHERE id_recurso = id_recursoA;
    ELSE
        SELECT "Impossível..." AS msg;
    END IF;
END */$$
DELIMITER ;

/* Procedure structure for procedure `proc_perfilVisita` */

/*!50003 DROP PROCEDURE IF EXISTS `proc_perfilVisita` */;

DELIMITER $$

/*!50003 CREATE
    DEFINER = `reduc`@`%` PROCEDURE `proc_perfilVisita`(IN xid_usuario INT, xid_usuarioVisitante int)
BEGIN
    IF (EXISTS(SELECT * FROM users WHERE id_usuario = xid_usuario)) THEN
        SELECT nomeUsuario,
               img_path,
               c.descritivo                                                                               "categoria",
               descricao,
               IFNULL((select count(id_usuario)
                       from seguir
                       where id_userseguindo = xid_usuarioVisitante and id_userseguido = xid_usuario), 0) "segue"
        FROM users u
                 inner join categoriausuario c
                            on (u.id_categoriaUsuario = c.id_categoriaUsuario)
        WHERE id_usuario = xid_usuario;
    END IF;
END */$$
DELIMITER ;

/* Procedure structure for procedure `proc_pesquisaRecursos` */

/*!50003 DROP PROCEDURE IF EXISTS `proc_pesquisaRecursos` */;

DELIMITER $$

/*!50003 CREATE
    DEFINER = `reduc`@`%` PROCEDURE `proc_pesquisaRecursos`(IN codigo INT, pesquisa text)
begin
    SELECT r.id_recurso                              "codigo",
           r.titulo,
           r.img_recurso_path                        "img",
           IFNULL(AVG(ar.nota), 0)                   "nota",
           IFNULL((SELECT rs.id_fav
                   FROM recursos_salvos rs
                   WHERE r.id_recurso = rs.id_recurso
                     AND codigo = rs.id_usuario), 0) "favorito"
    FROM recursos r
             LEFT JOIN avaliacao_recurso ar
                       ON (r.id_recurso = ar.id_recurso)
    WHERE r.status <> 0
      and titulo like CONCAT('%', pesquisa, '%')
    GROUP BY r.id_recurso
    ORDER BY AVG(ar.nota) DESC;
end */$$
DELIMITER ;

/* Procedure structure for procedure `proc_pesquisarPa` */

/*!50003 DROP PROCEDURE IF EXISTS `proc_pesquisarPa` */;

DELIMITER $$

/*!50003 CREATE
    DEFINER = `reduc`@`%` PROCEDURE `proc_pesquisarPa`(pesquisa TEXT)
begin
    SELECT p.id_pa "codigo", p.titulo, p.img_pa_path "img", IFNULL(AVG(ap.nota), 0) "nota", ta.descritivo "tipo"
    FROM pa p
             LEFT JOIN avaliacao_pa ap
                       ON (p.id_pa = ap.id_pa)
             INNER JOIN tipos_pa ta
                        ON (p.id_tipo = ta.id_tipo)
    WHERE p.status <> 0
      AND titulo LIKE CONCAT('%', pesquisa, '%')
    GROUP BY p.id_pa
    ORDER BY AVG(ap.nota) DESC;
end */$$
DELIMITER ;

/* Procedure structure for procedure `proc_PuxarComentarios` */

/*!50003 DROP PROCEDURE IF EXISTS `proc_PuxarComentarios` */;

DELIMITER $$

/*!50003 CREATE
    DEFINER = `reduc`@`%` PROCEDURE `proc_PuxarComentarios`(in codRecurso int)
begin
    SELECT id_comentario                                                                         "codigo",
           cr.id_usuario                                                                         "id_usuario",
           u.nomeUsuario,
           img_path                                                                              "img",
           descritivo                                                                            "comentario",
           DATE_FORMAT(datacomentario, "%d/%m/%Y")                                               "data",
           (select count(id_comentario) from comentarios_recursos where id_recurso = codRecurso) "nmrComentarios"
    from comentarios_recursos cr
             inner join users u
                        on (cr.id_usuario = u.id_usuario)
    where cr.id_recurso = codRecurso;
end */$$
DELIMITER ;

/* Procedure structure for procedure `proc_PuxarComentariosDenunciados` */

/*!50003 DROP PROCEDURE IF EXISTS `proc_PuxarComentariosDenunciados` */;

DELIMITER $$

/*!50003 CREATE
    DEFINER = `reduc`@`%` PROCEDURE `proc_PuxarComentariosDenunciados`()
begin
    select cr.id_comentario, u.nomeUsuario, cr.descritivo, date_format(cr.datacomentario, "%d/%m/%Y") "datacomentario"
    from comentarios_recursos cr
             inner join denuncia_comentario dc
                        on (cr.id_comentario = dc.id_comentario)
             inner join users u
                        on (cr.id_usuario = u.id_usuario);
end */$$
DELIMITER ;

/* Procedure structure for procedure `proc_RedeSocialParaCadastrar` */

/*!50003 DROP PROCEDURE IF EXISTS `proc_RedeSocialParaCadastrar` */;

DELIMITER $$

/*!50003 CREATE
    DEFINER = `reduc`@`%` PROCEDURE `proc_RedeSocialParaCadastrar`(IN xid_usuario INT)
BEGIN
    SELECT id_redesocial, descritivo
    FROM redesocial
    WHERE id_redesocial NOT IN (SELECT id_redesocial FROM user_redesocial WHERE id_usuario = xid_usuario);
END */$$
DELIMITER ;

/* Procedure structure for procedure `proc_reprovar_pa_adm` */

/*!50003 DROP PROCEDURE IF EXISTS `proc_reprovar_pa_adm` */;

DELIMITER $$

/*!50003 CREATE
    DEFINER = `reduc`@`%` PROCEDURE `proc_reprovar_pa_adm`(IN codigo INT)
BEGIN
    DELETE
    FROM pa
    WHERE id_pa = codigo;
END */$$
DELIMITER ;

/* Procedure structure for procedure `proc_reprovar_recurso_adm` */

/*!50003 DROP PROCEDURE IF EXISTS `proc_reprovar_recurso_adm` */;

DELIMITER $$

/*!50003 CREATE
    DEFINER = `reduc`@`%` PROCEDURE `proc_reprovar_recurso_adm`(IN codigo INT)
BEGIN
    DELETE
    FROM recursos
    WHERE id_recurso = codigo;
END */$$
DELIMITER ;

/* Procedure structure for procedure `proc_Seguidores` */

/*!50003 DROP PROCEDURE IF EXISTS `proc_Seguidores` */;

DELIMITER $$

/*!50003 CREATE
    DEFINER = `reduc`@`%` PROCEDURE `proc_Seguidores`(IN id_usuarioA INT)
BEGIN
    IF (EXISTS(SELECT id_userseguido FROM seguir WHERE id_userseguido = id_usuarioA)) THEN
        SELECT nomeUsuario "Seguidores"
        FROM seguir s
                 INNER JOIN users u
                            ON (s.id_userseguindo = u.id_usuario)
        WHERE id_userseguido = id_usuarioA;
    ELSE
        SELECT "Este usuario não possui seguidores" AS msg;
    END IF;
END */$$
DELIMITER ;

/* Procedure structure for procedure `proc_TodasPa` */

/*!50003 DROP PROCEDURE IF EXISTS `proc_TodasPa` */;

DELIMITER $$

/*!50003 CREATE
    DEFINER = `reduc`@`%` PROCEDURE `proc_TodasPa`()
begin
    SELECT p.id_pa "codigo", p.titulo, p.img_pa_path "img", IFNULL(AVG(ap.nota), 0) "nota", ta.descritivo "tipo"
    FROM pa p
             LEFT JOIN avaliacao_pa ap
                       ON (p.id_pa = ap.id_pa)
             inner join tipos_pa ta
                        on (p.id_tipo = ta.id_tipo)
    WHERE p.status <> 0
    GROUP BY p.id_pa
    ORDER BY AVG(ap.nota) DESC;
end */$$
DELIMITER ;

/* Procedure structure for procedure `proc_TodosRecursos` */

/*!50003 DROP PROCEDURE IF EXISTS `proc_TodosRecursos` */;

DELIMITER $$

/*!50003 CREATE
    DEFINER = `reduc`@`%` PROCEDURE `proc_TodosRecursos`(IN id_usuarioA INT)
BEGIN
    IF (EXISTS(SELECT id_usuario FROM recursos WHERE id_usuario = id_usuarioA)) THEN
        SELECT r.id_recurso,
               titulo,
               descricao,
               datacadastro,
               (SELECT AVG(nota) FROM avaliacao_recurso WHERE id_recurso = r.id_recurso) "avaliacao"
        FROM recursos r
                 INNER JOIN avaliacao_recurso ar
                            ON (r.id_recurso = ar.id_recurso)
        WHERE r.id_usuario = id_usuarioA
        GROUP BY r.id_recurso;
    ELSE
        SELECT "Usuario não possui recursos cadastrados..." AS msg;
    END IF;
END */$$
DELIMITER ;

/* Procedure structure for procedure `proc_usuariosInativos` */

/*!50003 DROP PROCEDURE IF EXISTS `proc_usuariosInativos` */;

DELIMITER $$

/*!50003 CREATE
    DEFINER = `reduc`@`%` PROCEDURE `proc_usuariosInativos`()
begin
    select id_usuario                            "codigo",
           nome,
           sobrenome,
           nomeUsuario                           "usuario",
           link_lattes                           "lattes",
           id_categoriaUsuario                   "categoria",
           email,
           DATE_FORMAT(datacadastro, '%d/%m/%Y') "cadastro",
           img_path                              "img",
           i.descritivo                          "instituicao"
    from users u
             inner join instituicao i
                        on (u.id_instituicao = i.id_instituicao)
    where status = 0;
end */$$
DELIMITER ;

/* Procedure structure for procedure `proc_VerificarUsuario` */

/*!50003 DROP PROCEDURE IF EXISTS `proc_VerificarUsuario` */;

DELIMITER $$

/*!50003 CREATE
    DEFINER = `reduc`@`%` PROCEDURE `proc_VerificarUsuario`(IN xemail VARCHAR(255), xsenha VARCHAR(255))
BEGIN
    IF (EXISTS(SELECT * FROM users WHERE email = xemail AND senha = xsenha)) THEN
        SELECT id_usuario,
               nomeUsuario,
               id_categoriaUsuario,
               IFNULL(img_path, "img/imgUsers/foto-perfil.avif") "img_path",
               status
        FROM users
        WHERE email = xemail
          AND senha = xsenha;
    END IF;
END */$$
DELIMITER ;

/*!40101 SET SQL_MODE = @OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS = @OLD_FOREIGN_KEY_CHECKS */;
