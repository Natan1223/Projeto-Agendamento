<?php

namespace App\DAO\MySQL;

use App\Models\MySQL\PessoaModel;
use App\DAO\MySQL\Conexao;

final class PessoaDAO extends Conexao
{
    public function __construct()
    {
        parent::__construct();
    }

    public function buscaPessoas(): array
    {
        $statement = $this->pdo
            ->prepare('SELECT
                        codigo,
                        nome,
                        data_nascimento as dataNascimento,
                        email
                    FROM pessoa 
            ');
        $statement->execute();
        $funcao = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return $funcao;
    }

    public function buscaStatusAcompanhamentoPessoa(int $codigoPessoa): array
    {
        $statement = $this->pdo
            ->prepare(' SELECT
                            sa.codigo,
                            sa.descricao,
                            sa.passou
                        FROM acompanhamento a
                            JOIN status_acompanhamento sa 
                                ON a.status1 = sa.codigo
                        WHERE a.codigo_pessoa = :codigoPessoa
            ');
        $statement->bindValue(':codigoPessoa', $codigoPessoa);
        $statement->execute();
        $funcao = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return $funcao;
    }

    public function verificaEmailPessoaExiste(string $email): array
    {
        $statement = $this->pdo
            ->prepare(' SELECT
                           email
                        FROM pessoa 
                        WHERE email = :email
            ');
        $statement->bindValue(':email', '%'.$email.'%');
        $statement->execute();
        $email = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return $email;
    }

    public function inserePessoa(PessoaModel $pessoa)
    {

        $statement = $this->pdo
            ->prepare('INSERT INTO pessoa VALUES (
                null,
                :nome,
                :email,
                :dataNascimento   
            );');
        $statement->execute([
            'nome'=>$pessoa->getNome(),
            'email'=>$pessoa->getEmail(),
            'dataNascimento'=>$pessoa->getDataNacimento()
        ]); 

        $codigoPessoaCad =  $this->pdo->lastInsertId();
            
        return $codigoPessoaCad;
    }

    // public function atualizaProfissao(ProfissaoModel $profissao): void
    // {
    //     $statement = $this->pdo
    //         ->prepare('UPDATE profissao SET
    //                 descricao = :descricao,
    //                 ativo = :ativo
    //             WHERE
    //             codigo = :codigo;');
    //     $statement->execute([
    //         'descricao' => $profissao->getDescricao(),
    //         'ativo' => $profissao->getAtivo(),
    //         'codigo' => $profissao->getCodigo()   
    //     ]);
    // }
}