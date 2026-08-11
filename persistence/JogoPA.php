<?php
require_once 'Banco.php';

class JogoPA {
    private $con;

    public function __construct() {
        $this->con = new Banco();
    }

    public function cadastrar($jogo) {
        $sql = "INSERT INTO jogo(capa, classificacao, quantidade, nome, genero, descricao, valor, data_lanc, cod_adm, plataforma) 
        VALUES(?,?,?,?,?,?,?,?,?,?)";
        $campos = [
            $jogo->getCapa(),
            $jogo->getClassificacao(),
            $jogo->getQuantidade(),
            $jogo->getNome(),
            $jogo->getGenero(),
            $jogo->getDescricao(),
            $jogo->getValor(),
            $jogo->getDataLanc(),
            $jogo->getCodAdm(),
            $jogo->getPlataforma()
        ];
        $resposta = $this->con->executar($sql, $campos, "ssisssdsis");
        $this->con->desconectar();
        return $resposta;
    }

    public function verificar($campo, $valor) {
        $sql = "SELECT $campo FROM jogo WHERE $campo=?";
        $consulta = $this->con->consultar($sql, [$valor], "s");
        if (!$consulta) {
            return true;
        } else {
            return false;
        }
    }

    public function listar($limite, $offset) {
        $sql = "SELECT * FROM jogo ORDER BY cod_jogo LIMIT ? OFFSET ?";
        $consulta = $this->con->consultar($sql, [$limite, $offset], 'ii');
        $this->con->desconectar();
        return $consulta;
    }

    public function listarPor($tipo,$termo,$valor,$limite,$offset){
        if(!empty($valor)){
            $sql="SELECT * FROM jogo WHERE $tipo=? AND nome LIKE ? ORDER BY $tipo LIMIT ? OFFSET ?";
            $consulta=$this->con->consultar($sql,[$termo,'%'.$valor.'%',$limite,$offset],'ssii');
        }else if(!empty($tipo)){
            $sql="SELECT * FROM jogo WHERE $tipo like ? ORDER BY $tipo LIMIT ? OFFSET ?";
            $consulta=$this->con->consultar($sql,['%'.$termo.'%',$limite,$offset],'sii');
        }else{
            $sql="SELECT * FROM jogo ORDER BY cod_prod LIMIT ? OFFSET ?";
            $consulta=$this->con->consultar($sql,[$limite,$offset],'ii');
        }
        $this->con->desconectar();
        return $consulta;
    }

    public function contar() {
        $sql = "SELECT COUNT(cod_jogo) AS 'total' FROM jogo";
        $consulta = $this->con->consultar($sql, [], '');
        $linha = $consulta->fetch_assoc();
        return $linha['total'];
    }

    public function buscar($termo, $tipo) {
        $sql = "SELECT * FROM jogo WHERE $tipo LIKE ?";
        $consulta = $this->con->consultar($sql, ['%' . $termo . '%'], 's');
        $this->con->desconectar();
        return $consulta;
    }

    public function buscarPorCod($cod_jogo) {
        $sql = "SELECT * FROM jogo WHERE cod_jogo=?";
        $consulta = $this->con->consultar($sql, [$cod_jogo], 'i');
        $this->con->desconectar();
        return $consulta;
    }

    public function alterar($jogo) {
        $sql = "UPDATE jogo 
        SET 
        capa=?, classificacao=?, quantidade=?, nome=?, genero=?, descricao=?, valor=?, data_lanc=?, plataforma=? WHERE cod_jogo=?";
        $campos = [
            $jogo->getCapa(),
            $jogo->getClassificacao(),
            $jogo->getQuantidade(),
            $jogo->getNome(),
            $jogo->getGenero(),
            $jogo->getDescricao(),
            $jogo->getValor(),
            $jogo->getDataLanc(),
            $jogo->getPlataforma(),
            $jogo->getCodJogo()
        ];
        $resposta = $this->con->executar($sql, $campos, 'ssisssdssi');
        $this->con->desconectar();
        return $resposta;
    }

    public function excluir($cod_jogo) {
        $sql = "DELETE FROM jogo WHERE cod_jogo=?";
        $resposta = $this->con->executar($sql, [$cod_jogo], 'i');
        $this->con->desconectar();
        return $resposta;
    }
}
?>
