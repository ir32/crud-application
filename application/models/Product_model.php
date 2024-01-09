<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_products() {
        return $this->db->get('products')->result_array();
    }

    public function create_product($data) {
        $this->db->insert('products', $data);
        return $this->db->insert_id();
    }

    public function get_product($id) {
        return $this->db->get_where('products', array('id' => $id))->row_array();
    }

    public function update_product($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('products', $data);
    }

    public function delete_product($id) {
        return $this->db->delete('products', array('id' => $id));
    }
}
