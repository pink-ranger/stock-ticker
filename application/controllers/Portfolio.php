<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Portfolio extends Application {

	public function index($playerkey = null)
	{
        // Set page info data
        $this->data['pagebody'] = 'portfolio';
        
        // Get the list of players
        $playersArray = array();
        $players = $this->players->all();
        foreach($players as $player)
        {
          $playersArray[] = $player;
        }
        $this->data['playerList'] = $playersArray;
        
        // Get the player key
        $playerInfo = array();
        if ($playerkey == null)
		{
            $sessInfo = $this->session->all_userdata();
            if (array_key_exists('player', $sessInfo)) 
            {
                $playerkey = $sessInfo["player"];
            }
		}
        
        // Get player info 
        if($playerkey != null)
        {
            $playerInfo[] = $this->players->get($playerkey);
        }
        else
        {
            $pInfo = new stdClass;
            $pInfo->Player = "Select a player";
            $pInfo->Cash = "n/a";
            $pInfo->Equity = "n/a";
            $playerInfo[0] = $pInfo;
        }
        $this->data['playerName'] = $playerInfo;
        
        // Get the list of transactions for the player
        $transactions = array();
        if($playerkey != null) 
        {
            $this->db->select('*');
            $this->db->from('transactions');
            $this->db->where('player', $playerkey);
            $query = $this->db->get();
            
            foreach($query->result() as $row) 
            {
                $transactions[] = $row;
            }
        }
        $this->data['transactions'] = $transactions;
        
        $this->render();
	}
    
}
