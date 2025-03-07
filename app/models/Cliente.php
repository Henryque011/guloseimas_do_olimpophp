<?php



class Cliente extends Model
{





    public function buscarCliente($email)
    {





        $sql = "SELECT * FROM tbl_cliente WHERE email_cliente = :email AND status_cliente = 'Ativo'";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function salvarCliente($nome, $email, $cpf, $data_nasc, $telefone, $endereco, $bairro, $cidade, $sigla_estado, $senha)
    {
        // Buscar o ID do estado com base na sigla fornecida
        $sqlEstado = "SELECT id_uf FROM tbl_estado WHERE sigla_uf= :sigla_estado LIMIT 1";
        $stmtEstado = $this->db->prepare($sqlEstado);
        $stmtEstado->bindValue(':sigla_estado', $sigla_estado);
        $stmtEstado->execute();

        $idEstado = $stmtEstado->fetchColumn();

        if (!$idEstado) {
            throw new Exception("Estado inválido: $sigla_estado");
        }

        // Inserir os dados do cliente, incluindo status_cliente como 'Ativo'
        $sql = "INSERT INTO tbl_cliente 
            (nome_cliente, cpf_cliente, data_nasc_cliente, email_cliente, senha_cliente, telefone_cliente, endereco_cliente, bairro_cliente, cidade_cliente, id_uf, status_cliente) 
            VALUES (:nome, :cpf, :data_nasc, :email, :senha, :telefone, :endereco, :bairro, :cidade, :id_uf, 'Ativo')";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':nome', $nome);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':cpf', $cpf);
        $stmt->bindValue(':data_nasc', $data_nasc);
        $stmt->bindValue(':telefone', $telefone);
        $stmt->bindValue(':endereco', $endereco);
        $stmt->bindValue(':bairro', $bairro);
        $stmt->bindValue(':cidade', $cidade);
        $stmt->bindValue(':id_uf', $idEstado);
        $stmt->bindValue(':senha', $senha);

        return $stmt->execute();
    }



    public function buscarPorEmail($email): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM tbl_cliente WHERE email_cliente = ?");
        $stmt->execute([$email]); // Passa o parâmetro corretamente
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        return $usuario ?: null; // Retorna null se não encontrar o e-mail
    }


    public function atualizarSenha($email, $novaSenha): bool
    {
        $stmt = $this->db->prepare("UPDATE tbl_cliente SET senha_cliente = ? WHERE email_cliente = ?");
        return $stmt->execute([$novaSenha, $email]); // Passa os parâmetros corretamente
    }


    public function atualizarCliente($email, $nome, $cpf, $telefone, $data_nascimento)
    {
        $sql = "UPDATE tbl_cliente SET nome_cliente = :nome, cpf_cliente = :cpf, telefone_cliente = :telefone , data_nasc_cliente = :data_nasc_cliente WHERE email_cliente = :email";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':nome', $nome);
        $stmt->bindValue(':cpf', $cpf);
        $stmt->bindValue(':telefone', $telefone);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':data_nasc_cliente', $data_nascimento);

        return $stmt->execute();
    }

    public function editar_Senha_cliente($email, $nova_senha)
    {
        $sql = "UPDATE tbl_cliente SET senha_cliente = :senha WHERE email_cliente = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':senha', $nova_senha);
        $stmt->bindParam(':email', $email);
    
        return $stmt->execute();
    }


    
}
