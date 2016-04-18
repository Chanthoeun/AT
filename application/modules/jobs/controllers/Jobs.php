<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of job
 *
 * @author Chanthoeun
 */
class Jobs extends Admin_Controller {
    public  $validation_errors =  array();
    
    public function __construct() {
        parent::__construct();
        $this->load->model('job_model', 'job');
        $this->lang->load('job');
        $this->load->helper('menu');
        
        // message
        $this->validation_errors = $this->session->flashdata('validation_errors');
        $this->data['message'] = empty($this->validation_errors['errors']) ? $this->session->flashdata('message') : $this->validation_errors['errors'];
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
    
    public function index()
    {
        parent::check_login();
        $this->data['jobs'] = $this->get_all_records(array('expire_date >=' => date('Y-m-d')) ,array('created_at' => 'desc'));
        
        // process template
        $title = $this->lang->line('index_job_heading');
        $this->data['title'] = $title;
        
        $layout_property = parent::load_index_script();
        
        $layout_property['breadcrumb'] = array($title);
        
        $layout_property['content']  = 'index';
        
        // menu
        $this->data['job_group_menu'] = TRUE; $this->data['job_menu'] = TRUE;
        generate_template($this->data, $layout_property); 
    }

    // create
    public function create()
    {
        parent::check_login();
        
        // display form
        $this->data['job_title'] = array(
            'name'  => 'title',
            'id'    => 'title',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['title']) ? NULL : $this->validation_errors['post_data']['title']
        );
        
        $this->data['description'] = array(
            'name'  => 'description',
            'id'    => 'description',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['description']) ? NULL : $this->validation_errors['post_data']['description']
        );
        
        $this->data['requirement'] = array(
            'name'  => 'requirement',
            'id'    => 'requirement',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['requirement']) ? NULL : $this->validation_errors['post_data']['requirement']
        );
        
        $this->data['apply'] = array(
            'name'  => 'apply',
            'id'    => 'apply',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['apply']) ? NULL : $this->validation_errors['post_data']['apply']
        );
        
        $this->data['close_date'] = array(
            'name'  => 'close_date',
            'id'    => 'close_date',
            'class' => 'form-control',
            'data-date-format' => 'yyyy-mm-dd',
            'data-date' => date('Y-m-d'),
            'value' => empty($this->validation_errors['post_data']['close_date']) ? NULL : $this->validation_errors['post_data']['close_date']
        );
        
        $this->data['category'] = form_dropdown('category', Modules::run('categories/dropdown', 'id', 'caption', 'ជ្រើស​ក្រុម​ការងារ', array('job' => TRUE, 'parent_id !=' => FALSE)), empty($this->validation_errors['post_data']['categoory']) ? NULL : $this->validation_errors['post_data']['category'], array('class' => 'form-control', 'id' => 'category'));
        
        $this->data['location'] = form_dropdown('location', Modules::run('locations/dropdown', 'id', 'caption', 'ជ្រើស​ទីតាំង', array('parent_id' => FALSE)), empty($this->validation_errors['post_data']['location']) ? NULL : $this->validation_errors['post_data']['location'], array('class' => 'form-control', 'id' => 'location'));
        
        $this->data['salary'] = array(
            'name'  => 'salary',
            'id'    => 'salary',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['salary']) ? NULL : $this->validation_errors['post_data']['salary']
        );
        
        $this->data['company'] = array(
            'name'  => 'company',
            'id'    => 'company',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['company']) ? NULL : $this->validation_errors['post_data']['company']
        );
        
        $this->data['logo'] = array(
            'name'  => 'logo',
            'id'    => 'logo',
            'accept'=> 'image/*'
        );
        
        $this->data['agripos'] = array(
            'name'  => 'agripos',
            'id'    => 'agripos',
            'value' => 1,
            'checked' => empty($this->validation_errors['post_data']['agripos']) ? FALSE : TRUE
        );
        
        $agriCats = get_dropdown(prepareList(Modules::run('categories/get_dropdown', array('article' => TRUE))), 'ជ្រើស​ក្រុមកសិកម្ម');
        $this->data['agricat'] = form_dropdown('agricat', $agriCats, empty($this->validation_errors['post_data']['agricat']) ? FALSE : $this->validation_errors['post_data']['agricat'], 'class="form-control" id="agricat"');
        
        $this->data['fb'] = array(
            'name'  => 'fb',
            'id'    => 'fb',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['fb']) ? NULL : $this->validation_errors['post_data']['fb']
        );
        
        $this->data['fbp'] = array(
            'name'  => 'fbp',
            'id'    => 'fbp',
            'value' => 1
        );
        
        // process template
        $title = $this->lang->line('form_job_create_heading');
        $this->data['title'] = $title;
        $layout_property['css'] = array('https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css' => FALSE,
                                        'css/plugins/metisMenu/metisMenu.min.css',
                                        'css/sb-admin-2.css',
                                        'font-awesome-4.1.0/css/font-awesome.min.css',
                                        'css/jquery-ui.css',
                                        'css/datepicker.min.css',
                                        );
        $layout_property['js']  = array('https://code.jquery.com/jquery-1.11.1.min.js' => FALSE,
                                        'https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js' => FALSE,
                                        'js/plugins/metisMenu/metisMenu.min.js',
                                        'js/sb-admin-2.js',
                                        'js/jquery-ui.min.js',
                                        'js/bootstrap-datepicker.min.js',
                                        );
        $layout_property['optional_js'] = base_url('assets/ckeditor/ckeditor.js');
        
        $field1 = array_to_string(Modules::run('agribooks/get_field', 'name'), 'name');
        $field2 = array_to_string(Modules::run('agribooks/get_field', 'name_en'), 'name_en');
        $layout_property['script'] = '$(\'#close_date\').datepicker();$(function() { var availableTags = ['.$field1.$field2.'];  $( "#company" ).autocomplete({ source: availableTags }); }); ';
        
        
        $layout_property['breadcrumb'] = array('jobs' => $this->lang->line('index_job_heading'), $title);
        
        $layout_property['content']  = 'create';
        
        // menu
        $this->data['job_group_menu'] = TRUE; $this->data['job_create_menu'] = TRUE;
        generate_template($this->data, $layout_property); 
    }

    // save
    public function store()
    {
        parent::check_login();
        $data = array(
            'title'     => ucwords(trim($this->input->post('title'))),
            'description'    => trim($this->input->post('description')),
            'requirement'    => trim($this->input->post('requirement')),
            'apply'    => trim($this->input->post('apply')),
            'expire_date'  => trim($this->input->post('close_date')),
            'category_id'   => trim($this->input->post('category')),
            'company'   => ucwords(trim($this->input->post('company'))),
            'agri_position'=> trim($this->input->post('agripos')),
            'agri_cat_id' => trim($this->input->post('agricat')),
            'status'    => 1,
            'fb_quote'  => trim($this->input->post('fb')),
            'salary' => trim($this->input->post('salary')),
            'location_id' => $this->input->post('location')
        );
        
        $fbpost = $this->input->post('fbp');
        
        if(check_empty_field('logo'))
        {
            $uploaded = upload_file('logo', 'image', url_title($data['title'], '-', TRUE));
            if($uploaded == FALSE)
            {
                $this->session->set_flashdata('message', print_upload_error());
                redirect_form_validation(validation_errors(), $this->input->post(), 'jobs/create');
            }
            else
            {
                $data['logo'] = $uploaded;
            }
        }
        
        if(($jid = $this->insert($data)) != FALSE)
        {                
            // post to facebook
            if($fbpost == TRUE)
            {
                // code
            }
            
            // set log
            array_unshift($data, $jid);
            set_log('Created Job', $data);

            $this->session->set_flashdata('message', $this->lang->line('form_job_report_success'));
            redirect('jobs/view/'.$jid, 'refresh');
        }
        else
        {
            redirect_form_validation(validation_errors(), $this->input->post(), 'jobs/create');
        }
    }

    // edit
    public function edit($id)
    {
        parent::check_login();
        $job = $this->get_detail($id);
        $this->data['job_id'] = array('job_id' => $job->id);
        $this->data['job'] = $job;
        // display form
        $this->data['job_title'] = array(
            'name'  => 'title',
            'id'    => 'title',
            'class' => 'form-control',
            'placeholder'=> 'Enter job title',
            'value' => empty($this->validation_errors['post_data']['title']) ? $job->title : $this->validation_errors['post_data']['title']
        );
        
        $this->data['description'] = array(
            'name'  => 'description',
            'id'    => 'description',
            'class' => 'form-control',
            'placeholder'=> 'Enter job description',
            'value' => empty($this->validation_errors['post_data']['description']) ? $job->description : $this->validation_errors['post_data']['description']
        );
        
        $this->data['requirement'] = array(
            'name'  => 'requirement',
            'id'    => 'requirement',
            'class' => 'form-control',
            'placeholder'=> 'Enter job requirement',
            'value' => empty($this->validation_errors['post_data']['requirement']) ? $job->requirement : $this->validation_errors['post_data']['requirement']
        );
        
        $this->data['apply'] = array(
            'name'  => 'apply',
            'id'    => 'apply',
            'class' => 'form-control',
            'placeholder'=> 'Enter how to apply information',
            'value' => empty($this->validation_errors['post_data']['apply']) ? $job->apply : $this->validation_errors['post_data']['apply']
        );
        
        $this->data['close_date'] = array(
            'name'  => 'close_date',
            'id'    => 'close_date',
            'class' => 'form-control',
            'data-date-format' => 'yyyy-mm-dd',
            'data-date' => date('Y-m-d'),
            'placeholder'=> 'Select close date',
            'value' => empty($this->validation_errors['post_data']['close_date']) ? $job->expire_date : $this->validation_errors['post_data']['close_date']
        );
        
        $this->data['category'] = form_dropdown('category', Modules::run('categories/dropdown', 'id', 'caption', 'ជ្រើស​ក្រុម​ការងារ', array('job' => TRUE, 'parent_id !=' => FALSE)), empty($this->validation_errors['post_data']['categoory']) ? $job->category_id : $this->validation_errors['post_data']['category'], array('class' => 'form-control', 'id' => 'category'));
        
        $this->data['location'] = form_dropdown('location', Modules::run('locations/dropdown', 'id', 'caption', 'ជ្រើស​ទីតាំង', array('parent_id' => FALSE)), empty($this->validation_errors['post_data']['location']) ? $job->location_id : $this->validation_errors['post_data']['location'], array('class' => 'form-control', 'id' => 'location'));
        
        $this->data['salary'] = array(
            'name'  => 'salary',
            'id'    => 'salary',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['salary']) ? $job->salary : $this->validation_errors['post_data']['salary']
        );
        
        $this->data['company'] = array(
            'name'  => 'company',
            'id'    => 'company',
            'class' => 'form-control',
            'placeholder'=> 'Enter company name or organization name',
            'value' => empty($this->validation_errors['post_data']['company']) ? $job->company : $this->validation_errors['post_data']['company']
        );
        
        $this->data['logo'] = array(
            'name'  => 'logo',
            'id'    => 'logo',
            'accept'=> 'image/*'
        );
        
        $this->data['agripos'] = array(
            'name'  => 'agripos',
            'id'    => 'agripos',
            'value' => 1,
            'checked' => empty($this->validation_errors['post_data']['agripos']) ? $job->agri_position : TRUE
        );
        
        $agriCats = get_dropdown(prepareList(Modules::run('categories/get_dropdown', array('article' => TRUE))), 'ជ្រើស​ក្រុមកសិកម្ម');
        $this->data['agricat'] = form_dropdown('agricat', $agriCats, empty($this->validation_errors['post_data']['agricat']) ? $job->agri_cat_id : $this->validation_errors['post_data']['agricat'], 'class="form-control" id="agricat"');
        
        $this->data['fb'] = array(
            'name'  => 'fb',
            'id'    => 'fb',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['fb']) ? $job->fb_quote : $this->validation_errors['post_data']['fb']
        );
        
        $this->data['fbp'] = array(
            'name'  => 'fbp',
            'id'    => 'fbp',
            'value' => 1
        );
        
        // process template
        $title = $this->lang->line('form_job_edit_heading');
        $this->data['title'] = $title;
        $layout_property['css'] = array('https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css' => FALSE,
                                        'css/plugins/metisMenu/metisMenu.min.css',
                                        'css/sb-admin-2.css',
                                        'font-awesome-4.1.0/css/font-awesome.min.css',
                                        'css/jquery-ui.css',
                                        'css/datepicker.min.css',
                                        );
        $layout_property['js']  = array('https://code.jquery.com/jquery-1.11.1.min.js' => FALSE,
                                        'https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js' => FALSE,
                                        'js/plugins/metisMenu/metisMenu.min.js',
                                        'js/sb-admin-2.js',
                                        'js/jquery-ui.min.js',
                                        'js/bootstrap-datepicker.min.js',
                                        );
        $layout_property['optional_js'] = base_url('assets/ckeditor/ckeditor.js');
        
        $field1 = array_to_string(Modules::run('agribooks/get_field', 'name'), 'name');
        $field2 = array_to_string(Modules::run('agribooks/get_field', 'name_en'), 'name_en');
        $layout_property['script'] = '$(\'#close_date\').datepicker();$(function() { var availableTags = ['.$field1.$field2.'];  $( "#company" ).autocomplete({ source: availableTags }); }); ';
        
        $layout_property['breadcrumb'] = array('jobs' => $this->lang->line('index_job_heading'), $title);
        
        $layout_property['content']  = 'edit';
        
        // menu
        $this->data['job_group_menu'] = TRUE; $this->data['job_menu'] = TRUE;
        generate_template($this->data, $layout_property); 
    }

    // update
    public function modify()
    {
        parent::check_login();
        $id = $this->input->post('job_id');
        $job = $this->get($id);
        $data = array(
            'title'     => ucwords(trim($this->input->post('title'))),
            'description'    => trim($this->input->post('description')),
            'requirement'    => trim($this->input->post('requirement')),
            'apply'    => trim($this->input->post('apply')),
            'expire_date'  => trim($this->input->post('close_date')),
            'category_id'   => trim($this->input->post('category')),
            'company'   => ucwords(trim($this->input->post('company'))),
            'agri_position'=> trim($this->input->post('agripos')),
            'agri_cat_id' => trim($this->input->post('agricat')),
            'fb_quote'  => trim($this->input->post('fb')),
            'salary' => trim($this->input->post('salary')),
            'location_id' => $this->input->post('location')
        );
        
        $fbpost = $this->input->post('fbp');
        
        if(check_empty_field('logo'))
        {
            // delete current logo
            if($job->logo != FALSE)
            {
                delete_uploaded_file($job->logo);
            }
            
            $uploaded = upload_file('logo', 'image', url_title($data['title'], '-', TRUE));
            if($uploaded == FALSE)
            {
                $this->session->set_flashdata('message', print_upload_error());
                redirect_form_validation(validation_errors(), $this->input->post(), 'jobs/create');
            }
            else
            {
                $data['logo'] = $uploaded;
            }
        }
        
        if($this->update($id, $data) != FALSE)
        {      
            // post to facebook
            if($fbpost == TRUE)
            {
                // Code
            }
            
            // set log
            array_unshift($data, $id);
            set_log('Updated Job', $data);

            $this->session->set_flashdata('message', $this->lang->line('form_job_report_success'));
            redirect('jobs/view/'.$id, 'refresh');
        }
        else
        {
            redirect_form_validation(validation_errors(), $this->input->post(), 'jobs/edit/'.$id);
        }
    }

    // view
    public function view($id)
    {
        parent::check_login();
        $this->data['job'] = $this->get_detail($id);
        
        // process template
        $title = $this->data['job']->title;
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
        
        $layout_property['breadcrumb'] = array('jobs' => $this->lang->line('index_job_heading'), $title);
        
        $layout_property['content']  = 'view';
        
        // menu
        $this->data['job_group_menu'] = TRUE; $this->data['job_menu'] = TRUE;
        generate_template($this->data, $layout_property); 
    }

    // delete
    public function destroy($id)
    {
        parent::check_login();
        $job = $this->get($id);
        
        // delete job
        if($this->delete($id))
        {
            // delete thumbnail
            delete_uploaded_file($job->logo);
            // set log
            set_log('Deleted Job', $job);
            
            $this->session->set_flashdata('message', $this->lang->line('del_job_report_success'));   
        }
        else
        {            
            $this->session->set_flashdata('message', $this->lang->line('del_job_report_error'));
        }
        redirect('jobs/ad', 'refresh');
    }
    
    public function search()
    {
        parent::check_login();
        $this->form_validation->set_rules('search', 'Search', 'trim|required|xss_clean');
        if($this->form_validation->run() == TRUE)
        {
            $search = trim($this->input->post('search'));
            $this->data['jobs'] = $this->get_like(array('title' => $search)); 
        }
        
        // message error
        $this->data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
        
        $this->data['search'] = array(
            'name'  => 'search',
            'id'    => 'search',
            'class' => 'form-control',
            'style' => 'width: 700px;',
            'value' => set_value('search')
        );
        
        // process template
        $title = $this->lang->line('search_heading_label');
        $this->data['title'] = $title;
        
        $layout_property = parent::load_index_script('css/jquery-ui.css', 'js/jquery-ui.min.js');
        
        $field = array_to_string($this->get_field('title'),'title');
        $layout_property['script'] = '$(function() { var availableTags = ['.$field.'];  $( "#search" ).autocomplete({ source: availableTags }); });';
        
        $layout_property['breadcrumb'] = array('jobs' => $this->lang->line('index_job_heading'), $title);
        
        $layout_property['content']  = 'search';
        
        // menu
        $this->data['job_group_menu'] = TRUE; $this->data['job_search_menu'] = TRUE;
        generate_template($this->data, $layout_property); 
    }
    
    public function expired()
    {
        parent::check_login();
        $this->data['jobs'] = $this->get_all_records(array('expire_date <' => date('Y-m-d')) ,array('created_at' => 'desc'));
        
        // process template
        $title = $this->lang->line('index_job_expired');
        $this->data['title'] = $title;
        
        $layout_property = parent::load_index_script();
        
        $layout_property['breadcrumb'] = array($title);
        
        $layout_property['content']  = 'index';
        
        // menu
        $this->data['job_group_menu'] = TRUE; $this->data['job_expired_menu'] = TRUE;
        generate_template($this->data, $layout_property); 
    }
    
    public function get($id)
    {
        return $this->job->as_object()->get($id);
    }
    
    public function get_detail($where)
    {
        return $this->job->get_detail($where);
    }
    
    public function get_by($where, $array = FALSE)
    {
        if($array == TRUE){
            return $this->job->as_array()->get_by($where);
        }
        return $this->job->as_object()->get_by($where);
    }
    
    public function get_all($order_by = FALSE, $limit = FALSE, $offset = 0)
    {
        if($order_by != FALSE)
        {
            $this->job->order_by($order_by);
        }
        
        if($limit != FALSE)
        {
            $this->job->limit($limit, $offset);
        }
        
        return $this->job->get_all();
    }
    
    public function get_all_records($where = FALSE, $order_by = FALSE, $limit = FALSE, $offset = 0)
    {
        if($order_by != FALSE)
        {
            $this->job->order_by($order_by);
        }
        
        if($limit != FALSE)
        {
            $this->job->limit($limit, $offset);
        }
        
        return $this->job->get_all_records($where);
    }
    
    public function get_many_by($where, $order_by = FALSE, $limit = FALSE, $offset = 0)
    {
        if($order_by != FALSE)
        {
            $this->order_by($order_by);
        }
        
        if($limit != FALSE)
        {
            $this->job->limit($limit, $offset);
        }
        
        return $this->job->get_many_by($where);
    }
    
    public function get_like($like, $where = FALSE, $condition = 'both')
    {        
        return $this->job->get_like($like, $where, $condition);
    }
    
    public function get_field($field, $where = FALSE, $array = FALSE)
    {
        return $this->job->get_field($field, $where, $array);
    }
    
    public function insert($data, $skip_validation = FALSE)
    {
        return $this->job->insert($data, $skip_validation);
    }
    
    public function insert_many($data, $skip_validation = FALSE)
    {
        return $this->job->insert_many($data, $skip_validation);
    }
    
    public function update($id, $data, $skip_validation = FALSE)
    {
        return $this->job->update($id, $data, $skip_validation);
    }
    
    public function delete($id)
    {
        return $this->job->delete($id);
    }
    
    public function delete_by($where)
    {
        return $this->job->delete_by($where);
    }
    
    public function count_all()
    {
        return $this->job->count_all();
    }
    
    public function count_by($where)
    {
        return $this->job->count_by($where);
    }
    
    public function dropdown($key, $value, $option_label = NULL, $where = NULL)
    {
        if($where != NULL){
            $this->db->where($where);
        }
        
        return $this->job->dropdown($key, $value,$option_label);
    }
    
    public function order_by($criteria, $order = NULL)
    {
        $this->job->order_by($criteria,$order);
    }
}