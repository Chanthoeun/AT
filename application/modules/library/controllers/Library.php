<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of library
 *
 * @author Chanthoeun
 */
class Library extends Admin_Controller {
    
    public  $validation_errors =  array();
    
    public function __construct() {
        parent::__construct();
        $this->load->model('library_model', 'library');
        $this->lang->load('library');
        $this->load->helper(array('video', 'string', 'menu'));
        
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
        
        $this->data['libraries'] = $this->get_all_records(FALSE, FALSE, 300);
        
        // process template
        $title = $this->lang->line('index_library_heading');
        $this->data['title'] = $title;
        
        $layout_property = parent::load_index_script('css/colorbox/colorbox.min.css', 'js/jquery.colorbox.min.js', '$(document).ready(function(){$(".color-box").colorbox({rel:"color-box",transition:"fade"})});');
        
        
        $layout_property['breadcrumb'] = array($title);
        
        $layout_property['content']  = 'index';
        
        // menu
        $this->data['library_group_menu'] = TRUE; $this->data['library_recently_menu'] = TRUE;
        generate_template($this->data, $layout_property); 
    }
    
    // create
    public function create($aId = FALSE, $gId = FALSE)
    {
        parent::check_login();
        if($aId != FALSE){
            $this->data['articleId'] = array('articleId' => $aId);
        }
        
        // display form 
        $library_groups = get_dropdown(prepareList(Modules::run('library_groups/get_dropdown')), 'ជ្រើស​ក្រុម');
        $this->data['group'] = form_dropdown('group', $library_groups, empty($this->validation_errors['post_data']['group']) ? $gId : $this->validation_errors['post_data']['group'], 'class="form-control" id="group"');
        
        $this->data['caption'] = array(
            'name'  => 'caption',
            'id'    => 'caption',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['caption']) ? NULL : $this->validation_errors['post_data']['caption']
        );
        
        $this->data['url'] = array(
            'name'  => 'url',
            'id'    => 'url',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['url']) ? NULL : $this->validation_errors['post_data']['url']
        );
        
        $this->data['document'] = array(
            'name'  => 'document',
            'id'    => 'document'
        );
        
        $this->data['picture'] = array(
            'name'  => 'picture',
            'id'    => 'picture',
            'accept'=> 'image/*'
        );
        
        // process template
        $title = $this->lang->line('form_library_create_heading');
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
        
        $layout_property['breadcrumb'] = array('library' => $this->lang->line('index_library_heading'), $title);
        
        $layout_property['content']  = 'create';
        
        // menu
        $this->data['library_group_menu'] = TRUE; $this->data['library_create_menu'] = TRUE;
        generate_template($this->data, $layout_property); 
    }
    
    // save
    public function store()
    {
        parent::check_login();
        $articleId = $this->input->post('articleId');
        $article = Modules::run('articles/get', $articleId);
        $group = trim($this->input->post('group'));
        $slug = str_replace(' ', '-', strtolower(trim($this->input->post('caption'))));
        $url = trim($this->input->post('url'));
        $data = array(
            'caption'   => trim($this->input->post('caption')),
            'slug'      => $slug,
            'library_group_id' => $group,
        );
        
        if(check_library_type($group) == TRUE)
        {
            $upload_type = 'document';
        }
        else if(check_library_type($group, 2) == TRUE){
            $upload_type = 'audio';
        }
        else{
            $upload_type = FALSE;
            $data['file'] = $url;
            $videoInfo = get_video_info($url);
            $data['picture'] = get_video_thumbnail($videoInfo['thumb']);
        }
        
        // upload file
        if($upload_type != FALSE)
        {
            if(check_empty_field('document'))
            {
                $uploaded = upload_file('document', $upload_type, random_string());

                if($uploaded == FALSE)
                {
                    $this->session->set_flashdata('message', print_upload_error());
                    redirect_form_validation(validation_errors(), $this->input->post(), 'library/create');
                }
                else
                {
                    $data['file'] = $uploaded;
                }
            }
            else
            {
                $this->library->validate[2]['rules'] = 'trim|required|xss_clean';
                $data['file'] = $url;
            }
            
            
            // add picture
            if(check_empty_field('picture'))
            {
                $uploaded = upload_file('picture', 'image', random_string());

                if($uploaded == FALSE)
                {
                    $this->session->set_flashdata('message', print_upload_error());
                    redirect_form_validation(validation_errors(), $this->input->post(), 'library/create');
                }
                else
                {
                    $data['picture'] = $uploaded;
                }
            }
            else
            {
                if($article->article_type_id == 3)
                {
                    $data['picture'] = $article->picture;
                }
            }
            
        }
        
        if(($lid = $this->insert($data)) != FALSE)
        {
            if($articleId != FALSE)
            {
                $dataAL = array(
                    'article_id' => $articleId,
                    'library_id' => $lid,
                    'order' => Modules::run('article_libraries/get_next_order', 'order', array('article_id' => $articleId))
                );
                
                // insert to Article Library
                Modules::run('article_libraries/insert', $dataAL, TRUE);
            }
            
            // set log
            array_unshift($data, $lid);
            set_log('Created Library', $data);

            $this->session->set_flashdata('message', $this->lang->line('form_library_report_success'));
            redirect($articleId == FALSE ? 'library' : 'articles/view/'.$articleId, 'refresh');
        }
        else
        {
            redirect_form_validation(validation_errors(), $this->input->post(), 'library/create');
        }
    }
    
    // edit
    public function edit($id, $aId = FALSE)
    {
        parent::check_login();
        
        $library = $this->get_detail($id);
        $this->data['library'] = $library;
        if($aId != FALSE)
        {
            $this->data['library_id'] = array('library_id' => $library->id, 'articleId' => $aId);
        }
        else
        {
            $this->data['library_id'] = array('library_id' => $library->id);
        }
        
        // set log
        set_log('View for update Library', $library);
        
        
        // display form 
        $library_groups = get_dropdown(prepareList(Modules::run('library_groups/get_dropdown')), 'ជ្រើស​ក្រុម');
        $this->data['group'] = form_dropdown('group', $library_groups, empty($this->validation_errors['post_data']['group']) ? $library->library_group_id : $this->validation_errors['post_data']['group'], 'class="form-control" id="group"');
        
        $this->data['caption'] = array(
            'name'  => 'caption',
            'id'    => 'caption',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['caption']) ? $library->caption : $this->validation_errors['post_data']['caption']
        );
        
        $url = valid_url($library->file) == TRUE ? $library->file : NULL;
        
        $this->data['url'] = array(
            'name'  => 'url',
            'id'    => 'url',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['url']) ? $url : $this->validation_errors['post_data']['url']
        );
        
        $this->data['document'] = array(
            'name'  => 'document',
            'id'    => 'document'
        );
        
        $this->data['picture'] = array(
            'name'  => 'picture',
            'id'    => 'picture',
            'accept'=> 'image/*'
        );
        
        // process template
        $title = $this->lang->line('form_library_edit_heading');
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
        
        $layout_property['breadcrumb'] = array('library' => $this->lang->line('index_library_heading'), $title);
        
        $layout_property['content']  = 'edit';
        
        // menu
        $this->data['library_group_menu'] = TRUE; $this->data['library_recently_menu'] = TRUE;
        generate_template($this->data, $layout_property); 
    }
    
    // update
    public function modify()
    {
        parent::check_login();
        $id = $this->input->post('library_id');
        $articleId = $this->input->post('articleId');
        $library = $this->get_detail($id);
        
        $group = trim($this->input->post('group'));
        $slug = str_replace(' ', '-', strtolower(trim($this->input->post('caption'))));
        $url = trim($this->input->post('url'));
        
        $data = array(
            'caption'   => trim($this->input->post('caption')),
            'slug'     => $slug,
            'library_group_id' => $group
        );
        
        if(check_library_type($group) == TRUE)
        {
            $upload_type = 'document';
        }
        else if(check_library_type($group, 2) == TRUE){
            $upload_type = 'audio';
        }
        else{
            $upload_type = FALSE;
            
            $data['file'] = $url;
            if($library->file != FALSE){
                // delete file
                delete_uploaded_file($library->file);
            }
            
            $videoInfo = get_video_info($url);
            
            $data['picture'] = get_video_thumbnail($videoInfo['thumb']);
            
            if($library->picture != FALSE){
                //delete old picture
                delete_uploaded_file($library->picture);
            }
        }
        
        // upload file
        if($upload_type != FALSE)
        {
            // upload file
            if(check_empty_field('document')){
                $uploaded = upload_file('document', $upload_type, random_string());

                if($uploaded == FALSE)
                {
                    $this->session->set_flashdata('message', print_upload_error());
                    redirect_form_validation(validation_errors(), $this->input->post(), 'library/edit/'.$library->id);
                }
                else
                {
                    if($library->file != FALSE){
                        // delete file
                        delete_uploaded_file($library->file);
                    }

                    $data['file'] = $uploaded;
                }
            }
            else
            {
                if($url != FALSE)
                {
                    $data['file'] = $url;
                }
            }
            
            
            // upload picture
            if(check_empty_field('picture'))
            {
                $uploaded = upload_file('picture', 'image', random_string());

                if($uploaded == FALSE)
                {
                    $this->session->set_flashdata('message', print_upload_error());
                    redirect_form_validation(validation_errors(), $this->input->post(), 'library/edit/'.$library->id);
                }
                else
                {
                    if($library->picture != FALSE){
                        //delete old picture
                        delete_uploaded_file($library->picture);
                    }
                    
                    $data['picture'] = $uploaded;
                }
            }
        }
        
        
        $this->library->validate[0]['rules'] = 'trim|required|xss_clean';
        if($this->update($library->id, $data))
        {
            // set log
            array_unshift($data, $library->id);
            set_log('Updated Library', $data);

            $this->session->set_flashdata('message', $this->lang->line('form_library_report_success'));
            redirect($articleId == FALSE ? 'library' : 'articles/view/'.$articleId, 'refresh');
        }
        else
        {
            redirect_form_validation(validation_errors(), $this->input->post(), 'library/edit/'.$library->id);
        }
    }
    
    // delete
    public function destroy($id, $alId = FALSE, $aId = FALSE)
    {
        parent::check_login();
        $library = $this->get($id);
        
        if($this->delete($library->id))
        {
            // delete picture
            if($library->picture != FALSE)
            {
                delete_uploaded_file($library->picture);
            }
            
            if($library->library_group_id != 3){
                if($library->file != FALSE){
                    delete_uploaded_file($library->file);
                }
            }           
            
            if($alId != FALSE)
            {
                Modules::run('article_libraries/delete', $alId);
            }
            
            // set log
            set_log('Deleted Library', $library);
            $this->session->set_flashdata('message', $this->lang->line('del_library_report_success'));
        }
        else
        {
            $this->session->set_flashdata('message', $this->lang->line('del_library_report_success'));
        }
        redirect($aId == FALSE ? 'library' : 'articles/view/'.$aId, 'refresh');
    }
    
    // Search
    public function search()
    {
        parent::check_login();
        $this->form_validation->set_rules('search', $this->lang->line('search_caption_label'), 'trim|required|xss_clean', array('required' => '%s តម្រូវឲ្យ​មាន'));
        if($this->form_validation->run() == TRUE)
        {
            $search = trim($this->input->post('search'));
            $this->data['libraries'] = $this->get_like(array('library.caption' => $search)); 
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
        
        $field = array_to_string($this->get_field('caption'),'caption');
        $layout_property['script'] = '$(function() { var availableTags = ['.$field.'];  $( "#search" ).autocomplete({ source: availableTags }); });';
        
        $layout_property['breadcrumb'] = array('library' => $this->lang->line('index_library_heading'), $title);
        
        $layout_property['content']  = 'search';
        
        // menu
        $this->data['library_group_menu'] = TRUE; $this->data['library_search_menu'] = TRUE;
        generate_template($this->data, $layout_property); 
    }
    
    // Filter by group
    public function filter_by_group()
    {
        parent::check_login();
        $this->form_validation->set_rules('group', $this->lang->line('search_caption_label'), 'trim|required|xss_clean', array('required' => '%s តម្រូវឲ្យ​មាន'));
        if($this->form_validation->run() == TRUE)
        {
            $search = trim($this->input->post('group'));
            $this->data['libraries'] = $this->get_all_records(array('library_group_id' => $search)); 
        }
        
        // message error
        $this->data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
        
        $this->data['group'] = form_dropdown('group', Modules::run('library_groups/dropdown', 'id', 'caption', $this->lang->line('filter_group_caption_label')), set_value('group'), 'class="form-control" id="group"');
        
        // process template
        $title = $this->lang->line('filter_group_heading_label');
        $this->data['title'] = $title;
        
        $layout_property = parent::load_index_script();
        
        $layout_property['breadcrumb'] = array('library' => $this->lang->line('index_library_heading'), $title);
        
        $layout_property['content']  = 'filter_by_group';
        
        // menu
        $this->data['library_group_menu'] = TRUE; $this->data['library_filter_group_menu'] = TRUE;
        generate_template($this->data, $layout_property);
    }
    
    public function get($id, $array = FALSE)
    {
        if($array == TRUE){
            return $this->library->as_array()->get($id);
        }
        return $this->library->as_object()->get($id);
    }
    
    public function get_detail($where)
    {
        return $this->library->get_detail($where);
    }
    
    public function get_by($where, $array = FALSE)
    {
        if($array == TRUE){
            return $this->library->as_array()->get_by($where);
        }
        return $this->library->as_object()->get_by($where);
    }
    
    public function get_all($order_by = FALSE, $limit = FALSE, $offset = 0)
    {
        if($order_by != FALSE)
        {
            $this->order_by($order_by);
        }
        if($limit != FALSE)
        {
            $this->library->limit($limit, $offset);
        }
        return $this->library->get_all();
    }
    
    public function get_all_records($where = FALSE, $order_by = FALSE, $limit = FALSE, $offset = 0)
    {
        if($order_by != FALSE)
        {
            $this->order_by($order_by);
        }
        if($limit != FALSE)
        {
            $this->library->limit($limit, $offset);
        }
        
        return $this->library->get_all_records($where);
    }
    
    public function get_many_by($where, $order_by = FALSE, $limit = FALSE, $offset = 0)
    {
        if($order_by != FALSE)
        {
            $this->order_by($order_by);
        }
        if($limit != FALSE)
        {
            $this->library->limit($limit, $offset);
        }
        return $this->library->get_many_by($where);
    }
    
    public function get_field($field, $where = FALSE, $array = FALSE)
    {
        return $this->library->get_field($field, $where, $array);
    }
    
    public function insert($data, $skip_validation = FALSE)
    {
        return $this->library->insert($data, $skip_validation);
    }
    
    public function insert_many($data, $skip_validation = FALSE)
    {
        return $this->library->insert_many($data, $skip_validation);
    }
    
    public function update($id, $data, $skip_validation = FALSE)
    {
        return $this->library->update($id, $data, $skip_validation);
    }
    
    public function delete($id)
    {
        return $this->library->delete($id);
    }
    
    public function delete_by($where)
    {
        return $this->library->delete_by($where);
    }
    
    public function count_all()
    {
        return $this->library->count_all();
    }
    
    public function count_by($where)
    {
        return $this->library->count_by($where);
    }
    
    public function dropdown($key, $value, $option_label = NULL, $where = NULL)
    {
        if($where != NULL){
            $this->db->where($where);
        }
        
        return $this->library->dropdown($key, $value,$option_label);
    }
    
    public function order_by($criteria, $order = NULL)
    {
        $this->library->order_by($criteria,$order);
    }
    
    public function get_next_order($field, $where = FALSE)
    {
        return $this->library->get_next_order($field, $where);
    }
    
    public function get_like($like, $where = FALSE, $condition = 'both', $order_by = FALSE, $limit = FALSE, $offset = 0)
    {
        if($order_by != FALSE)
        {
            $this->order_by($order_by);
        }
        
        if($limit != FALSE)
        {
            $this->library->limit($limit, $offset);
        }
        
        return $this->library->get_like($like, $where, $condition);
    }
}