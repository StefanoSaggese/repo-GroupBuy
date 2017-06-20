<?php
/**
 * Created by PhpStorm.
 * User: Utente
 * Date: 25/05/2017
 * Time: 11:57
 */

namespace Entity;


class E_Misura
{
    private $valore;
    private $unità_misura;

    public function __construct()
    {}

    public function init_Misura($val, $um)
    {
        $this->set_Valore($val);
        $this->set_Unità_Misura($um);
    }

    public function set_Valore($val)
    {
        $this->valore = $val;
    }

    public function set_Unità_Misura($um)
    {
        $this->unità_misura = $um;
    }

    public function get_Valore()
    {
        return $this->valore;
    }

    public function get_Unità_Misura()
    {
        return $this->unità_misura;
    }
}
