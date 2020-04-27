<?php 

namespace App\Models\MySQL;

final class LocalAgendamentoModel
{
    private $codigo;
    private $codigoEmpresa;
    private $descricao;
    private $quantidadeVagas;
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
    public function setCodigo($codigo): LocalAgendamentoModel
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
    public function setDescricao($descricao): LocalAgendamentoModel
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
    public function setAtivo($ativo): LocalAgendamentoModel
    {
        $this->ativo = $ativo;

        return $this;
    }

    /**
     * Get the value of codigoEmpresa
     */ 
    public function getCodigoEmpresa(): int
    {
        return $this->codigoEmpresa;
    }

    /**
     * Set the value of codigoEmpresa
     *
     * @return  self
     */ 
    public function setCodigoEmpresa($codigoEmpresa): LocalAgendamentoModel
    {
        $this->codigoEmpresa = $codigoEmpresa;

        return $this;
    }

    /**
     * Get the value of quantidadeVagas
     */ 
    public function getQuantidadeVagas(): int
    {
        return $this->quantidadeVagas;
    }

    /**
     * Set the value of quantidadeVagas
     *
     * @return  self
     */ 
    public function setQuantidadeVagas($quantidadeVagas): LocalAgendamentoModel
    {
        $this->quantidadeVagas = $quantidadeVagas;

        return $this;
    }
}