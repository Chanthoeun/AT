<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of article_detail
 *
 * @author Chanthoeun
 */
class Article_details extends Admin_Controller {
    public  $validation_errors =  array();
    
    public function __construct() {
        parent::__construct();
        $this->load->model('article_detail_model', 'article_detail');
    }
    
    public function _remap($method, $params = array())
    {   
        $get_method = str_replace('-', '_', $method);
        
        if (method_exists($this, $get_method))
        {
            return call_user_func_array(array($this, $get_method), $params);
        }
        show_404();
    }
    
    public function get($id)
    {
        return $this->article_detail->as_object()->get($id);
    }
    
    public function get_by($where, $array = FALSE)
    {
        if($array == TRUE){
            return $this->article_detail->as_array()->get_by($where);
        }
        return $this->article_detail->as_object()->get_by($where);
    }
    
    public function get_all($order_by = FALSE, $limit = FALSE, $offset = 0)
    {
        if($order_by != FALSE)
        {
            $this->article_detail->order_by($order_by);
        }
        
        if($limit != FALSE)
        {
            $this->article_detail->limit($limit, $offset);
        }
        
        return $this->article_detail->get_all();
    }
    
    public function get_many_by($where, $order_by = FALSE, $limit = FALSE, $offset = 0)
    {
        if($order_by != FALSE)
        {
            $this->order_by($order_by);
        }
        
        if($limit != FALSE)
        {
            $this->article_detail->limit($limit, $offset);
        }
        
        return $this->article_detail->get_many_by($where);
    }
    
    public function insert($data, $skip_validation = FALSE)
    {
        return $this->article_detail->insert($data, $skip_validation);
    }
    
    public function insert_many($data, $skip_validation = FALSE)
    {
        return $this->article_detail->insert_many($data, $skip_validation);
    }
    
    public function update($id, $data, $skip_validation = FALSE)
    {
        return $this->article_detail->update($id, $data, $skip_validation);
    }
    
    public function delete($id)
    {
        return $this->article_detail->delete($id);
    }
    
    public function delete_by($where)
    {
        return $this->article_detail->delete_by($where);
    }
    
    public function count_all()
    {
        return $this->article_detail->count_all();
    }
    
    public function count_by($where)
    {
        return $this->article_detail->count_by($where);
    }
    
    public function dropdown($key, $value, $option_label = NULL, $where = NULL)
    {
        if($where != NULL){
            $this->db->where($where);
        }
        
        return $this->article_detail->dropdown($key, $value,$option_label);
    }
    
    public function order_by($criteria, $order = NULL)
    {
        $this->article_detail->order_by($criteria,$order);
    }
    
    public function get_next_order($field, $where)
    {
        return $this->article_detail->get_next_order($field, $where);
    }
}