<?php
require_once 'Banco.php';

class ItensPA {
    private $con;

    public function __construct() {
        $this->con = new Banco();
    }

    public function cadastrar($itens) {
        $sql = "INSERT INTO itens(cod_item) VALUES(?,?,?,?,?)";
        $campos = [
            $itens->getcod_item(),

        ];
        $resposta = $this->con->executar($sql, $campos, "ddiii");
        $this->con->desconectar();
        return $resposta;
    }

    public function consultar($campo, $valor) {
        $sql = "SELECT $campo FROM pedido WHERE $campo=?";
        $consulta = $this->con->consultar($sql, [$cod_item], "i");
        if (!$consulta) {
            return true;
        } else {
            return false;
        }
    }

    public function listar($limite, $offset) {
        $sql = "SELECT * FROM pedido ORDER BY cod_item LIMIT ? OFFSET ?";
        $consulta = $this->con->consultar($sql, [$limite, $offset], 'ii');
        $this->con->desconectar();
        return $consulta;
    }

    public function buscar($termo, $tipo) {
        $sql = "SELECT * FROM pedido WHERE $tipo LIKE ?";
        $consulta = $this->con->consultar($sql, ['%' . $termo . '%'], 's');
        $this->con->desconectar();
        return $consulta;
    }

    public function buscarPorCodigo($cod_item) {
        $sql = "SELECT * FROM pedido WHERE cod_item=?";
        $consulta = $this->con->consultar($sql, [$cod_item], 'i');
        $this->con->desconectar();
        return $consulta;
    }

    public function excluir($cod_item) {
        $sql = "DELETE FROM pedido WHERE cod_item=?";
        $resposta = $this->con->executar($sql, [$cod_item], 'i');
        $this->con->desconectar();
        return $resposta;
    }
}
?>