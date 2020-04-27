<?php 

namespace App\Models\MySQL;

final class PessoaModel
{


    private $codigo;
    private $nome;
    private $email;
    private $telefone;
    private $dataNacimento;

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
    public function setCodigo($codigo): PessoaModel
    {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * Get the value of nome
     */ 
    public function getNome(): string
    {
        return $this->nome;
    }

    /**
     * Set the value of nome
     *
     * @return  self
     */ 
    public function setNome($nome): PessoaModel
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email): PessoaModel
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of telefone
     */ 
    public function getTelefone(): string
    {
        return $this->telefone;
    }

    /**
     * Set the value of telefone
     *
     * @return  self
     */ 
    public function setTelefone($telefone): PessoaModel
    {
        $this->telefone = $telefone;

        return $this;
    }

    /**
     * Get the value of dataNacimento
     */ 
    public function getDataNacimento(): string
    {
        return $this->dataNacimento;
    }

    /**
     * Set the value of dataNacimento
     *
     * @return  self
     */ 
    public function setDataNacimento($dataNacimento): PessoaModel
    {
        $this->dataNacimento = $dataNacimento;

        return $this;
    }
}