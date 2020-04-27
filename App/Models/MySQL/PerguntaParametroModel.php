<?php 

namespace App\Models\MySQL;

final class PerguntaParametroModel
{
    private $codigoPrgunta;
    private $codigoTipoPergunta;
    private $codigoParametro;
    private $inapta;

    /**
     * Get the value of codigoPrgunta
     */ 
    public function getCodigoPrgunta(): int
    {
        return $this->codigoPrgunta;
    }

    /**
     * Set the value of codigoPrgunta
     *
     * @return  self
     */ 
    public function setCodigoPrgunta($codigoPrgunta): PerguntaParametroModel
    {
        $this->codigoPrgunta = $codigoPrgunta;

        return $this;
    }

    /**
     * Get the value of codigoTipoPergunta
     */ 
    public function getCodigoTipoPergunta(): int
    {
        return $this->codigoTipoPergunta;
    }

    /**
     * Set the value of codigoTipoPergunta
     *
     * @return  self
     */ 
    public function setCodigoTipoPergunta($codigoTipoPergunta): PerguntaParametroModel
    {
        $this->codigoTipoPergunta = $codigoTipoPergunta;

        return $this;
    }

    /**
     * Get the value of codigoParametro
     */ 
    public function getCodigoParametro(): int
    {
        return $this->codigoParametro;
    }

    /**
     * Set the value of codigoParametro
     *
     * @return  self
     */ 
    public function setCodigoParametro($codigoParametro): PerguntaParametroModel
    {
        $this->codigoParametro = $codigoParametro;

        return $this;
    }

    /**
     * Get the value of inapta
     */ 
    public function getInapta(): string
    {
        return $this->inapta;
    }

    /**
     * Set the value of inapta
     *
     * @return  self
     */ 
    public function setInapta($inapta): PerguntaParametroModel
    {
        $this->inapta = $inapta;

        return $this;
    }
}