<?php

namespace App\DAO\MySQL;

use App\DAO\MySQL\Conexao;
use App\Models\MySQL\UsuarioModel;

class UsuarioPerfilDAO extends Conexao
{
    public function __construct()
    {
        parent::__construct();
    }

    public function buscaPerfil($usuario): array
    {
        $statement = $this->pdo
            ->prepare(' SELECT DISTINCT
                            m.codigo_menu as codigo,    
                            m.codigo_menu_titulo as codigoTitulo,
                            m.descricao
                        FROM usuario u
                            join usuario_perfil up
                                on u.codigo_usuario = up.codigo_usuario
                            join menu m
                                on up.codigo_perfil = m.codigo_perfil
                                and m.codigo_menu_titulo = 0
                        WHERE usuario = :usuario
            ');
        $statement->bindParam('usuario', $usuario);
        $statement->execute();

        $perfilTitulo = $statement->fetchAll(\PDO::FETCH_ASSOC);
                
        foreach($perfilTitulo as $dataTitulo){
            
            $perfilTitulo = $dataTitulo;
            $perfilMenu = UsuarioPerfilDAO::buscaTiruloPerfil($dataTitulo['codigo']);

            $dataTitulo['menu']= $perfilMenu;
            $perfilTitulo = $dataTitulo;
            $resultado[] = $perfilTitulo;
        }

        return $resultado;
    }

    public function buscaTiruloPerfil($perfil): array
    {
        $statement = $this->pdo
            ->prepare(' SELECT DISTINCT
                            m.descricao,
                            m.path
                        FROM menu m
                        WHERE codigo_menu_titulo = :perfil
            ');
        $statement->bindParam('perfil', $perfil);
        $statement->execute();
        $perfil = $statement->fetchAll(\PDO::FETCH_ASSOC);

        return $perfil;
    }

    public function listaPerfil(): array
    {
        $statement = $this->pdo
            ->prepare(' SELECT DISTINCT
                            p.codigo_perfil as codigoPerfil,
                            p.descricao_perfil as descricaoPerfil
                        FROM perfil p
            ');
        $statement->execute();
        $perfil = $statement->fetchAll(\PDO::FETCH_ASSOC);

        return $perfil;
    }

    public function listaPerfilUsuario($usuario): array
    {
        $statement = $this->pdo
            ->prepare(' SELECT DISTINCT
                            p.codigo_perfil as codigoPerfil,
                            p.descricao_perfil as descricaoPerfil
                        FROM usuario u
                            join usuario_perfil up
                                on u.codigo_usuario = up.codigo_usuario
                            join perfil p
                                on up.codigo_perfil = p.codigo_perfil
                        WHERE u.codigo_usuario = :usuario
            ');
        $statement->bindParam('usuario', $usuario);
        $statement->execute();
        $perfilUsuario = $statement->fetchAll(\PDO::FETCH_ASSOC);

        return $perfilUsuario;
    }

    public function listaUsuarios(): array
    {
        $statement = $this->pdo
            ->prepare(' SELECT DISTINCT
                            f.codigo_funcionario as codigoFucnionario, 
                            f.nome_funcionario as nomeFuncionario,
                            u.usuario,
                            u.codigo_usuario as codigoUsuario
                        FROM funcionario f
                            join usuario u 
                                on f.codigo_funcionario = u.funcionario_codigo_funcionario
            ');
        $statement->execute();
        $perfilUsuario = $statement->fetchAll(\PDO::FETCH_ASSOC);

        return $perfilUsuario;
    }

    public function deleteUsuarioPerfil($codigoUsuario): void
    {
        try{
            $statement = $this->pdo
                ->prepare(' DELETE 
                                FROM usuario_perfil 
                                WHERE 
                                codigo_usuario = :codigoUsuario;');
            $statement->bindParam('codigoUsuario', $codigoUsuario);
            $statement->execute();
        }catch (Exception $e) {
            
        } 
    }

}