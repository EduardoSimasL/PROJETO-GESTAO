<?php
class Nota {
    private $db;

    public function __construct($database) {
        $this->db = $database->getConnection();
    }

    public function obterNotas($id_aluno) {
        $query = "SELECT * FROM notas WHERE ID_aluno = :id_aluno";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id_aluno', $id_aluno);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function atualizarNota($id_aluno, $dados) {
        $query = "UPDATE notas SET
            nota_prova1 = :nota_prova1,
            nota_aep1 = :nota_aep1,
            nota_integrada_1 = :nota_integrada_1,
            nota_prova2 = :nota_prova2,
            nota_aep2 = :nota_aep2,
            nota_integrada_2 = :nota_integrada_2
            WHERE ID_aluno = :id_aluno";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':nota_prova1', $dados['nota_prova1']);
        $stmt->bindParam(':nota_aep1', $dados['nota_aep1']);
        $stmt->bindParam(':nota_integrada_1', $dados['nota_integrada_1']);
        $stmt->bindParam(':nota_prova2', $dados['nota_prova2']);
        $stmt->bindParam(':nota_aep2', $dados['nota_aep2']);
        $stmt->bindParam(':nota_integrada_2', $dados['nota_integrada_2']);
        $stmt->bindParam(':id_aluno', $id_aluno);

        return $stmt->execute();
    }

    public function inserirNotas($id_aluno, $nota_prova1, $nota_aep1, $nota_integrada_1, $nota_prova2, $nota_aep2, $nota_integrada_2) {
        try {
            // Preparar a declaração SQL para inserção de notas
            $query = "INSERT INTO notas (ID_aluno, nota_prova1, nota_aep1, nota_integrada_1, nota_prova2, nota_aep2, nota_integrada_2) 
                      VALUES (:id_aluno, :nota_prova1, :nota_aep1, :nota_integrada_1, :nota_prova2, :nota_aep2, :nota_integrada_2)";

            // Preparar a declaração
            $stmt = $this->db->prepare($query);

            // Vincular parâmetros
            $stmt->bindParam(':id_aluno', $id_aluno);
            $stmt->bindParam(':nota_prova1', $nota_prova1);
            $stmt->bindParam(':nota_aep1', $nota_aep1);
            $stmt->bindParam(':nota_integrada_1', $nota_integrada_1);
            $stmt->bindParam(':nota_prova2', $nota_prova2);
            $stmt->bindParam(':nota_aep2', $nota_aep2);
            $stmt->bindParam(':nota_integrada_2', $nota_integrada_2);

            // Executar a declaração
            $stmt->execute();

            // Verificar se a inserção foi bem sucedida
            if ($stmt->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "Erro ao inserir notas: " . $e->getMessage();
            return false;
        }
    }
}
?>
