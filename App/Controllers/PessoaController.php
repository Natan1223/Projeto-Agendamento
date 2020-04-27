<?php 

namespace App\Controllers;

use App\DAO\MySQL\PessoaDAO;
use App\DAO\MySQL\UsuariosDAO;
use App\Models\MySQL\PessoaModel;
use App\Models\MySQL\UsuarioModel;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\Models\MySQL\TokenModel;
use App\DAO\MySQL\TokensDAO;
use App\Controllers\EmailPessoaController;

use Firebase\JWT\JWT;

class PessoaController
{
    public function buscaPessoas(Request $request, Response $response, array $args): Response
    {
        $pessoaDAO = new PessoaDAO();
        $pessoa = $pessoaDAO->buscaPessoas();

        $response = $response->withjson($pessoa);

        return $response;
    }

    public function buscaStatusAcompanhamentoPessoa(Request $request, Response $response, array $args): Response
    {
        $queryParams = $request->getQueryParams();
        $codigoPessoa = $queryParams['codigoPessoa'];
        
        $pessoaDAO = new PessoaDAO();
        $pessoa = $pessoaDAO->buscaStatusAcompanhamentoPessoa($codigoPessoa);

        $response = $response->withjson($pessoa);

        return $response;
    }

    public function inserePessoa(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody();

        $pessoaDAO = new PessoaDAO();
        $pessoa = new PessoaModel();

        $usuarioDAO = new UsuariosDAO();
        $usuario = new UsuarioModel();

        $enviaEmail = new EmailPessoaController();
        $emailDestinatario = $data['email'];
        $senhaEmail = $data['senha'];

        $verificaEmailExiste = $pessoaDAO->verificaEmailPessoaExiste($data['email']);
        
        // if($verificaEmailExiste ==''){
        
            $pessoa
                ->setNome((string)$data['nome'])
                ->setDataNacimento((string)$data['dataNascimento'])
                ->setEmail((string)$data['email']);
            
            $codigoPessoaCad = $pessoaDAO->inserePessoa($pessoa);           

            if($codigoPessoaCad){

                $usuario
                    ->setCodigoPessoa($codigoPessoaCad)
                    ->setUsuario((string)$data['email'])
                    ->setSenha(md5($data['senha']));

                $usuarioDAO->insereUsuario($usuario);

                $usuario = $data['email'];
                $senha = md5($data['senha']);

                $usuarioDAO = new UsuariosDAO();
                $usuario = $usuarioDAO->getUsuario($usuario);

                if(is_null($usuario))
                    return $response->withJson([
                                        "menssagem" => 'Usuario Invalido.'
                                    ])
                                    ->withStatus(401);

                if($senha <> $usuario->getSenha())
                    return $response->withJson([
                                        "menssagem" => 'Senha Invalida.'
                                    ])
                                    ->withStatus(401);

                $data_expeira = (new \DateTime())->modify('+8 hour')->format('Y-m-d H:i:s');

                $tokenCarrega = [
                    'sub' =>$usuario->getCodigoPessoa(),
                    'usuario' => $usuario->getUsuario(),
                    'codigoPessoa' =>$usuario->getCodigoPessoa(),
                    'data_expira' => $data_expeira
                ];

                $token = JWT::encode($tokenCarrega,getenv('JWT_SECRET_KEY'));

                $refreshToken = [
                    'usuario' => $usuario->getUsuario()
                ];

                $refreshToken = JWT::encode($refreshToken, getenv('JWT_SECRET_KEY'));

                $tokenModel = new TokenModel();
                $tokenModel->setToken($token)
                        ->setRefresh_token($refreshToken)
                        ->setData_expira($data_expeira)
                        ->setUsuario_codigo($usuario->getCodigoPessoa());

                $tokenDAO = new TokensDAO();
                $tokenDAO->criaToken($tokenModel);

                $response = $response->withJson([
                    "token" => $token,
                    "refresh_token" => $refreshToken,
                    "codigoPessoa"=> $codigoPessoaCad
                ]);

                $enviaEmail->enviaEmail($emailDestinatario, $senhaEmail);

                $response->withJson([
                    "menssagem" => 'Cadastro realizado.'
                ]);

            }
        // }else{
        //     $response->withJson([
        //         "menssagem" => 'E-mail ja cadastrado.'
        //     ]);
        // }
        

        return $response;
    }



}