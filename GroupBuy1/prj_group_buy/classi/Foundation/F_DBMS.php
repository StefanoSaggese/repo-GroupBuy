<?php
/**
 * Created by PhpStorm.
 * User: Utente
 * Date: 01/06/2017
 * Time: 11:42
 */

namespace Foundation;

include("C:\Users\Utente\PhpstormProjects\prj_Group_Buy\Files_di_Configurazione\Variabili_Configurazione_DB.php");

class F_DBMS extends \mysqli
{
    /*
     * Crea un'Istanza di Connessione al DataBase, utilizzando i Dati di Accesso Globali salvati nel file
     * /Files_di_Configurazione/Variabili_Configurazione_DB.php.
     * Se la Connessione và a buon fine, stampa "Connesso!".
     * Se invece la Connessione non funziona, stampa una stringa dove specifica Numero e Descrizione dell'Errore.     *
     */
    public function __construct()
    {
        global $mysqlConfig;
        parent::__construct($mysqlConfig["host"], $mysqlConfig["user"], $mysqlConfig["password"], $mysqlConfig["database"]);
        if ($this->connect_error)
        {
            die("Errore di connessione (".$this->connect_errno."): ".$this->connect_error.".\n");
        }
        else
        {
            echo "Connesso! \n";
        }
    }

    /*
     * Esegue una Query sul DataBase.
     * Restituisce un Array, contenente le N-ple risultanti.
     * La singola N-pla è essa stessa un Array, di tipo Associativo, con elementi del tipo: ['nome_attributo'] => valore_attributo.
     *
     * @param string $query Contiene la Query da mandare al DataBase, espressa in una Stringa.
     * @return mixed Se la Query ha successo, l'Array contiene tutte le N-ple Risultanti;
     * Se invece la Query non viene eseguita con successo, restituisce Null.
     */
    public function assoc_Query($query)
    {
        $ans = $this->query($query);
        $v = []; // L'Array vuoto sarà il risultato in caso la Query abbia successo ma non ci siano N-ple risultanti
        if ($ans) // Query eseguita correttamente
        {
            if($ans->num_rows != 0) // Ci sono delle N-ple risultanti
            {
                while ($n_pla = $ans->fetch_assoc()) /*
                                                      * FETCH_ASSOC : restituisce ciclicamente tutte le T-ple risultanti,
                                                      * ognuna sottoforma di Array Asscociativo.
                                                      * Il WHILE esprime il seguente concetto: "Finchè FETCH_ASSOC ha delle
                                                      * N-ple da restituire".
                                                      * L'Assegnazione è implicita nella Condizione di Ciclo.
                                                      */
                {
                    $v[] = $n_pla;
                }
            }
        }
        else // La Query non viene eseguita
        {
            $v = null;
        }
        return $v;
    }

    /*
     * Crea e restituisce una Stringa nel formato SELECT FROM WHERE
     *
     * @param string $select_field Stringa che riempe il campo SELECT
     * @param string $from_field Stringa che riempe il campo FROM
     * @param string $where_field Stringa che riempe il campo WHERE
     * @return string Query SELECT FROM WHERE completa e pronta all'esecuzione
     */
    public function SELECT_qr($select_field, $from_field, $where_field)
    {
        return "SELECT ".$select_field."\nFROM ".$from_field."\nWHERE ".$where_field;
    }
}