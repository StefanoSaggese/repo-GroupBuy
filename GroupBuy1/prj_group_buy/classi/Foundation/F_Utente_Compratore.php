<?php
/**
 * Created by PhpStorm.
 * User: Utente
 * Date: 01/06/2017
 * Time: 15:42
 */

namespace Foundation;

use Entity\E_Utente_Compratore;

include("C:\Users\Utente\PhpstormProjects\prj_Group_Buy\Files_di_Configurazione\Variabili_Configurazione_DB.php");
include("C:\Users\Utente\PhpstormProjects\prj_Group_Buy\Classi\Entity\E_Utente_Compratore.php");
include("C:\Users\Utente\PhpstormProjects\prj_Group_Buy\Classi\Entity\E_Indirizzo.php");
include("C:\Users\Utente\PhpstormProjects\prj_Group_Buy\Classi\Entity\E_Data.php");

class F_Utente_Compratore extends F_DBMS
{
    /*
     * Richiama l'Istanza di Connessione dalla Super-Classe
     */
    public function __construct()
    {
        parent::__construct();
    }

    /*
     * Esegue una Query del tipo INSERT INTO sul DataBase, con riferimento alla Tabella "Utente_Compratore".
     * Preleva i Dati necessari a costruire la nuova N-pla dal corrispondente Oggetto E_Utente_Compratore.
     * Dato che è una Query di tipo INSERT, oltre ad eseguire il suo compito, restituirà un Valore Booleano dipendente
     * dall'esito della Query stessa.
     *
     * @param \Entity\E_Utente_Compratore $utente_compratore.
     * @return bool|\mysqli_result Vero se la Query ha avuto successo, Falso altrimenti.
     */
    public function Store(E_Utente_Compratore $utente_compratore)
    {
        $user_name = '"'.$utente_compratore->get_User_Name().'"';
        $password = '"'.$utente_compratore->get_Password().'"';
        $identità = '"'.$utente_compratore->get_Identità().'"';
        $indirizzo = '"'.$utente_compratore->get_Indirizzo()->get_Località().'-'.
                     $utente_compratore->get_Indirizzo()->get_Comune().'-'.
                     $utente_compratore->get_Indirizzo()->get_Via().'-'.
                     $utente_compratore->get_Indirizzo()->get_Num_Civico().'"';
        $CAP = '"'.$utente_compratore->get_CAP().'"';
        $mail = '"'.$utente_compratore->get_Mail().'"';
        $telefono = '"'.$utente_compratore->get_Telefono().'"';
        $codice_fiscale = '"'.$utente_compratore->get_Codice_Fiscale().'"';
        $data_nascita = '"'.$utente_compratore->get_Data_Nascita()->get_Giorno().'/'.
                        $utente_compratore->get_Data_Nascita()->get_Mese().'/'.
                        $utente_compratore->get_Data_Nascita()->get_Anno().'"';
        $q = "INSERT INTO `utente_compratore` (`user_name`, `password`, `identità`, `codice_fiscale`, `indirizzo`, `CAP`, `mail`, `telefono`, `data_nascita`)
              VALUES($user_name, $password, $identità, $codice_fiscale, $indirizzo, $CAP, $mail, $telefono, $data_nascita)";
        return $this->query($q);
    }

    /*
     * Cerca e, in caso la trovi, restituisce la N-pla corrispondente alla Chiave mandata per parametro.
     *
     * !!! N.B. !!! Si presuppone che la Chiave Primaria per la Tabella utente_compratore sia codice_fiscale
     *
     * @param string $codice_fiscale;
     * @return \Entity\E_Utente_Compratore|bool se falso \Entity\E_Utente_Compratore se vero
     */
    public function get_Compratore_per_Chiave($codice_fiscale)
    {
        $q = parent::SELECT_qr("*", "`utente_compratore`", "`codice_fiscale` = \"$codice_fiscale\"");
        $array_ans = parent::assoc_Query($q);
        // Costruzione Oggetto E_Utente_Compratore risultante
        if(count($array_ans) != 0)
        {
            list($ind_loc, $ind_com, $ind_via, $ind_n_civ) = explode ("-", $array_ans[0]['indirizzo']);
            list($b_day, $b_month, $b_year) = explode ("/", $array_ans[0]['data_nascita']);
            $obj_res = new E_Utente_Compratore();
            $obj_res->init_Utente_Compratore($array_ans[0]['user_name'], $array_ans[0]['password'], $array_ans[0]['identità'],
                                             $ind_loc, $ind_com, $ind_via, $ind_n_civ, $array_ans[0]['CAP'],
                                             $array_ans[0]['mail'], $array_ans[0]['telefono'],
                                             $array_ans[0]['codice_fiscale'],$b_day, $b_month, $b_year);
        }
        else
        {
            $obj_res = false;
        }
        return $obj_res;
    }

    /*
     * Restituisce tutte le N-ple della Tabella utente_compratore, memorizzandole in un Array
     *
     * @return mixed Array di Oggetti \Entity\E_Utente_Compratore, oppure, in caso di tabella vuota, Array vuoto
     */
    public function get_tutti_Compratori()
    {
        $q = parent::SELECT_qr("*", "`utente_compratore`", "1");
        $array_ans = parent::assoc_Query($q);

        if(count($array_ans) != 0)
        {
            $vekt_res = array();
            for($i = 0; $i < count($array_ans); $i++)
            {
                list($ind_loc, $ind_com, $ind_via, $ind_n_civ) = explode ("-", $array_ans[$i]['indirizzo']);
                list($b_day, $b_month, $b_year) = explode ("/", $array_ans[$i]['data_nascita']);
                $obj_res = new E_Utente_Compratore();
                $obj_res->init_Utente_Compratore($array_ans[$i]['user_name'], $array_ans[$i]['password'], $array_ans[$i]['identità'],
                    $ind_loc, $ind_com, $ind_via, $ind_n_civ, $array_ans[$i]['CAP'], $array_ans[$i]['mail'],
                    $array_ans[$i]['telefono'], $array_ans[$i]['codice_fiscale'], $b_day, $b_month, $b_year);
                $vekt_res[] = $obj_res;
            }
        }
        else
        {
            $vekt_res = array();
        }
        return $vekt_res;
    }
}