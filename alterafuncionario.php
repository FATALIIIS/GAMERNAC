<?php 
require_once 'paineladm.php'; 
require_once 'persistence/FuncionarioPA.php'; 

$funcionariopa = new FuncionarioPA(); 
$total = $funcionariopa->contar(); 

if ($total <= 0) { 
    echo "<h2>Não há funcionários cadastrados.</h2>";
    echo "<li><a href='paineladm.php'>Voltar</a></li>"; 
} else { 
    if (isset($_GET['pagina'])) { 
        $pagina = $_GET['pagina']; 
    } else { 
        $pagina = 1; 
    } 
    
    $limite = 2; 
    $offset = ($pagina - 1) * $limite; 
    $consulta = $funcionariopa->listar($limite, $offset); 
    
    require_once 'model/Funcionario.php'; 
    $funcionario = new Funcionario(); 
    
    echo "<table>"; 
    echo "<thead>"; 
    echo "<tr>"; 
    echo "<th>Código</th>"; 
    echo "<th>Nome</th>"; 
    echo "<th>CPF</th>"; 
    echo "<th>Telefone</th>"; 
    echo "<th>Email</th>"; 
    echo "<th>Data de Nascimento</th>"; 
    echo "<th>Sexo</th>"; 
    echo "<th>Endereço</th>"; 
    echo "<th>Alterar Dados</th>";  
    echo "</tr>"; 
    echo "</thead>"; 
    echo "<tbody>"; 
    
    while ($linha = $consulta->fetch_assoc()) { 
        $funcionario->setCodFunc($linha['cod_func']); 
        $funcionario->setNome($linha['nome']); 
        $funcionario->setCpf($linha['cpf']); 
        $funcionario->setTelefone($linha['telefone']); 
        $funcionario->setEmail($linha['email']); 
        $funcionario->setDataNasci($linha['data_nasci']); 
        $funcionario->setSexo($linha['sexo']); 
        $funcionario->setEndereco($linha['endereco']); 
        
        echo "<tr>"; 
        echo "<td>" . $funcionario->getCodFunc() . "</td>"; 
        echo "<td>" . $funcionario->getNome() . "</td>"; 
        echo "<td>" . $funcionario->getCpf() . "</td>"; 
        echo "<td>" . $funcionario->getTelefone() . "</td>"; 
        echo "<td>" . $funcionario->getEmail() . "</td>"; 
        $databr = new DateTime($funcionario->getDataNasci()); 
        echo "<td>" . $databr->format('d/m/Y') . "</td>"; 
        echo "<td>" . $funcionario->getSexo() . "</td>";
        echo "<td>" . $funcionario->getEndereco() . "</td>";
        echo "<td><a href='alterarfuncionario.php?cod_func=".$funcionario->getCodFunc()."'>Alterar</a></td>";
        echo "</tr>"; 
    } 
    
    echo "</tbody>"; 
    echo "</table>"; 
    echo "<section class='paginacao'>"; 
    
    if ($pagina > 1) { 
        $anterior = $pagina - 1; 
        echo "<a href='alterafuncionario.php?pagina=$anterior'> &lt;&lt;</a>"; 
    } 
    
    echo " página $pagina "; 
    $num_pag = ceil($total / $limite); 
    
    if ($pagina < $num_pag) { 
        $proximo = $pagina + 1; 
        echo "<a href='alterafuncionario.php?pagina=$proximo'> &gt;&gt;</a>"; 
    } 
    
    echo "</section>"; 
}
?>
<section>
<li><a id="voltar" href="inicioadm.php">Voltar</a></li>
</section>
<?php include 'rodape.php'; ?>
</body> 
</html>
