<?php

/**
 * The Bsx_tokens model
 */
 class Bsx_tokens extends MY_Model {
    // constructor
    function __construct() {
        parent::__construct('bsx_tokens','round');
    }

    /*
     * Adds the current round and the agent token (required for buying and selling
     * stocks) to the bsx_tokens MySql Table
     */
    function addToken($round, $token)
    {
      if ($this->exists($round))
      {
        echo 'round/token already exists';
      }
      else
      {
        $record = array('round' => $round, 'token' => $token);
        $this->add($record);  
      }
    }

    /*
     * Gets the agent token for the current round
     */
    function getCurrentToken($round)
    {
      $currentToken = $this->get($round);
      return $currentToken->token;
    }
}
