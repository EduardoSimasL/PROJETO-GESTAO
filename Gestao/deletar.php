<?php
require_once 'classes/Database.php';
require_once 'classes/Aluno.php';

$dbname = "SGN.db";
$database = new Database($dbname);
$aluno = new Aluno($database);

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['ID'])) {
    $alunoID = $_POST['ID'];

    if ($aluno->excluirAluno($alunoID)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Erro ao excluir aluno.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Dados inválidos recebidos.']);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exclusão de Aluno</title>
</head>
<body>
    <h1>Exclusão de Aluno</h1>
    
    <?php if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['ID'])): ?>
        <?php
        $alunoID = $_POST['ID'];
        if ($aluno->excluirAluno($alunoID)) {
            echo '<p>Aluno excluído com sucesso.</p>';
        } else {
            echo '<p>Erro ao excluir aluno.</p>';
        }
        ?>
        <a href="lista.php">Voltar para lista</a>
    <?php else: ?>
        <p>Dados inválidos recebidos.</p>
        <a href="lista.php">Voltar para lista</a>
    <?php endif; ?>
</body>
</html>
