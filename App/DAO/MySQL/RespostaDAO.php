<?php

namespace App\DAO\MySQL;

use App\Models\MySQL\RespostaModel;
use App\DAO\MySQL\Conexao;

final class RespostaDAO extends Conexao
{
    public function __construct()
    {
        parent::__construct();
    }

    public function buscaPessoaRespostas(): array
    {
        $statement = $this->pdo
            ->prepare(' SELECT DISTINCT
                            p.codigo,
                            p.nome,
                            p.data_nascimento
                        FROM resposta r
                            JOIN pessoa p 
                            ON r.codigo_pessoa = p.codigo
            ');
        $statement->execute();
        $funcao = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return $funcao;
    }

    public function buscaPessoaRespostaPergunta(int $codigoPessoa): array
    {
        $statement = $this->pdo
            ->prepare(' SELECT DISTINCT
                            pg.codigo,
                            pg.descricao
                        FROM resposta r                      
                            JOIN pergunta pg 
                            ON r.codigo_pergunta = pg.codigo
                            and r.codigo_pessoa = :codigoPessoa
            ');
        $statement->bindValue(':codigoPessoa', $codigoPessoa);
        $statement->execute();
        $funcao = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return $funcao;
    }

    public function buscaPessoaRespostaPerguntaParamentro(int $codigoPessoa, int $codigoPergunta): array
    {
        $statement = $this->pdo
            ->prepare(' SELECT 
                            pm1.descricao as escolhaUnica, 
                            pm2.descricao as escolhaMultipla, 
                            r.texto, 
                            r.numero, 
                            r.data, 
                            r.arquivo
                        FROM resposta r                            
                            LEFT JOIN parametro pm1
                            ON r.escolha_unica = pm1.codigo
                            
                            LEFT JOIN parametro pm2
                            ON r.escolha_multipla = pm2.codigo
                        WHERE r.codigo_pessoa = :codigoPessoa
                        and r.codigo_pergunta = :codigoPergunta
            ');
        $statement->bindValue(':codigoPessoa', $codigoPessoa);
        $statement->bindValue(':codigoPergunta', $codigoPergunta);
        $statement->execute();
        $funcao = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return $funcao;
    }

    public function buscaResposta(string $descricao): array
    {
        $statement = $this->pdo
            ->prepare('SELECT
                        codigo,
                        descricao,
                        ativo
                    FROM resposta
                    WHERE descricao = :descricao 
                    order by ativo DESC, descricao
            ');
        $statement->bindValue(':descricao', '%'.$descricao.'%');
        $statement->execute();
        $funcao = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return $funcao;
    }

    public function insereResposta(RespostaModel $resposta): void
    {

        $statement = $this->pdo
            ->prepare('INSERT INTO resposta VALUES (
                null,
                :codigoPessoa,
                :codigoPergunta,
                :escolhaUnica,
                :escolhaMultipla,
                :texto,
                :numero,
                :data,
                :arquivo  
            );');
        $statement->execute([
            "codigoPessoa" =>$resposta->getCodigoPessoa(),
            "codigoPergunta" =>$resposta->getCodigoPergunta(),
            "escolhaUnica" =>$resposta->getEscolhaUnica(),
            "escolhaMultipla" =>$resposta->getEscolhaMultipla() ,
            "texto" =>$resposta->getTexto(),
            "numero" =>$resposta->getNumero(),
            "data" =>$resposta->getData(),
            "arquivo" =>$resposta->getArquivo()
        ]); 
    }

    public function atualizaResposta(RespostaModel $resposta): void
    {
        $statement = $this->pdo
            ->prepare('UPDATE resposta SET
                    descricao = :descricao,
                    ativo = :ativo
                WHERE
                codigo = :codigo;');
        $statement->execute([
            'descricao' => $resposta->getDescricao(),
            'ativo' => $resposta->getAtivo(),
            'codigo' => $resposta->getCodigo()   
        ]);
    }
}