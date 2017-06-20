<?php
/**
 * Created by PhpStorm.
 * User: Utente
 * Date: 25/05/2017
 * Time: 11:07
 */

namespace Entity;


class E_Data
{
    private $giorno;
    private $mese;
    private $anno;

    public function __construct()
    {}

    public function init_Data($g, $m, $a)
    {
        $this->set_Giorno($g);
        $this->set_Mese($m);
        $this->set_Anno($a);
    }

    public function set_Giorno($g)
    {
        $this->giorno = $g;
    }

    public function set_Mese($m)
    {
        $this->mese = $m;
    }

    public function set_Anno($a)
    {
        $this->anno = $a;
    }

    public function get_Giorno()
    {
        return $this->giorno;
    }

    public function get_Mese()
    {
        return $this->mese;
    }

    public function get_Anno()
    {
        return $this->anno;
    }
}