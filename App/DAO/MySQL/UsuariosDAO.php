<?php

namespace App\DAO\MySQL;

use App\DAO\MySQL\Conexao;
use App\Models\MySQL\UsuarioModel;

class UsuariosDAO extends Conexao
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getUsuario(string $usuario): ?UsuarioModel
    {
        $statement = $this->pdo
            ->prepare(' SELECT 
                            u.codigo_pessoa as codigo,
                            u.usuario,
                            u.senha,
                            p.codigo as codigoPessoa,
                            u.ativo
                        FROM usuario u
                            join pessoa p
                                on u.codigo_pessoa = p.codigo
                        WHERE u.usuario = :usuario
            ');
        $statement->bindParam('usuario', $usuario);
        $statement->execute();
        $usuarios = $statement->fetchAll(\PDO::FETCH_ASSOC);

        if(count($usuarios) === 0)
            return null;
        
        $usuario = new UsuarioModel();
        $usuario->setUsuario($usuarios[0]['usuario'])
                ->setSenha($usuarios[0]['senha'])
                ->setCodigoPessoa($usuarios[0]['codigoPessoa'])
                ->setAtivo($usuarios[0]['ativo']);

        return $usuario;
    }

    public function insereUsuario(UsuarioModel $usuario): void
    {
        $statement = $this->pdo
            ->prepare('INSERT INTO usuario VALUES (
                :codigoPessoa,
                :usuario,
                :senha,
                :ativo
            );');
        $statement->execute([
            "codigoPessoa" => $usuario->getCodigoPessoa(),
            "usuario" => $usuario->getUsuario(),
            "senha" => $usuario->getSenha(),
            "ativo" => 'T'
        ]); 
    }


    
}