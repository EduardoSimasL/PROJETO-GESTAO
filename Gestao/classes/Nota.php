<?php

class Nota {
    private $db;

    public function __construct($database) {
        $this->db = $database->getConnection();
    }

    public function obterNotas($id_aluno) {
        $query = "SELECT * FROM notas WHERE ID_aluno = :id_aluno";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id_aluno', $id_aluno, PDO::PARAM_INT);
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
        $stmt->bindParam(':id_aluno', $id_aluno, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function inserirNotas($id_aluno, $nota_prova1, $nota_aep1, $nota_integrada_1, $nota_prova2, $nota_aep2, $nota_integrada_2) {
        try {
            $query = "INSERT INTO notas (ID_aluno, nota_prova1, nota_aep1, nota_integrada_1, nota_prova2, nota_aep2, nota_integrada_2) 
                      VALUES (:id_aluno, :nota_prova1, :nota_aep1, :nota_integrada_1, :nota_prova2, :nota_aep2, :nota_integrada_2)";

            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id_aluno', $id_aluno, PDO::PARAM_INT);
            $stmt->bindParam(':nota_prova1', $nota_prova1);
            $stmt->bindParam(':nota_aep1', $nota_aep1);
            $stmt->bindParam(':nota_integrada_1', $nota_integrada_1);
            $stmt->bindParam(':nota_prova2', $nota_prova2);
            $stmt->bindParam(':nota_aep2', $nota_aep2);
            $stmt->bindParam(':nota_integrada_2', $nota_integrada_2);

            $stmt->execute();
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            echo "Erro ao inserir notas: " . $e->getMessage();
            return false;
        }
    }
    public function calcularMediaBimestral1($nota_prova1, $nota_aep1, $nota_integrada_1) {
        $media = ($nota_prova1 * 0.8) + ($nota_aep1 * 0.1) + ($nota_integrada_1 * 0.1);
        return min(max($media, 0), 10); // Limitar a média entre 0 e 10
    }

    public function calcularMediaBimestral2($nota_prova2, $nota_aep2, $nota_integrada_2) {
        $media = ($nota_prova2 * 0.8) + ($nota_aep2 * 0.1) + ($nota_integrada_2 * 0.1);
        return min(max($media, 0), 10); // Limitar a média entre 0 e 10
    }

    public function calcularMediaFinal($media1, $media2) {
        return ($media1 + $media2) / 2;
    }
}
?>

