<?php

abstract class Dato
{
}

trait Identificable
{
    protected int $id;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }
}

class Usuario extends Dato
{
    use Identificable;

    private $identificador;
    private $contrasenna;
    private $codigoCookie;
    private $nombre;
    private $apellidos;

    public function __construct($id, $identificador, $contrasenna, $codigoCookie, $nombre, $apellidos)
    {
        $this->id = $id;
        $this->setIdentificador($identificador);
        $this->setContrasenna($contrasenna);
        $this->setCodigoCookie($codigoCookie);
        $this->setNombre($nombre);
        $this->setApellidos($apellidos);
    }

    public function getIdentificador()
    {
        return $this->identificador;
    }

    public function setIdentificador($identificador)
    {
        $this->identificador = $identificador;
    }

    public function getContrasenna()
    {
        return $this->contrasenna;
    }

    public function setContrasenna($contrasenna)
    {
        $this->contrasenna = $contrasenna;
    }

    public function getCodigoCookie()
    {
        return $this->codigoCookie;
    }

    public function setCodigoCookie($codigoCookie)
    {
        $this->codigoCookie = $codigoCookie;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function getApellidos()
    {
        return $this->apellidos;
    }

    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;
    }

}

class Publicacion extends Dato
{
    use Identificable;

    private $fecha;
    private $emisorId;
    private $destinatarioId;
    private $asunto;
    private $contenido;

    public function __construct($id, $fecha, $emisorId, $receptorId, $asunto, $contenido)
    {
        $this->id = $id;
        $this->setFecha($fecha);
        $this->setEmisorId($emisorId);
        $this->setReceptorId($receptorId);
        $this->setAsunto($asunto);
        $this->setContenido($contenido);
    }

    public function getFecha()
    {
        return $this->fecha;
    }

    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    public function getEmisorId()
    {
        return $this->emisorId;
    }

    public function setEmisorId($emisorId)
    {
        $this->emisorId = $emisorId;
    }

    public function getReceptorId()
    {
        return $this->receptorId;
    }

    public function setReceptorId($receptorId)
    {
        $this->receptorId = $receptorId;
    }

    public function getAsunto()
    {
        return $this->asunto;
    }

    public function setAsunto($asunto)
    {
        $this->asunto = $asunto;
    }

    public function getContenido()
    {
        return $this->contenido;
    }

    public function setContenido($contenido)
    {
        $this->contenido = $contenido;
    }
}
