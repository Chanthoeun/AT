<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of member_type
 *
 * @author chanthoeun
 */
class Member_type extends Admin_Controller {
    //put your code here
    
    function __construct() {
        parent::__construct();
        $this->load->model('member_type_model','member_type');
        
        $this->lang->load('member_type');
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
    
    // list member type
    function index(){
        parent::check_login();        
        //set the flash data error message if there is one
        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
        
        $this->data['member_types'] = $this->member_type->get_all();
        
        // process template
        $title = $this->lang->line('index_member_type_heading');
        $this->data['title'] = $title;
        
        $layout_property = parent::load_index_script();
        
        $layout_property['breadcrumb'] = array($title);
        
        $layout_property['content']  = 'index';
        
        // menu
        $this->data['account_menu'] = TRUE; $this->data['member_type_menu'] = TRUE;
        generate_template($this->data, $layout_property);
    }
    
    // create member type
    public function create()
    {
        parent::check_login();
        
        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
        
        $this->data['caption'] = array(
            'name'  => 'caption',
            'id'    => 'caption',
            'class' => 'form-control',
            'placeholder' => 'Member type name',
            'value' => (isset($validation_errors['post_data']['caption']) ? $validation_errors['post_data']['caption'] : NULL),
        );
        
        // process template
        $title = $this->lang->line('form_member_type_create_heading');
        $this->data['title'] = $title;
        $layout_property['css'] = array('https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css' => FALSE,
                                        'css/plugins/metisMenu/metisMenu.min.css',
                                        'css/sb-admin-2.css',
                                        'font-awesome-4.1.0/css/font-awesome.min.css'
                                        );
        $layout_property['js']  = array('https://code.jquery.com/jquery-1.11.1.min.js' => FALSE,
                                        'https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js' => FALSE,
                                        'js/plugins/metisMenu/metisMenu.min.js',
                                        'js/sb-admin-2.js'
                                        );        
        $layout_property['breadcrumb'] = array('member_type' => $this->lang->line('index_member_type_heading'), $title);
        
        $layout_property['content']  = 'create';
        
        // menu
        $this->data['account_menu'] = TRUE; $this->data['member_type_menu'] = TRUE;
        generate_template($this->data, $layout_property);
    }
    
    // save member type
    public function store()
    {
        parent::check_login();
        $data = array(
            'caption'=> ucwords(strtolower(trim($this->input->post('caption')))), 
            'slug' => url_title(trim($this->input->post('caption')), '-', TRUE), 
        );
        
        if(($mid = $this->member_type->insert($data))){
            // set log
            array_unshift($data, $mid);
            set_log('Created Member Type', $data);
            
            $this->session->set_flashdata('message', $this->lang->line('form_member_type_save_label'));
            redirect('member_type','refresh');
        }else{
            redirect_form_validation(validation_errors(), $this->input->post(), 'member_type/create');
        }
    }
    
    // edit member type
    public function edit($id)
    {
        parent::check_login();
        $member_type = $this->get($id);
        
        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
        
        $this->data['member_type_id'] = array(
            'member_type_id'  => $member_type->id
        );
        
        $this->data['caption'] = array(
            'name'  => 'caption',
            'id'    => 'caption',
            'class' => 'form-control',
            'placeholder' => 'Member type name',
            'value' => (isset($validation_errors['post_data']['caption']) ? $validation_errors['post_data']['caption'] : $member_type->caption),
        );
        
        // process template
        $title = $this->lang->line('form_member_type_edit_heading');
        $this->data['title'] = $title;
        $layout_property['css'] = array('https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css' => FALSE,
                                        'css/plugins/metisMenu/metisMenu.min.css',
                                        'css/sb-admin-2.css',
                                        'font-awesome-4.1.0/css/font-awesome.min.css'
                                        );
        $layout_property['js']  = array('https://code.jquery.com/jquery-1.11.1.min.js' => FALSE,
                                        'https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js' => FALSE,
                                        'js/plugins/metisMenu/metisMenu.min.js',
                                        'js/sb-admin-2.js'
                                        );        
        $layout_property['breadcrumb'] = array('member_type' => $this->lang->line('index_member_type_heading'), $title);
        
        $layout_property['content']  = 'edit';
        
        // menu
        $this->data['account_menu'] = TRUE; $this->data['member_type_menu'] = TRUE;
        generate_template($this->data, $layout_property);
    }
    
    // update member type
    public function modify()
    {
        parent::check_login();
        $data = array(
            'caption'=> ucwords(strtolower(trim($this->input->post('caption')))),
            'slug' => url_title(trim($this->input->post('caption')), '-', TRUE), 
        );
        
        $id = trim($this->input->post('member_type_id'));
        
        $this->member_type->validate[0]['rules'] = 'trim|required|xss_clean';
        if($this->member_type->update($id,$data)){
            // set log
            array_unshift($data, $id);
            set_log('Updated Member Type', $data);
            
            $this->session->set_flashdata('message', $this->lang->line('form_member_type_save_label'));
            redirect('member_type','refresh');
        }else{
            redirect_form_validation(validation_errors(), $this->input->post(), 'member_type/edit/'.$id);
        }
    }
    
    // delete member type
    public function destroy($id)
    {
        parent::check_login();
        $member_type = $this->get($id);
        
        if($this->member_type->delete($id)){
            // set log
            set_log('Deleted Member Type', $member_type);
            $this->session->set_flashdata('message', $this->lang->line('del_member_type_successed'));
        }else{
            $this->session->set_flashdata('message', $this->lang->line('del_member_type_error'));
        }
        redirect('member_type','refresh');
    }  
    
    public function get($id, $array = FALSE)
    {
        if($array == TRUE){
            return $this->member_type->as_array()->get($id);
        }
        return $this->member_type->as_object()->get($id);
    }
    
    
    public function get_all($order_by = FALSE, $limit = FALSE, $offset = 0)
    {
        if($order_by != FALSE)
        {
            $this->order_by($order_by);
        }
        if($limit != FALSE)
        {
            $this->member_type->limit($limit, $offset);
        }
        return $this->member_type->get_all();
    }
    
    
    public function insert($data, $skip_validation = FALSE)
    {
        return $this->member_type->insert($data, $skip_validation);
    }
    
    
    public function update($id, $data, $skip_validation = FALSE)
    {
        return $this->member_type->update($id, $data, $skip_validation);
    }
    
    public function delete($id)
    {
        return $this->member_type->delete($id);
    }
    
    public function dropdown($key, $value, $option_label = NULL, $where = NULL)
    {
        if($where != NULL){
            $this->db->where($where);
        }
        
        return $this->member_type->dropdown($key, $value,$option_label);
    }
    
}
