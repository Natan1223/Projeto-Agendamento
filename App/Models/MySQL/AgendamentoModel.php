<?php 

namespace App\Models\MySQL;

final class AgendamentoModel
{
    private $codigo;
    private $codigoPesssoa;
    private $codigoLocalAgendamento;
    private $data;
    private $hora;
    private $status;

    

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
    public function setCodigo($codigo): AgendamentoModel
    {
        $this->codigo = $codigo;

        return $this;
    }

    

    /**
     * Get the value of codigoPesssoa
     */ 
    public function getCodigoPesssoa(): int
    {
        return $this->codigoPesssoa;
    }

    /**
     * Set the value of codigoPesssoa
     *
     * @return  self
     */ 
    public function setCodigoPesssoa($codigoPesssoa): AgendamentoModel
    {
        $this->codigoPesssoa = $codigoPesssoa;

        return $this;
    }

    /**
     * Get the value of codigoLocalAgendamento
     */ 
    public function getCodigoLocalAgendamento(): int
    {
        return $this->codigoLocalAgendamento;
    }

    /**
     * Set the value of codigoLocalAgendamento
     *
     * @return  self
     */ 
    public function setCodigoLocalAgendamento($codigoLocalAgendamento): AgendamentoModel
    {
        $this->codigoLocalAgendamento = $codigoLocalAgendamento;

        return $this;
    }

    /**
     * Get the value of data
     */ 
    public function getData(): string
    {
        return $this->data;
    }

    /**
     * Set the value of data
     *
     * @return  self
     */ 
    public function setData($data): AgendamentoModel
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get the value of hora
     */ 
    public function getHora(): string
    {
        return $this->hora;
    }

    /**
     * Set the value of hora
     *
     * @return  self
     */ 
    public function setHora($hora): AgendamentoModel
    {
        $this->hora = $hora;

        return $this;
    }

    /**
     * Get the value of status
     */ 
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */ 
    public function setStatus($status): AgendamentoModel
    {
        $this->status = $status;

        return $this;
    }
}