<?php
class banco{
	private $url;
	private $usuario;
	private $senha;
	private $database;
	private $con;

    public function __construct()
{
    $this->url="localhost";
    $this->usuario="root";
    $this->senha="";
    $this->database="gamernac";
    $this->con=new mysqli($this->url,$this->usuario,$this->senha,$this->database);
    $this->con->set_charset("utf8mb4");
}
    public function executar($sql,$params=[],$types="")
{
    $stmt=$this->con->prepare($sql);
    if (!$stmt) {
    	error_log("Erro no prepare: " . $this->con->error);
    	return false;
    }
    if(!empty($params)){
    	$stmt->bind_param($types,...$params);
    }
    $resultado=$stmt->execute();
    if (!$resultado) {
    	error_log("Erro no execute: " . $stmt->error);
    }
    $stmt->close();
    return $resultado;
}
    public function consultar($sql,$params=[],$types)
    {
    $stmt=$this->con->prepare($sql);
    if (!$stmt){
    	error_log("Erro no prepare: " . $this->con->error);
    	return false;
    }
    if(!empty($params)){
    $stmt->bind_param($types,...$params);
    }
    if (!$stmt->execute()) {
    	error_log("Erro no execute: " . $stmt->error);
    	$stmt->close();
    	return false;
    }
    $consulta=$stmt->get_result();
    $stmt->close();
    if ($consulta->num_rows>0) {
    return $consulta;
    }else{
    return false;
}
}
    public function desconectar()
{
    $this->con->close();

}
}
?>
