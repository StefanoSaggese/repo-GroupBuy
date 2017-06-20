<?php

namespace foundation;

use Entity\E_Offerta;
use Entity\E_Scaglione;

include("C:\Users\Utente\PhpstormProjects\prj_Group_Buy\Files_di_Configurazione\Variabili_Configurazione_DB.php");

class F_Presentazione_Offerta extends F_DBMS
{
	public function __construct()
	{
		parent::__construct();
	}

	public function Store(E_Offerta $offerta)
    {
        $nome_prodotto = '"'.$offerta->get_Nome_Prodotto().'"';
        $tipo_prodotto = '"'.$offerta->get_Tipo_Prodotto().'"';
        $nome_produttore = '"'.$offerta->get_Nome_Produttore().'"';
        $quantità_prenotata = '"'.$offerta->get_Quantità_Prenotata()->get_Valore()."_".
            $offerta->get_Quantità_Prenotata()->get_Unità_Misura().'"';
        for($i = 0; $i < count($offerta->get_vettore_Scaglioni()); $i++)
        {
            $rango_scaglione = '"'.$offerta->get_Scaglione_di_Prezzo($i)->get_Rango().'"';
            $quantità_minima = '"'.$offerta->get_Scaglione_di_Prezzo($i)->get_Quantità_Minima()->get_Valore()."_".
                $offerta->get_Scaglione_di_Prezzo($i)->get_Quantità_Minima()->get_Unità_Misura().'"';
            $quantità_massima = '"'.$offerta->get_Scaglione_di_Prezzo($i)->get_Quantità_Massima()->get_Valore()."_".
                $offerta->get_Scaglione_di_Prezzo($i)->get_Quantità_Massima()->get_Unità_Misura().'"';
            $prezzo_unitario = '"'.$offerta->get_Scaglione_di_Prezzo($i)->get_Prezzo_Unitario().'"';
            $q = "INSERT INTO `offerta` (`nome_prodotto`, `tipo_prodotto`, `nome_produttore`, `quantità_prenotata`, 
                                      `scaglione_rango`, `scaglione_quantità_minima`, `scaglione_quantità_massima`, 
                                      `scaglione_prezzo_unitario`)
              VALUES($nome_prodotto, $tipo_prodotto, $nome_produttore, $quantità_prenotata, $rango_scaglione, $quantità_minima, 
                     $quantità_massima, $prezzo_unitario)";
            $this->query($q);
        }
    }

    public function get_Offerta_per_Chiave($nome_offerta)
    {
        $q = parent::SELECT_qr("*", "`offerta`", "`nome_prodotto` = \"$nome_offerta\"");
        $array_ans = parent::assoc_Query($q);
        if(count($array_ans) != 0)
        {
            $offerta_ris = new E_Offerta();
            list($val_quantità_pren, $um_quantità_pren) = explode("_", $array_ans[0]['quantità_prenotata']);
            $offerta_ris->init_Offerta($array_ans[0]['nome_prodotto'], $array_ans[0]['tipo_prodotto'],
                $array_ans[0]['nome_produttore'], $val_quantità_pren, $um_quantità_pren);
            for($i = 0; $i < count($array_ans); $i++)
            {
                $sc = new E_Scaglione();
                list($quantità_min_val, $quantità_min_um) = explode("_", $array_ans[$i]['scaglione_quantità_minima']);
                list($quantità_max_val, $quantità_max_um) = explode("_", $array_ans[$i]['scaglione_quantità_massima']);
                $sc->init_Scaglione($array_ans[$i]['scaglione_rango_scaglione'], $quantità_min_val, $quantità_min_um,
                    $quantità_max_val, $quantità_max_um, $array_ans[$i]['scaglione_prezzo_unitario']);
                $offerta_ris->push_Scaglione($sc);
            }
        }
        else
        {
            $offerta_ris = array();
        }
        return $offerta_ris;
    }
}























?>