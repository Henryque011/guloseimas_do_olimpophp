<?php



class Banner extends Model
{

    // METODO PARA PEGAR FOTOS DA GALERIA

    public function getBanner($status = null){
        // Consulta básica que retorna todos os banners
        $sql = "SELECT * FROM tbl_banner";
        
        // Adiciona a condição de status apenas se fornecida
        if ($status !== null) {
            $sql .= " WHERE status_banner = :status";
        }
    
        $stmt = $this->db->prepare($sql);
    
        // Liga o parâmetro do status, se necessário
        if ($status !== null) {
            $stmt->bindValue(':status', $status, PDO::PARAM_STR);
        }
    
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



    public function getBanner_produto(){



        $sql = "SELECT * FROM tbl_banner WHERE id_banner = 2  AND status_banner ='Ativo'";


        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getBanner_galeria(){



        $sql = "SELECT * FROM tbl_banner WHERE id_banner = 3  AND status_banner ='Ativo'";


        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getBanner_contato(){



        $sql = "SELECT * FROM tbl_banner WHERE id_banner = 4  AND status_banner ='Ativo'";


        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getBanner_login(){



        $sql = "SELECT * FROM tbl_banner WHERE id_banner = 5  AND status_banner ='Ativo'";


        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getBanner_entrar(){



        $sql = "SELECT * FROM tbl_banner WHERE id_banner = 6  AND status_banner ='Ativo'";


        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getBanner_criar_conta(){



        $sql = "SELECT * FROM tbl_banner WHERE id_banner = 7  AND status_banner ='Ativo'";


        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getBanner_recuperar_senha(){



        $sql = "SELECT * FROM tbl_banner WHERE id_banner = 8  AND status_banner ='Ativo'";


        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }




   
    public function  getbannerPorId($id){
        $sql = "SELECT * FROM tbl_banner WHERE id_banner = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function atualizarProduto_banner($id, $dados){
        // Definindo a query SQL
        $sql = "UPDATE tbl_banner SET nome_banner = :nome_banner , foto_banner = :foto_banner , alt_foto_banner = :alt_foto_banner WHERE id_banner = :id";
        
        // Depuração: Exibe a query e os dados antes da execução
        echo '<pre>';
        echo 'Query SQL antes da execução: ';
        var_dump($sql); // Exibe a query SQL
        echo 'Dados a serem vinculados: ';
        var_dump($dados); // Exibe os dados sendo passados para o banco
        echo '</pre>';
        
        // Prepara a query
        $stmt = $this->db->prepare($sql);
        
        // Vincula os parâmetros
        $stmt->bindValue(':nome_banner', $dados['nome_banner']);
        $stmt->bindValue(':alt_foto_banner', $dados['alt_foto_banner']);
        $stmt->bindValue(':foto_banner', $dados['foto_banner']);
        $stmt->bindValue(':id', $id);
        
        // Executa a query
        if (!$stmt->execute()) {
            echo '<pre>';
            echo 'Erro ao executar a query: ';
            print_r($stmt->errorInfo()); // Exibe os erros da execução
            echo '</pre>';
            return false;
        }
        return true;
    }


public function atualizarStatusBanner($id, $status){
    $sql = "UPDATE tbl_banner 
            SET status_banner = :status 
            WHERE id_banner = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(':status', $status, PDO::PARAM_STR);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);

    return $stmt->execute();
}

}
