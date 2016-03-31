<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of people_group
 *
 * @author Chanthoeun
 */
class People_groups extends Admin_Controller {
    public  $validation_errors =  array();
    
    public function __construct() {
        parent::__construct();
        $this->load->model('people_group_model', 'people_group');
        $this->lang->load('people_group');
        
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
        $this->data['groups'] = $this->get_all();
        
        // process template
        $title = $this->lang->line('index_people_group_heading');
        $this->data['title'] = $title;
        
        $layout_property = parent::load_index_script();
        
        $layout_property['breadcrumb'] = array($title);
        
        $layout_property['content']  = 'index';
        
        // menu
        $this->data['setting_menu'] = TRUE; $this->data['people_groups_menu'] = TRUE;
        generate_template($this->data, $layout_property); 
    }

    // create
    public function create()
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
        
        $this->data['display'] = array(
            'name'          => 'display',
            'id'            => 'display',
            'value'         => 1,
            'checked'       => empty($this->validation_errors['post_data']['display']) ? FALSE : $this->validation_errors['post_data']['display']
        );
        
        // process template
        $title = $this->lang->line('form_people_group_create_heading');
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
        $layout_property['breadcrumb'] = array('people-groups' => $this->lang->line('index_people_group_heading'), $title);
        
        $layout_property['content']  = 'create';
        
        // menu
        $this->data['setting_menu'] = TRUE; $this->data['people_groups_menu'] = TRUE;
        generate_template($this->data, $layout_property);
    }

    // save
    public function store()
    {
        parent::check_login();
        $data = array(
            'caption'   => trim($this->input->post('caption')),
            'slug'     => str_replace(' ', '-', strtolower(trim($this->input->post('caption')))),
            'display'   => $this->input->post('display'),
            'order'    => $this->get_next_order('order')
        );

        if(($pgid = $this->insert($data)) != FALSE)
        {
            // set log
            array_unshift($data, $pgid);
            set_log('Created People Group', $data);

            $this->session->set_flashdata('message', $this->lang->line('form_people_group_report_success'));
            redirect('people-groups', 'refresh');
        }
        else
        {
            redirect_form_validation(validation_errors(), $this->input->post(), 'people-groups/create');
        }
    }

    // edit
    public function edit($id)
    {
        parent::check_login();        
        // get people_group
        $people_group = $this->get($id);
        
        $this->data['people_group_id'] = array('people_group_id' => $people_group->id);
        $this->data['people_group'] = $people_group;
            
        // set log
        set_log('View for Update People Group', $people_group);
        
        // display form
        $this->data['caption'] = array(
            'name'  => 'caption',
            'id'    => 'caption',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['caption']) ? $people_group->caption : $this->validation_errors['post_data']['caption']
        );
        
        $this->data['display'] = array(
            'name'          => 'display',
            'id'            => 'display',
            'value'         => 1,
            'checked'       => empty($this->validation_errors['post_data']['display']) ? $people_group->display : $this->validation_errors['post_data']['display']
        );
        
        // process template
        $title = $this->lang->line('form_people_group_edit_heading');
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
        $layout_property['breadcrumb'] = array('people-groups' => $this->lang->line('index_people_group_heading'), $title);
        
        $layout_property['content']  = 'edit';
        
        // menu
        $this->data['setting_menu'] = TRUE; $this->data['people_groups_menu'] = TRUE;
        generate_template($this->data, $layout_property);
    }

    // update
    public function modify()
    {
        parent::check_login();
        $id = $this->input->post('people_group_id');
        $data = array(
            'caption'   => trim($this->input->post('caption')),
            'slug'     => str_replace(' ', '-', strtolower(trim($this->input->post('caption')))),
            'display'   => $this->input->post('display')
        );
        
        $this->people_group->validate[0]['rules'] = 'trim|required|xss_clean';

        if($this->update($id, $data))
        {
            // set log
            array_unshift($data, $id);
            set_log('Updated People Group',$data);

            $this->session->set_flashdata('message', $this->lang->line('form_people_group_report_success'));

            redirect('people-groups', 'refresh');
        }
        else
        {
            redirect_form_validation(validation_errors(), $this->input->post(), 'people-groups/edit/'.$id);
        }
    }

    // delete
    public function destroy($id)
    {
        parent::check_login();       
        $people_group = $this->get($id);
        
        // delete people_group
        if($this->delete($id))
        {
            
            // set log
            set_log('Deleted People Group', $people_group);
            
            $this->session->set_flashdata('message', $this->lang->line('del_people_group_report_success'));
            redirect('people-groups', 'refresh');
        }
        else
        {
            $this->session->set_flashdata('message', $this->lang->line('del_people_group_report_error'));
        }
        redirect('people-groups', 'refresh');
    }
    
    public function get($id, $array = FALSE)
    {
        if($array == TRUE){
            return $this->people_group->as_array()->get($id);
        }
        return $this->people_group->as_object()->get($id);
    }
    
    public function get_by($where, $array = FALSE)
    {
        if($array == TRUE){
            return $this->people_group->as_array()->get_by($where);
        }
        return $this->people_group->as_object()->get_by($where);
    }
    
    public function get_all($order_by = FALSE, $limit = FALSE, $offset = 0)
    {
        if($order_by != FALSE)
        {
            $this->people_group->order_by($order_by);
        }
        
        if($limit != FALSE)
        {
            $this->people_group->limit($limit, $offset);
        }
        return $this->people_group->get_all();
    }
    
    public function get_many_by($where, $order_by = FALSE, $limit = FALSE, $offset = 0)
    {
        if($order_by != FALSE)
        {
            $this->people_group->order_by($order_by);
        }
        
        if($limit != FALSE)
        {
            $this->people_group->limit($limit, $offset);
        }
        return $this->people_group->get_many_by($where);
    }
    
    public function insert($data, $skip_validation = FALSE)
    {
        return $this->people_group->insert($data, $skip_validation);
    }
    
    public function insert_many($data, $skip_validation = FALSE)
    {
        return $this->people_group->insert_many($data, $skip_validation);
    }
    
    public function update($id, $data, $skip_validation = FALSE)
    {
        return $this->people_group->update($id, $data, $skip_validation);
    }
    
    public function delete($id)
    {
        return $this->people_group->delete($id);
    }
    
    public function delete_by($where)
    {
        return $this->people_group->delete_by($where);
    }
    
    public function count_all()
    {
        return $this->people_group->count_all();
    }
    
    public function count_by($where)
    {
        return $this->people_group->count_by($where);
    }
    
    public function dropdown($key, $value, $option_label = NULL, $where = NULL)
    {
        if($where != NULL){
            $this->db->where($where);
        }
        
        return $this->people_group->dropdown($key, $value,$option_label);
    }
    
    public function order_by($criteria, $order = NULL)
    {
        $this->people_group->order_by($criteria,$order);
    }
    
    public function get_next_order($field, $where = FALSE)
    {
        return $this->people_group->get_next_order($field, $where);
    }
}