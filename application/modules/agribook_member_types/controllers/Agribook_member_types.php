<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of agribook_member_type
 *
 * @author Chanthoeun
 */
class Agribook_member_types extends Admin_Controller {
    public  $validation_errors =  array();
    
    public function __construct() {
        parent::__construct();
        $this->load->model('agribook_member_type_model', 'agribook_member_type');
        $this->lang->load('agribook_member_type');
        
        // message
        $this->validation_errors = $this->session->flashdata('validation_errors');
        $this->data['message'] = empty($this->validation_errors['errors']) ? $this->session->flashdata('message') : $this->validation_errors['errors'];
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
    
    public function index()
    {
        parent::check_login();
        $this->data['agribook_member_types'] = $this->get_all();
        
        // process template
        $title = $this->lang->line('index_agribook_member_type_heading');
        $this->data['title'] = $title;
        
        $layout_property = parent::load_index_script();
        
        $layout_property['breadcrumb'] = array($title);
        
        $layout_property['content']  = 'index';
        
        // menu
        $this->data['setting_menu'] = TRUE; $this->data['agribook_member_types_menu'] = TRUE;
        generate_template($this->data, $layout_property); 
    }
    
    // create
    public function create($pid = FALSE)
    {
        parent::check_login();
        $this->load->helper('menu');
        // display form
        $this->data['caption'] = array(
            'name'  => 'caption',
            'id'    => 'caption',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['caption']) ? NULL : $this->validation_errors['post_data']['caption']
        );
        
        $this->data['price'] = array(
            'name'  => 'price',
            'id'    => 'price',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['price']) ? NULL : $this->validation_errors['post_data']['price']
        );
        
        // process template
        $title = $this->lang->line('form_agribook_member_type_create_heading');
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
        
        $layout_property['breadcrumb'] = array('agribook_member_types' => $this->lang->line('index_agribook_member_type_heading'), $title);
        
        $layout_property['content']  = 'create';
        
        // menu
        $this->data['setting_menu'] = TRUE; $this->data['agribook_member_types_menu'] = TRUE;
        generate_template($this->data, $layout_property); 
    }

    // save
    public function store()
    {
        parent::check_login();
        $data = array(
            'caption' => trim($this->input->post('caption')),
            'price' => trim($this->input->post('price'))
        );

        if (($atid = $this->insert($data)) != FALSE)
        {
            // set log
            array_unshift($data, $atid);
            set_log('Created Agribook Member Type', $data);

            $this->session->set_flashdata('message', $this->lang->line('form_agribook_member_type_report_success'));
            redirect('agribook-member-types', 'refresh');
        }
        else
        {
            redirect_form_validation(validation_errors(), $this->input->post(), 'agribook-member-types/create');
        }
    }

    // edit
    public function edit($id)
    {
        parent::check_login();
        $this->load->helper('menu');
        $agribook_member_type = $this->get($id);
        $this->data['agribook_member_type_id'] = array('agribook_member_type_id' => $agribook_member_type->id);
        $this->data['agribook_member_type'] = $agribook_member_type;

        // set log
        set_log('View Update Agribook Member Type', $agribook_member_type);
        
        // display form
        $this->data['caption'] = array(
            'name'  => 'caption',
            'id'    => 'caption',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['caption']) ? $agribook_member_type->caption : $this->validation_errors['post_data']['caption']
        );
        
        $this->data['price'] = array(
            'name'  => 'price',
            'id'    => 'price',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['price']) ? $agribook_member_type->price : $this->validation_errors['post_data']['price']
        );
        
        // process template
        $title = $this->lang->line('form_agribook_member_type_edit_heading');
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
        
        $layout_property['breadcrumb'] = array('agribook_member_types' => $this->lang->line('index_agribook_member_type_heading'), $title);
        
        $layout_property['content']  = 'edit';
        
        // menu
        $this->data['setting_menu'] = TRUE; $this->data['agribook_member_types_menu'] = TRUE;
        generate_template($this->data, $layout_property); 
    }
    
    // update
    public function modify()
    {
        parent::check_login();
        $id = $this->input->post('agribook_member_type_id');

        $data = array(
            'caption' => trim($this->input->post('caption')),
            'price' => trim($this->input->post('price'))
        );
        
        $this->agribook_member_type->validate[0]['rules'] = 'trim|required|xss_clean';
        if($this->update($id, $data))
        {
            // set log
            array_unshift($data, $id);
            set_log('Updated Agribook Member Type', $data);

            $this->session->set_flashdata('message', $this->lang->line('form_agribook_member_type_report_success'));
            redirect('agribook-member-types', 'refresh');
        }
        else
        {
            redirect_form_validation(validation_errors(), $this->input->post(), 'agribook-member-types/edit/'.$id);
        }
    }

    // delete
    public function destroy($id)
    {
        parent::check_login();
        $agribook_member_type = $this->get($id);
        
        if($this->delete($id))
        {            
            // set log
            set_log('Deleted Agribook Member Type', $agribook_member_type);
            
            $this->session->set_flashdata('message', $this->lang->line('del_agribook_member_type_report_success'));
        }
        else
        {
            $this->session->set_flashdata('message', $this->lang->line('del_agribook_member_type_report_error'));
        }
        redirect('agribook-member-types', 'refresh');
    }
    
    public function get($id, $array = FALSE)
    {
        if($array == TRUE){
            return $this->agribook_member_type->as_array()->get($id);
        }
        return $this->agribook_member_type->as_object()->get($id);
    }
      
    public function get_by($where, $array = FALSE)
    {
        if($array == TRUE){
            return $this->agribook_member_type->as_array()->get_by($where);
        }
        return $this->agribook_member_type->as_object()->get_by($where);
    }
    
    public function get_all()
    {
        return $this->agribook_member_type->get_all();
    }
    
    public function get_many_by($where)
    {
        return $this->agribook_member_type->get_many_by($where);
    }
    
    public function insert($data, $skip_validation = FALSE)
    {
        return $this->agribook_member_type->insert($data, $skip_validation);
    }
    
    public function insert_many($data, $skip_validation = FALSE)
    {
        return $this->agribook_member_type->insert_many($data, $skip_validation);
    }
    
    public function update($id, $data, $skip_validation = FALSE)
    {
        return $this->agribook_member_type->update($id, $data, $skip_validation);
    }
    
    public function delete($id)
    {
        return $this->agribook_member_type->delete($id);
    }
    
    public function delete_by($where)
    {
        return $this->agribook_member_type->delete_by($where);
    }
    
    public function count_all()
    {
        return $this->agribook_member_type->count_all();
    }
    
    public function count_by($where)
    {
        return $this->agribook_member_type->count_by($where);
    }
    
    public function dropdown($key, $value, $option_label = NULL, $where = NULL)
    {
        if($where != NULL){
            $this->db->where($where);
        }
        
        return $this->agribook_member_type->dropdown($key, $value,$option_label);
    }
    
    public function order_by($criteria, $order = NULL)
    {
        $this->agribook_member_type->order_by($criteria,$order);
    }

}