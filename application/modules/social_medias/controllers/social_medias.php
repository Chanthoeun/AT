<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of social_media
 *
 * @author Chanthoeun
 */
class Social_medias extends Admin_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('social_media_model', 'social_media');
        $this->lang->load('social_media');
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
    
    public function get($id, $array = FALSE)
    {
        if($array == TRUE){
            return $this->social_media->as_array()->get($id);
        }
        return $this->social_media->as_object()->get($id);
    }
    
    public function get_by($where, $array = FALSE)
    {
        if($array == TRUE){
            return $this->social_media->as_array()->get_by($where);
        }
        return $this->social_media->as_object()->get_by($where);
    }
    
    public function get_all($order_by = FALSE, $limit = FALSE, $offset = 0)
    {
        if($order_by != FALSE)
        {
            $this->order_by($order_by);
        }
        if($limit != FALSE)
        {
            $this->social_media->limit($limit, $offset);
        }
        return $this->social_media->get_all();
    }
    
    public function get_many_by($where, $order_by = FALSE, $limit = FALSE, $offset = 0)
    {
        if($order_by != FALSE)
        {
            $this->order_by($order_by);
        }
        if($limit != FALSE)
        {
            $this->social_media->limit($limit, $offset);
        }
        return $this->social_media->get_many_by($where);
    }
    
    public function insert($data, $skip_validation = FALSE)
    {
        return $this->social_media->insert($data, $skip_validation);
    }
    
    public function insert_many($data, $skip_validation = FALSE)
    {
        return $this->social_media->insert_many($data, $skip_validation);
    }
    
    public function update($id, $data, $skip_validation = FALSE)
    {
        return $this->social_media->update($id, $data, $skip_validation);
    }
    
    public function update_by($where, $data)
    {
         return $this->social_media->update_by($where, $data);
    }
    
    public function delete($id)
    {
        return $this->social_media->delete($id);
    }
    
    public function delete_by($where)
    {
        return $this->social_media->delete_by($where);
    }
    
    public function count_all()
    {
        return $this->social_media->count_all();
    }
    
    public function count_by($where)
    {
        return $this->social_media->count_by($where);
    }
    
    public function dropdown($key, $value, $option_label = NULL, $where = NULL)
    {
        if($where != NULL){
            $this->db->where($where);
        }
        
        return $this->social_media->dropdown($key, $value,$option_label);
    }
    
    public function order_by($criteria, $order = NULL)
    {
        $this->social_media->order_by($criteria,$order);
    }
    
}