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
                <form action="adiciona_aluno.php" method="post">
                    <div class="input-box">
                        <div class="input_nome">
                            <label for="input_nome">NOME COMPLETO</label>
                            <div class="input-field">
                                <i class="fa-solid fa-user"></i>
                                <input id="input_nome" type="text" name="name" placeholder="Digite seu nome" required>
                            </div>
                        </div>

                        <div class="input_email">
                            <label for="input_email">E-MAIL</label>
                            <div class="input-field">
                                <i class="fa-solid fa-envelope"></i>
                                <input id="input_email" type="email" name="email" placeholder="Digite seu e-mail" required>
                            </div>
                        </div>

                        <div class="input_ra">
                            <label for="input_ra">REGISTRO ACADÊMICO [RA]</label>
                            <div class="input-field">
                                <i class="fa-solid fa-folder-open"></i>
                                <input id="input_ra" type="number" name="number" placeholder="Digite seu RA" required>
                            </div>
                        </div>
                        <button type="submit">Adicionar Aluno</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="js/script.js"></script>
</body>

</html>
