<?php 

namespace App\Controllers;

use App\DAO\MySQL\UsuariosDAO;
use App\Models\MySQL\UsuarioModel;
use Firebase\JWT\JWT;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class UsuarioController
{

    // public function consultaUsuarioCPF(Request $request, Response $response, array $args): Response
    // {
    //     $queryParams = $request->getQueryParams();

    //     $usuarioDAO = new UsuariosDAO();
    //     $cpf = $queryParams['cpf'];

    //     $verifica = $usuarioDAO->consultaUsuarioCPF($cpf);

    //     if($verifica){
    //         $response = $response->withjson($verifica);
    //     }else{
    //         $response = $response->withjson([
    //             "message" => "Usuario nao pode ser cadastrado."
    //         ]);
    //     }
        

    //     return $response;
    // }

    // public function consultaUsuarioCPFReset(Request $request, Response $response, array $args): Response
    // {
    //     $queryParams = $request->getQueryParams();

    //     $usuarioDAO = new UsuariosDAO();
    //     $cpf = $queryParams['cpf'];
        

    //     $verifica = $usuarioDAO->consultaUsuarioCPFReset($cpf);

    //     if($verifica){
    //         $response = $response->withjson($verifica);
    //     }else{
    //         $response = $response->withjson([
    //             "message" => "Usuario não cadastrado."
    //         ]);
    //     }
    

    //     return $response;
    // }

    public function insereUsuario(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody();

        $usuarioDAO = new UsuariosDAO();
        $usuario = new UsuarioModel();

        if($teste = 0){
            $usuario
            ->setCodigoFuncionario((int)$data['codigoFuncionario'])
            ->setUsuario((string)$data['usuario'])
            ->setSenha(md5($data['senha']))
            ->setStatus((string)$data['status']);

            $codigoUsuarioCadastrado = $usuarioDAO->insereUsuario($usuario); 
            
            if($codigoUsuarioCadastrado){
                $usuarioDAO->insereUsuarioPerfil($perfil, $codigoUsuarioCadastrado);
                $response = $response->withjson([
                    "message" => "Usuario cadastrado com sucesso..."
                ]);
            }else {
                $response = $response->withjson([
                    "message" => "Erro ao cadastrar usuário..."
                ]);
            }

        }else {
            $response = $response->withjson([
                "message" => "Token invalido."
            ]);
        }

        return $response;
    }

    // public function atualizaSenhaUsuario(Request $request, Response $response, array $args): Response
    // {
    //     $data = $request->getParsedBody();

    //     $usuarioDAO = new UsuariosDAO();
    //     $usuario = new UsuarioModel();

    //     $senha = md5($data['senha']);

    //     $token = $data['token'];
    //     $tokenDecoded = JWT::decode($token, 'O Senhor é meu pastor', array('HS256'));

    //     $expireDate = date_format(new \DateTime($tokenDecoded->dataExpira), 'Y-m-d H:i:s');
    //     $now = new \DateTime();
    //     $now = date_format($now, 'Y-m-d H:i:s');



    //     if($expireDate > $now && $tokenDecoded->cpf == $data['cpf']){
    //         $usuario
    //         ->setCodigoFuncionario((int)$data['codigoFuncionario'])
    //         ->setUsuario((string)$data['usuario'])
    //         ->setSenha((string)$senha);

    //         $usuarioDAO->atualizaSenhaUsuario($usuario);
    //         $response = $response->withjson([
    //             "message" => "senha atualizada com sucesso..."
    //         ]);

    //     }else {
    //         $response = $response->withjson([
    //             "message" => "Token invalido."
    //         ]);
    //     }

    //     return $response;
    // }

    
}