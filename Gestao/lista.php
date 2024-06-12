<?php
require_once 'classes/Database.php';
require_once 'classes/Aluno.php';
require_once 'classes/Nota.php';

$dbname = "SGN.db";
$database = new Database($dbname);
$aluno = new Aluno($database);
$nota = new Nota($database);

$alunos = $aluno->listarTodos();

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
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gestão de Notas</title>
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
  <h1 id="titulo">Gestão de Notas</h1>

  <table id="tabelaAlunos">
    <thead>
      <tr>
        <th>Nome</th>
        <th>RA</th>
        <th>E-mail</th>
        <th>Nota Prova 1</th>
        <th>Nota AEP 1</th>
        <th>Nota Prova Integrada 1</th>
        <th>Nota Prova 2</th>
        <th>Nota AEP 2</th>
        <th>Nota Prova Integrada 2</th>
        <th>Média 1</th>
        <th>Média 2</th>
        <th>Média Final</th>
        <th>Status</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>
    <?php foreach ($alunos as $aluno):
        $notas = $nota->obterNotas($aluno['ID']);
        // Inicializa as notas com 'N/A' se não houver notas associadas
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
        // Calcular médias corretamente
        $media1 = calcularMedia(floatval($notas['nota_prova1']), (floatval($notas['nota_aep1']) + floatval($notas['nota_integrada_1'])) / 2);
        $media2 = calcularMedia(floatval($notas['nota_prova2']), (floatval($notas['nota_aep2']) + floatval($notas['nota_integrada_2'])) / 2);
        $media_final = calcularMedia($media1, $media2);
        // Calcular status
        $status = calcularStatus($media_final);
    ?>
      <tr>
        <td><?php echo htmlspecialchars($aluno['nome']); ?></td>
        <td><?php echo htmlspecialchars($aluno['RA']); ?></td>
        <td><?php echo htmlspecialchars($aluno['email']); ?></td>
        <td><?php echo htmlspecialchars($notas['nota_prova1']); ?></td>
        <td><?php echo htmlspecialchars($notas['nota_aep1']); ?></td>
        <td><?php echo htmlspecialchars($notas['nota_integrada_1']); ?></td>
        <td><?php echo htmlspecialchars($notas['nota_prova2']); ?></td>
        <td><?php echo htmlspecialchars($notas['nota_aep2']); ?></td>
        <td><?php echo htmlspecialchars($notas['nota_integrada_2']); ?></td>
        <td><?php echo htmlspecialchars($media1); ?></td>
        <td><?php echo htmlspecialchars($media2); ?></td>
        <td><?php echo htmlspecialchars($media_final); ?></td>
        <td class="<?php echo strtolower($status); ?>"><?php echo htmlspecialchars($status); ?></td>
        <td>
          <form action="deletar.php" method="post">
            <input type="hidden" name="ID" value="<?php echo $aluno['ID']; ?>">
            <button type="submit">Excluir</button>
          </form>
        </td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>

  <script src="js/script.js"></script>
</body>
</html>
