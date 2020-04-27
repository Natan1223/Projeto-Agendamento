<?php 

namespace App\Controllers;

use App\DAO\MySQL\RespostaDAO;
use App\Models\MySQL\RespostaModel;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

use Psr\Http\UploadedFile;

class RespostaController
{
    public function buscaRespostas(Request $request, Response $response, array $args): Response
    {
        $respostaDAO = new RespostaDAO();
        $resposta = $respostaDAO->buscaPessoaRespostas();

        foreach($resposta as $data){
            $resposta= $data;

            $respostaPergunta= $respostaDAO->buscaPessoaRespostaPergunta($data['codigo']);

            foreach($respostaPergunta as $datarespostaPergunta){
                $perguntaTipoResposta = $respostaDAO->buscaPessoaRespostaPerguntaParamentro($data['codigo'],$datarespostaPergunta['codigo']);
                
                $datarespostaPergunta['parametros'] = $perguntaTipoResposta;
                $PerguntaTipoParametroBD = $datarespostaPergunta;

                $data['pergunta'][] = $PerguntaTipoParametroBD;

            }

            $resposta= $data;
            $resultado['respostas'][] = $resposta; 

        }

        $response = $response->withjson($resultado);

        return $response;
    }

    public function insereResposta(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody();

        $imagem = $request->getUploadedFiles();

        $respostaDAO = new RespostaDAO();
        $resposta = new RespostaModel();

        $respostas = $data['respostas'];

        $pergunta = $respostas['perguntas'];
    
        foreach($pergunta as $dataPergunta){
            $parametros = $dataPergunta['parametros'];

            foreach($parametros as $dataParametros){
                $parametro = $dataParametros;

                $resposta
                    ->setCodigoPessoa($respostas['codigoPessoa'])
                    ->setCodigoPergunta($dataPergunta['codigo'])
                    ->setEscolhaUnica($parametro['escolhaUnica'])
                    ->setEscolhaMultipla($parametro['escolhaMultipla'])
                    ->setTexto($parametro['texto'])
                    ->setNumero($parametro['numero'])
                    ->setData($parametro['data'])
                    ->setArquivo($parametro['arquivo']);

                    // var_dump($resposta);
                
                $respostaDAO->insereResposta($resposta);
            }

        }

        $response = $response->withjson([
            "message" => "Cadastro realizado"
        ]);

        return $response;
    }

    public function insereRespostaImagem(Request $request, Response $response, array $args): Response
    {

        $imagem = $request->getUploadedFiles();

        $pasta = "./arquivos/";
                    
        if (!file_exists($pasta)){
            mkdir("$pasta", 0777);
        }

        $novoArquivo = $imagem['imagem'];

        $nomeArquivo = $novoArquivo->getClientFilename();
        $arquivo[] = $imagem['imagem'];

        $diretorio = "./arquivos/";

        $destino = $diretorio."/".$nomeArquivo;
        if(move_uploaded_file($arquivo[0]->file, $destino)){
            $response = $response->withjson([
                "message" => "Cadastro realizado"
            ]);
        }else{
            $response = $response->withjson([
                "message" => "Falha ao carregar arquivo"
            ]);
        }
    
        return $response;
    }

}