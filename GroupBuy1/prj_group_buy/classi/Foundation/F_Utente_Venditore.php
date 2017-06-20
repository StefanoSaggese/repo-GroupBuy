<?php
/**
 * Created by PhpStorm.
 * User: Utente
 * Date: 11/06/2017
 * Time: 15:09
 */

namespace Foundation;

use Entity\E_Utente_Venditore;


class F_Utente_Venditore extends F_DBMS
{
    public function __construct()
    {
        parent::__construct();
    }

    /*
     * Esegue una Query del tipo INSERT INTO sul DataBase, con riferimento alla Tabella "Utente_Venditore".
     * Preleva i Dati necessari a costruire la nuova N-pla dal corrispondente Oggetto E_Utente_Venditore.
     * Dato che è una Query di tipo INSERT, oltre ad eseguire il suo compito, restituirà un Valore Booleano dipendente
     * dall'esito della Query stessa.
     *
     * @param \Entity\E_Utente_Venditore $venditore.
     * @return bool|\mysqli_result Vero se la Query ha avuto successo, Falso altrimenti.
     */
    public function Store(E_Utente_Venditore $venditore)
    {
        $user_name = '"'.$venditore->get_User_Name().'"';
        $password = '"'.$venditore->get_Password().'"';
        $identità = '"'.$venditore->get_Identità().'"';
        $indirizzo = '"'.$venditore->get_Indirizzo()->get_Località().'-'.$venditore->get_Indirizzo()->get_Comune().'-'.
                      $venditore->get_Indirizzo()->get_Via().'-'.$venditore->get_Indirizzo()->get_Num_Civico().'"';
        $cap = '"'.$venditore->get_CAP().'"';
        $mail = '"'.$venditore->get_Mail().'"';
        $telefono = '"'.$venditore->get_Telefono().'"';
        $id_proprietario = '"'.$venditore->get_ID_Proprietario().'"';
        $cod_fisc_propr = '"'.$venditore->get_Cod_Fisc_Proprietario().'"';
        $partita_iva = '"'.$venditore->get_IVA().'"';
        $q = "INSERT INTO `utente_compratore` (`user_name`, `password`, `identità`, `indirizzo`, `CAP`, `mail`, `telefono`,
                                               `id_proprietario`, `cod_fisc_proprietario`, `partita_iva`)
              VALUES ($user_name, $password, $identità, $indirizzo, $cap, $mail, $telefono, $id_proprietario, 
                      $cod_fisc_propr, $partita_iva)";
        return $this->query($q);
    }

    /*
     * Cerca e, in caso la trovi, restituisce la N-pla corrispondente alla Chiave mandata per parametro.
     *
     * !!! N.B. !!! Si presuppone che la Chiave Primaria per la Tabella utente_venditore sia nome_azienda ($identità).
     *
     * @param string $nome_azienda;
     * @return \Entity\E_Utente_Venditore|bool se falso \Entity\E_Utente_Venditore se vero
     */
    public function get_Venditore_per_Chiave($nome_azienda)
    {
        $q = parent::SELECT_qr("*", "`utente_venditore`", "`identità` = \"$nome_azienda\"");
        $array_ans = parent::assoc_Query($q);
        // Costruzione Oggetto E_Utente_Compratore risultante
        if(count($array_ans) != 0)
        {
            list($ind_loc, $ind_com, $ind_via, $ind_n_civ) = explode ("-", $array_ans[0]['indirizzo']);
            $obj_res = new E_Utente_Venditore();
            $obj_res->init_Utente_Venditore($array_ans[0]['user_name'], $array_ans[0]['password'], $array_ans[0]['identità'],
                $ind_loc, $ind_com, $ind_via, $ind_n_civ, $array_ans[0]['CAP'],
                $array_ans[0]['mail'], $array_ans[0]['telefono'], $array_ans[0]['id_proprietario'],
                $array_ans[0]['cod_fisc_proprietario'], $array_ans[0]['partita_iva']);
        }
        else
        {
            $obj_res = false;
        }
        return $obj_res;
    }
}