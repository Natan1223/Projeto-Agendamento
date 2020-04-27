<?php

namespace App\Models\MySQL;

final class TokenModel
{ 
    /**
     * @var int
     */
    private $codigo;

    /**
     * @var int
     */
    private $usuario_codigo;

    /**
     * @var string
     */
    private $token;

     /**
     * @var string
     */
    private $refresh_token;

     /**
     * @var string
     */
    private $data_expira;


    /**
     * @return int
     */
    public function getCodigo(): int
    {
        return $this->codigo;
    }

    /**
     * @param int $codigo
     * @return TokenModel
     */
    public function setCodigo(int $codigo): TokenModel
    {
        $this->codigo = $codigo;
        return $this;
    }
    
   
    /**
     * Get the value of usuario_codigo
     *
     * @return  int
     */ 
    public function getUsuario_codigo(): int
    {
        return $this->usuario_codigo;
    }

    /**
     * Set the value of usuario_codigo
     *
     * @param  int  $usuario_codigo
     *
     * @return  self
     */ 
    public function setUsuario_codigo(int $usuario_codigo): TokenModel
    {
        $this->usuario_codigo = $usuario_codigo;

        return $this;
    }

    /**
     * Get the value of token
     * @return  string
     */ 
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * Set the value of token
     *
     * @param  string  $token
     * @return  self
     */ 
    public function setToken(string $token): self
    {
        $this->token = $token;
        return $this;
    }

    /**
     * Get the value of refresh_token
     * @return  string
     */ 
    public function getRefresh_token(): string
    {
        return $this->refresh_token;
    }

    /**
     * Set the value of refresh_token
     *
     * @param  string  $refresh_token
     * @return  self
     */ 
    public function setRefresh_token(string $refresh_token): self
    {
        $this->refresh_token = $refresh_token;
        return $this;
    }

    /**
     * Get the value of data_expira
     * @return  string
     */ 
    public function getData_expira(): string
    {
        return $this->data_expira;
    }

    /**
     * Set the value of data_expira
     *
     * @param  string  $data_expira
     * @return  self
     */ 
    public function setData_expira(string $data_expira): self
    {
        $this->data_expira = $data_expira;
        return $this;
    }

}