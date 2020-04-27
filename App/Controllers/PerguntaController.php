<?php 

namespace App\Controllers;

use App\DAO\MySQL\PerguntaDAO;
use App\Models\MySQL\PerguntaModel;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class PerguntaController
{
    public function buscaPerguntas(Request $request, Response $response, array $args): Response
    {
        $perguntaDAO = new PerguntaDAO();
        $pergunta = $perguntaDAO->buscaPerguntas();

        $response = $response->withjson($pergunta);

        return $response;
    }

    public function buscaPergunta(Request $request, Response $response, array $args): Response
    {
        $queryParams = $request->getQueryParams();
        $descricao = $queryParams['descricao'];
        
        $perguntaDAO = new PerguntaDAO();
        $pergunta = $perguntaDAO->buscaPergunta($descricao);

        $response = $response->withjson($pergunta);

        return $response;
    }

    public function inserePergunta(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody();

        $perguntaDAO = new PerguntaDAO();
        $pergunta = new PerguntaModel();

        $pergunta->setDescricao((string)$data['descricao'])
                ->setAtivo((string)$data['ativo']);
        
        $perguntaDAO->inserePergunta($pergunta);           
        
        $response = $response->withjson([
            "message" => "Cadastro realizado"
        ]);

        return $response;
    }

    public function atualizaPergunta(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody();

        $perguntaDAO = new PerguntaDAO();
        $pergunta = new PerguntaModel();

        $pergunta
            ->setCodigo((int)$data['codigo'])
            ->setDescricao((string)$data['descricao'])
            ->setAtivo((string)$data['ativo']);

        $perguntaDAO->atualizaPergunta($pergunta);           
        
        $response = $response->withjson([
            "message" => "Registro Atualizado"
        ]);

        return $response;
    }

}