<?php

class Newsletter extends Model
{

    public function salvarNewsletter($email)
    {
        try {
            // Verificar se o email já está na base de dados
            $sql = "SELECT COUNT(*) FROM tbl_newsletter WHERE email_newsletter = :email_newsletter";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':email_newsletter', $email);
            $stmt->execute();
            $emailExistente = $stmt->fetchColumn();

            // Se o email já existir, não faz o insert e redireciona
            if ($emailExistente > 0) {
                // Email já está registrado, retorne um erro para o frontend
                return ['erro' => 'Este email já está cadastrado.'];
            }

            // Se o email não existir, faz o insert
            $sql = "INSERT INTO tbl_newsletter(email_newsletter , data_inscricao_newsletter , staus_newsletter) VALUES (:email_newsletter, NOW(), 'Ativo')";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':email_newsletter', $email);
            $stmt->execute();

            return ['sucesso' => 'O formulário foi enviado com sucesso!'];
        } catch (PDOException $e) {
            // Tratar outros erros de PDO
            throw $e;
        }
    }




    public function emails_Newsletter(){
        $sql = "SELECT * FROM tbl_newsletter";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        // Recuperar os emails e formatar a data
        $emails = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($emails as &$email) {
            // Formatar a data de inscrição para o formato brasileiro
            $email['data_inscricao_newsletter'] = date('d/m/Y H:i:s', strtotime($email['data_inscricao_newsletter']));
        }

        return $emails;
    }
}
