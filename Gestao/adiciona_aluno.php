<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de alunos</title>
    <link rel="stylesheet" href="./index.css">
    <link rel="website icon" type="png" href="./Img/Educ_1.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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

    <div class="bo">
        <div class="container">
            <div class="form-image">
                <img src="./Img/Educ_3.png">
            </div>

            <div class="cadastroForm">
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $dbname = "SGN.db";

                    try {
                        $pdo = new PDO("sqlite:$dbname");
                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        $nome = $_POST['name'];
                        $email = $_POST['email'];
                        $ra = $_POST['number'];

                        $stmt = $pdo->prepare("INSERT INTO Alunos (nome, email, RA) VALUES (:nome, :email, :RA)");
                        $stmt->execute([':nome' => $nome, ':email' => $email, ':RA' => $ra]);

                        // Mostra as informações do aluno adicionado
                        echo "<h2>Aluno Adicionado com Sucesso:</h2>";
                        echo "<p><strong>Nome:</strong> $nome</p>";
                        echo "<p><strong>E-mail:</strong> $email</p>";
                        echo "<p><strong>RA:</strong> $ra</p>";

                    } catch (PDOException $e) {
                        echo "Erro: " . $e->getMessage();
                    }
                }
                ?>
                <a href="index.php" class="button">Voltar</a>
            </div>
        </div>
    </div>
    <script src="js/script.js"></script>
</body>

</html>
