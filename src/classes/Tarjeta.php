<?php

class Tarjeta
{
    private $numero;
    private $entidadBancaria;
    private $tipo;
    private $limiteDisponible;
    private $titularDNI;
    private $titularNombre;
    private $titularApellido;

    public function __construct($numero, $entidadBancaria, $tipo, $limiteDisponible, $titularDNI, $titularNombre, $titularApellido)
    {
        $this->numero = $numero;
        $this->entidadBancaria = $entidadBancaria;
        $this->tipo = $tipo;
        $this->limiteDisponible = $limiteDisponible;
        $this->titularDNI = $titularDNI;
        $this->titularNombre = $titularNombre;
        $this->titularApellido = $titularApellido;
    }

    public function getNumero()
    {
        return $this->numero;
    }

    public function getTipo()
    {
        return $this->tipo;
    }

    public function getLimiteDisponible()
    {
        return $this->limiteDisponible;
    }

    public function setLimiteDisponible($nuevoLimite)
    {
        $this->limiteDisponible = $nuevoLimite;
    }

    public function getTitularDNI()
    {
        return $this->titularDNI;
    }

    public function getTitularNombre()
    {
        return $this->titularNombre;
    }

    public function getTitularApellido()
    {
        return $this->titularApellido;
    }
}
