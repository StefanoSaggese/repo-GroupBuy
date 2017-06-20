<?php
/**
 * Created by PhpStorm.
 * User: Utente
 * Date: 25/05/2017
 * Time: 11:28
 */

namespace Entity;


class E_Offerta
{
    private $nome_prodotto;
    private $tipo_prodotto;
    private $nome_produttore;
    private $scaglioni;
    private $quantità_prenotata;


    public function __construct()
    {
        $this->scaglioni= [];
        $this->quantità_prenotata = new E_Misura();
    }

    public function init_Offerta($n_prod, $t_prod, $n_prodt, $val_q_pren, $um_q_pren)
    {
        $this->set_Nome_Prodotto($n_prod);
        $this->set_Tipo_Prodotto($t_prod);
        $this->set_Nome_Produttore($n_prodt);
        $this->set_Quantità_Prenotata($val_q_pren, $um_q_pren);
    }

    public function set_Nome_Prodotto($n_prod)
    {
        $this->nome_prodotto = $n_prod;
    }

    public function set_Tipo_Prodotto($t_prod)
    {
        $this->tipo_prodotto = $t_prod;
    }

    public function set_Nome_Produttore($n_prodt)
    {
        $this->nome_produttore = $n_prodt;
    }

    public function set_Quantità_Prenotata($val_q_pren, $um_q_pren)
    {
        $this->quantità_prenotata->init_Misura($val_q_pren, $um_q_pren);
    }

    public function push_Scaglione(E_Scaglione $scaglione)
    {
        $this->scaglioni[] = $scaglione;
    }

    public function get_Nome_Prodotto()
    {
        return $this->nome_prodotto;
    }

    public function get_Tipo_Prodotto()
    {
        return $this->tipo_prodotto;
    }

    public function get_Nome_Produttore()
    {
        return $this->nome_produttore;
    }

    public function get_Quantità_Prenotata()
    {
        return $this->quantità_prenotata;
    }

    public function get_vettore_Scaglioni()
    {
        return $this->scaglioni;
    }

    public function get_Scaglione_di_Prezzo($rango)
    {
        return $this->scaglioni[$rango];
    }

    public function trova_Scaglione_Attuale()
    {
        $trovato = false;
        $ans_scagl = null;
        for($i = 0; ($i < count($this->scaglioni)) && !$trovato; $i++)
        {
            $sc = $this->scaglioni[$i];
            if(($this->quantità_prenotata->get_Valore() > $sc->get_Quantità_Minima()->get_Valore()) &&
                ($this->quantità_prenotata->get_Valore() < $sc->get_Quantità_Massima()->get_Valore()))
            {
                $trovato = true;
                $ans_scagl = $sc;
            }
        }
        return $ans_scagl;
    }
}
