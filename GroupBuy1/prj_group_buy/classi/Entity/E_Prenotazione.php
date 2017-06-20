<?php
/**
 * Created by PhpStorm.
 * User: Utente
 * Date: 25/05/2017
 * Time: 18:40
 */

namespace Entity;


class E_Prenotazione
{
    private $offerta_relativa;
    private $quantità_desiderata;

    public function __construct(E_Offerta $offerta)
    {
        $this->offerta_relativa = $offerta;
        $this->quantità_desiderata = new E_Misura();
    }

    public function set_Offerta_Relativa(E_Offerta $offerta)
    {
        $this->offerta_relativa = $offerta;
    }

    public function set_Quantità_Desiderata($qd_val, $qd_mis)
    {
        $this->get_Quantità_Desiderata()->init_Misura($qd_val, $qd_mis);
    }

    public function get_Offerta_Relativa()
    {
        return $this->offerta_relativa;
    }

    public function get_Quantità_Desiderata()
    {
        return $this->quantità_desiderata;
    }

    // Blocco SET_PREZZO_PRENOTAZIONE ...
    /*
     * Prende come parametro l'input dell'Utente Compratore, in cui quest'ultimo specifica la quantità che vuole prenotare,
     * espressa come una Stringa nella seguente forma: "valore unità_di_misura".
     * Ricava da tale stringa i due elementi necessari per settare il parametro $quantità_desiderata.
     *
     * @param string $quantità_prenotata và inserita con la seguente forma "valore unità_di_misura".
     */
    public function inserisci_Quantità($quantità_prenotata)
    {
        list($inserted_q_val, $inserted_q_um) = explode(" ", $quantità_prenotata);
        $this->set_Quantità_Desiderata($inserted_q_val, $inserted_q_um);
    }

    /*
     * Ogni volta che viene inserita una nuova quantità, lo Scaglione attuale potrebbe variare.
     * Questa funzione controlla tale eventualità.
     * In caso si scali di Scaglione, $offerta_relativa restituirà quello nuovo.
     * @ return Entity\E_Scaglione
     */
    public function setta_Scaglione()
    {
        $nuova_quantità_tot = $this->get_Offerta_Relativa()->get_Quantità_Prenotata()->get_Valore() +
            $this->get_Quantità_Desiderata()->get_Valore();
        $this->get_Offerta_Relativa()->get_Quantità_Prenotata()->set_Valore($nuova_quantità_tot);
        return $this->get_Offerta_Relativa()->trova_Scaglione_Attuale();
    }

    /*
     * Restituisce il Prezzo corrispondente alla Quantità Inserita, secondo le informazioni prese dallo Scaglione Attuale.
     *
     * @return number
     */
    public function setta_Prezzo_Corrispondente()
    {
        $scaglione_attuale = $this->setta_Scaglione();
        return ($scaglione_attuale->get_Prezzo_Unitario() * $this->get_Quantità_Desiderata()->get_Valore());
    }
    // ... fine Blocco
}