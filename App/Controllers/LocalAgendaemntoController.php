<?php 

namespace App\Controllers;

use App\DAO\MySQL\LocalAgendamentoDAO;
use App\Models\MySQL\LocalAgendamentoModel;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class LocalAgendamentoController
{
    public function buscaLocalAgendamentos(Request $request, Response $response, array $args): Response
    {
        $queryParams = $request->getQueryParams();
        $codigoEmpresa = $queryParams['codigoEmpresa'];

        $localAgendamentoDAO = new LocalAgendamentoDAO();
        $localAgendamento = $localAgendamentoDAO->buscaLocalAgendamentos($codigoEmpresa);

        $response = $response->withjson($localAgendamento);

        return $response;
    }

    public function insereLocalAgendamento(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody();

        $localAgendamentoDAO = new LocalAgendamentoDAO();
        $localAgendamento = new LocalAgendamentoModel();

        $localAgendamento
            ->setCodigoEmpresa($data['codigoEmpresa'])
            ->setDescricao((string)$data['descricao'])
            ->setQuantidadeVagas($data['quantidadeVagas'])
            ->setAtivo((string)$data['ativo']);
        
        $codigoLocalAgendaemnto = $localAgendamentoDAO->insereLocalAgendamento($localAgendamento);  
        
        if($codigoLocalAgendaemnto){

        }
        
        $response = $response->withjson([
            "message" => "Cadastro realizado"
        ]);

        return $response;
    }

    // public function atualizaLocalAgendamento(Request $request, Response $response, array $args): Response
    // {
    //     $data = $request->getParsedBody();

    //     $localAgendamentoDAO = new LocalAgendamentoDAO();
    //     $localAgendamento = new LocalAgendamentoModel();

    //     $localAgendamento
    //         ->setCodigo((int)$data['codigo'])
    //         ->setDescricao((string)$data['descricao'])
    //         ->setAtivo((string)$data['ativo']);

    //     $localAgendamentoDAO->atualizaLocalAgendamento($localAgendamento);           
        
    //     $response = $response->withjson([
    //         "message" => "Registro Atualizado"
    //     ]);

    //     return $response;
    // }

}