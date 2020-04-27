<?php 

namespace App\Models\MySQL;

final class TipoPerguntaModel
{
    private $codigo;
    private $descricao;
    private $ativo;
    

    /**
     * Get the value of codigo
     */ 
    public function getCodigo(): int
    {
        return $this->codigo;
    }

    /**
     * Set the value of codigo
     *
     * @return  self
     */ 
    public function setCodigo($codigo): TipoPerguntaModel
    {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * Get the value of descricao
     */ 
    public function getDescricao(): string
    {
        return $this->descricao;
    }

    /**
     * Set the value of descricao
     *
     * @return  self
     */ 
    public function setDescricao($descricao): TipoPerguntaModel
    {
        $this->descricao = $descricao;

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
    public function setAtivo($ativo): TipoPerguntaModel
    {
        $this->ativo = $ativo;

        return $this;
    }
}