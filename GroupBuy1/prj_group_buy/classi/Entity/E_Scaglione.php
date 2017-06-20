<?php
/**
 * Created by PhpStorm.
 * User: Utente
 * Date: 25/05/2017
 * Time: 11:37
 */

namespace Entity;


class E_Scaglione
{
    private $rango;
    private $quantità_minima;
    private $quantità_massima;
    private $prezzo_unitario;

    public function __construct()
    {
        $this->quantità_minima = new E_Misura();
        $this->quantità_massima = new E_Misura();
    }

    public function init_Scaglione($rank, $q_min_val, $q_min_um, $q_max_val, $q_max_um, $prezzo_unit)
    {
        $this->set_Rango($rank);
        $this->set_Quantità_Minima($q_min_val, $q_min_um);
        $this->set_Quantità_Massima($q_max_val, $q_max_um);
        $this->set_Prezzo_Unitario($prezzo_unit);
    }

    public function set_Rango($rank)
    {
        $this->rango = $rank;
    }

    public function set_Quantità_Minima($q_min_val, $q_min_um)
    {
        $this->quantità_minima->init_Misura($q_min_val, $q_min_um);
    }

    public function set_Quantità_Massima($q_max_val, $q_max_um)
    {
        $this->quantità_massima->init_Misura($q_max_val, $q_max_um);
    }

    public function set_Prezzo_Unitario($prezzo_unit)
    {
        $this->prezzo_unitario = $prezzo_unit;
    }

    public function get_Rango()
    {
        return $this->rango;
    }

    public function get_Quantità_Minima()
    {
        return $this->quantità_minima;
    }

    public function get_Quantità_Massima()
    {
        return $this->quantità_massima;
    }

    public function get_Prezzo_Unitario()
    {
        return $this->prezzo_unitario;
    }
}
