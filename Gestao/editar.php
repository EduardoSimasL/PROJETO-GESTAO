<?php
require_once 'classes/Database.php';
require_once 'classes/Aluno.php';
require_once 'classes/Nota.php';

// Verifique se o ID do aluno foi fornecido
if (!isset($_GET['id'])) {
    header('Location: lista.php');
    exit();
}

// Inicialize o banco de dados
$dbname = "SGN.db";
$database = new Database($dbname);
$aluno = new Aluno($database);
$nota = new Nota($database);

$id_aluno = $_GET['id'];

// Obter as informações do aluno
$dados_aluno = $aluno->obterAlunoPorId($id_aluno);
if (!$dados_aluno) {
    // Redirecione se o aluno não for encontrado
    header('Location: lista.php');
    exit();
}

// Verifique se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Coletar as notas do formulário
    $nota_prova1 = $_POST['nota_prova1'];
    $nota_aep1 = $_POST['nota_aep1'];
    $nota_integrada_1 = $_POST['nota_integrada_1'];
    $nota_prova2 = $_POST['nota_prova2'];
    $nota_aep2 = $_POST['nota_aep2'];
    $nota_integrada_2 = $_POST['nota_integrada_2'];

    // Atualize as notas do aluno
    $dados = array(
        'nota_prova1' => $nota_prova1,
        'nota_aep1' => $nota_aep1,
        'nota_integrada_1' => $nota_integrada_1,
        'nota_prova2' => $nota_prova2,
        'nota_aep2' => $nota_aep2,
        'nota_integrada_2' => $nota_integrada_2
    );

    $success = $nota->atualizarNota($id_aluno, $dados);
    if ($success) {
        // Redirecione de volta para a lista após a atualização bem-sucedida
        header('Location: lista.php');
        exit();
    } else {
        // Trate o erro, se houver
        $error_message = "Erro ao atualizar as notas.";
    }
}

// Obter as notas atuais do aluno
$notas = $nota->obterNotas($id_aluno);

// Se não houver notas para o aluno, inicialize com valores padrão
if (!$notas) {
    $notas = array(
        'nota_prova1' => 0,
        'nota_aep1' => 0,
        'nota_integrada_1' => 0,
        'nota_prova2' => 0,
        'nota_aep2' => 0,
        'nota_integrada_2' => 0
    );
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar Notas</title>
  <link rel="stylesheet" href="lista.css">
  <link rel="icon" type="image/png" href="./Img/Educ_1.png">
</head>
<body>
  <header>
    <img id="logo" src="./Img/Educ_1.png">
    <nav>
      <ul>
        <li><a href="index.php">Cadastro de alunos</a></li>
        <li><a href="lista.php">Gestão de Notas</a></li>
        <li><a href="#">Sair</a></li>
      </ul>
    </nav>
  </header>
  <h1 id="titulo">Editar Notas do Aluno</h1>

  <?php if (isset($error_message)) : ?>
    <p><?php echo $error_message; ?></p>
  <?php endif; ?>

  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $id_aluno; ?>" method="post">
    <h2>Informações do Aluno</h2>
    <p><strong>Nome:</strong> <?php echo htmlspecialchars($dados_aluno['nome']); ?></p>
    <p><strong>RA:</strong> <?php echo htmlspecialchars($dados_aluno['RA']); ?></p>
    
    <h2>Notas</h2>
    <label for="nota_prova1">Nota Prova 1:</label>
    <input type="number" id="nota_prova1" name="nota_prova1" min="0" max="10" step="0.1" value="<?php echo $notas['nota_prova1']; ?>" required>
    <br>
    <label for="nota_aep1">Nota AEP 1:</label>
    <input type="number" id="nota_aep1" name="nota_aep1" min="0" max="10" step="0.1" value="<?php echo $notas['nota_aep1']; ?>" required>
    <br>
    <label for="nota_integrada_1">Nota Prova Integrada 1:</label>
    <input type="number" id="nota_integrada_1" name="nota_integrada_1" min="0" max="10" step="0.1" value="<?php echo $notas['nota_integrada_1']; ?>" required>
    <br>
    <label for="nota_prova2">Nota Prova 2:</label>
    <input type="number" id="nota_prova2" name="nota_prova2" min="0" max="10" step="0.1" value="<?php echo $notas['nota_prova2']; ?>" required>
    <br>
    <label for="nota_aep2">Nota AEP 2:</label>
    <input type="number" id="nota_aep2" name="nota_aep2" min="0" max="10" step="0.1" value="<?php echo $notas['nota_aep2']; ?>" required>
    <br>
    <label for="nota_integrada_2">Nota Prova Integrada 2:</label>
    <input type="number" id="nota_integrada_2" name="nota_integrada_2" min="0" max="10" step="0.1" value="<?php echo $notas['nota_integrada_2']; ?>" required>
    <br>
    <button type="submit">Salvar Notas</button>
  </form>

</body>
</html>
