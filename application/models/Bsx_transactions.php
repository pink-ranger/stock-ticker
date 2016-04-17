<?php

/**
 * The Bsx_transactions model
 */
 class Bsx_transactions extends MY_Model {
    // constructor
    function __construct() {
        parent::__construct('bsx_transactions','token');
    }

    /*
     * When a player buys stock(s), a transaction is added to the bsx_transactions
     * MySql table. These entries would have to be retrived and put in a dropdown
     * so that players can sell the stocks they own
     */
    function addTransaction($token, $stock, $agent, $player, $amount, $datetime)
    {
      if ($this->exists($token))
      {
        echo 'round/token already exists';
      }
      else
      {
        $record = array('token' => $token,
                        'stock' => $stock,
                        'agent' => $agent,
                        'player' => $player,
                        'amount' => $amount,
                        'datetime' => $datetime);
        $this->add($record);  
      }
    }

    /*
     * Every new round needs to have new transactions data. So call this function
     * either when the state of the game is GAME_OVER or GAME_CLOSED or GAME_SETUP
     */
    function emptyTransactionsTable()
    {
      $this->db->truncate('bsx_transactions');
    }


}
