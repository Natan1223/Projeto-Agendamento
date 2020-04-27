<?php

namespace App\DAO\MySQL;

use App\Models\MySQL\AcompanhamentoModel;
use App\DAO\MySQL\Conexao;

final class AcompanhamentoDAO extends Conexao
{
    public function __construct()
    {
        parent::__construct();
    }

    public function buscaAcompanhamentos(): array
    {
        $statement = $this->pdo
            ->prepare('SELECT
                        codigo,
                        descricao,
                        ativo
                    FROM acompanhamento 
                    order by ativo DESC, descricao
            ');
        $statement->execute();
        $funcao = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return $funcao;
    }

    public function buscaAcompanhamento(string $descricao): array
    {
        $statement = $this->pdo
            ->prepare('SELECT
                        codigo,
                        descricao,
                        ativo
                    FROM acompanhamento
                    WHERE descricao = :descricao 
                    order by ativo DESC, descricao
            ');
        $statement->bindValue(':descricao', '%'.$descricao.'%');
        $statement->execute();
        $funcao = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return $funcao;
    }

    // public function insereAcompanhamento(AcompanhamentoModel $acompanhamento): void
    // {

    //     $statement = $this->pdo
    //         ->prepare('INSERT INTO acompanhamento VALUES (
    //             null,
    //             :descricao,
    //             :ativo   
    //         );');
    //     $statement->execute([
    //         'descricao'=>$acompanhamento->getDescricao(),
    //         'ativo'=>$acompanhamento->getAtivo()
    //     ]); 
    // }

    // public function atualizaAcompanhamento(AcompanhamentoModel $acompanhamento): void
    // {
    //     $statement = $this->pdo
    //         ->prepare('UPDATE acompanhamento SET
    //                 descricao = :descricao,
    //                 ativo = :ativo
    //             WHERE
    //             codigo = :codigo;');
    //     $statement->execute([
    //         'descricao' => $acompanhamento->getDescricao(),
    //         'ativo' => $acompanhamento->getAtivo(),
    //         'codigo' => $acompanhamento->getCodigo()   
    //     ]);
    // }
}