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
        // Get the player info
        if ($playerkey == null)
		{
            $sessInfo = $this->session->all_userdata();
            if (array_key_exists('player', $sessInfo)) 
            {
                $playerkey = $sessInfo["player"];
            }
            else{
                redirect("/login");	
            }
		}
		else
		{
		}
            $playerInfo = array();
            $playerInfo[] = $this->players->get($playerkey);
        
        
        // Get the list of players
        $playersArray = array();
        $players = $this->players->all();
        foreach($players as $player)
        {
          $playersArray[] = $player;
        }
        
        // Get the list of transactions for the player
        $this->db->select('*');
        $this->db->from('transactions');
        $this->db->where('player', $playerkey);
        $query = $this->db->get();
        
        $transactions = array();
        foreach($query->result() as $row) 
        {
            $transactions[] = $row;
        }
        
        // Add data
        $this->data['playerList'] = $playersArray;
        $this->data['transactions'] = $transactions;
        $this->data['playerName'] = $playerInfo;
        $this->data['pagebody'] = 'portfolio';
        $this->render();
	}
    
}
