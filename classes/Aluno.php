<?php

class Aluno {
    private $database;

    public function __construct($database) {
        $this->database = $database;
    }

    // Método para obter aluno por ID
    public function obterAlunoPorId($id) {
        $query = "SELECT * FROM Alunos WHERE ID = :id";
        $stmt = $this->database->getConnection()->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Método para listar todos os alunos
    public function listarTodos() {
        $query = "SELECT * FROM Alunos"; // Certifique-se que o nome da tabela está correto
        $stmt = $this->database->getConnection()->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Método para excluir um aluno por ID
    public function excluirAluno($id) {
        $query = "DELETE FROM Alunos WHERE ID = :id"; // Certifique-se que o nome da tabela está correto
        $stmt = $this->database->getConnection()->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>
