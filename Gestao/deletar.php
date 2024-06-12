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
