<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of advertise_page_layout
 *
 * @author Chanthoeun
 */
class Advertise_page_layouts extends Admin_Controller {
    public  $validation_errors =  array();
    
    public function __construct() {
        parent::__construct();
        $this->load->model('advertise_page_layout_model', 'advertise_page_layout');
        
        // message
        $this->validation_errors = $this->session->flashdata('validation_errors');
        $this->data['message'] = empty($this->validation_errors['errors']) ? $this->session->flashdata('message') : $this->validation_errors['errors'];
    }
    
    public function get($id, $array = FALSE)
    {
        if($array == TRUE){
            return $this->advertise_page_layout->as_array()->get($id);
        }
        return $this->advertise_page_layout->as_object()->get($id);
    }
    
    public function get_detail($where)
    {
        return $this->advertise_page_layout->get_detail($where);
    }
    
    public function get_by($where, $array = FALSE)
    {
        if($array == TRUE){
            return $this->advertise_page_layout->as_array()->get_by($where);
        }
        return $this->advertise_page_layout->as_object()->get_by($where);
    }
    
    public function get_all()
    {
        return $this->advertise_page_layout->get_all();
    }
    
    public function get_all_records($where = FALSE)
    {
        return $this->advertise_page_layout->get_all_records($where);
    }
    
    public function get_many_by($where)
    {
        return $this->advertise_page_layout->get_many_by($where);
    }
    
    public function insert($data, $skip_validation = FALSE)
    {
        return $this->advertise_page_layout->insert($data, $skip_validation);
    }
    
    public function insert_many($data, $skip_validation = FALSE)
    {
        return $this->advertise_page_layout->insert_many($data, $skip_validation);
    }
    
    public function update($id, $data, $skip_validation = FALSE)
    {
        return $this->advertise_page_layout->update($id, $data, $skip_validation);
    }
    
    public function delete($id)
    {
        return $this->advertise_page_layout->delete($id);
    }
    
    public function delete_by($where)
    {
        return $this->advertise_page_layout->delete_by($where);
    }
    
    public function count_all()
    {
        return $this->advertise_page_layout->count_all();
    }
    
    public function count_by($where)
    {
        return $this->advertise_page_layout->count_by($where);
    }
    
    public function dropdown($key, $value, $option_label = FALSE, $where = FALSE)
    {
        return $this->advertise_page_layout->dropdown($key, $value,$option_label);
    }
    
    public function get_dropdown($key, $value, $option_label = FALSE, $where = FALSE)
    {
        return $this->advertise_page_layout->get_dropdown($key, $value,$option_label, $where);
    }
}