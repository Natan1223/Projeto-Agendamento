<?php

namespace App\DAO\MySQL;

use App\Models\MySQL\ParametroModel;
use App\DAO\MySQL\Conexao;

final class ParametroDAO extends Conexao
{
    public function __construct()
    {
        parent::__construct();
    }

    public function buscaParametros(): array
    {
        $statement = $this->pdo
            ->prepare('SELECT
                        codigo,
                        descricao,
                        ativo
                    FROM parametro 
                    order by ativo DESC, descricao
            ');
        $statement->execute();
        $funcao = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return $funcao;
    }

    public function buscaParametro(string $descricao): array
    {
        $statement = $this->pdo
            ->prepare('SELECT
                        codigo,
                        descricao,
                        ativo
                    FROM parametro
                    WHERE descricao = :descricao 
                    order by ativo DESC, descricao
            ');
        $statement->bindValue(':descricao', '%'.$descricao.'%');
        $statement->execute();
        $funcao = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return $funcao;
    }

    public function insereParametro(ParametroModel $parametro): void
    {

        $statement = $this->pdo
            ->prepare('INSERT INTO parametro VALUES (
                null,
                :descricao,
                :ativo   
            );');
        $statement->execute([
            'descricao'=>$parametro->getDescricao(),
            'ativo'=>$parametro->getAtivo()
        ]); 
    }

    public function atualizaParametro(ParametroModel $parametro): void
    {
        $statement = $this->pdo
            ->prepare('UPDATE parametro SET
                    descricao = :descricao,
                    ativo = :ativo
                WHERE
                codigo = :codigo;');
        $statement->execute([
            'descricao' => $parametro->getDescricao(),
            'ativo' => $parametro->getAtivo(),
            'codigo' => $parametro->getCodigo()   
        ]);
    }
}