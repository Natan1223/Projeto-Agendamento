<?php

namespace App\DAO\MySQL;

use App\Models\MySQL\TipoPerguntaModel;
use App\DAO\MySQL\Conexao;

final class TipoPerguntaDAO extends Conexao
{
    public function __construct()
    {
        parent::__construct();
    }

    public function buscaTipoPerguntas(): array
    {
        $statement = $this->pdo
            ->prepare('SELECT
                        codigo,
                        descricao,
                        ativo
                    FROM tipo_pergunta 
                    order by ativo DESC, descricao
            ');
        $statement->execute();
        $funcao = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return $funcao;
    }

    public function buscaTipoPergunta(string $descricao): array
    {
        $statement = $this->pdo
            ->prepare('SELECT
                        codigo,
                        descricao,
                        ativo
                    FROM tipo_pergunta
                    WHERE descricao = :descricao 
                    order by ativo DESC, descricao
            ');
        $statement->bindValue(':descricao', '%'.$descricao.'%');
        $statement->execute();
        $funcao = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return $funcao;
    }

    public function insereTipoPergunta(TipoPerguntaModel $tipoPergunta): void
    {

        $statement = $this->pdo
            ->prepare('INSERT INTO tipo_pergunta VALUES (
                null,
                :descricao,
                :ativo   
            );');
        $statement->execute([
            'descricao'=>$tipoPergunta->getDescricao(),
            'ativo'=>$tipoPergunta->getAtivo()
        ]); 
    }

    public function atualizaTipoPergunta(TipoPerguntaModel $tipoPergunta): void
    {
        $statement = $this->pdo
            ->prepare('UPDATE tipo_pergunta SET
                    descricao = :descricao,
                    ativo = :ativo
                WHERE
                codigo = :codigo;');
        $statement->execute([
            'descricao' => $tipoPergunta->getDescricao(),
            'ativo' => $tipoPergunta->getAtivo(),
            'codigo' => $tipoPergunta->getCodigo()   
        ]);
    }
}