<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class History extends Application {

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
	public function index() 
    {
        $this->db->select('Code');
        $this->db->from('movements');
        $this->db->order_by('DateTime', 'desc');

        $query = $this->db->get();
        $stock = $query->result_array();
        $this->displayStock($stock[0]['Code']);
    }

    public function displayStock($stockName = null)
    {
        $this->data['pagebody'] = 'history';
            
        $stockNamesArray = array();
        $stocks = $this->stocks->all();
        foreach($stocks as $stock)
        {
          $stockNamesArray[] = $stock;
        }

        $this->db->select('*');
        $this->db->from('movements');
        $this->db->where('movements.Code', strtoupper($stockName));
        $query = $this->db->get();

        $movementsArray = array();
        foreach($query->result() as $row) 
        {
            $movementsArray[] = $row;
        }
        
        //print_r($movementsArray);

        $this->data['movements'] = $movementsArray;
        $this->data['stockNames'] = $stockNamesArray;
        $this->data['name'] = $stockName;
        
        $this->render();
    }
}
