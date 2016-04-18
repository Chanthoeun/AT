<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of advertise_price
 *
 * @author Chanthoeun
 */
class Advertise_prices extends Admin_Controller {
    public  $validation_errors =  array();
    
    public function __construct() {
        parent::__construct();
        $this->load->model('advertise_price_model', 'advertise_price');
        
        // message
        $this->validation_errors = $this->session->flashdata('validation_errors');
        $this->data['message'] = empty($this->validation_errors['errors']) ? $this->session->flashdata('message') : $this->validation_errors['errors'];
    }
    
    public function get($id, $array = FALSE)
    {
        if($array == TRUE){
            return $this->advertise_price->as_array()->get($id);
        }
        return $this->advertise_price->as_object()->get($id);
    }
    
    public function get_by($where, $array = FALSE)
    {
        if($array == TRUE){
            return $this->advertise_price->as_array()->get_by($where);
        }
        return $this->advertise_price->as_object()->get_by($where);
    }
    
    public function get_all()
    {
        return $this->advertise_price->get_all();
    }
    
    public function get_many_by($where)
    {
        return $this->advertise_price->get_many_by($where);
    }
    
    public function insert($data, $skip_validation = FALSE)
    {
        return $this->advertise_price->insert($data, $skip_validation);
    }
    
    public function insert_many($data, $skip_validation = FALSE)
    {
        return $this->advertise_price->insert_many($data, $skip_validation);
    }
    
    public function update($id, $data, $skip_validation = FALSE)
    {
        return $this->advertise_price->update($id, $data, $skip_validation);
    }
    
    public function delete($id)
    {
        return $this->advertise_price->delete($id);
    }
    
    public function delete_by($where)
    {
        return $this->advertise_price->delete_by($where);
    }
    
    public function count_all()
    {
        return $this->advertise_price->count_all();
    }
    
    public function count_by($where)
    {
        return $this->advertise_price->count_by($where);
    }
    
    public function dropdown($key, $value, $option_label = NULL, $where = NULL)
    {
        if($where != NULL){
            $this->db->where($where);
        }
        
        return $this->advertise_price->dropdown($key, $value,$option_label);
    }
}