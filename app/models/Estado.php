<?php



class Estado extends Model
{
    public function getEstado(){
        // A consulta agora busca pelo valor da sigla e retorna o id_uf correspondente.
        $sql = "SELECT * FROM tbl_estado ";
        $stmt = $this->db->prepare($sql);
        // $stmt->bindValue( );  // Agora o parâmetro é a sigla do estado.
        $stmt->execute();
        
        // O método agora retorna o id_uf encontrado
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }
}

