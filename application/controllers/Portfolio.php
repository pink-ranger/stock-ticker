<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Portfolio extends Application {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
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
            $pInfo->Player = "-";
            $pInfo->Cash = "-";
            $pInfo->Equity = "-";
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
