<?php



class Funcionario extends Model
{
    // Método para buscar o funcionário pelo email
    public function buscarFunc($email){
        $sql = "SELECT * FROM tbl_funcionario WHERE email_funcionario = :email AND status_funcionario = 'Ativo'";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Método para buscar o funcionário pelo ID
    public function buscarPorId($id){
        $sql = "SELECT * FROM tbl_funcionario WHERE id_funcionario = :id AND status_funcionario = 'Ativo'";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
