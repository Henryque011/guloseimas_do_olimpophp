<?php



class Servicos extends Model
{



    public function getServicos(){



        $sql = "SELECT * FROM tbl_servico";


        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getServicoPorId($id){
      $sql = "SELECT * FROM tbl_servico WHERE id_servico = :id"; // Remova o filtro de status
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); // Retorna um array com os dados ou false
    }


    public function atualizarservico($id, $dados){


        // Definindo a query SQL
        $sql = "UPDATE tbl_servico
        SET alt_foto_servico = :alt_foto_servico, 
            foto_servico = :foto_servico,
            descricao_servico =:descricao_servico,
            nome_servico= :nome_servico
        WHERE id_servico = :id";

        try {
            // Prepara a query
            $stmt = $this->db->prepare($sql);

            // Vincula os parâmetros
            $stmt->bindValue(':alt_foto_servico', $dados['alt_foto_servico']);
            $stmt->bindValue(':foto_servico', $dados['foto_servico']);
            $stmt->bindValue(':nome_servico', $dados['nome_servico']);
            $stmt->bindValue(':descricao_servico', $dados['descricao_servico']);

            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            // Executa a query
            if ($stmt->execute()) {
                return true; // Atualização bem-sucedida
            } else {
                // Log ou tratamento do erro
                error_log(print_r($stmt->errorInfo(), true));
                return false;
            }
        } catch (PDOException $e) {
            // Captura exceções e registra no log
            error_log('Erro ao atualizar galeria: ' . $e->getMessage());
            return false;
        }
    }


    public function atualizarStatusServico($id, $status){
        $sql = "UPDATE tbl_servico 
                SET status_servico = :status 
                WHERE id_servico = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':status', $status, PDO::PARAM_STR);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }




}
