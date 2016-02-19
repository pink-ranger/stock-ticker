<?php
/**
 * core/MY_Controller.php
 *
 * Default application controller
 */
class Application extends CI_Controller {
	protected $data = array();	  // parameters for view components
	protected $id;	// identifier for our content
	/**
	 * Constructor.
	 * Establish view parameters & load common helpers
	 */
	function __construct()
	{
		parent::__construct();
		$this->data = array();
		$this->data['title'] = 'Demo Stock Ticker';
		$this->load->library('parser');

    $session_id = $this->session->userdata('player');
		if ($session_id)
		{
			$this->data['playername'] = $session_id;
		}
	}
	/**
	 * Render this page
	 */
	function render()
	{
		if (isset($this->data['playername']))
		{
			$this->data['header'] = $this->parser->parse('_header_loggedin', $this->data, true);
		}
		else
		{
			$this->data['header'] = $this->parser->parse('_header', $this->data, true);
		} 
		$this->data['content'] = $this->parser->parse($this->data['pagebody'], $this->data, true);
		$this->data['data'] = &$this->data;
		$this->parser->parse('_template', $this->data);
	}
}
/* End of file MY_Controller.php */
/* Location: application/core/MY_Controller.php */