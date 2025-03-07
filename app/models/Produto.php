<?php



class Produto extends Model
{



    // METODO PARA PEGAR FOTOS DA GALERIA

    public function getProduto()
    {



        $sql = " SELECT id_produto, foto_produto, alt_foto_produto, nome_produto, preco_produto, status_pedido , link_produto
       FROM tbl_produtos
       WHERE id_produto NOT IN (1, 2, 3 , 4 , 5)
       LIMIT 10
       ";


        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getPg_produtos($categoria = null, $status = null)
    {
        $sql = " SELECT * 
            FROM tbl_produtos p
            INNER JOIN tbl_categoria c ON c.id_categoria = p.id_categoria
            WHERE p.id_produto NOT IN (1, 2, 3, 4, 5, 6) ORDER BY p.nome_produto ASC";

        // Adiciona a condição de categoria, se fornecida
        if ($categoria !== null) {
            $sql .= " AND c.nome_categoria = :categoria";
        }

        // Adiciona a condição de status, se fornecida
        if ($status !== null) {
            $sql .= " AND p.status_pedido = :status";
        }

        $stmt = $this->db->prepare($sql);

        // Liga o parâmetro da categoria, se necessário
        if ($categoria !== null) {
            $stmt->bindValue(':categoria', $categoria, PDO::PARAM_STR);
        }

        // Liga o parâmetro do status, se necessário
        if ($status !== null) {
            $stmt->bindValue(':status', $status, PDO::PARAM_STR);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getServicoPorlink($link)
    {
       
        $sql = "SELECT * 
   FROM tbl_info_produtos AS ip
     INNER JOIN tbl_produtos AS p ON ip.id_produto = p.id_produto WHERE status_pedido = 'Ativo' AND link_produto = :link  AND status_info_produtos = 'Ativo'";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':link', $link);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); // Certifique-se de que isso retorna um array ou um objeto
    }


    public function getTodosServicos($id = null)
    {
        $sql = "SELECT * FROM tbl_info_produtos AS ip
            INNER JOIN tbl_produtos AS p ON ip.id_produto = p.id_produto";

        if ($id !== null) {
            $sql .= " WHERE ip.id_info_produtos = :id";
        }

        $stmt = $this->db->prepare($sql);

        if ($id !== null) {
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getServicoPorId($id)
    {
        $sql = "SELECT 
                ip.*, 
                p.* 
                 
            FROM tbl_info_produtos AS ip
            INNER JOIN tbl_produtos AS p ON ip.id_produto = p.id_produto
            WHERE ip.status_info_produtos = 'Ativo' AND ip.id_info_produtos = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    //################################################### 

    // BACK-END - DASHBORAD

    //###################################################


    public function atualizarProduto($id, $dados)
    {
        // Definindo a query SQL
        $sql = "UPDATE tbl_produtos 
            SET nome_produto = :nome_produto, 
                descricao_produto = :descricao_produto, 
                preco_produto = :preco_produto,
                foto_produto = :foto_produto
            WHERE id_produto = :id";

        // Depuração: Exibe a query e os dados antes da execução
        echo '<pre>';
        echo 'Query SQL antes da execução: ';
       
        echo 'Dados a serem vinculados: ';
      
        echo '</pre>';

        // Prepara a query
        $stmt = $this->db->prepare($sql);

        // Vincula os parâmetros
        $stmt->bindValue(':nome_produto', $dados['nome_produto']);
        $stmt->bindValue(':descricao_produto', $dados['descricao_produto']);
        $stmt->bindValue(':preco_produto', $dados['preco_produto']);
        $stmt->bindValue(':foto_produto', $dados['foto_produto']);
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


    public function atualizar_info_Produto($id, $dados)
    {
        // Definindo a query SQL
        $sql = "UPDATE tbl_produtos AS p
    INNER JOIN tbl_info_produtos AS ip ON p.id_produto = ip.id_produto
    SET ip.nome_info_produtos = :nome_info_produtos,

        ip.descricao_info_produto = :descricao_info_produto,

        ip.foto_info_produto = :foto_info_produto,

        ip.info_alt_foto_produto = :info_alt_foto_produto,


        p.preco_produto = :preco_produto,

        ip.personalizacao_info_produtos = :personalizacao_info_produtos,

        ip.forma_pagamento_info_produto = :forma_pagamento_info_produto,

        ip.entrega_info_produtos = :entrega_info_produtos,

        ip.reserva_info_produtos = :reserva_info_produtos

    WHERE ip.id_info_produtos = :id";


        $stmt = $this->db->prepare($sql);

        // Vincula os parâmetros
        $stmt->bindValue(':nome_info_produtos', $dados['nome_info_produtos']);

        $stmt->bindValue(':descricao_info_produto', $dados['descricao_info_produto']);

        $stmt->bindValue(':foto_info_produto', $dados['foto_info_produto']);

        $stmt->bindValue(':info_alt_foto_produto', $dados['info_alt_foto_produto']);

        $stmt->bindValue(':preco_produto', $dados['preco_produto']);

        $stmt->bindValue(':personalizacao_info_produtos', $dados['personalizacao_info_produtos']);


        $stmt->bindValue(':forma_pagamento_info_produto', $dados['forma_pagamento_info_produto']);

        $stmt->bindValue(':entrega_info_produtos', $dados['entrega_info_produtos']);

        $stmt->bindValue(':reserva_info_produtos', $dados['reserva_info_produtos']);



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

    public function getProdutoPorId($id)
    {
        $sql = "SELECT * FROM tbl_produtos WHERE id_produto = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function atualizarStatusProduto($id, $status)
    {
        $sql = "UPDATE tbl_produtos 
            SET status_pedido = :status 
            WHERE id_produto = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':status', $status, PDO::PARAM_STR);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }


    public function adicionar($idProduto, $id_cliente)
    {
        // Verifica se o cliente está logado
        if (!isset($_SESSION['userId'])) {
            $_SESSION['erro'] = 'Faça login para continuar.';
            header('Location: ' . BASE_URL . 'login');
            exit();
        }

        $sql = "SELECT * FROM tbl_reserva WHERE id_cliente = :id_cliente AND id_produto = :id_produto";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id_cliente', $id_cliente);
        $stmt->bindValue(':id_produto', $idProduto);
        $stmt->execute();
        $reserva = $stmt->fetch();

        if ($reserva) {
            // Atualiza a quantidade no banco
            $sql = "UPDATE tbl_reserva SET quantidade_reserva = quantidade_reserva + 1 WHERE id_cliente = :id_cliente AND id_produto = :id_produto";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':id_cliente', $id_cliente);
            $stmt->bindValue(':id_produto', $idProduto);
            $stmt->execute();
        } else {
            // Insere um novo item no banco
            $sql = "INSERT INTO tbl_reserva (id_cliente, id_produto, quantidade_reserva) VALUES (:id_cliente, :id_produto, 1)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':id_cliente', $id_cliente);
            $stmt->bindValue(':id_produto', $idProduto);
            $stmt->execute();
        }

        // Atualiza a sessão com os dados mais recentes
        $this->atualizarCarrinhoSessao($id_cliente);

        // Redireciona para a página de compras
        header('Location: ' . BASE_URL . 'compras');
        exit();
    }

    public function addFotoProduto($id_produto, $arquivo, $link_produto)
    {
        // Verifica se os valores são válidos
        if (empty($arquivo)) {
            throw new Exception('O arquivo não pode ser vazio.');
        }
        if (empty($id_produto)) {
            throw new Exception('O ID do produto não pode ser vazio.');
        }

        // Se o link_produto estiver vazio, gera um slug baseado no nome do produto
        if (empty($link_produto)) {
            $link_produto = "produto-" . time(); // Gera um identificador único
        }

        // Inserção no banco de dados associando a foto ao produto
        $sql = "INSERT INTO tbl_produtos (id_produto, foto_produto, link_produto) 
                VALUES (:id_produto, :foto_produto, :link_produto)";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id_produto', $id_produto); // Usando o id_produto retornado da inserção anterior
        $stmt->bindValue(':foto_produto', $arquivo);
        $stmt->bindValue(':link_produto', $link_produto);

        return $stmt->execute();
    }


    public function existeEsseServico($link)
    {
        $sql = "SELECT COUNT(*) AS total FROM tbl_produtos WHERE link_produto = :link";

        $stmt = $this->db->prepare($sql);
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':link', $link);
        $stmt->execute();

        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);


        return $resultado['total'] > 0;
    }


    private function atualizarCarrinhoSessao($id_cliente)
    {
        $sql = "SELECT r.id_produto, r.quantidade_reserva, p.nome_produto, p.preco_produto, p.foto_produto
            FROM tbl_reserva r
            JOIN tbl_produtos p ON r.id_produto = p.id_produto
            WHERE r.id_cliente = :id_cliente";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id_cliente', $id_cliente);
        $stmt->execute();
        $reservas = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Atualiza a variável de sessão
        $_SESSION['carrinho'] = [];
        foreach ($reservas as $reserva) {
            $_SESSION['carrinho'][$reserva['id_produto']] = [
                'quantidade' => $reserva['quantidade_reserva'],
                'nome' => $reserva['nome_produto'],
                'preco' => $reserva['preco_produto'],
                'foto' => $reserva['foto_produto'] // Certifique-se de que este campo está no banco
            ];
        }
    }


    public function remover($idProduto, $id_cliente)
    {
        // Verifica se o cliente está logado
        if (!isset($_SESSION['userId'])) {
            $_SESSION['erro'] = 'Faça login para continuar.';
            header('Location: ' . BASE_URL . 'login');
            exit();
        }

        // Remove o item da tabela tbl_reserva
        $sql = "DELETE FROM tbl_reserva WHERE id_cliente = :id_cliente AND id_produto = :id_produto";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id_cliente', $id_cliente);
        $stmt->bindValue(':id_produto', $idProduto);
        $stmt->execute();

        // Atualiza a sessão com os dados mais recentes
        $this->atualizarCarrinhoSessao($id_cliente);

        // Redireciona para a página do carrinho
        header('Location: ' . BASE_URL . 'compras');
        exit();
    }

    public function addproduto($dados, $arquivo, $informacoes_produto)
    {
        try {
            // Inicia a transação
            $this->db->beginTransaction();

            // Inserção do produto na tabela tbl_produtos
            $sql_produto = "INSERT INTO tbl_produtos(nome_produto, preco_produto, status_pedido, id_categoria, alt_foto_produto, link_produto, foto_produto) 
                        VALUES(:nome_produto, :preco_produto, :status_pedido, :id_categoria, :alt_foto_produto, :link_produto, :foto_produto)";

            $stmt_produto = $this->db->prepare($sql_produto);
            $stmt_produto->bindValue(':nome_produto', $dados['nome_produto']);
            $stmt_produto->bindValue(':preco_produto', $dados['preco_produto']);
            $stmt_produto->bindValue(':status_pedido', $dados['status_pedido']);
            $stmt_produto->bindValue(':id_categoria', $dados['id_categoria']);
            $stmt_produto->bindValue(':alt_foto_produto', $dados['nome_produto']);
            $stmt_produto->bindValue(':link_produto', $dados['link_produto']);
            $stmt_produto->bindValue(':foto_produto', $arquivo);
            $stmt_produto->execute();

            // Obtém o ID do produto recém-inserido
            $id_produto = $this->db->lastInsertId();

            // Inserção na tabela de informações do produto
            $sql_info_produto = "INSERT INTO tbl_info_produtos(id_produto, descricao_info_produto, personalizacao_info_produtos, forma_pagamento_info_produto, entrega_info_produtos, reserva_info_produtos, status_info_produtos, foto_info_produto)
            VALUES(:id_produto, :descricao_info_produto, :personalizacao_info_produtos, :forma_pagamento_info_produto, :entrega_info_produtos, :reserva_info_produtos, :status_info_produtos , :foto_info_produto)";

            $stmt_info_produto = $this->db->prepare($sql_info_produto);
            $stmt_info_produto->bindValue(':id_produto', $id_produto);
            $stmt_info_produto->bindValue(':descricao_info_produto', $informacoes_produto['descricao_info_produto']);
            $stmt_info_produto->bindValue(':personalizacao_info_produtos', $informacoes_produto['personalizacao_info_produtos']);
            $stmt_info_produto->bindValue(':forma_pagamento_info_produto', $informacoes_produto['forma_pagamento_info_produto']);
            $stmt_info_produto->bindValue(':entrega_info_produtos', $informacoes_produto['entrega_info_produtos']);
            $stmt_info_produto->bindValue(':reserva_info_produtos', $informacoes_produto['reserva_info_produtos']);
            $stmt_info_produto->bindValue(':foto_info_produto', $arquivo);
            $stmt_info_produto->bindValue(':status_info_produtos', 'Ativo');
            $stmt_info_produto->execute();
            // Confirma a transação
            $this->db->commit();

            // Retorna o ID do produto
            return $id_produto;
        } catch (Exception $e) {
            // Reverte a transação em caso de erro
            $this->db->rollBack();
            throw $e;
        }
    }

    public function addInformacoesProduto($id_produto, $informacoes)
    {
        $sql = "INSERT INTO tbl_info_produtos(id_produto,  descricao_info_produto, personalizacao_info_produtos, forma_pagamento_info_produto, entrega_info_produtos, reserva_info_produtos)
            VALUES(:id_produto,  :descricao_info_produto, :personalizacao_info_produtos, :forma_pagamento_info_produto, :entrega_info_produtos, :reserva_info_produtos)";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id_produto', $id_produto);
        $stmt->bindValue(':descricao_info_produto', $informacoes['descricao_info_produto']);
        $stmt->bindValue(':personalizacao_info_produtos', $informacoes['personalizacao_info_produtos']);
        $stmt->bindValue(':forma_pagamento_info_produto', $informacoes['forma_pagamento_info_produto']);
        $stmt->bindValue(':entrega_info_produtos', $informacoes['entrega_info_produtos']);
        $stmt->bindValue(':reserva_info_produtos', $informacoes['reserva_info_produtos']);

        return $stmt->execute(); // Retorna true se for bem-sucedido
    }


    public function obterOuCriarcategoria($nome)
    {
        $sql = "INSERT INTO tbl_categoria(nome_categoria , status_categoria) VALUES(
                :nome_categoria, 'Ativo')";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':nome_categoria', $nome);


        if ($stmt->execute()) {
            return $this->db->lastInsertId();
        }

        return false;
    }


    public function getVerMaisProdutos($limite, $offset)
{
    $sql = "SELECT * FROM tbl_produtos 
            WHERE status_pedido = 'Ativo' 
            ORDER BY id_produto ASC 
            LIMIT :limite OFFSET :offset";

    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(':limite', $limite, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}



    public function getProdutosPorCategoria($categoriaId, $limite = 10, $offset = 0)
    {
        $sql = "SELECT * FROM tbl_produtos 
                WHERE status_pedido = 'Ativo' 
                AND id_categoria IN (SELECT id_categoria FROM tbl_categoria WHERE status_categoria = 'Ativo') 
                AND id_categoria = :categoriaId
                LIMIT :limite OFFSET :offset";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':categoriaId', $categoriaId, PDO::PARAM_INT);
        $stmt->bindValue(':limite', $limite, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getTodosProdutos($limite = 2, $offset = 0)
    {
        // Query para buscar todos os produtos com limite e offset
        $sql = "SELECT * FROM tbl_produtos WHERE status_pedido = 'Ativo' LIMIT :limite OFFSET :offset";

        // Prepara a consulta
        $stmt = $this->db->prepare($sql);

        // Bind dos parâmetros
        $stmt->bindValue(':limite', $limite, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

        // Executa a consulta
        $stmt->execute();

        // Retorna os resultados
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProdutosPorPreco($precoMax)
    {
        $sql = "SELECT * FROM tbl_produtos WHERE preco_produto <= :precoMax AND status_pedido = 'Ativo' ORDER BY preco_produto ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':precoMax', $precoMax, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
