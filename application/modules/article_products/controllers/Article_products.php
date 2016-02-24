<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of article_product
 *
 * @author Chanthoeun
 */
class Article_products extends Admin_Controller {
    public  $validation_errors =  array();
    
    public function __construct() {
        parent::__construct();
        $this->load->model('article_product_model', 'article_product');
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

    public function destroy($id)
    {
        parent::check_login();
        $article_product = $this->get($id);
        if($this->delete($article_product->id)){
            $this->session->set_flashdata('message', 'សម្ភារៈ និង​កសិផល​នេះ​លុប​រួចរាល់');
        }
        else
        {
            $this->session->set_flashdata('message', 'សម្ភារៈ និង​កសិផល​កំពុង​លុប​មាន​បញ្ហា');
        }
        
        redirect('articles/view/'.$article_product->article_id, 'refresh');
    }
    
    public function get($id, $array = FALSE)
    {
        if($array == TRUE){
            return $this->article_product->as_array()->get($id);
        }
        return $this->article_product->as_object()->get($id);
    }
    
    public function get_by($where, $array = FALSE)
    {
        if($array == TRUE){
            return $this->article_product->as_array()->get_by($where);
        }
        return $this->article_product->as_object()->get_by($where);
    }
    
    public function get_all($order_by = FALSE, $limit = FALSE, $offset = 0)
    {
        if($order_by != FALSE)
        {
            $this->order_by($order_by);
        }
        if($limit != FALSE)
        {
            $this->article_product->limit($limit, $offset);
        }
        return $this->article_product->get_all();
    }
    
    public function get_all_records($where = FALSE, $get_product = TRUE)
    {
        return $this->article_product->get_all_records($where, $get_product);
    }
    
    public function get_many_by($where, $order_by = FALSE, $limit = FALSE, $offset = 0)
    {
        if($order_by != FALSE)
        {
            $this->order_by($order_by);
        }
        if($limit != FALSE)
        {
            $this->article_product->limit($limit, $offset);
        }
        return $this->article_product->get_many_by($where);
    }
    
    public function insert($data, $skip_validation = FALSE)
    {
        return $this->article_product->insert($data, $skip_validation);
    }
    
    public function insert_many($data, $skip_validation = FALSE)
    {
        return $this->article_product->insert_many($data, $skip_validation);
    }
    
    public function update($id, $data, $skip_validation = FALSE)
    {
        return $this->article_product->update($id, $data, $skip_validation);
    }
    
    public function delete($id)
    {
        return $this->article_product->delete($id);
    }
    
    public function delete_by($where)
    {
        return $this->article_product->delete_by($where);
    }
    
    public function count_all()
    {
        return $this->article_product->count_all();
    }
    
    public function count_by($where)
    {
        return $this->article_product->count_by($where);
    }
    
    public function dropdown($key, $value, $option_label = NULL, $where = NULL)
    {
        if($where != NULL){
            $this->db->where($where);
        }
        
        return $this->article_product->dropdown($key, $value,$option_label);
    }
    
    public function order_by($criteria, $order = NULL)
    {
        $this->article_product->order_by($criteria,$order);
    }
    
    public function get_next_order($field, $where = FALSE)
    {
        return $this->article_product->get_next_order($field, $where);
    }
}