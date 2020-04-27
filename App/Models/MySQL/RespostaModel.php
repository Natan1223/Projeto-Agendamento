<?php 

namespace App\Models\MySQL;

final class RespostaModel
{
    private $codigo;
    private $codigoPessoa;
    private $codigoPergunta;
    private $escolhaUnica;
    private $escolhaMultipla;
    private $texto;
    private $numero;
    private $data;
    private $arquivo;
    
    

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
    public function setCodigo($codigo): RespostaModel
    {
        $this->codigo = $codigo;

        return $this;
    }

    
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
    public function setCodigoPessoa($codigoPessoa): RespostaModel
    {
        $this->codigoPessoa = $codigoPessoa;

        return $this;
    }

    /**
     * Get the value of codigoPergunta
     */ 
    public function getCodigoPergunta(): int
    {
        return $this->codigoPergunta;
    }

    /**
     * Set the value of codigoPergunta
     *
     * @return  self
     */ 
    public function setCodigoPergunta($codigoPergunta): RespostaModel
    {
        $this->codigoPergunta = $codigoPergunta;

        return $this;
    }

    /**
     * Get the value of escolhaUnica
     */ 
    public function getEscolhaUnica()
    {
        return $this->escolhaUnica;
    }

    /**
     * Set the value of escolhaUnica
     *
     * @return  self
     */ 
    public function setEscolhaUnica($escolhaUnica): RespostaModel
    {
        $this->escolhaUnica = $escolhaUnica;

        return $this;
    }

    /**
     * Get the value of escolhaMultipla
     */ 
    public function getEscolhaMultipla()
    {
        return $this->escolhaMultipla;
    }

    /**
     * Set the value of escolhaMultipla
     *
     * @return  self
     */ 
    public function setEscolhaMultipla($escolhaMultipla): RespostaModel
    {
        $this->escolhaMultipla = $escolhaMultipla;

        return $this;
    }

    /**
     * Get the value of texto
     */ 
    public function getTexto()
    {
        return $this->texto;
    }

    /**
     * Set the value of texto
     *
     * @return  self
     */ 
    public function setTexto($texto): RespostaModel
    {
        $this->texto = $texto;

        return $this;
    }

    /**
     * Get the value of numero
     */ 
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set the value of numero
     *
     * @return  self
     */ 
    public function setNumero($numero): RespostaModel
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get the value of data
     */ 
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set the value of data
     *
     * @return  self
     */ 
    public function setData($data): RespostaModel
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get the value of arquivo
     */ 
    public function getArquivo()
    {
        return $this->arquivo;
    }

    /**
     * Set the value of arquivo
     *
     * @return  self
     */ 
    public function setArquivo($arquivo): RespostaModel
    {
        $this->arquivo = $arquivo;

        return $this;
    }
}