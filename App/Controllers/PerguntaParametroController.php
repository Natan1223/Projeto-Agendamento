<?php 

namespace App\Controllers;

use App\DAO\MySQL\PerguntaParametroDAO;
use App\Models\MySQL\PerguntaParametroModel;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class PerguntaParametroController
{
    public function buscaPerguntaParametros(Request $request, Response $response, array $args): Response
    {
        $perguntaParametroDAO = new PerguntaParametroDAO();
        $perguntaParametro = $perguntaParametroDAO->buscaPerguntaParametros();

        foreach($perguntaParametro as $data){
            $perguntaParametro= $data;

            $perguntaTipoPergunta = $perguntaParametroDAO->buscaPerguntaTipoPergunta($data['codigo']);

            foreach($perguntaTipoPergunta as $dataTipoPergunta){
                $perguntaTipoPerguntaParametro = $perguntaParametroDAO->buscaPerguntaTipoPerguntaParametro($data['codigo'],$dataTipoPergunta['codigo']);
                $dataTipoPergunta['parametros'] = $perguntaTipoPerguntaParametro;

                $PerguntaTipoParametroBD = $dataTipoPergunta;
                $data['tipoPergunta']= $PerguntaTipoParametroBD;

            }

            $perguntaParametro= $data;
            $resultado['perguntas'][] = $perguntaParametro; 

        }

        $response = $response->withjson($resultado);

        return $response;
    }


    public function inserePerguntaParametro(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody();

        $perguntaParametroDAO = new PerguntaParametroDAO();
        $perguntaParametro = new PerguntaParametroModel();


        $tipoPergunta = $data['tipoPergunta'];
        $parametros = $tipoPergunta['parametros'];

        foreach($parametros as $dataParametros){
            $parametro = $dataParametros;

            $perguntaParametro
                ->setCodigoPrgunta($data['codigo'])
                ->setCodigoTipoPergunta($tipoPergunta['codigo'])
                ->setCodigoParametro($parametro['codigo'])
                ->setInapta($parametro['inapta']);

            $perguntaParametroDAO->inserePerguntaParametro($perguntaParametro);
        }
                  
        

        $response = $response->withjson([
            "message" => "Cadastro realizado com sucesso"
        ]);

        return $response;
    }

    public function atualizaPerguntaParametro(Request $request, Response $response, array $args): Response
    {
        $data = $request->getQueryParams();

        $perguntaParametroDAO = new PerguntaParametroDAO();
        $perguntaParametro = new PerguntaParametroModel();

        $perguntaParametro = $data['codigoPergunta'];

        $perguntaParametroDAO->atualizaPerguntaParametro($perguntaParametro);           
        
        $response = $response->withjson([
            "message" => "Alterado com sucesso"
        ]);

        return $response;
    }

}