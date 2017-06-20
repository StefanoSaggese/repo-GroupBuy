<?php
/**
 * Created by PhpStorm.
 * User: Utente
 * Date: 25/05/2017
 * Time: 10:56
 */

namespace Entity;


class E_Indirizzo
{
    private $località;
    private $comune;
    private $via;
    private $num_civico;

    public function __construct()
    {}

    public function init_Indirizzo($loc, $com, $v, $n_civ)
    {
        $this->set_Località($loc);
        $this->set_Comune($com);
        $this->set_Via($v);
        $this->set_Num_Civico($n_civ);
    }

    public function set_Località($loc)
    {
        $this->località = $loc;
    }

    public function set_Comune($com)
    {
        $this->comune = $com;
    }

    public function set_Via($v)
    {
        $this->via = $v;
    }

    public function set_Num_Civico($n_civ)
    {
        $this->num_civico = $n_civ;
    }

    public function get_Località()
    {
        return $this->località;
    }

    public function get_Comune()
    {
        return $this->comune;
    }

    public function get_Via()
    {
        return $this->via;
    }

    public function get_Num_Civico()
    {
        return $this->num_civico;
    }
}
