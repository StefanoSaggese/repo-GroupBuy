<?php
/**
 * Created by PhpStorm.
 * User: Utente
 * Date: 25/05/2017
 * Time: 11:19
 */

namespace Entity;


class E_Utente_Venditore extends E_Utente
{
    private $id_proprietario;
    private $cod_fisc_proprietario;
    private $num_partita_IVA;

    public function __construct()
    {
        parent::__construct();
    }

    public function init_Utente_Venditore($u_nm, $psw, $id, $ind_loc, $ind_com, $ind_via, $ind_n_civ, $cod_post, $mail,
                                           $num_cell, $id_prop, $cfpr, $p_IVA)
    {
        parent::init_Utente($u_nm, $psw, $id, $ind_loc, $ind_com, $ind_via, $ind_n_civ, $cod_post, $mail, $num_cell);
        $this->set_ID_Proprietario($id_prop);
        $this->set_Cod_Fisc_Proprietario($cfpr);
        $this->set_IVA($p_IVA);
    }

    public function set_ID_Proprietario($id_prop)
    {
        $this->id_proprietario = $id_prop;
    }

    public function set_Cod_Fisc_Proprietario($cfpr)
    {
        $this->cod_fisc_proprietario = $cfpr;
    }

    public function set_IVA($p_IVA)
    {
        $this->num_partita_IVA = $p_IVA;
    }

    public function get_ID_Proprietario()
    {
        return $this->id_proprietario;
    }

    public function get_IVA()
    {
        return $this->num_partita_IVA;
    }

    public function get_Cod_Fisc_Proprietario()
    {
        return $this->cod_fisc_proprietario;
    }

    // Blocco CREA_OFFERTA ...
    public function nuova_Presentazione_Offerta($nome_prodotto, $tipo_prodotto, $val_quantità_prenotata,
                                                $um_quantità_prenotata)
    {
        $new_offerta = new E_Offerta();
        $nome_produttore = parent::get_Identità();
        $new_offerta->init_Offerta($nome_prodotto, $tipo_prodotto, $nome_produttore, $val_quantità_prenotata,
            $um_quantità_prenotata);
        return $new_offerta;
    }

    public function nuovo_Scaglione_Offerta($rango, $val_quantità_min, $um_quantità_min, $val_quantità_min, $um_quantità_min,
                                            $prezzo_unitario)
    {
        $new_scagl = new E_Scaglione();
        $new_scagl->init_Scaglione($rango, $val_quantità_min, $um_quantità_min, $val_quantità_min, $um_quantità_min,
            $prezzo_unitario);
        return $new_scagl;
    }

    public function aggiungi_Scaglione_ad_Offerta(E_Offerta $offerta, E_Scaglione $scaglione)
    {
        $offerta->push_Scaglione($scaglione);
    }
    // ... fine Blocco
}
