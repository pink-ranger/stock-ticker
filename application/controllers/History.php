<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class History extends Application {
	
    /*
     * Used to find the stock with the latest movement to display
     * when there is no specified stock code.
     */
    public function index() 
    {
	// Look for stock with latest movement
	// Make it go by descending DateTime so we know latest is first
        $this->db->select('Code');
        $this->db->from('movements');
        $this->db->order_by('DateTime', 'desc');
	
	// Since we know latest is first turn it into an array and grab the first row
	// Use the latest stock to render the default page
        $query = $this->db->get();
        $stock = $query->result_array();
        $this->displayStock($stock[0]['Code']);
    }
    
    /*
     * Used to display the history of the stck specified.
     * @arg $stockName the code of the stock to display  
     */    
    public function displayStock($stockName = null)
    {
        $this->data['pagebody'] = 'history';
        
	// Grab all stock names for drop down menu
        $stockNamesArray = array();
        $stocks = $this->stocks->all();
        foreach($stocks as $stock)
        {
          $stockNamesArray[] = $stock;
        }
	
	// Now query database to display all movements for the specific
	// stock specified from the url variable from the route 
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
