<?php



class Destaque extends Model
{

    // METODO PARA PEGAR FOTOS DA GALERIA

    public function getDestaque(){



        $sql = "SELECT  id_produto, foto_produto , alt_foto_produto ,nome_produto , preco_produto, link_produto FROM tbl_produtos  WHERE status_pedido = 'Ativo' LIMIT 3";


        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
