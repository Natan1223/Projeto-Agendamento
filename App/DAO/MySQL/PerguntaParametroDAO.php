<?php

namespace App\DAO\MySQL;

use App\Models\MySQL\PerguntaParametroModel;
use App\DAO\MySQL\Conexao;

final class PerguntaParametroDAO extends Conexao
{
    public function __construct()
    {
        parent::__construct();
    }

    public function buscaPerguntaParametros(): array
    {
        $statement = $this->pdo
            ->prepare(' SELECT DISTINCT
                            p.codigo,
                            p.descricao
                        FROM pergunta_parametro pp
                        JOIN pergunta p
                            ON pp.codigo_pergunta = p.codigo
                        
            ');
        $statement->execute();
        $funcao = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return $funcao;
    }

    public function buscaPerguntaTipoPergunta(int $codigoPergunta): array
    {
        $statement = $this->pdo
            ->prepare(' SELECT DISTINCT
                            tp.codigo,
                            tp.descricao
                        FROM pergunta_parametro pp
                        JOIN tipo_pergunta tp
                            ON pp.codigo_tipo_pergunta = tp.codigo
                            and pp.codigo_pergunta = :codigoPergunta
                        
            ');
        $statement->bindValue(':codigoPergunta', $codigoPergunta);
        $statement->execute();
        $funcao = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return $funcao;
    }

    public function buscaPerguntaTipoPerguntaParametro(int $codigoPergunta, int $codigoTipoPergunta): array
    {
        $statement = $this->pdo
            ->prepare(' SELECT DISTINCT
                            pa.codigo,
                            pa.descricao,
                            pp.inapta
                        FROM pergunta_parametro pp

                        JOIN parametro pa 
                            ON pp.codigo_parametro = pa.codigo
                            and pp.codigo_pergunta = :codigoPergunta
                            and pp.codigo_tipo_pergunta = :codigoTipoPergunta
                        
            ');
        $statement->bindValue(':codigoPergunta', $codigoPergunta);
        $statement->bindValue(':codigoTipoPergunta', $codigoTipoPergunta);
        $statement->execute();
        $funcao = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return $funcao;
    }

    

    public function buscaPerguntaParametro(string $descricao): array
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

    public function inserePerguntaParametro(PerguntaParametroModel $perguntaParametro): void
    {

        $statement = $this->pdo
            ->prepare('INSERT INTO pergunta_parametro VALUES (
                null,
                :codigoPergunta,
                :codigoTipoPergunta,
                :codigoParametro,
                :inapta
            );');
        $statement->execute([
            'codigoPergunta' => $perguntaParametro->getCodigoPrgunta(),
            'codigoTipoPergunta' => $perguntaParametro->getCodigoTipoPergunta(),
            'codigoParametro' => $perguntaParametro->getCodigoParametro(),
            'inapta' => $perguntaParametro->getInapta()

        ]); 
    }

    public function atualizaPerguntaParametro(int $codigoPergunta): void
    {
        $statement = $this->pdo
            ->prepare(' DELETE FROM
                            pergunta_parametro
                        WHERE
                        codigo_pergunta = :codigoPergunta;');
        $statement->bindParam(':codigoPergunta', $codigoPergunta, \PDO::PARAM_STR);
        $statement->execute();
    }

    // public function atualizaPerguntaParametro(PerguntaParametroModel $parametro): void
    // {
    //     $statement = $this->pdo
    //         ->prepare('UPDATE parametro SET
    //                 descricao = :descricao,
    //                 ativo = :ativo
    //             WHERE
    //             codigo = :codigo;');
    //     $statement->execute([
    //         'descricao' => $parametro->getDescricao(),
    //         'ativo' => $parametro->getAtivo(),
    //         'codigo' => $parametro->getCodigo()   
    //     ]);
    // }
}