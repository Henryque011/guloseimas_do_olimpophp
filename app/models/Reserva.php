<?php



class Reserva extends Model
{

    public function listarReservasPorCliente($id_cliente)
    {



        $sql = "SELECT r.*, p.nome_produto, p.foto_produto 
        FROM tbl_reserva r 
        JOIN tbl_produtos p ON r.id_produto = p.id_produto 
        WHERE r.id_cliente = :id_cliente 
        ORDER BY r.data_entrega_reserva DESC";


        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



    public function finalizarReserva()
    {
        if (isset($_SESSION['carrinho']) && !empty($_SESSION['carrinho'])) {
            $id_cliente = $_SESSION['userId'];
            $dataReserva = date('Y-m-d H:i:s');
    
            // Calcula o total da reserva
            $total = array_sum(array_map(function ($produto) {
                return $produto['quantidade'] * $produto['preco'];
            }, $_SESSION['carrinho']));
    
            try {
                // Iniciar uma transação para garantir que tudo seja inserido corretamente
                $this->db->beginTransaction();
    
                // Inserir a reserva na tbl_reserva
                $sqlReserva = "INSERT INTO tbl_reserva (id_cliente, valor_total, data_reserva) 
                               VALUES (:id_cliente, :valor_total, :data_reserva)";
                $stmtReserva = $this->db->prepare($sqlReserva);
                $stmtReserva->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
                $stmtReserva->bindParam(':valor_total', $total);
                $stmtReserva->bindParam(':data_reserva', $dataReserva);
                $stmtReserva->execute();
    
                // Pegar o ID da reserva recém-criada
                $id_reserva = $this->db->lastInsertId();
    
                // Inserir cada item do carrinho na tbl_reserva_produtos
                $sqlItens = "INSERT INTO tbl_reserva_produtos (id_reserva, id_produto, quantidade, preco_unitario) 
                             VALUES (:id_reserva, :id_produto, :quantidade, :preco_unitario)";
                $stmtItens = $this->db->prepare($sqlItens);
    
                foreach ($_SESSION['carrinho'] as $produto) {
                    $stmtItens->bindParam(':id_reserva', $id_reserva, PDO::PARAM_INT);
                    $stmtItens->bindParam(':id_produto', $produto['id_produto'], PDO::PARAM_INT);
                    $stmtItens->bindParam(':quantidade', $produto['quantidade'], PDO::PARAM_INT);
                    $stmtItens->bindParam(':preco_unitario', $produto['preco']);
                    $stmtItens->execute();
                }
    
                // Confirma a transação
                $this->db->commit();
    
                // Esvazia o carrinho após a reserva ser concluída
                $_SESSION['carrinho'] = [];
    
                return true;
            } catch (PDOException $e) {
                // Se houver erro, cancela a transação e retorna erro
                $this->db->rollBack();
                $_SESSION['erro'] = 'Erro no banco de dados: ' . $e->getMessage();
                return false;
            }
        } else {
            $_SESSION['erro'] = 'Carrinho vazio. Não é possível realizar a reserva.';
            return false;
        }
    }
    
    

    
    


}
