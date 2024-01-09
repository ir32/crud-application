<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Product extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Product_model');
    }

    public function index() {
        $data['products'] = $this->Product_model->get_products();
        //  echo "<pre>";
        // print_r ($data); 
        
        $this->load->view('product/product_list.php', $data);

    }

    public function create() {
        // Handle form submission for creating a product
        $data = array(
            'name' => $this->input->post('name'),
            'description' => $this->input->post('description'),
            'price' => $this->input->post('price')
            // Add other fields as needed
        );

        $this->Product_model->create_product($data);
        // Redirect to product listing page or show a success message
    }

    public function edit($id) {
        // Handle editing a product
        $data['product'] = $this->Product_model->get_product($id);
        // Load view to edit product details
    }

    public function update($id) {
        // Handle form submission for updating a product
        $data = array(
            'name' => $this->input->post('name'),
            'description' => $this->input->post('description'),
            'price' => $this->input->post('price')
            // Add other fields as needed
        );

        $this->Product_model->update_product($id, $data);
        // Redirect to product listing page or show a success message
    }

    public function delete($id) {
        $this->Product_model->delete_product($id);
        // Redirect to product listing page or show a success message
    }
}
