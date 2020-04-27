<?php

namespace App\Controllers;

use App\DAO\MySQL\UsuarioPerfilDAO;
use App\DAO\MySQL\UsuariosDAO;
use App\Models\MySQL\UsuarioModel;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

final class UsuarioPerfilController
{
    // public function buscaPerfil($usuario)
    // {

    //     // $usuario = $queryParams['usuario'];

    //     $perfilDAO = new UsuarioPerfilDAO();
    //     $perfilTitulo = $perfilDAO->buscaPerfil($usuario);

                
    //     foreach($perfilTitulo as $dataTitulo){

    //         $perfilMenu = $perfilDAO->buscaTiruloPerfil($dataTitulo['codigo']);
            
    //         foreach($perfilMenu as $dataPerfil){

    //             $dataTitulo['menu'][]= $dataPerfil;
    //         }

    //         $perfilTitulo = $dataTitulo;

    //         $resultado[] = $perfilTitulo;
    //     }
    //     return $resultado;
    // }

    public function listaPerfilUsuario(Request $request, Response $response, array $args): Response
    {
        $usuarioPerfilDAO = new UsuarioPerfilDAO();
        $usuario = $_SESSION['codigoUsuario'];

        $usuarioPerfil = $usuarioPerfilDAO->listaPerfilUsuario($usuario);

        if($usuarioPerfil){
            $response = $response->withjson($usuarioPerfil);
        }else{
            $response = $response->withjson([
                "message" => "Nenhum perfil encontrado para esse usuário"
            ]);
        }
        
        return $response;
    }

    public function listaMenuPrincipal(Request $request, Response $response, array $args): Response
    {
        $usuarioPerfilDAO = new UsuarioPerfilDAO();
        $usuario = $_SESSION['codigoUsuario'];

        $usuarioPerfil = $usuarioPerfilDAO->listaPerfilUsuario($usuario);

        if($usuarioPerfil){
            $response = $response->withjson($usuarioPerfil);
        }else{
            $response = $response->withjson([
                "message" => "Nenhum perfil encontrado para esse usuário"
            ]);
        }
        
        return $response;
    }

    public function listaSubMenuPrincipal(Request $request, Response $response, array $args): Response
    {
        $usuarioPerfilDAO = new UsuarioPerfilDAO();
        $usuario = $_SESSION['codigoUsuario'];

        $usuarioPerfil = $usuarioPerfilDAO->listaPerfilUsuario($usuario);

        if($usuarioPerfil){
            $response = $response->withjson($usuarioPerfil);
        }else{
            $response = $response->withjson([
                "message" => "Nenhum perfil encontrado para esse usuário"
            ]);
        }
        
        return $response;
    }

    public function listaPerfil(Request $request, Response $response, array $args): Response
    {
        $perfilDAO = new UsuarioPerfilDAO();


        $perfil = $perfilDAO->listaPerfil();

        if($perfil){
            $response = $response->withjson($perfil);
        }else{
            $response = $response->withjson([
                "message" => "Nenhum perfil encontrado"
            ]);
        }
        
        return $response;
    }

    public function listaUsuarios(Request $request, Response $response, array $args): Response
    {
        $usuarioPerfilDAO = new UsuarioPerfilDAO();

        $usuario = $usuarioPerfilDAO->listaUsuarios();

        foreach($usuario as $dataUsuario){
            $usuarioPerfil = $usuarioPerfilDAO->listaPerfilUsuario($dataUsuario['codigoUsuario']);

            $dataUsuario['perfil'] = $usuarioPerfil;

            $usuarioPefilDados[] = $dataUsuario;

            if($usuarioPefilDados){
                $response = $response->withjson($usuarioPefilDados);
            }else{
                $response = $response->withjson([
                    "message" => "Nenhum usuário encontrado"
                ]);
            }

        }
        
        return $response;
    }

    public function insereUsuarioPerfil(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody();

        $usuarioPerfilDAO = new UsuariosDAO();
        $usuarioPerfil = new UsuarioPerfilDAO();
        $usuario = new UsuarioModel();

        if($data){

            $usuarioPerfil->deleteUsuarioPerfil($data['codigoUsuario']);

            if($usuario){
                $perfil =  $data['perfil'];

                foreach($perfil as $dataPerfil){
                    $usuarioPerfilDAO->insereUsuarioPerfil($dataPerfil['codigoPerfil'], $data['codigoUsuario']);
                }
                $response = $response->withjson([
                    "message" => "Perfil cadastrado."
                ]);
                
            }else {
                $response = $response->withjson([
                    "message" => "Erro ao cadastrar perfil usuário..."
                ]);
            }
        }

        return $response;
    }


}