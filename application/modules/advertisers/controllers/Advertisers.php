<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of advertiser
 *
 * @author Chanthoeun
 */
class Advertisers extends Admin_Controller {
    public  $validation_errors =  array();
    
    public function __construct() {
        parent::__construct();
        $this->load->model('advertiser_model', 'advertiser');
        $this->lang->load('advertiser');
        
        // message
        $this->validation_errors = $this->session->flashdata('validation_errors');
        $this->data['message'] = empty($this->validation_errors['errors']) ? $this->session->flashdata('message') : $this->validation_errors['errors'];
    }
    
    public function index()
    {
        parent::check_login();
        $this->data['advertisers'] = $this->get_all();
        
        // process template
        $title = $this->lang->line('index_advertiser_heading');
        $this->data['title'] = $title;
        
        $layout_property = parent::load_index_script();
        
        $layout_property['breadcrumb'] = array($title);
        
        $layout_property['content']  = 'index';
        
        // menu
        $this->data['advertise_group_menu'] = TRUE; $this->data['advertiser_group_menu'] = TRUE; $this->data['advertiser_recently_menu'] = TRUE;
        generate_template($this->data, $layout_property); 
    }
    
    // create
    public function create($pid = FALSE)
    {
        parent::check_login();
        // display form
        $this->data['name'] = array(
            'name'  => 'name',
            'id'    => 'name',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['name']) ? NULL : $this->validation_errors['post_data']['name']
        );
        
        $this->data['address'] = array(
            'name'  => 'address',
            'id'    => 'address',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['address']) ? NULL : $this->validation_errors['post_data']['address']
        );
        
        $this->data['telephone'] = array(
            'name'  => 'telephone',
            'id'    => 'telephone',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['telephone']) ? NULL : $this->validation_errors['post_data']['telephone']
        );
        
        $this->data['email'] = array(
            'name'  => 'email',
            'id'    => 'email',
            'type'  => 'email',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['email']) ? NULL : $this->validation_errors['post_data']['email']
        );
        
        // process template
        $title = $this->lang->line('form_advertiser_create_heading');
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
        
        $layout_property['breadcrumb'] = array('advertisers' => $this->lang->line('index_advertiser_heading'), $title);        
        
        $layout_property['content']  = 'create';
        
        // menu
        $this->data['advertise_group_menu'] = TRUE; $this->data['advertiser_group_menu'] = TRUE; $this->data['advertiser_create_menu'] = TRUE;
        generate_template($this->data, $layout_property); 
    }

    // save
    public function store()
    {
        parent::check_login();
        $data = array(
            'name' => trim($this->input->post('name')),
            'address'    => trim($this->input->post('address')),
            'telephone' => trim($this->input->post('telephone')),
            'email'     => trim($this->input->post('email')),
        );

        if (($aid = $this->insert($data)) != FALSE)
        {
            // set log
            array_unshift($data, $aid);
            set_log('Created Advertiser', $data);

            $this->session->set_flashdata('message', $this->lang->line('form_advertiser_report_success'));
            redirect('advertisers/view/'.$aid, 'refresh');
        }
        else
        {
            redirect_form_validation(validation_errors(), $this->input->post(), 'advertisers/create');
        }
    }

    // edit
    public function edit($id)
    {
        parent::check_login();
        $advertiser = $this->get($id);
        $this->data['advertiser_id'] = array('advertiser_id' => $advertiser->id);
        $this->data['advertiser'] = $advertiser;

        // set log
        set_log('View Update Advertiser', $advertiser);
        
        // display form
        $this->data['name'] = array(
            'name'  => 'name',
            'id'    => 'name',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['name']) ? $advertiser->name : $this->validation_errors['post_data']['name']
        );
        
        $this->data['address'] = array(
            'name'  => 'address',
            'id'    => 'address',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['address']) ? $advertiser->address : $this->validation_errors['post_data']['address']
        );
        
        $this->data['telephone'] = array(
            'name'  => 'telephone',
            'id'    => 'telephone',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['telephone']) ? $advertiser->telephone : $this->validation_errors['post_data']['telephone']
        );
        
        $this->data['email'] = array(
            'name'  => 'email',
            'id'    => 'email',
            'type'  => 'email',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['email']) ? $advertiser->email : $this->validation_errors['post_data']['email']
        );
        
        // process template
        $title = $this->lang->line('form_advertiser_edit_heading');
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
        
        $layout_property['breadcrumb'] = array('advertisers' => $this->lang->line('index_advertiser_heading'), $title);
        
        $layout_property['content']  = 'edit';
        
        // menu
        $this->data['advertise_group_menu'] = TRUE; $this->data['advertiser_group_menu'] = TRUE; $this->data['advertiser_recently_menu'] = TRUE;
        generate_template($this->data, $layout_property); 
    }
    
    // update
    public function modify()
    {
        parent::check_login();
        $id = $this->input->post('advertiser_id');
        $data = array(
            'name' => trim($this->input->post('name')),
            'address'    => trim($this->input->post('address')),
            'telephone' => trim($this->input->post('telephone')),
            'email'     => trim($this->input->post('email')),
        );
        
        $this->advertiser->validate[0]['rules'] = 'trim|required|xss_clean';
        if($this->update($id, $data))
        {
            // set log
            array_unshift($data, $id);
            set_log('Updated Advertiser', $data);

            $this->session->set_flashdata('message', $this->lang->line('form_advertiser_report_success'));
            redirect('advertisers/view/'.$id, 'refresh');
        }
        else
        {
            redirect_form_validation(validation_errors(), $this->input->post(), 'advertisers/edit/'.$id);
        }
    }

    // delete
    public function destroy($id)
    {
        parent::check_login();
        $advertiser = $this->get($id);
        
        if($this->delete($id))
        {            
            // set log
            set_log('Deleted Advertiser', $advertiser);
            
            $this->session->set_flashdata('message', $this->lang->line('del_advertiser_report_success'));
        }
        else
        {
            $this->session->set_flashdata('message', $this->lang->line('del_advertiser_report_error'));
        }
        redirect('advertisers', 'refresh');
    }
    
    public function search() {
        parent::check_login();
        $this->form_validation->set_rules('search', $this->lang->line('search_caption_label'), 'trim|required|xss_clean', array('required' => '%s តម្រូវឲ្យ​មាន'));
        if($this->form_validation->run() == TRUE)
        {
            $search = trim($this->input->post('search'));
            if(is_numeric($search))
            {
                $this->data['advertisers'] = $this->get_like(array('telephone' => $search)); 
            }
            else if(valid_email($search))
            {
                $this->data['advertisers'] = $this->get_like(array('email' => $search)); 
            }
            else
            {
                $this->data['advertisers'] = $this->get_like(array('name' => $search)); 
            }
            
        }
        
        // message error
        $this->data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
        
        $this->data['search'] = array(
            'name'  => 'search',
            'id'    => 'search',
            'class' => 'form-control',
            'style' => 'width: 700px;',
            'placeholder' => $this->lang->line('search_placeholder_label'),
            'value' => set_value('search')
        );
        
        // process template
        $title = $this->lang->line('search_heading_label');
        $this->data['title'] = $title;
        
        $layout_property = parent::load_index_script('css/jquery-ui.css', 'js/jquery-ui.min.js');
        
        $name = array_to_string($this->get_field('name'), 'name');
        $telephone = array_to_string($this->get_field('telephone'), 'telephone');
        $email = array_to_string($this->get_field('email'), 'email');
        $layout_property['script'] = '$(function() { var availableTags = ['.$name.$telephone.$email.'];  $( "#search" ).autocomplete({ source: availableTags }); });';
        
        $layout_property['breadcrumb'] = array('advertisers' => $this->lang->line('index_advertiser_heading'), $title);
        
        $layout_property['content']  = 'search';
        
        // menu
        $this->data['advertise_group_menu'] = TRUE; $this->data['advertiser_group_menu'] = TRUE; $this->data['advertiser_search_menu'] = TRUE;
        generate_template($this->data, $layout_property); 
    }
    
    public function view($id) {
        parent::check_login();
        $this->lang->load('advertises/advertise');
        $this->data['advertiser'] = $this->get($id);
        $this->data['advertises'] = Modules::run('advertises/get_all_records', array('advertise.advertiser_id' => $this->data['advertiser']->id));
        
        // process template
        $title = $this->data['advertiser']->name;
        $this->data['title'] = $title;
        $layout_property['css'] = array('https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css' => FALSE,
                                        'css/plugins/metisMenu/metisMenu.min.css',
                                        'css/sb-admin-2.css',
                                        'font-awesome-4.1.0/css/font-awesome.min.css',
                                        'css/colorbox/colorbox.min.css'
                                        );
        $layout_property['js']  = array('https://code.jquery.com/jquery-1.11.1.min.js' => FALSE,
                                        'https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js' => FALSE,
                                        'js/plugins/metisMenu/metisMenu.min.js',
                                        'js/sb-admin-2.js',
                                        'js/jquery.colorbox.min.js'
                                        ); 
        $layout_property['script'] = '$(document).ready(function(){$(".color-box").colorbox({rel:"color-box",transition:"fade"})});';
        $layout_property['breadcrumb'] = array('advertisers' => $this->lang->line('index_advertiser_heading'), $title);
        
        $layout_property['content']  = 'view';
        
        // menu
        $this->data['advertise_group_menu'] = TRUE; $this->data['advertiser_group_menu'] = TRUE; $this->data['advertiser_recently_menu'] = TRUE;
        generate_template($this->data, $layout_property);
    }
    
    public function get($id, $array = FALSE)
    {
        if($array == TRUE){
            return $this->advertiser->as_array()->get($id);
        }
        return $this->advertiser->as_object()->get($id);
    }
    
    public function get_by($where, $array = FALSE)
    {
        if($array == TRUE){
            return $this->advertiser->as_array()->get_by($where);
        }
        return $this->advertiser->as_object()->get_by($where);
    }
    
    public function get_field($field, $where = FALSE, $array = FALSE) {
        return $this->advertiser->get_field($field, $where, $array);
    }
    
    public function get_all()
    {
        return $this->advertiser->get_all();
    }
    
    public function get_many_by($where)
    {
        return $this->advertiser->get_many_by($where);
    }
    
    public function get_like($like, $condition = 'both') {
        return $this->advertiser->get_like($like, $condition);
    }
    
    public function insert($data, $skip_validation = FALSE)
    {
        return $this->advertiser->insert($data, $skip_validation);
    }
    
    public function insert_many($data, $skip_validation = FALSE)
    {
        return $this->advertiser->insert_many($data, $skip_validation);
    }
    
    public function update($id, $data, $skip_validation = FALSE)
    {
        return $this->advertiser->update($id, $data, $skip_validation);
    }
    
    public function delete($id)
    {
        return $this->advertiser->delete($id);
    }
    
    public function delete_by($where)
    {
        return $this->advertiser->delete_by($where);
    }
    
    public function count_all()
    {
        return $this->advertiser->count_all();
    }
    
    public function count_by($where)
    {
        return $this->advertiser->count_by($where);
    }
    
    public function dropdown($key, $value, $option_label = NULL, $where = NULL)
    {
        if($where != NULL){
            $this->db->where($where);
        }
        
        return $this->advertiser->dropdown($key, $value,$option_label);
    }
}