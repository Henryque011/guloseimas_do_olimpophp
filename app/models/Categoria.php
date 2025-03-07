<?php


class Categoria extends Model
{

    public function getCategoria(){



        $sql = "SELECT * FROM tbl_categoria WHERE status_categoria = 'Ativo'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Debug para verificar os dados retornados


        return $resultado;
    }


    public function listar_getCategoria(){



        $sql = "SELECT * FROM tbl_categoria";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Debug para verificar os dados retornados


        return $resultado;
    }

    public function  getCategoriaPorId($id){
        $sql = "SELECT * FROM tbl_categoria WHERE id_categoria = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function atualizarCategoria($id, $dados)
{
    // Query para atualizar apenas nome e descrição
    $sql = "UPDATE tbl_categoria 
            SET nome_categoria = :nome_categoria, 
                descricao_categoria = :descricao_categoria
            WHERE id_categoria = :id";

    // Prepara a query
    $stmt = $this->db->prepare($sql);

    // Vincula os parâmetros
    $stmt->bindValue(':nome_categoria', $dados['nome_categoria']);
    $stmt->bindValue(':descricao_categoria', $dados['descricao_categoria']);
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


public function atualizarStatusCategoria($id, $status)
{
    $sql = "UPDATE tbl_categoria SET status_categoria = :status WHERE id_categoria = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(':status', $status, PDO::PARAM_STR);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    
    return $stmt->execute();
}





}
