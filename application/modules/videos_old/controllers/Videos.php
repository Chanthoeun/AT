<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of video
 *
 * @author Chanthoeun
 */
class Videos extends Admin_Controller {
    public  $validation_errors =  array();
    
    public function __construct() {
        parent::__construct();
        $this->load->model('video_model', 'video');
        $this->lang->load('video');
        $this->load->helper(array('menu', 'video'));
        
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
        $this->data['videos'] = $this->get_all_records(FALSE, array('created_at' => 'desc'), 300);
        
        // process template
        $title = $this->lang->line('index_video_heading');
        $this->data['title'] = $title;
        
        $layout_property = parent::load_index_script();
        
        $layout_property['breadcrumb'] = array($title);
        
        $layout_property['content']  = 'index';
        
        // menu
        $this->data['video_group_menu'] = TRUE; $this->data['video_menu'] = TRUE;
        generate_template($this->data, $layout_property); 
    }

    // create
    public function create()
    {
        parent::check_login();
        
        // display form
        $this->data['video_title'] = array(
            'name'  => 'title',
            'id'    => 'title',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['title']) ? NULL : $this->validation_errors['post_data']['title']
        );
        
        $this->data['detail'] = array(
            'name'  => 'detail',
            'id'    => 'detail',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['detail']) ? NULL : $this->validation_errors['post_data']['detail']
        );
        
        $this->data['publish'] = array(
            'name'  => 'publish',
            'id'    => 'publish',
            'class' => 'form-control',
            'data-date-format' => 'yyyy-mm-dd',
            'data-date' => date('Y-m-d'),
            'value' => empty($this->validation_errors['post_data']['publish']) ? NULL : $this->validation_errors['post_data']['publish']
        );
        
        $this->data['source'] = array(
            'name'  => 'source',
            'id'    => 'source',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['source']) ? NULL : $this->validation_errors['post_data']['source']
        );
        
        $categories = get_dropdown(prepareList(Modules::run('categories/get_dropdown', array('article' => TRUE))), 'ជ្រើស​ក្រុម');
        $this->data['category'] = form_dropdown('category', $categories, empty($this->validation_errors['post_data']['category']) ? NULL : $this->validation_errors['post_data']['category'], 'class="form-control" id="category"');
        
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
        $title = $this->lang->line('form_video_create_heading');
        $this->data['title'] = $title;
        $layout_property['css'] = array('https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css' => FALSE,
                                        'css/plugins/metisMenu/metisMenu.min.css',
                                        'css/sb-admin-2.css',
                                        'font-awesome-4.1.0/css/font-awesome.min.css',
                                        'css/datepicker.min.css'
                                        );
        $layout_property['js']  = array('https://code.jquery.com/jquery-1.11.1.min.js' => FALSE,
                                        'https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js' => FALSE,
                                        'js/plugins/metisMenu/metisMenu.min.js',
                                        'js/sb-admin-2.js',
                                        'js/bootstrap-datepicker.min.js'
                                        );
        $layout_property['optional_js'] = base_url('assets/ckeditor/ckeditor.js');
        
        $layout_property['script'] = '$(\'#publish\').datepicker()';
        
        $layout_property['breadcrumb'] = array('videos' => $this->lang->line('index_video_heading'), $title);
        
        $layout_property['content']  = 'create';
        
        // menu
        $this->data['video_group_menu'] = TRUE; $this->data['video_menu'] = TRUE;
        generate_template($this->data, $layout_property); 
    }

    // save
    public function store()
    {
        parent::check_login();
        $source = explode(', ', trim($this->input->post('source')));
        if(valid_url($source[0]))
        {
            $url = $source[0];
        }
        else
        {
            $getSource = $source[0];
            $url = isset($source[1]) && valid_url($source[1]) ? $source[1] : FALSE;
        }
        
        if($url == FALSE)
        {
            $this->session->set_flashdata('message', $this->lang->line('from_video_url_not_valid'));
            redirect_form_validation(validation_errors(), $this->input->post(), 'videos/create');
        }
        
        $videoInfo = get_video_info($url);
        $videoTitle = $this->input->post('title') == FALSE ? $videoInfo['title'] : trim($this->input->post('title'));
        $category = $this->input->post('category');
        $fbpost = $this->input->post('fbp');
        
        
        $data = array(
            'title'     => $videoTitle,
            'slug'     => str_replace(' ', '-', strtolower($videoTitle)),
            'detail'    => $this->input->post('detail') != FALSE ? $this->input->post('detail') : $videoInfo['desc'],
            'published_at'  => $this->input->post('publish') != FALSE ? $this->input->post('publish') : $videoInfo['p_date'],
            'source'    => $getSource,
            'fb_quote'  => trim($this->input->post('fb')),
            'category_id' => $category
        );
        
        $dataVideo = array(
            'caption'   => $videoTitle,
            'slug'      => $data['slug'],
            'library_group_id' => 3,
            'file'  => $url,
            'picture' => get_video_thumbnail($videoInfo['thumb'])
        );
        
        if((($vid = $this->insert($data)) != FALSE) && (($lid = Modules::run('library/insert',$dataVideo, TRUE)) != FALSE))
        {                
            // insert video library
            $dataVL = array(
                'video_id' => $vid,
                'library_id' => $lid,
                'order' => Modules::run('video_libraries/get_next_order', 'order', array('video_id' => $vid))
            );
            Modules::run('video_libraries/insert', $dataVL, TRUE);
            
            // Post to Facebook
            if($fbpost == TRUE)
            {
                
            }
            
            // set log
            array_unshift($data, $vid);
            set_log('Created Video', array_merge($data, $dataVL));

            $this->session->set_flashdata('message', $this->lang->line('form_video_report_success'));
            redirect('videos/view/'.$vid, 'refresh');
        }
        else
        {
            redirect_form_validation(validation_errors(), $this->input->post(), 'videos/create');
        }
    }

    // edit
    public function edit($id)
    {
        parent::check_login();
        $video = $this->get_detail($id);
        $this->data['video_id'] = array('video_id' => $video->id);
        $this->data['video'] = $video;
        
        // display form
        $this->data['video_title'] = array(
            'name'  => 'title',
            'id'    => 'title',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['title']) ? $video->title : $this->validation_errors['post_data']['title']
        );
        
        $this->data['detail'] = array(
            'name'  => 'detail',
            'id'    => 'detail',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['detail']) ? $video->detail : $this->validation_errors['post_data']['detail']
        );
        
        $this->data['publish'] = array(
            'name'  => 'publish',
            'id'    => 'publish',
            'class' => 'form-control',
            'data-date-format' => 'yyyy-mm-dd',
            'data-date' => date('Y-m-d'),
            'value' => empty($this->validation_errors['post_data']['publish']) ? $video->published_at : $this->validation_errors['post_data']['publish']
        );
        
        $this->data['source'] = array(
            'name'  => 'source',
            'id'    => 'source',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['source']) ? $video->source.', '.$video->file : $this->validation_errors['post_data']['source']
        );
        
        $categories = get_dropdown(prepareList(Modules::run('categories/get_dropdown', array('article' => TRUE))), 'ជ្រើស​ក្រុម');
        $this->data['category'] = form_dropdown('category', $categories, empty($this->validation_errors['post_data']['category']) ? $video->category_id : empty($this->validation_errors['post_data']['category']) ? $video->category_id : $this->validation_errors['post_data']['category'], 'class="form-control" id="category"');
        
        $this->data['fb'] = array(
            'name'  => 'fb',
            'id'    => 'fb',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['fb']) ? $video->fb_quote : $this->validation_errors['post_data']['fb']
        );
        
        $this->data['fbp'] = array(
            'name'  => 'fbp',
            'id'    => 'fbp',
            'value' => 1
        );
        
        // process template
        $title = $this->lang->line('form_video_edit_heading');
        $this->data['title'] = $title;
        $layout_property['css'] = array('https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css' => FALSE,
                                        'css/plugins/metisMenu/metisMenu.min.css',
                                        'css/sb-admin-2.css',
                                        'font-awesome-4.1.0/css/font-awesome.min.css',
                                        'css/datepicker.min.css'
                                        );
        $layout_property['js']  = array('https://code.jquery.com/jquery-1.11.1.min.js' => FALSE,
                                        'https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js' => FALSE,
                                        'js/plugins/metisMenu/metisMenu.min.js',
                                        'js/sb-admin-2.js',
                                        'js/bootstrap-datepicker.min.js'
                                        );
        $layout_property['optional_js'] = base_url('assets/ckeditor/ckeditor.js');
        $layout_property['script'] = '$(\'#publish\').datepicker()';
        
        $layout_property['breadcrumb'] = array('videos' => $this->lang->line('index_video_heading'), $title);
        
        $layout_property['content']  = 'edit';
        
        // menu
        $this->data['video_group_menu'] = TRUE; $this->data['video_menu'] = TRUE;
        generate_template($this->data, $layout_property); 
    }


    // update
    public function modify()
    {
        parent::check_login();
        $id = trim($this->input->post('video_id'));
        $video = $this->get_detail($id);
        $source = explode(', ', trim($this->input->post('source')));
        if(valid_url($source[0]))
        {
            $url = $source[0];
        }
        else
        {
            $getSource = $source[0];
            $url = isset($source[1]) && valid_url($source[1]) ? $source[1] : FALSE;
        }
        
        if($url == FALSE)
        {
            $this->session->set_flashdata('message', $this->lang->line('from_video_url_not_valid'));
            redirect_form_validation(validation_errors(), $this->input->post(), 'videos/edit/'.$id);
        }
        
        $videoInfo = get_video_info($url);
        $videoTitle = $this->input->post('title') == FALSE ? $videoInfo['title'] : trim($this->input->post('title'));
        $category = $this->input->post('category');
        $fbpost = $this->input->post('fbp');
        
        $data = array(
            'title'     => $videoTitle,
            'slug'     => str_replace(' ', '-', strtolower($videoTitle)),
            'detail'    => $this->input->post('detail') != FALSE ? $this->input->post('detail') : $videoInfo['desc'],
            'published_at'  => $this->input->post('publish') != FALSE ? $this->input->post('publish') : $videoInfo['p_date'],
            'source'    => $getSource,
            'fb_quote'  => trim($this->input->post('fb')),
            'category_id' => $category
        );
        
        $dataVideo = array(
            'caption'   => $videoTitle,
            'slug'      => $data['slug'],
        );
        
        //check url
        if($video->file != $url)
        {
            //delete old picute
            delete_uploaded_file($video->picture);
            $dataVideo['file'] = $url;
            $dataVideo['picture'] = get_video_thumbnail($videoInfo['thumb']);
        }
        
        
        if(($this->update($id, $data) != FALSE) && (Modules::run('library/update', $video->lid, $dataVideo, TRUE)))
        {           
            // post to facebook
            if($fbpost == TRUE)
            {
                //code 
            }
            
            // set log
            array_unshift($data, $id);
            set_log('Updated Video', $data);

            $this->session->set_flashdata('message', $this->lang->line('form_video_report_success'));
            redirect('videos/view/'.$id, 'refresh');
        }
        else
        {
            redirect_form_validation(validation_errors(), $this->input->post(), 'videos/edit/'.$id);
        }
    }

    // view
    public function view($id)
    {
        parent::check_login();
        $video = $this->get_detail($id);
        $this->form_validation->set_rules('video_id', 'Video ID', 'trim|required|xss_clean');
        if($this->form_validation->run() == TRUE)
        {
            $uploaded = upload_file('thumbs', 'image', $video->picture);
            if($uploaded == FALSE)
            {
                $this->session->set_flashdata('message', print_upload_error());
            }
            else
            {
                Modules::run('library/update', $video->lid, array('picture' => $uploaded), TRUE);
                $this->session->set_flashdata('message', $this->lang->line('view_video_upload_success_label'));
                redirect(current_url(), 'refresh');
            }
        }
        
        $this->data['video'] = $video;
        $this->data['video_id'] = array('video_id' => $video->id);
        
        $this->data['thumbs'] = array(
            'name'  => 'thumbs',
            'id'    => 'thumbs',
            'accept'=> 'image/*'
        );
        
        // process template
        $title = $video->title;
        $this->data['title'] = $title;
        $layout_property['css'] = array('https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css' => FALSE,
                                        'css/plugins/metisMenu/metisMenu.min.css',
                                        'css/sb-ad-2.css',
                                        'font-awesome-4.1.0/css/font-awesome.min.css',
                                        'css/colorbox/colorbox.min.css'
                                        );
        $layout_property['js']  = array('https://code.jquery.com/jquery-1.11.1.min.js' => FALSE,
                                        'https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js' => FALSE,
                                        'js/plugins/metisMenu/metisMenu.min.js',
                                        'js/sb-ad-2.js',
                                        'js/jquery.colorbox.min.js'
                                        );
        $layout_property['script'] = '$(document).ready(function(){$(".color-box").colorbox({rel:"color-box",transition:"fade"})});';
        $layout_property['breadcrumb'] = array('videos' => $this->lang->line('index_video_heading'), $title);
        
        $layout_property['content']  = 'view';
        
        // menu
        $this->data['video_group_menu'] = TRUE; $this->data['video_menu'] = TRUE;
        generate_template($this->data, $layout_property); 
    }

    // delete
    public function destroy($id)
    {
        parent::check_login();
        $video = $this->get_detail($id);
        
        // delete video
        if(($this->delete($video->id)) && (Modules::run('library/delete', $video->lid)))
        {
            
            // delete thumbnail
            delete_uploaded_file($video->picture);
            
            // delete video library
            Modules::run('video_libraries/delete_by', array('video_id' => $video->id));
            
            // set log
            set_log('Deleted Video', $video);
            
            $this->session->set_flashdata('message', $this->lang->line('del_video_report_success'));   
        }
        else
        {            
            $this->session->set_flashdata('message', $this->lang->line('del_video_report_error'));
        }
        redirect('videos/ad', 'refresh');
    }
    
    public function search()
    {
        parent::check_login();
        $this->form_validation->set_rules('search', 'Search', 'trim|required|xss_clean');
        if($this->form_validation->run() == TRUE)
        {
            $search = trim($this->input->post('search'));
            $this->data['videos'] = $this->get_like(array('title' => $search)); 
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
        
        $field = array_to_string($this->get_field('title'),'title');
        $layout_property['script'] = '$(function() { var availableTags = ['.$field.'];  $( "#search" ).autocomplete({ source: availableTags }); });';
        
        $layout_property['breadcrumb'] = array('videos' => $this->lang->line('index_video_heading'), $title);
        
        $layout_property['content']  = 'search';
        
        // menu
        $this->data['video_group_menu'] = TRUE; $this->data['video_search_menu'] = TRUE;
        generate_template($this->data, $layout_property); 
    }
    
    
    public function get($id)
    {
        return $this->video->as_object()->get($id);
    }
    
    public function get_detail($where)
    {
        return $this->video->get_detail($where);
    }
    
    public function get_by($where, $array = FALSE)
    {
        if($array == TRUE){
            return $this->video->as_array()->get_by($where);
        }
        return $this->video->as_object()->get_by($where);
    }
    
    public function get_all($order_by = FALSE, $limit = FALSE, $offset = 0)
    {
        if($order_by != FALSE)
        {
            $this->video->order_by($order_by);
        }
        
        if($limit != FALSE)
        {
            $this->video->limit($limit, $offset);
        }
        
        return $this->video->get_all();
    }
    
    public function get_many_by($where, $order_by = FALSE, $limit = FALSE, $offset = 0)
    {
        if($order_by != FALSE)
        {
            $this->order_by($order_by);
        }
        
        if($limit != FALSE)
        {
            $this->video->limit($limit, $offset);
        }
        
        return $this->video->get_many_by($where);
    }
    
    public function get_all_records($where = FALSE, $order_by = FALSE, $limit = FALSE, $offset = 0)
    {
        if($order_by != FALSE)
        {
            $this->video->order_by($order_by);
        }
        
        if($limit != FALSE)
        {
            $this->video->limit($limit, $offset);
        }
        
        return $this->video->get_all_records($where);
    }
    
    public function get_like($like, $where = FALSE)
    {
        return $this->video->get_like($like, $where);
    }
    
    public function get_field($field, $where = FALSE, $array = FALSE)
    {
        return $this->video->get_field($field, $where, $array);
    }
    
    public function insert($data, $skip_validation = FALSE)
    {
        return $this->video->insert($data, $skip_validation);
    }
    
    public function insert_many($data, $skip_validation = FALSE)
    {
        return $this->video->insert_many($data, $skip_validation);
    }
    
    public function update($id, $data, $skip_validation = FALSE)
    {
        return $this->video->update($id, $data, $skip_validation);
    }
    
    public function delete($id)
    {
        return $this->video->delete($id);
    }
    
    public function delete_by($where)
    {
        return $this->video->delete_by($where);
    }
    
    public function count_all()
    {
        return $this->video->count_all();
    }
    
    public function count_by($where)
    {
        return $this->video->count_by($where);
    }
    
    public function dropdown($key, $value, $option_label = NULL, $where = NULL)
    {
        if($where != NULL){
            $this->db->where($where);
        }
        
        return $this->video->dropdown($key, $value,$option_label);
    }
    
    public function order_by($criteria, $order = NULL)
    {
        $this->video->order_by($criteria,$order);
    }
}