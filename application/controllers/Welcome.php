<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends Application {

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
	 	$stocks = $this->stocks->all();
    foreach($stocks as $stock)
    {
      $stockArr[] = $stock;
    }

    $players = $this->players->all();
    foreach($players as $player)
    {
      $playerArr[] = $player;
    }

    $this->data['pagebody'] = 'welcome';
    $this->data['stocks'] = $stockArr;
    $this->data['players'] = $playerArr;
    $this->render();
	}
}
