<?php

class Favoritos extends Model
{
    // Adicionar produto aos favoritos
    public function adicionarFavorito($id_cliente, $id_produto)
    {
        // Verificar se o id_cliente existe na tabela tbl_cliente
        $sql = "SELECT COUNT(*) FROM tbl_cliente WHERE id_cliente = :id_cliente";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id_cliente', $id_cliente);
        $stmt->execute();
    
        if ($stmt->fetchColumn() == 0) {
            // Se o id_cliente não existe, retorna erro
            return false;
        }
    
        // Verificar se o produto já foi adicionado aos favoritos
        $sql = "SELECT * FROM tbl_favoritos WHERE id_cliente = :id_cliente AND id_produto = :id_produto";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id_cliente', $id_cliente);
        $stmt->bindValue(':id_produto', $id_produto);
        $stmt->execute();
        
        if ($stmt->rowCount() > 0) {
            return false; // Produto já está nos favoritos
        }
    
        // Caso não exista, inserir o novo favorito
        $sql = "INSERT INTO tbl_favoritos (id_cliente, id_produto) VALUES (:id_cliente, :id_produto)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id_cliente', $id_cliente);
        $stmt->bindValue(':id_produto', $id_produto);
        
        return $stmt->execute(); // Retorna true ou false
    }
    

    // Remover produto dos favoritos
    public function removerFavorito($id_cliente, $id_produto)
    {
        // Deleta o produto dos favoritos
        $sql = "DELETE FROM tbl_favoritos WHERE id_cliente = :id_cliente AND id_produto = :id_produto";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id_cliente', $id_cliente);
        $stmt->bindValue(':id_produto', $id_produto);
        
        return $stmt->execute(); // Retorna true ou false
    }

    // Obter os favoritos de um cliente
    public function getFavoritosByCliente($id_cliente)
    {
        // Seleciona todos os favoritos de um cliente
        $sql = "SELECT p.id_produto, p.nome_produto, p.preco_produto, p.foto_produto , p.alt_foto_produto
        , p.link_produto
                FROM tbl_favoritos f 
                JOIN tbl_produtos p ON f.id_produto = p.id_produto
                WHERE f.id_cliente = :id_cliente";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id_cliente', $id_cliente);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retorna os favoritos com detalhes dos produtos
    }
}
