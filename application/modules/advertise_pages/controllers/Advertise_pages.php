<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of advertise_page
 *
 * @author Chanthoeun
 */
class Advertise_pages extends Admin_Controller {
    public  $validation_errors =  array();
    
    public function __construct() {
        parent::__construct();
        $this->load->model('advertise_page_model', 'advertise_page');
        $this->lang->load('advertise_page');
        
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
        $this->data['advertise_pages'] = $this->get_all();
        
        // process template
        $title = $this->lang->line('index_advertise_page_heading');
        $this->data['title'] = $title;
        
        $layout_property = parent::load_index_script();
        
        $layout_property['breadcrumb'] = array($title);
        
        $layout_property['content']  = 'index';
        
        // menu
        $this->data['advertise_group_menu'] = TRUE; $this->data['advertise_page_menu'] = TRUE;
        generate_template($this->data, $layout_property); 
    }
    
    public function get_index($pid)
    {
        parent::check_login();
        $this->lang->load('advertise_layouts/advertise_layout');
        $page = $this->get($pid);
        $layouts = Modules::run('advertise_page_layouts/get_all_records', array('page_id' => $page->id));
        $this->data['page'] = $page;
        $this->data['layouts'] = $layouts;
        
        
        // process template
        $title = $page->caption;
        $this->data['title'] = $title;
        
        $layout_property = parent::load_index_script();
        
        $layout_property['breadcrumb'] = array('advertise-pages' => $this->lang->line('index_advertise_page_heading'), $title);
        
        $layout_property['content']  = 'list_layout';
        
        // menu
        $this->data['advertise_group_menu'] = TRUE; $this->data['advertise_page_menu'] = TRUE;
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
        
        $this->data['layouts'] = Modules::run('advertise_layouts/get_all');
        
        // process template
        $title = $this->lang->line('form_advertise_page_create_heading');
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
        
        $layout_property['breadcrumb'] = array('advertise_pages' => $this->lang->line('index_advertise_page_heading'), $title);
        
        $layout_property['content']  = 'create';
        
        // menu
        $this->data['advertise_group_menu'] = TRUE; $this->data['advertise_page_menu'] = TRUE;
        generate_template($this->data, $layout_property); 
    }

    // save
    public function store()
    {
        parent::check_login();
        $data = array(
            'caption' => trim(ucwords($this->input->post('caption'))),
            'slug'    => url_title($this->input->post('caption'), '-', TRUE),
        );

        if (($apid = $this->insert($data)) != FALSE)
        {
            $layouts = $this->input->post('layout');
            foreach ($layouts as $layout)
            {
                Modules::run('advertise_page_layouts/insert', array('page_id' => $apid, 'layout_id' => $layout));
            }
            
            // set log
            array_unshift($data, $apid);
            set_log('Created Advertise Page', $data);

            $this->session->set_flashdata('message', $this->lang->line('form_advertise_page_report_success'));
            redirect('advertise-pages', 'refresh');
        }
        else
        {
            redirect_form_validation(validation_errors(), $this->input->post(), 'advertise-pages/create');
        }
    }

    // edit
    public function edit($id)
    {
        parent::check_login();
        $advertise_page = $this->get($id);
        $this->data['advertise_page_id'] = array('advertise_page_id' => $advertise_page->id);
        $this->data['advertise_page'] = $advertise_page;

        // set log
        set_log('View Update Advertise Page', $advertise_page);
        
        // display form
        $this->data['caption'] = array(
            'name'  => 'caption',
            'id'    => 'caption',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['caption']) ? $advertise_page->caption : $this->validation_errors['post_data']['caption']
        );
        
        // process template
        $title = $this->lang->line('form_advertise_page_edit_heading');
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
        
        $layout_property['breadcrumb'] = array('advertise_pages' => $this->lang->line('index_advertise_page_heading'), $title);
        
        $layout_property['content']  = 'edit';
        
        // menu
        $this->data['advertise_group_menu'] = TRUE; $this->data['advertise_page_menu'] = TRUE;
        generate_template($this->data, $layout_property); 
    }
    
    // update
    public function modify()
    {
        parent::check_login();
        $id = $this->input->post('advertise_page_id');
        $data = array(
            'caption' => trim(ucwords($this->input->post('caption'))),
            'slug'    => url_title($this->input->post('caption'), '-', TRUE)
        );
        
        $this->advertise_page->validate[0]['rules'] = 'trim|required|xss_clean';
        $this->advertise_page->validate[1]['rules'] = 'trim|xss_clean';
        if($this->update($id, $data))
        {
            // set log
            array_unshift($data, $id);
            set_log('Updated Advertise Page', $data);

            $this->session->set_flashdata('message', $this->lang->line('form_advertise_page_report_success'));
            redirect('advertise-pages', 'refresh');
        }
        else
        {
            redirect_form_validation(validation_errors(), $this->input->post(), 'advertise-pages/edit/'.$id);
        }
    }

    // delete
    public function destroy($id)
    {
        parent::check_login();
        $advertise_page = $this->get($id);
        
        if($this->delete($id))
        {
            Modules::run('advertise_page_layouts/delete_by', array('page_id' => $advertise_page->id));
            
            // set log
            set_log('Deleted Advertise Page', $advertise_page);
            
            $this->session->set_flashdata('message', $this->lang->line('del_advertise_page_report_success'));
        }
        else
        {
            $this->session->set_flashdata('message', $this->lang->line('del_advertise_page_report_error'));
        }
        redirect('advertise-pages', 'refresh');
    }
    
    public function add_layout($page_id){
        parent::check_login();
        $page = $this->get($page_id);
        $get_layouts = Modules::run('advertise_page_layouts/get_many_by', array('page_id' => $page->id));
        $this->form_validation->set_rules('layout[]', $this->lang->line('form_advertise_layout_label'), 'trim|required|xss_clean', array('required' => '%s តម្រូវ​ឲ្យ​មាន​'));
        if($this->form_validation->run() == TRUE)
        {
            $post_layouts = $this->input->post('layout');
            foreach ($post_layouts as $post_layout)
            {
                Modules::run('advertise_page_layouts/insert', array('page_id' => $page_id, 'layout_id' => $post_layout));
            }
            
            $this->session->set_flashdata('message', $this->lang->line('form_advertise_page_layout_report_success'));
            redirect('advertise-pages/'.$page->id, 'refresh');
        }
        
        // message error
        $this->data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
        
        if($get_layouts == FALSE)
        {
            $this->data['layouts'] = Modules::run('advertise_layouts/get_all');
        }
        else
        {
            foreach ($get_layouts as $layout)
            {
                $layout_id[] = $layout->layout_id;
            }
            
            $this->data['layouts'] = Modules::run('advertise_layouts/get_all_not_where_in', $layout_id);
        }
        
        // process template
        $title = $this->lang->line('form_advertise_page_add_layout_heading');
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
        
        $layout_property['breadcrumb'] = array('advertise_pages' => $this->lang->line('index_advertise_page_heading'), 'advertise-pages/'.$page->id => $page->caption, $title);
        
        $layout_property['content']  = 'add_layout';
        
        // menu
        $this->data['advertise_group_menu'] = TRUE; $this->data['advertise_page_menu'] = TRUE;
        generate_template($this->data, $layout_property); 
    }
    
    public function edit_layout($layout_id){
        parent::check_login();
        $page_layout = Modules::run('advertise_page_layouts/get_detail', $layout_id);
        $this->data['page_layout'] = $page_layout;
        
        $this->form_validation->set_rules('layout', $this->lang->line('form_advertise_page_layout_report_success'), 'trim|xss_clean');
        if($this->form_validation->run() == TRUE)
        {
            $data = array(
                'layout_id' => $this->input->post('layout')
            );
            if(Modules::run('advertise_page_layouts/update', $page_layout->id, $data))
            {
                // set log
                array_unshift($data, $page_layout->id);
                set_log('Update Advertise Page Layout', $data);

                $this->session->set_flashdata('message', $this->lang->line('form_advertise_page_layout_report_success'));
                redirect('advertise-pages/'.$page_layout->page_id, 'refresh');
            }
        }
        
        // message error
        $this->data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
        
        $this->data['layout'] = form_dropdown('layout', Modules::run('advertise_layouts/dropdown', 'id', 'caption'), set_value('layout', $page_layout->layout_id), array('class' => 'form-control', 'id' => 'layout'));
        
        // process template
        $title = $this->lang->line('form_advertise_page_edit_layout_heading');
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
        
        $layout_property['breadcrumb'] = array('advertise_pages' => $this->lang->line('index_advertise_page_heading'), 'advertise-pages/'.$page_layout->page_id => $page_layout->page, $title);
        
        $layout_property['content']  = 'edit_layout';
        
        // menu
        $this->data['advertise_group_menu'] = TRUE; $this->data['advertise_page_menu'] = TRUE;
        generate_template($this->data, $layout_property); 
    }
    
    public function del_layout($layout_id) {
        parent::check_login(TRUE, TRUE);
        $layout = Modules::run('advertise_page_layouts/get', $layout_id);
        
        if(Modules::run('advertise_page_layouts/delete', $layout->id)){
            set_log('Deleted Advertise Page Layout', $layout);
            $this->session->set_flashdata('message', $this->lang->line('del_advertise_page_layout_report_success'));
        }
        else
        {
            $this->session->set_flashdata('message', $this->lang->line('del_advertise_page_layout_report_error'));
        }
        redirect('advertise-pages/'.$layout->page_id, 'refresh');
    }
    
    public function get($id, $array = FALSE)
    {
        if($array == TRUE){
            return $this->advertise_page->as_array()->get($id);
        }
        return $this->advertise_page->as_object()->get($id);
    }
    
    public function get_by($where, $array = FALSE)
    {
        if($array == TRUE){
            return $this->advertise_page->as_array()->get_by($where);
        }
        return $this->advertise_page->as_object()->get_by($where);
    }
    
    public function get_all()
    {
        return $this->advertise_page->get_all();
    }
    
    public function get_many_by($where)
    {
        return $this->advertise_page->get_many_by($where);
    }
    
    public function insert($data, $skip_validation = FALSE)
    {
        return $this->advertise_page->insert($data, $skip_validation);
    }
    
    public function insert_many($data, $skip_validation = FALSE)
    {
        return $this->advertise_page->insert_many($data, $skip_validation);
    }
    
    public function update($id, $data, $skip_validation = FALSE)
    {
        return $this->advertise_page->update($id, $data, $skip_validation);
    }
    
    public function delete($id)
    {
        return $this->advertise_page->delete($id);
    }
    
    public function delete_by($where)
    {
        return $this->advertise_page->delete_by($where);
    }
    
    public function count_all()
    {
        return $this->advertise_page->count_all();
    }
    
    public function count_by($where)
    {
        return $this->advertise_page->count_by($where);
    }
    
    public function dropdown($key, $value, $option_label = NULL, $where = NULL)
    {
        if($where != NULL){
            $this->db->where($where);
        }
        
        return $this->advertise_page->dropdown($key, $value,$option_label);
    }
}