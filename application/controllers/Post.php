<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *  Post Controller
 */
class Post extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('crud');
	}

	public function index()
	{
		$data['data'] = $this->crud->get_records('posts');
		//  echo "<pre>";
        // print_r ($data); 
        // die("hi");
		$this->load->view('post/list', $data);
	}


	public function create()
	{
		echo "hello";
		$this->load->view('post/create');
	}


	public function store()
	{
		$data['title'] = $this->input->post('title');
		$data['description'] = $this->input->post('description');

		$this->crud->insert('posts', $data);
		$this->session->set_flashdata('message', '<div class="alert alert-success">Record has been saved successfully.</div>');
		redirect(base_url());
	}

	public function edit($id)
	{
		$data['data'] = $this->crud->find_record_by_id('posts', $id);
		$this->load->view('post/edit', $data);
	}

	public function update($id)
	{
		$data['title'] = $this->input->post('title');
		$data['description'] = $this->input->post('description');

		$this->crud->update('posts', $data, $id);
		$this->session->set_flashdata('message', '<div class="alert alert-success">Record has been updated successfully.</div>');
		redirect(base_url());
	}

	public function delete($id)
	{
		$this->crud->delete('posts', $id);
		$this->session->set_flashdata('message', '<div class="alert alert-success">Record has been deleted successfully.</div>');
		redirect(base_url());
	}

	public function view_data(){
 		$id = $this->input->post('id');

        $resilt = $this->crud->get_view_data($id);
        echo json_encode($resilt);
 		//echo "<pre>";print_r($resilt);die("heloo");
	}

	public function read_data() {
		$this->load->view('file/index');
	}
	public function read_xml() {
		$xmlFile = APPPATH . 'views/xml/sample_data.xml';		
		if (file_exists($xmlFile) && is_readable($xmlFile)) {
            $xmlData = file_get_contents($xmlFile);

            $xml = simplexml_load_string($xmlData);
            $jsonData = json_encode($xml);
			// echo "<pre>";print_r($jsonData);
            // $this->output
            //      ->set_content_type('application/json')
            //      ->set_output($jsonData);
			$this->load->view('display_json', ['json_data' => $jsonData]);

        } else {
            echo 'XML file not found or not readable';
        }
	}
	public function process_form_submission() {
	
		$form_data = $this->input->post();

    // Loop through the array and modify keys
    $modified_data = [];
    foreach ($form_data as $key => $value) {
        $underscore_position = strrpos($key, '_');
        if ($underscore_position !== false) {
            $modified_key = substr($key, $underscore_position + 1);
            $modified_data[$modified_key] = $value;
        }
    }

    // Print the modified data
    echo '<pre>';
    print_r($modified_data);
    echo '</pre>';
	}
	

}
