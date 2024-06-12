<?php
require_once 'classes/Database.php';
require_once 'classes/Aluno.php';

$dbname = "SGN.db";
$database = new Database($dbname);
$aluno = new Aluno($database);

$data = json_decode(file_get_contents('php://input'), true);

if ($aluno->excluirAluno($data['ID'])) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}
?>
