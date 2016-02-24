<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of video_library
 *
 * @author Chanthoeun
 */
class Video_libraries extends Admin_Controller {
    public  $validation_errors =  array();
    
    public function __construct() {
        parent::__construct();
        $this->load->model('video_library_model', 'video_library');
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

    public function destroy($vlid, $vid)
    {
        parent::check_login();
        if($this->delete($vlid)){
            $this->session->set_flashdata('message', 'ឯកសារ​នេះ​លុប​រួចរាល់');
            redirect('videos/view/'.$vid, 'refresh');
        }
    }
    
    public function get($id, $array = FALSE)
    {
        if($array == TRUE){
            return $this->video_library->as_array()->get($id);
        }
        return $this->video_library->as_object()->get($id);
    }
    
    public function get_detail($where)
    {
        return $this->video_library->get_detail($where);
    }
    
    public function get_by($where, $array = FALSE)
    {
        if($array == TRUE){
            return $this->video_library->as_array()->get_by($where);
        }
        return $this->video_library->as_object()->get_by($where);
    }
    
    public function get_all($order_by = FALSE, $limit = FALSE, $offset = 0)
    {
        if($order_by != FALSE)
        {
            $this->order_by($order_by);
        }
        if($limit != FALSE)
        {
            $this->video_library->limit($limit, $offset);
        }
        return $this->video_library->get_all();
    }
    
    public function get_all_records($where = FALSE)
    {
        return $this->video_library->get_all_records($where);
    }
    
    public function get_many_by($where, $order_by = FALSE, $limit = FALSE, $offset = 0)
    {
        if($order_by != FALSE)
        {
            $this->order_by($order_by);
        }
        if($limit != FALSE)
        {
            $this->video_library->limit($limit, $offset);
        }
        return $this->video_library->get_many_by($where);
    }
    
    public function insert($data, $skip_validation = FALSE)
    {
        return $this->video_library->insert($data, $skip_validation);
    }
    
    public function insert_many($data, $skip_validation = FALSE)
    {
        return $this->video_library->insert_many($data, $skip_validation);
    }
    
    public function update($id, $data, $skip_validation = FALSE)
    {
        return $this->video_library->update($id, $data, $skip_validation);
    }
    
    public function delete($id)
    {
        return $this->video_library->delete($id);
    }
    
    public function delete_by($where)
    {
        return $this->video_library->delete_by($where);
    }
    
    public function count_all()
    {
        return $this->video_library->count_all();
    }
    
    public function count_by($where)
    {
        return $this->video_library->count_by($where);
    }
    
    public function dropdown($key, $value, $option_label = NULL, $where = NULL)
    {
        if($where != NULL){
            $this->db->where($where);
        }
        
        return $this->video_library->dropdown($key, $value,$option_label);
    }
    
    public function order_by($criteria, $order = NULL)
    {
        $this->video_library->order_by($criteria,$order);
    }
    
    public function get_next_order($field, $where = FALSE)
    {
        return $this->video_library->get_next_order($field, $where);
    }
}