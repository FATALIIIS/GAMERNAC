<?php
require_once 'Banco.php';

class PedidoPA {
    private $con;

    public function __construct() {
        $this->con = new Banco();
    }

    public function cadastrar($pedido) {
        $sql = "INSERT INTO pedido(valor, data, cod_ped, fechado, cod_cli) VALUES(?,?,?,?,?)";
        $campos = [
            $pedido->getValor(),
            $pedido->getData(),
            $pedido->getCodPed(),
            $pedido->getFechado(),
            $pedido->getCodCli(),
        ];
        $resposta = $this->con->executar($sql, $campos, "ddiii");
        $this->con->desconectar();
        return $resposta;
    }

    public function consultar($campo, $valor) {
        $sql = "SELECT $campo FROM pedido WHERE $campo=?";
        $consulta = $this->con->consultar($sql, [$cod_ped], "i");
        if (!$consulta) {
            return true;
        } else {
            return false;
        }
    }

    public function listar($limite, $offset) {
        $sql = "SELECT * FROM pedido ORDER BY cod_ped LIMIT ? OFFSET ?";
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

    public function buscarPorCodigo($cod_ped) {
        $sql = "SELECT * FROM pedido WHERE cod_ped=?";
        $consulta = $this->con->consultar($sql, [$cod_ped], 'i');
        $this->con->desconectar();
        return $consulta;
    }

    public function excluir($cod_ped) {
        $sql = "DELETE FROM pedido WHERE cod_ped=?";
        $resposta = $this->con->executar($sql, [$cod_ped], 'i');
        $this->con->desconectar();
        return $resposta;
    }
}
?>
