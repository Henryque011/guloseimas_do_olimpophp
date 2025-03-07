<?php



class Galeria extends Model
{

    // METODO PARA PEGAR FOTOS DA GALERIA

    public function getGaleria($config = [])
    {
        // Define valores padrão
        $limit = isset($config['limit']) ? $config['limit'] : null;
        $order = isset($config['order']) ? $config['order'] : null;

        $sql = "SELECT id_galeira, foto_galeria, alt_foto_galeria , nome_galeria , status_galeria
                FROM tbl_galeria 
                WHERE status_galeria = 'Ativo' 
                  AND id_galeira NOT IN (7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21)";

        // Adiciona a ordenação se especificada
        if ($order) {
            $sql .= " ORDER BY $order";
        }

        // Adiciona o limite se especificado
        if ($limit) {
            $sql .= " LIMIT $limit";
        }

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



    public function getGaleriasobre()
    {

        $sql = "SELECT * FROM tbl_galeria WHERE id_galeira   IN (7 ,8,9,10);";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getGaleriaquemsoueu()
    {

        $sql = "SELECT * FROM tbl_galeria WHERE id_galeira = 11 AND status_galeria =:status_galeria";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':status_galeria', 'Ativo', PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); // Retorna apenas uma linha


    }

    public function getGaleriaqualidade()
    {
        $sql = "SELECT * FROM tbl_galeria WHERE id_galeira = 12 AND status_galeria = :status_galeria";

        try {
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':status_galeria', 'Ativo', PDO::PARAM_STR);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC); // Retorna apenas uma linha
        } catch (PDOException $e) {
            error_log('Erro ao buscar galeria: ' . $e->getMessage());
            return false;
        }
    }


    public function getGaleriaminha_historia()
    {

        $sql = "SELECT * FROM tbl_galeria WHERE id_galeira = 13 AND status_galeria ='Ativo'";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); // Retorna apenas uma linha


    }


    public function getGaleria_pg_galeria(){

        $sql = "SELECT * 
        FROM tbl_galeria 
        WHERE id_galeira  IN (14, 15, 16, 17, 18, 19, 20, 21);";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // retorna todas as linhas 




    }

    public function getGaleriaPorId($id){
        $sql = "SELECT * FROM tbl_galeria WHERE  id_galeira = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); // Retorna um array com os dados ou false
    }


    public function atualizargaleria($id, $dados){
        // Definindo a query SQL
        $sql = "UPDATE tbl_galeria
        SET alt_foto_galeria = :alt_foto_galeria, 
            foto_galeria = :foto_galeria,
            nome_galeria = :nome_galeria
        WHERE id_galeira = :id";

        try {
            // Prepara a query
            $stmt = $this->db->prepare($sql);

            // Vincula os parâmetros
            $stmt->bindValue(':alt_foto_galeria', $dados['alt_foto_galeria']);
            $stmt->bindValue(':foto_galeria', $dados['foto_galeria']);
            $stmt->bindValue(':nome_galeria', $dados['nome_galeria']);
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


    public function atualizar_qualidade_home($id, $dados){
        $sql = "UPDATE tbl_galeria
                SET alt_foto_galeria = :alt_foto_galeria, 
                    foto_galeria = :foto_galeria,
                    nome_galeria = :nome_galeria
                WHERE id_galeira = :id";

        try {
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':alt_foto_galeria', $dados['alt_foto_galeria']);
            $stmt->bindValue(':foto_galeria', $dados['foto_galeria']);
            $stmt->bindValue(':nome_galeria', $dados['nome_galeria']);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);

            return $stmt->execute();
        } catch (PDOException $e) {
            error_log('Erro ao atualizar galeria: ' . $e->getMessage());
            return false;
        }
    }


    public function atualizar_sobre_home($id, $dados){
        $sql = "UPDATE tbl_galeria
                SET alt_foto_galeria = :alt_foto_galeria, 
                    foto_galeria = :foto_galeria,
                    nome_galeria = :nome_galeria
                WHERE id_galeira = :id";

        try {
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':alt_foto_galeria', $dados['alt_foto_galeria']);
            $stmt->bindValue(':foto_galeria', $dados['foto_galeria']);
            $stmt->bindValue(':nome_galeria', $dados['nome_galeria']);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);

            return $stmt->execute();
        } catch (PDOException $e) {
            error_log('Erro ao atualizar galeria: ' . $e->getMessage());
            return false;
        }
    }


    public function atualizarStatusGaleria($id, $status){
        $sql = "UPDATE tbl_galeria 
            SET status_galeria = :status 
            WHERE id_galeira = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':status', $status, PDO::PARAM_STR);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }
}
