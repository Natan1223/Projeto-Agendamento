<?php

namespace App\DAO\MySQL;

use App\Models\MySQL\LocalAgendamentoModel;
use App\DAO\MySQL\Conexao;

final class LocalAgendamentoDAO extends Conexao
{
    public function __construct()
    {
        parent::__construct();
    }

    public function buscaLocalAgendamentos(int $codigoEmpresa): array
    {
        $statement = $this->pdo
            ->prepare('SELECT
                        codigo,
                        descricao,
                        quantidade_vagas,
                        ativo
                    FROM local_agendamento
                    WHERE codigo_empresa = :codigoEmpresa
                    order by ativo DESC, descricao
            ');
        $statement->bindValue(':codigoEmpresa', $codigoEmpresa);
        $statement->execute();
        $local = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return $local;
    }

    public function insereLocalAgendamento(LocalAgendamentoModel $local)
    {

        $statement = $this->pdo
            ->prepare('INSERT INTO parametro VALUES (
                null,
                :codigoEmpresa,
                :descricao,
                :quantidadeVagas,
                :ativo   
            );');
        $statement->execute([
            'codigoEmpresa'=>$local->getCodigoEmpresa(),
            'descricao'=>$local->getDescricao(),
            'quantidadeVagas'=>$local->getQuantidadeVagas(),
            'ativo'=>$local->getAtivo()
        ]); 

        $codigoLocalAgendaemnto =  $this->pdo->lastInsertId();

        return $codigoLocalAgendaemnto;
    }

    public function atualizaLocalAgendamento(LocalAgendamentoModel $local): void
    {
        $statement = $this->pdo
            ->prepare('UPDATE local_agendamento SET
                    descricao = :descricao,
                    quantidade_vagas = :quantidadeVagas
                    ativo = :ativo
                WHERE
                codigo = :codigo;');
        $statement->execute([
            'descricao' => $local->getDescricao(),
            'quantidadeVagas'=>$local->getQuantidadeVagas(),
            'ativo' => $local->getAtivo(),
            'codigo' => $local->getCodigo()   
        ]);
    }
}