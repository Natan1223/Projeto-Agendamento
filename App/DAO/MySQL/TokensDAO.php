<?php

namespace App\DAO\MySQL;

use App\DAO\MySQL\Conexao;
use App\Models\MySQL\TokenModel;

class TokensDAO extends Conexao
{
    public function __construct()
    {
        parent::__construct();
    }

    public function criaToken(TokenModel $token): void
    {
        $statement = $this->pdo
            ->prepare('INSERT INTO token
                (
                    token,
                    codigo_pessoa,
                    refresh_token,
                    data_expira
                )
                VALUES
                (
                    :token,
                    :codigoPessoa,
                    :refresh_token,
                    :data_expira
                )
            ');
        $statement->execute([
            'token' => $token->getToken(),
            'codigoPessoa' => $token->getUsuario_codigo(),
            'refresh_token' => $token->getRefresh_token(),
            'data_expira' => $token->getData_expira()
        ]);
        
    }

    public function consultaToken(int $codigoPessoa): array
    {
        $statement = $this->pdo
            ->prepare('SELECT
                        token
                    FROM token
                    WHERE codigo_pessoa = :codigoPessoa 
                    order by ativo DESC, descricao
            ');
        $statement->bindValue(':codigoPessoa', $codigoPessoa);
        $statement->execute();
        $token = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return $token;
    }
}