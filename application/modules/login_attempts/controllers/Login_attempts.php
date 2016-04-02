<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of login_attempt
 *
 * @author Chanthoeun
 */
class Login_attempts extends Admin_Controller {
    public  $validation_errors =  array();
    
    public function __construct() {
        parent::__construct();
        $this->load->model('login_attempt_model', 'login_attempt');
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

    public function destroy($alid, $aid)
    {
        parent::check_login();
        if($this->delete($alid)){
            $this->session->set_flashdata('message', 'ឯកសារ​នេះ​លុប​រួចរាល់');
            redirect('articles/view/'.$aid, 'refresh');
        }
    }
    
    public function get($id, $array = FALSE)
    {
        if($array == TRUE){
            return $this->login_attempt->as_array()->get($id);
        }
        return $this->login_attempt->as_object()->get($id);
    }
    
    public function get_by($where, $array = FALSE)
    {
        if($array == TRUE){
            return $this->login_attempt->as_array()->get_by($where);
        }
        return $this->login_attempt->as_object()->get_by($where);
    }
    
    public function get_all($order_by = FALSE, $limit = FALSE, $offset = 0)
    {
        if($order_by != FALSE)
        {
            $this->order_by($order_by);
        }
        if($limit != FALSE)
        {
            $this->login_attempt->limit($limit, $offset);
        }
        return $this->login_attempt->get_all();
    }
    
    public function get_many_by($where, $order_by = FALSE, $limit = FALSE, $offset = 0)
    {
        if($order_by != FALSE)
        {
            $this->order_by($order_by);
        }
        if($limit != FALSE)
        {
            $this->login_attempt->limit($limit, $offset);
        }
        return $this->login_attempt->get_many_by($where);
    }
    
    public function insert($data, $skip_validation = FALSE)
    {
        return $this->login_attempt->insert($data, $skip_validation);
    }
    
    public function insert_many($data, $skip_validation = FALSE)
    {
        return $this->login_attempt->insert_many($data, $skip_validation);
    }
    
    public function update($id, $data, $skip_validation = FALSE)
    {
        return $this->login_attempt->update($id, $data, $skip_validation);
    }
    
    public function delete($id)
    {
        return $this->login_attempt->delete($id);
    }
    
    public function delete_by($where)
    {
        return $this->login_attempt->delete_by($where);
    }
    
    public function count_all()
    {
        return $this->login_attempt->count_all();
    }
    
    public function count_by($where)
    {
        return $this->login_attempt->count_by($where);
    }
    
    public function dropdown($key, $value, $option_label = NULL, $where = NULL)
    {
        if($where != NULL){
            $this->db->where($where);
        }
        
        return $this->login_attempt->dropdown($key, $value,$option_label);
    }
    
    public function order_by($criteria, $order = NULL)
    {
        $this->login_attempt->order_by($criteria,$order);
    }
    
    public function get_next_order($field, $where = FALSE)
    {
        return $this->login_attempt->get_next_order($field, $where);
    }
}