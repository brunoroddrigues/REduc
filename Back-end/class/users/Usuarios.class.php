<?php
// require_once '..\conexao\Conexao.class.php';
require_once 'Pergunta.class.php';
require_once 'CategoriaUsuario.class.php';
require_once 'Instituicao.class.php';
require_once 'RedeSocial.class.php';

class Usuario extends Conexao
{
    public function __construct(
        private int    $id_usuario = 0,
        private string $nomeUsuario = "",
        private string $nome = "",
        private string $sobrenome = "",
        private string $dataNascimento = "",
        private string $email = "",
        private string $cpf = "",
        private        $categoria = null,
        private string $lattes = "",
        private string $areaAtuacao = "",
        private        $instituicao = null,
        private string $senha = "",
        private        $pergunta = null,
        private string $resposta = "",
        private array  $recursos = array(),
        private array  $pa = array(),
        private array  $seguidores = array(),
        private array  $seguindo = array(),
        private int    $status = 0,
                       $id_redesocial = 0,
                       $tiporede = null,
                       $link = ""
    )
    {
        parent:: __construct();
    }

    //set methods
    public function setIdUsuario($id)
    {
        $this->id_usuario = $id;
    }

    public function setNomeUsuario($nome)
    {
        $this->nomeUsuario = $nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function setSobrenome($sobrenome)
    {
        $this->sobrenome = $sobrenome;
    }

    public function setDataNasc($data)
    {
        $this->dataNascimento = $data;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
    }

    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;
    }

    public function setLattes($lattes)
    {
        $this->lattes = $lattes;
    }

    public function setAreaAtuacao($area)
    {
        $this->areaAtuacao = $area;
    }

    public function setInstituicao($instituicao)
    {
        $this->instituicao = $instituicao;
    }

    public function setSenha($senha)
    {
        $this->senha = $senha;
    }

    public function setPergunta($pergunta)
    {
        $this->pergunta = $pergunta;
    }

    public function setResposta($resposta)
    {
        $this->resposta = $resposta;
    }

    public function setRecursos($recurso)
    {
        $this->recursos[] = $recurso;
    }

    public function setPA($pa)
    {
        $this->pa[] = $pa;
    }

    public function setSeguidores($seguidores)
    {
        $this->seguidores[] = $seguidores;
    }

    public function setSeguindo($seguindo)
    {
        $this->seguindo[] = $seguindo;
    }

    public function setRedeSocial($id_redesocial, $tiporede, $link)
    {
        $this->redesocial[] = new RedeSocial($id_redesocial, $tiporede, $link);
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    //get methods
    public function getIdUsuario()
    {
        return $this->id_usuario;
    }

    public function getNomeUsuario()
    {
        return $this->nomeUsuario;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getSobrenome()
    {
        return $this->sobrenome;
    }

    public function getDataNasc()
    {
        return $this->dataNascimento;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getCpf()
    {
        return $this->cpf;
    }

    public function getCategoria()
    {
        return $this->categoria;
    }

    public function getLattes()
    {
        return $this->lattes;
    }

    public function getAreaAtuacao()
    {
        return $this->areaAtuacao;
    }

    public function getInstituicao()
    {
        return $this->instituicao;
    }

    public function getSenha()
    {
        return $this->senha;
    }

    public function getPergunta()
    {
        return $this->pergunta;
    }

    public function getResposta()
    {
        return $this->resposta;
    }

    public function getRecursos()
    {
        return $this->recursos;
    }

    public function getPA()
    {
        return $this->pa;
    }

    public function getSeguidores()
    {
        return $this->seguidores;
    }

    public function getSeguindo()
    {
        return $this->seguindo;
    }

    public function getRedeSocial()
    {
        return $this->redesocial;
    }

    public function getStatus()
    {
        return $this->status;
    }

    // Other methods
    public function CadastrarAluno()
    {
        $sql = "CALL proc_CadastroAluno(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stm = $this->db->prepare($sql);
        $stm->bindValue(1, $this->nome);
        $stm->bindValue(2, $this->sobrenome);
        $stm->bindValue(3, $this->nomeUsuario);
        $stm->bindValue(4, $this->cpf);
        $stm->bindValue(5, $this->dataNascimento);
        $stm->bindValue(6, $this->email);
        $stm->bindValue(7, $this->senha);
        $stm->bindValue(8, $this->pergunta->getIdPergunta());
        $stm->bindValue(9, $this->resposta);
        $stm->bindValue(10, $this->instituicao->getIdInstituicao());
        $stm->bindValue(11, $this->categoria->getIdCategoria());
        $stm->bindValue(12, $this->status);
        $stm->execute();
    }

    public function CadastrarProfessor()
    {
        $sql = "CALL proc_CadastroProfessor(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stm = $this->db->prepare($sql);
        $stm->bindValue(1, $this->nome);
        $stm->bindValue(2, $this->sobrenome);
        $stm->bindValue(3, $this->nomeUsuario);
        $stm->bindValue(4, $this->cpf);
        $stm->bindValue(5, $this->dataNascimento);
        $stm->bindValue(6, $this->email);
        $stm->bindValue(7, $this->senha);
        $stm->bindValue(8, $this->lattes);
        $stm->bindValue(9, $this->areaAtuacao);
        $stm->bindValue(10, $this->pergunta->getIdPergunta());
        $stm->bindValue(11, $this->resposta);
        $stm->bindValue(12, $this->instituicao->getIdInstituicao());
        $stm->bindValue(13, $this->categoria->getIdCategoria());
        $stm->bindValue(14, $this->status);
        $stm->execute();
    }

    public function BuscarSeguidores()
    {
        $sql = "CALL proc_Seguidores(?)";
        $stm = $this->db->prepare($sql);
        $stm->bindValue(1, $this->id_usuario);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_OBJ);
    }

    public function AlterarSenha($senhanova)
    {
        $sql = "UPDATE users SET senha = ? WHERE id_usuario = ?";
        $stm = $this->db->prepare($sql);
        $stm->bindValue(1, $senhanova);
        $stm->bindValue(2, $this->id_usuario);
        $stm->execute();
    }

    public function BuscarTodosRecursosUsuario()
    {
        $sql = "CALL proc_TodosRecursos(?)";
        $stm = $this->db->prepare($sql);
        $stm->bindValue(1, $this->id_usuario);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_OBJ);
    }

    public function InativarRecurso($id_recurso)
    {
        $sql = "CALL proc_InativarRecurso(?,?)";
        $stm = $this->db->prepare($sql);
        $stm->bindValue(1, $this->id_usuario);
        $stm->bindValue(2, $id_recurso);
        $stm->execute();
    }

    public function LoginUsuario()
    {
        $sql = "CALL proc_Login(?, ?)";
        $stm = $this->db->prepare($sql);
        $stm->bindValue(1, $this->nomeUsuario);
        $stm->bindValue(2, $this->senha);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_OBJ);
    }

    public function verificarUsuario()
    {
        $sql = "CALL proc_VerificarUsuario(?, ?)";
        $stm = $this->db->prepare($sql);
        $stm->bindValue(1, $this->email);
        $stm->bindValue(2, $this->senha);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_OBJ);
    }

    public function BuscarRedeSocial()
    {
        $sql = "CALL proc_BuscarRedeSocial(?)";
        $stm = $this->db->prepare($sql);
        $stm->bindValue(1, $this->id_usuario);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_OBJ);
    }

    public function BuscarPerfilUsuario()
    {
        $sql = "CALL proc_BuscarPerfilUsuario(?)";
        $stm = $this->db->prepare($sql);
        $stm->bindValue(1, $this->id_usuario);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_OBJ);
    }

    public function RedeSocialDisponivel()
    {
        $sql = "CALL proc_RedeSocialParaCadastrar(?)";
        $stm = $this->db->prepare($sql);
        $stm->bindValue(1, $this->id_usuario);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_OBJ);
    }

    public function BuscarNumeroRedeSociasUsuario()
    {
        $sql = "CALL proc_BuscarNumeroRedeSociasUsuario(?)";
        $stm = $this->db->prepare($sql);
        $stm->bindValue(1, $this->id_usuario);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_OBJ);
    }

    public function TrocarImg($nova_img)
    {
        $sql = "UPDATE users SET img_path = ? WHERE id_usuario = ?";
        $stm = $this->db->prepare($sql);
        $stm->bindValue(1, $nova_img);
        $stm->bindValue(2, $this->id_usuario);
        $stm->execute();
    }

    public function usuariosInativos()
    {
        $sql = "CALL proc_usuariosInativos()";
        $stm = $this->db->prepare($sql);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_OBJ);
    }

    public function aprovarUsuario()
    {
        $sql = "CALL proc_aprovarUsuario(?)";
        $stm = $this->db->prepare($sql);
        $stm->bindValue(1, $this->id_usuario);
        $stm->execute();
    }

    public function banirUsuario()
    {
        $sql = "CALL proc_banirUsuario(?)";
        $stm = $this->db->prepare($sql);
        $stm->bindValue(1, $this->id_usuario);
        $stm->execute();
    }

    public function VisitaUsuario($visitante)
    {
        $sql = "CALL proc_perfilVisita(?, ?)";
        $stm = $this->db->prepare($sql);
        $stm->bindValue(1, $this->id_usuario);
        $stm->bindValue(2, $visitante);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_OBJ);
    }

    public function BuscarRecursosUsuarioVisita($visitante)
    {
        $sql = "CALL proc_BuscarRecursosUsuarioVisita(?, ?)";
        $stm = $this->db->prepare($sql);
        $stm->bindValue(1, $this->id_usuario);
        $stm->bindValue(2, $visitante);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_OBJ);
    }

    public function BuscarMeusRecursos()
    {
        $sql = "CALL proc_BuscarMeusRecursos(?)";
        $stm = $this->db->prepare($sql);
        $stm->bindValue(1, $this->id_usuario);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_OBJ);
    }

    public function BuscarMinhasPa()
    {
        $sql = "CALL proc_BuscarMinhasPa(?)";
        $stm = $this->db->prepare($sql);
        $stm->bindValue(1, $this->id_usuario);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_OBJ);
    }

    public function BuscarRecursosSalvos()
    {
        $sql = "CALL proc_BuscarRecursosSalvos(?)";
        $stm = $this->db->prepare($sql);
        $stm->bindValue(1, $this->id_usuario);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_OBJ);
    }

    public function SeguirUsuario($usuarioSeguido)
    {
        $sql = "INSERT INTO seguir (id_userseguido, id_userseguindo) VALUES (?, ?)";
        $stm = $this->db->prepare($sql);
        $stm->bindValue(1, $usuarioSeguido);
        $stm->bindValue(2, $this->id_usuario);
        $stm->execute();
    }

    public function UnfollowUsuario($usuarioSeguido)
    {
        $sql = "DELETE FROM seguir WHERE id_userseguido = ? AND id_userseguindo = ?";
        $stm = $this->db->prepare($sql);
        $stm->bindValue(1, $usuarioSeguido);
        $stm->bindValue(2, $this->id_usuario);
        $stm->execute();
    }
}