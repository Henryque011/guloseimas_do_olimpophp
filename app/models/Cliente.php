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

    public function salvarCliente($nome, $email, $cpf, $data_nasc, $telefone, $endereco, $bairro, $cidade, $sigla_estado, $cep, $senha)
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
            (nome_cliente, cpf_cliente, data_nasc_cliente, email_cliente, senha_cliente, telefone_cliente, endereco_cliente, bairro_cliente, cidade_cliente, cep_cliente, id_uf, status_cliente) 
            VALUES (:nome, :cpf, :data_nasc, :email, :senha, :telefone, :endereco, :bairro, :cidade, :cep, :id_uf, 'Ativo')";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':nome', $nome);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':cpf', $cpf);
        $stmt->bindValue(':data_nasc', $data_nasc);
        $stmt->bindValue(':telefone', $telefone);
        $stmt->bindValue(':endereco', $endereco);
        $stmt->bindValue(':bairro', $bairro);
        $stmt->bindValue(':cidade', $cidade);
        $stmt->bindValue(':cep', $cep);
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

    public function getClienteById($id)
    {
        $sql = "SELECT * FROM 
                tbl_cliente
                WHERE
                id_cliente = :id 
                AND
                status_cliente = 'Ativo';";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function salvarTokenRecuperacao($idCliente, $token, $expira)
    {
        $sql = "UPDATE tbl_cliente 
            SET token_recuperacao = :token, token_expira = :expira 
            WHERE id_cliente = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':token', $token);
        $stmt->bindValue(':expira', $expira);
        $stmt->bindValue(':id', $idCliente, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function getClientePorToken($token)
    {
        $sql = "SELECT id_cliente, token_recuperacao, token_expira 
            FROM tbl_cliente 
            WHERE token_recuperacao = :token 
            LIMIT 1";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':token', $token, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        return false;
    }

    public function upadateSenha($idCliente, $novaSenha)
    {
        $sql = "UPDATE tbl_cliente SET senha_cliente = :senha WHERE id_cliente = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':senha', $novaSenha, PDO::PARAM_STR); 
        $stmt->bindValue(':id', $idCliente, PDO::PARAM_INT);

        return $stmt->execute();
    }



    public function limparTokenRecuperacao($idCliente)
    {
        $sql = "UPDATE tbl_cliente 
            SET token_recuperacao = NULL, token_expira = NULL 
            WHERE id_cliente = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $idCliente, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
