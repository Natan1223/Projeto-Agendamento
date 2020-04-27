<?php 

namespace App\Controllers;

use App\DAO\MySQL\ParametroDAO;
use App\Models\MySQL\ParametroModel;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class ParametroController
{
    public function buscaParametros(Request $request, Response $response, array $args): Response
    {
        $parametroDAO = new ParametroDAO();
        $parametro = $parametroDAO->buscaParametros();

        $response = $response->withjson($parametro);

        return $response;
    }

    public function buscaParametro(Request $request, Response $response, array $args): Response
    {
        $queryParams = $request->getQueryParams();
        $descricao = $queryParams['descricao'];
        
        $parametroDAO = new ParametroDAO();
        $parametro = $parametroDAO->buscaParametro($descricao);

        $response = $response->withjson($parametro);

        return $response;
    }

    public function insereParametro(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody();

        $parametroDAO = new ParametroDAO();
        $parametro = new ParametroModel();

        $parametro->setDescricao((string)$data['descricao'])
                ->setAtivo((string)$data['ativo']);
        
        $parametroDAO->insereParametro($parametro);           
        
        $response = $response->withjson([
            "message" => "Cadastro realizado"
        ]);

        return $response;
    }

    public function atualizaParametro(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody();

        $parametroDAO = new ParametroDAO();
        $parametro = new ParametroModel();

        $parametro
            ->setCodigo((int)$data['codigo'])
            ->setDescricao((string)$data['descricao'])
            ->setAtivo((string)$data['ativo']);

        $parametroDAO->atualizaParametro($parametro);           
        
        $response = $response->withjson([
            "message" => "Registro Atualizado"
        ]);

        return $response;
    }

}