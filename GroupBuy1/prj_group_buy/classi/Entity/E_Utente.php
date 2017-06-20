<?php
/**
 * Created by PhpStorm.
 * User: Utente
 * Date: 25/05/2017
 * Time: 10:46
 */

namespace Entity;


class E_Utente
{
    protected $user_name;
    protected $password;
    protected $identità;
    protected $indirizzo;
    protected $cap;
    protected $email;
    protected $telefono;

    public function __construct()
    {
        $this->indirizzo = new E_Indirizzo();
    }

    public function init_Utente($u_nm, $psw, $id, $ind_loc, $ind_com, $ind_via, $ind_n_civ, $cod_post, $mail,
                                $num_cell)
    {
        $this->set_User_Name($u_nm);
        $this->set_Password($psw);
        $this->set_Identità($id);
        $this->indirizzo->init_Indirizzo($ind_loc, $ind_com, $ind_via, $ind_n_civ);
        $this->set_CAP($cod_post);
        $this->set_Mail($mail);
        $this->set_Telefono($num_cell);
    }

    public function set_User_Name($u_nm)
    {
        $this->user_name = $u_nm;
    }

    public function set_Password($psw)
    {
        $this->password = $psw;
    }

    public function set_Identità($id)
    {
        $this->identità = $id;
    }

    public function set_Indirizzo($ind_loc, $ind_com, $ind_via, $ind_n_civ)
    {
        $this->indirizzo = new E_Indirizzo();
        $this->indirizzo->init_Indirizzo($ind_loc, $ind_com, $ind_via, $ind_n_civ);
    }

    public function set_CAP($cod_post)
    {
        $this->cap = $cod_post;
    }

    public function set_Mail($mail)
    {
        $this->email = $mail;
    }

    public function set_Telefono($num_cell)
    {
        $this->telefono = $num_cell;
    }

    public function get_User_Name()
    {
        return $this->user_name;
    }

    public function get_Password()
    {
        return $this->password;
    }

    public function get_Identità()
    {
        return $this->identità;
    }


    public function get_Indirizzo()
    {
        return $this->indirizzo;
    }

    public function get_CAP()
    {
        return $this->cap;
    }

    public function get_Mail()
    {
        return $this->email;
    }

    public function get_Telefono()
    {
        return $this->telefono;
    }
}