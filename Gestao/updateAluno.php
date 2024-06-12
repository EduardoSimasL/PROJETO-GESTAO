<?php
require_once 'classes/Database.php';
require_once 'classes/Aluno.php';
require_once 'classes/Nota.php';

$dbname = "SGN.db";
$database = new Database($dbname);
$nota = new Nota($database);

$data = json_decode(file_get_contents('php://input'), true);

if ($nota->atualizarNota($data['ID'], $data)) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}
?>
