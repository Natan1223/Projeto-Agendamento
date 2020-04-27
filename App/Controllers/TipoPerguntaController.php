<?php 

namespace App\Controllers;

use App\DAO\MySQL\TipoPerguntaDAO;
use App\Models\MySQL\TipoPerguntaModel;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class TipoPerguntaController
{
    public function buscaTipoPerguntas(Request $request, Response $response, array $args): Response
    {
        $tipoPerguntaDAO = new TipoPerguntaDAO();
        $tipoPergunta = $tipoPerguntaDAO->buscaTipoPerguntas();

        $response = $response->withjson($tipoPergunta);

        return $response;
    }

    public function buscaTipoPergunta(Request $request, Response $response, array $args): Response
    {
        $queryParams = $request->getQueryParams();
        $descricao = $queryParams['descricao'];
        
        $tipoPerguntaDAO = new TipoPerguntaDAO();
        $tipoPergunta = $tipoPerguntaDAO->buscaTipoPergunta($descricao);

        $response = $response->withjson($tipoPergunta);

        return $response;
    }

    public function insereTipoPergunta(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody();

        $tipoPerguntaDAO = new TipoPerguntaDAO();
        $tipoPergunta = new TipoPerguntaModel();

        $tipoPergunta->setDescricao((string)$data['descricao'])
                ->setAtivo((string)$data['ativo']);
        
        $tipoPerguntaDAO->insereTipoPergunta($tipoPergunta);           
        
        $response = $response->withjson([
            "message" => "Cadastro realizado"
        ]);

        return $response;
    }

    public function atualizaTipoPergunta(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody();

        $tipoPerguntaDAO = new TipoPerguntaDAO();
        $tipoPergunta = new TipoPerguntaModel();

        $tipoPergunta
            ->setCodigo((int)$data['codigo'])
            ->setDescricao((string)$data['descricao'])
            ->setAtivo((string)$data['ativo']);

        $tipoPerguntaDAO->atualizaTipoPergunta($tipoPergunta);           
        
        $response = $response->withjson([
            "message" => "Registro Atualizado"
        ]);

        return $response;
    }

}