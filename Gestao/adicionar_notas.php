<?php
require_once 'classes/Database.php';
require_once 'classes/Nota.php';

// Verifica se os dados do formulário foram enviados
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados do formulário
    $nome_aluno = $_POST['nome_aluno'];
    $nota_prova1 = $_POST['nota_prova1'];
    $nota_aep1 = $_POST['nota_aep1'];
    $nota_integrada1 = $_POST['nota_integrada1'];
    $nota_prova2 = $_POST['nota_prova2'];
    $nota_aep2 = $_POST['nota_aep2'];
    $nota_integrada2 = $_POST['nota_integrada2'];

    // Conexão com o banco de dados
    $dbname = "SGN.db";
    $database = new Database($dbname);
    $nota = new Nota($database);

    // Insere as notas no banco de dados
    $success = $nota->inserirNotas($nome_aluno, $nota_prova1, $nota_aep1, $nota_integrada1, $nota_prova2, $nota_aep2, $nota_integrada2);

    if ($success) {
        echo "Notas adicionadas com sucesso!";
    } else {
        echo "Erro ao adicionar as notas.";
    }
} else {
    // Se não foram enviados dados via POST, redireciona para a página de lista
    header("Location: lista.php");
    exit;
}
?>
