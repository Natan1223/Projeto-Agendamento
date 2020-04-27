<?php

namespace App\Controllers;

use App\DAO\MySQL\TokensDAO;
use App\DAO\MySQL\UsuariosDAO;
use App\Models\MySQL\TokenModel;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

use Firebase\JWT\JWT;


final class AutenticaController
{   
    public function login(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody();

        $usuario = $data['usuario'];
        $senha = md5($data['senha']);
        // $senha = md5($data['senha']);

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

        $dadoUsuario = [
            'codigoPessoa' => $usuario->getCodigoPessoa(),
            'dataAcesso' => (new \DateTime())->format('d-m-Y H:i:s')
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
            "dadosUsuario" =>$dadoUsuario
        ]);

        return $response;
    }

}