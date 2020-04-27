<?php

namespace App\Models\MySQL;

final class UsuarioModel
{ 
    private $codigoPessoa;
    private $usuario;
    private $senha;
    private $ativo;


    /**
     * Get the value of codigoPessoa
     */ 
    public function getCodigoPessoa(): int
    {
        return $this->codigoPessoa;
    }

    /**
     * Set the value of codigoPessoa
     *
     * @return  self
     */ 
    public function setCodigoPessoa($codigoPessoa): UsuarioModel
    {
        $this->codigoPessoa = $codigoPessoa;

        return $this;
    }

    /**
     * Get the value of usuario
     */ 
    public function getUsuario(): string
    {
        return $this->usuario;
    }

    /**
     * Set the value of usuario
     *
     * @return  self
     */ 
    public function setUsuario($usuario): UsuarioModel
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get the value of senha
     */ 
    public function getSenha(): string
    {
        return $this->senha;
    }

    /**
     * Set the value of senha
     *
     * @return  self
     */ 
    public function setSenha($senha): UsuarioModel
    {
        $this->senha = $senha;

        return $this;
    }

    /**
     * Get the value of ativo
     */ 
    public function getAtivo(): string
    {
        return $this->ativo;
    }

    /**
     * Set the value of ativo
     *
     * @return  self
     */ 
    public function setAtivo($ativo): UsuarioModel
    {
        $this->ativo = $ativo;

        return $this;
    }
}