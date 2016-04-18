<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of advertise_layout
 *
 * @author Chanthoeun
 */
class Advertise_layouts extends Admin_Controller {
    public  $validation_errors =  array();
    
    public function __construct() {
        parent::__construct();
        $this->load->model('advertise_layout_model', 'advertise_layout');
        $this->lang->load('advertise_layout');
        
        // message
        $this->validation_errors = $this->session->flashdata('validation_errors');
        $this->data['message'] = empty($this->validation_errors['errors']) ? $this->session->flashdata('message') : $this->validation_errors['errors'];
    }
    
    public function index()
    {
        parent::check_login();
        $this->data['advertise_layouts'] = $this->get_all();
        
        // process template
        $title = $this->lang->line('index_advertise_layout_heading');
        $this->data['title'] = $title;
        
        $layout_property = parent::load_index_script();
        
        $layout_property['breadcrumb'] = array($title);
        
        $layout_property['content']  = 'index';
        
        // menu
        $this->data['advertise_group_menu'] = TRUE; $this->data['advertise_layout_menu'] = TRUE;
        generate_template($this->data, $layout_property); 
    }
    
    // create
    public function create()
    {
        parent::check_login();
        // display form
        $this->data['caption'] = array(
            'name'  => 'caption',
            'id'    => 'caption',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['caption']) ? NULL : $this->validation_errors['post_data']['caption']
        );
        
        $this->data['amount'] = array(
            'name'  => 'amount',
            'id'    => 'amount',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['amount']) ? NULL : $this->validation_errors['post_data']['amount']
        );
        
        $this->data['width'] = array(
            'name'  => 'width',
            'id'    => 'width',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['width']) ? NULL : $this->validation_errors['post_data']['width']
        );
        
        $this->data['height'] = array(
            'name'  => 'height',
            'id'    => 'height',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['height']) ? NULL : $this->validation_errors['post_data']['height']
        );
        
        $this->data['price'] = array(
            'name'  => 'price',
            'id'    => 'price',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['price']) ? NULL : $this->validation_errors['post_data']['price']
        );
        
        $this->data['position'] = array(
            'name'  => 'position',
            'id'    => 'position',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['position']) ? 1 : $this->validation_errors['post_data']['position']
        );
        
        
        // process template
        $title = $this->lang->line('form_advertise_layout_create_heading');
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
        
        $layout_property['breadcrumb'] = array('advertise_layouts' => $this->lang->line('index_advertise_layout_heading'), $title);
        
        
        $layout_property['content']  = 'create';
        
        // menu
        $this->data['advertise_group_menu'] = TRUE; $this->data['advertise_layout_menu'] = TRUE;
        generate_template($this->data, $layout_property); 
    }

    // save
    public function store()
    {
        parent::check_login();
        $data = array(
            'caption'   => trim($this->input->post('caption')),
            'amount'    => trim($this->input->post('amount')),
            'width'     => trim($this->input->post('width')),
            'height'     => trim($this->input->post('height')),
            'price'     => trim($this->input->post('price')),
            'position'     => trim($this->input->post('position'))
        );

        if (($alid = $this->insert($data)) != FALSE)
        {
            // set log
            array_unshift($data, $alid);
            set_log('Created Advertise Layout', $data);

            $this->session->set_flashdata('message', $this->lang->line('form_advertise_layout_report_success'));
            redirect('advertise-layouts', 'refresh');
        }
        else
        {
            redirect_form_validation(validation_errors(), $this->input->post(), 'advertise-layouts/create');
        }
    }

    // edit
    public function edit($id)
    {
        parent::check_login();
        $advertise_layout = $this->get($id);
        $this->data['advertise_layout_id'] = array('advertise_layout_id' => $advertise_layout->id);
        $this->data['advertise_layout'] = $advertise_layout;

        // set log
        set_log('View Update Advertise Layout', $advertise_layout);
        
        // display form
        $this->data['caption'] = array(
            'name'  => 'caption',
            'id'    => 'caption',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['caption']) ? $advertise_layout->caption : $this->validation_errors['post_data']['caption']
        );
        
        $this->data['amount'] = array(
            'name'  => 'amount',
            'id'    => 'amount',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['amount']) ? $advertise_layout->amount : $this->validation_errors['post_data']['amount']
        );
        
        $this->data['width'] = array(
            'name'  => 'width',
            'id'    => 'width',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['width']) ? $advertise_layout->width : $this->validation_errors['post_data']['width']
        );
        
        $this->data['height'] = array(
            'name'  => 'height',
            'id'    => 'height',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['height']) ? $advertise_layout->height : $this->validation_errors['post_data']['height']
        );
        
        $this->data['price'] = array(
            'name'  => 'price',
            'id'    => 'price',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['price']) ? $advertise_layout->price : $this->validation_errors['post_data']['price']
        );
        
        $this->data['position'] = array(
            'name'  => 'position',
            'id'    => 'position',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['position']) ? $advertise_layout->position : $this->validation_errors['post_data']['position']
        );
        
        // process template
        $title = $this->lang->line('form_advertise_layout_edit_heading');
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
        
        $layout_property['breadcrumb'] = array('advertise_layouts' => $this->lang->line('index_advertise_layout_heading'), $title);
        
        $layout_property['content']  = 'edit';
        
        // menu
        $this->data['advertise_group_menu'] = TRUE; $this->data['advertise_layout_menu'] = TRUE;
        generate_template($this->data, $layout_property); 
    }
    
    // update
    public function modify()
    {
        parent::check_login();
        $id = $this->input->post('advertise_layout_id');
        $data = array(
            'caption'   => trim($this->input->post('caption')),
            'amount'    => trim($this->input->post('amount')),
            'width'     => trim($this->input->post('width')),
            'height'     => trim($this->input->post('height')),
            'price'     => trim($this->input->post('price')),
            'position'     => trim($this->input->post('position'))
        );
        
        $this->advertise_layout->validate[0]['rules'] = 'trim|required|xss_clean';
        if($this->update($id, $data))
        {
            // set log
            array_unshift($data, $id);
            set_log('Updated Advertise Layout', $data);

            $this->session->set_flashdata('message', $this->lang->line('form_advertise_layout_report_success'));
            redirect('advertise-layouts', 'refresh');
        }
        else
        {
            redirect_form_validation(validation_errors(), $this->input->post(), 'advertise-layouts/edit/'.$id);
        }
    }

    // delete
    public function destroy($id)
    {
        parent::check_login();
        $advertise_layout = $this->get($id);
        
        
        if($this->delete($id))
        {            
            // set log
            set_log('Deleted Advertise Layout', $advertise_layout);
            
            $this->session->set_flashdata('message', $this->lang->line('del_advertise_layout_report_success'));
        }
        else
        {
            $this->session->set_flashdata('message', $this->lang->line('del_advertise_layout_report_error'));
        }
        redirect('advertise-layouts', 'refresh');
    }
    
    public function get($id, $array = FALSE)
    {
        if($array == TRUE){
            return $this->advertise_layout->as_array()->get($id);
        }
        return $this->advertise_layout->as_object()->get($id);
    }
    
    public function get_by($where, $array = FALSE)
    {
        if($array == TRUE){
            return $this->advertise_layout->as_array()->get_by($where);
        }
        return $this->advertise_layout->as_object()->get_by($where);
    }
    
    public function get_all()
    {
        return $this->advertise_layout->get_all();
    }
    
    public function get_all_not_where_in($where) {
        return $this->advertise_layout->get_all_not_where_in($where);
    }
    
    public function get_many_by($where)
    {
        return $this->advertise_layout->get_many_by($where);
    }
    
    public function insert($data, $skip_validation = FALSE)
    {
        return $this->advertise_layout->insert($data, $skip_validation);
    }
    
    public function insert_many($data, $skip_validation = FALSE)
    {
        return $this->advertise_layout->insert_many($data, $skip_validation);
    }
    
    public function update($id, $data, $skip_validation = FALSE)
    {
        return $this->advertise_layout->update($id, $data, $skip_validation);
    }
    
    public function delete($id)
    {
        return $this->advertise_layout->delete($id);
    }
    
    public function delete_by($where)
    {
        return $this->advertise_layout->delete_by($where);
    }
    
    public function count_all()
    {
        return $this->advertise_layout->count_all();
    }
    
    public function count_by($where)
    {
        return $this->advertise_layout->count_by($where);
    }
    
    public function dropdown($key, $value, $option_label = NULL, $where = NULL)
    {
        if($where != NULL){
            $this->db->where($where);
        }
        
        return $this->advertise_layout->dropdown($key, $value,$option_label);
    }
    
}