<?php
/**
 * Created by PhpStorm.
 * User: Utente
 * Date: 08/06/2017
 * Time: 11:03
 */

namespace Foundation;

use Entity\E_Scaglione;


class F_Scaglione extends F_DBMS
{
    public function __construct()
    {
        parent::__construct();
    }

    public function Store(E_Scaglione $scaglione)
    {
        $rango = '"'.$scaglione->get_Rango().'"';
        $quantità_minima = '"'.$scaglione->get_Quantità_Minima()->get_Valore()." ".
            $scaglione->get_Quantità_Minima()->get_Unità_Misura().'"';
        $quantità_massima = '"'.$scaglione->get_Quantità_Massima()->get_Valore()." ".
            $scaglione->get_Quantità_Massima()->get_Unità_Misura().'"';
        $prezzo_unitario = $scaglione->get_Prezzo_Unitario();
        $q = "INSERT INTO `scaglioni_prezzo` (`rango`, `quantità_minima`, `quantità_massima`, `prezzo_unitario`)
              VALUES($rango, $quantità_minima, $quantità_massima, $prezzo_unitario)";
        return $this->query($q);
    }

    public function get_Scaglione_per_Chiave($rango_scaglione)
    {
        $q = parent::SELECT_qr("*", "`scaglioni_prezzo`", "`rango`=\"$rango_scaglione\"");
        $array_ans = parent::assoc_Query($q);
        if(count($array_ans) != 0)
        {
            list($val_q_min, $um_q_min) = explode (" ", $array_ans[0]['quantità_minima']);
            list($val_q_max, $um_q_max) = explode (" ", $array_ans[0]['quantità_massima']);
            $obj_res = new E_Scaglione();
            $obj_res->init_Scaglione($array_ans[0]['rango'], $val_q_min, $um_q_min,$val_q_max, $um_q_max,
                $array_ans[0]['prezzo_unitario']);
        }
        else
        {
            $obj_res = false;
        }
        return $obj_res;
    }
}