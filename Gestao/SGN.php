<?php
require_once 'classes/Database.php';
require_once 'classes/Aluno.php';
require_once 'classes/Nota.php';

$dbname = "SGN.db";
$database = new Database($dbname);
$aluno = new Aluno($database);
$nota = new Nota($database);

$alunos = $aluno->listarTodos();

header('Content-Type: application/json');

function calcularMedia($nota1, $nota2) {
    return ($nota1 + $nota2) / 2;
}

function calcularStatus($media_final) {
    if ($media_final >= 6) {
        return "Aprovado";
    } elseif ($media_final >= 3) {
        return "Recuperação";
    } else {
        return "Reprovado";
    }
}
// Check if any students are fetched
if (!$alunos) {
    // Handle the case where no students are retrieved
    echo json_encode(array('error' => 'No students found in the database'));
    exit; // Terminate the script execution
}

$data = [];

// Loop through each student and retrieve their grades
foreach ($alunos as $aluno) {
    $notas = $nota->obterNotas($aluno['ID']);
    if (!$notas) {
        // Handle the case where no grades are retrieved for a student
        echo json_encode(array('error' => 'No grades found for student ID: ' . $aluno['ID']));
        exit; // Terminate the script execution
    }
    
    // Calculate averages and status for each student
    $media1 = calcularMedia($notas['nota_prova1'] + $notas['nota_integrada_1'] + $notas['nota_aep1'], 0);
    $media2 = calcularMedia($notas['nota_prova2'] + $notas['nota_integrada_2'] + $notas['nota_aep2'], 0);
    $media_final = calcularMedia($media1, $media2);
    $status = calcularStatus($media_final);

    // Populate the data array with student information
    $data[] = [
        'ID' => $aluno['ID'],
        'nome' => $aluno['nome'],
        'RA' => $aluno['RA'],
        'email' => $aluno['email'],
        'nota_prova1' => $notas['nota_prova1'],
        'nota_aep1' => $notas['nota_aep1'],
        'nota_integrada_1' => $notas['nota_integrada_1'],
        'nota_prova2' => $notas['nota_prova2'],
        'nota_aep2' => $notas['nota_aep2'],
        'nota_integrada_2' => $notas['nota_integrada_2'],
        'med1' => $media1,
        'med2' => $media2,
        'medFinal' => $media_final,
        'status' => $status
    ];
}

// Output the JSON-encoded data
echo json_encode($data);
?>