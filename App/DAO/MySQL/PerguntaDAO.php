<?php

namespace App\DAO\MySQL;

use App\Models\MySQL\PerguntaModel;
use App\DAO\MySQL\Conexao;

final class PerguntaDAO extends Conexao
{
    public function __construct()
    {
        parent::__construct();
    }

    public function buscaPerguntas(): array
    {
        $statement = $this->pdo
            ->prepare('SELECT
                        codigo,
                        descricao,
                        ativo
                    FROM pergunta 
                    order by ativo DESC, descricao
            ');
        $statement->execute();
        $funcao = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return $funcao;
    }

    public function buscaPergunta(string $descricao): array
    {
        $statement = $this->pdo
            ->prepare('SELECT
                        codigo,
                        descricao,
                        ativo
                    FROM pergunta
                    WHERE descricao = :descricao 
                    order by ativo DESC, descricao
            ');
        $statement->bindValue(':descricao', '%'.$descricao.'%');
        $statement->execute();
        $funcao = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return $funcao;
    }

    public function inserePergunta(PerguntaModel $pergunta): void
    {

        $statement = $this->pdo
            ->prepare('INSERT INTO pergunta VALUES (
                null,
                :descricao,
                :ativo   
            );');
        $statement->execute([
            'descricao'=>$pergunta->getDescricao(),
            'ativo'=>$pergunta->getAtivo()
        ]); 
    }

    public function atualizaPergunta(PerguntaModel $pergunta): void
    {
        $statement = $this->pdo
            ->prepare('UPDATE pergunta SET
                    descricao = :descricao,
                    ativo = :ativo
                WHERE
                codigo = :codigo;');
        $statement->execute([
            'descricao' => $pergunta->getDescricao(),
            'ativo' => $pergunta->getAtivo(),
            'codigo' => $pergunta->getCodigo()   
        ]);
    }
}