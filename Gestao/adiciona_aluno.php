<?php
$dbname = "SGN.db";

try {
    $pdo = new PDO("sqlite:$dbname");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Verifica se o formulário foi submetido
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = $_POST['name'];
        $email = $_POST['email'];
        $ra = $_POST['number'];

        // Função para inserir dados no banco de dados
        function inserirDados($pdo, $nome, $email, $RA) {
            $stmt = $pdo->prepare("INSERT INTO Alunos (nome, email, RA) VALUES (:nome, :email, :RA)");
            $stmt->execute([':nome' => $nome, ':email' => $email, ':RA' => $RA]);
        }

        // Insere os dados recebidos do formulário
        inserirDados($pdo, $nome, $email, $ra);
        echo "Aluno adicionado com sucesso!";
    }

} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
?>
