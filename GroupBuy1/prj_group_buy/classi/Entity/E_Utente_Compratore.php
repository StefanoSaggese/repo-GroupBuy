<?php
/**
 * Created by PhpStorm.
 * User: Utente
 * Date: 25/05/2017
 * Time: 11:10
 */

namespace Entity;


class E_Utente_Compratore extends E_Utente
{
    private $codice_fiscale;
    private $data_nascita;

    public function __construct()
    {
        parent::__construct();
        $this->data_nascita = new E_Data();
    }

    public function init_Utente_Compratore($u_nm, $psw, $id, $ind_loc, $ind_com, $ind_via, $ind_n_civ, $cod_post, $mail,
                                           $num_cell, $cf, $b_day, $b_month, $b_year)
    {
        parent::init_Utente($u_nm, $psw, $id, $ind_loc, $ind_com, $ind_via, $ind_n_civ, $cod_post, $mail, $num_cell);
        $this->set_Codice_Fiscale($cf);
        $this->set_Data_Nascita($b_day, $b_month, $b_year);
    }

    public function set_Codice_Fiscale($cf)
    {
        $this->codice_fiscale = $cf;
    }

    public function set_Data_Nascita($b_day, $b_month, $b_year)
    {
        $this->data_nascita->init_Data($b_day, $b_month, $b_year);
    }

    public function get_Codice_Fiscale()
    {
        return $this->codice_fiscale;
    }

    public function get_Data_Nascita()
    {
        return $this->data_nascita;
    }
}