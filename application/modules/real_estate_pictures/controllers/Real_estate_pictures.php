<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of real_estate_picture
 *
 * @author Chanthoeun
 */
class Real_estate_pictures extends Admin_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('real_estate_picture_model', 'real_estate_picture');
    }
    
    public function _remap($method, $params = array())
    {   
        if(is_numeric($method))
        {
            $get_method = 'get_index';
            $params[] = $method;
        }
        else
        {
            $get_method = str_replace('-', '_', $method);
        }
        
        if (method_exists($this, $get_method))
        {
            return call_user_func_array(array($this, $get_method), $params);
        }
        show_404();
    }
    
    public function get($id, $array = FALSE)
    {
        if($array == TRUE){
            return $this->real_estate_picture->as_array()->get($id);
        }
        return $this->real_estate_picture->as_object()->get($id);
    }
    
    public function get_by($where, $array = FALSE)
    {
        if($array == TRUE){
            return $this->real_estate_picture->as_array()->get_by($where);
        }
        return $this->real_estate_picture->as_object()->get_by($where);
    }
    
    public function get_all($order_by = FALSE, $limit = FALSE, $offset = 0)
    {
        if($order_by != FALSE)
        {
            $this->order_by($order_by);
        }
        if($limit != FALSE)
        {
            $this->real_estate_picture->limit($limit, $offset);
        }
        return $this->real_estate_picture->get_all();
    }
    
    public function get_many_by($where, $order_by = FALSE, $limit = FALSE, $offset = 0)
    {
        if($order_by != FALSE)
        {
            $this->order_by($order_by);
        }
        if($limit != FALSE)
        {
            $this->real_estate_picture->limit($limit, $offset);
        }
        return $this->real_estate_picture->get_many_by($where);
    }
    
    public function insert($data, $skip_validation = FALSE)
    {
        return $this->real_estate_picture->insert($data, $skip_validation);
    }
    
    public function insert_many($data, $skip_validation = FALSE)
    {
        return $this->real_estate_picture->insert_many($data, $skip_validation);
    }
    
    public function update($id, $data, $skip_validation = FALSE)
    {
        return $this->real_estate_picture->update($id, $data, $skip_validation);
    }
    
    public function delete($id)
    {
        return $this->real_estate_picture->delete($id);
    }
    
    public function delete_by($where)
    {
        return $this->real_estate_picture->delete_by($where);
    }
    
    public function count_all()
    {
        return $this->real_estate_picture->count_all();
    }
    
    public function count_by($where)
    {
        return $this->real_estate_picture->count_by($where);
    }
    
    public function dropdown($key, $value, $option_label = NULL, $where = NULL)
    {
        if($where != NULL){
            $this->db->where($where);
        }
        
        return $this->real_estate_picture->dropdown($key, $value,$option_label);
    }
    
    public function order_by($criteria, $order = NULL)
    {
        $this->real_estate_picture->order_by($criteria,$order);
    }
}