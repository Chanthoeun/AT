<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of article_type
 *
 * @author Chanthoeun
 */
class Article_types extends Admin_Controller {
    public  $validation_errors =  array();
    
    public function __construct() {
        parent::__construct();
        $this->load->model('article_type_model', 'article_type');
        $this->lang->load('article_type');
        
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
        $this->data['article_types'] = $this->get_all_records(array('article_type.parent_id' => 0));
        
        // process template
        $title = $this->lang->line('index_article_type_heading');
        $this->data['title'] = $title;
        
        $layout_property = parent::load_index_script();
        
        $layout_property['breadcrumb'] = array($title);
        
        $layout_property['content']  = 'index';
        
        // menu
        $this->data['setting_menu'] = TRUE; $this->data['article_type_menu'] = TRUE;
        generate_template($this->data, $layout_property); 
    }
    
    public function get_index($pid)
    {
        parent::check_login();
        $article_type = $this->get($pid);
        $this->data['article_types'] = $this->get_all_records(array('article_type.parent_id' => $pid));
        
        // process template
        $title = $article_type->caption;
        $this->data['title'] = $title;
        
        $layout_property = parent::load_index_script();
        
        $layout_property['breadcrumb'] = array_merge(array('article-types' => $this->lang->line('index_article_type_heading')), generate_breadcrumb($pid, 'article-types', 'article_types', 'article_type'));
        
        $layout_property['content']  = 'index';
        
        // menu
        $this->data['setting_menu'] = TRUE; $this->data['article_type_menu'] = TRUE;
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
        
        $this->data['parent'] = form_dropdown('parent', get_dropdown(prepareList($this->get_dropdown()), 'ជ្រើស​ក្រុម'), empty($this->validation_errors['post_data']['parent']) ? $pid : $this->validation_errors['post_data']['parent'], 'class="form-control" id="parent"');
        // process template
        $title = $this->lang->line('form_article_type_create_heading');
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
        
        if($pid == FALSE)
        {
            $layout_property['breadcrumb'] = array('article_types' => $this->lang->line('index_article_type_heading'), $title);
        }
        else
        {
            $layout_property['breadcrumb'] = array_merge(array('article_types' => $this->lang->line('index_article_type_heading')), generate_breadcrumb($pid, 'article-types', 'article_types', 'article_type'), array($title));
        }
        
        
        
        $layout_property['content']  = 'create';
        
        // menu
        $this->data['setting_menu'] = TRUE; $this->data['article_type_menu'] = TRUE;
        generate_template($this->data, $layout_property); 
    }


    // save
    public function store()
    {
        parent::check_login();
        $parentId = trim($this->input->post('parent'));
        $data = array(
            'caption' => ucwords(trim($this->input->post('caption'))),
            'slug'    => str_replace(' ', '-', strtolower(trim($this->input->post('caption')))),
            'parent_id' => $parentId,
            'order'     => $this->get_next_order('order', array('parent_id' => $parentId)),
        );

        if (($atid = $this->insert($data)) != FALSE)
        {
            // set log
            array_unshift($data, $atid);
            set_log('Created Article Type', $data);

            $this->session->set_flashdata('message', $this->lang->line('form_article_type_report_success'));
            redirect('article-types/'.$parentId, 'refresh');
        }
        else
        {
            redirect_form_validation(validation_errors(), $this->input->post(), 'article-types/create/'.$parentId);
        }
    }

    // edit
    public function edit($id)
    {
        parent::check_login();
        $this->load->helper('menu');
        $article_type = $this->get($id);
        $this->data['article_type_id'] = array('article_type_id' => $article_type->id);
        $this->data['article_type'] = $article_type;

        // set log
        set_log('View Update Article Type', $article_type);
        
        // display form
        $this->data['caption'] = array(
            'name'  => 'caption',
            'id'    => 'caption',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['caption']) ? $article_type->caption : $this->validation_errors['post_data']['caption']
        );
        
        $this->data['parent'] = form_dropdown('parent', get_dropdown(prepareList($this->get_dropdown()), 'ជ្រើស​ក្រុម'), empty($this->validation_errors['post_data']['parent']) ? $article_type->parent_id : $this->validation_errors['post_data']['parent'], 'class="form-control" id="parent"');
        
        // process template
        $title = $this->lang->line('form_article_type_edit_heading');
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
        
        $layout_property['breadcrumb'] = array_merge(array('article_types' => $this->lang->line('index_article_type_heading')), generate_breadcrumb($article_type->id, 'article-types', 'article_types', 'article_type'), array($title));$layout_property['breadcrumb'] = array('article_types' => $this->lang->line('index_article_type_heading'), $title);
        
        $layout_property['content']  = 'edit';
        
        // menu
        $this->data['setting_menu'] = TRUE; $this->data['article_type_menu'] = TRUE;
        generate_template($this->data, $layout_property); 
    }
    
    // update
    public function modify()
    {
        parent::check_login();
        $id = $this->input->post('article_type_id');
        $parentId = trim($this->input->post('parent'));
        $data = array(
            'caption' => ucwords(strtolower(trim($this->input->post('caption')))),
            'slug'    => str_replace(' ', '-', strtolower(trim($this->input->post('caption')))),
            'parent_id' => $parentId
        );
        
        $this->article_type->validate[0]['rules'] = 'trim|required|xss_clean';
        if($this->update($id, $data))
        {
            // set log
            array_unshift($data, $id);
            set_log('Updated Article Type', $data);

            $this->session->set_flashdata('message', $this->lang->line('form_article_type_report_success'));
            redirect('article-types/'.$parentId, 'refresh');
        }
        else
        {
            redirect_form_validation(validation_errors(), $this->input->post(), 'article-types/edit/'.$id);
        }
    }

    // delete
    public function destroy($id, $del_child = FALSE)
    {
        parent::check_login();
        $article_type = $this->get($id);
        
        // do they have childs
        $get_childs = $this->get_many_by(array('parent_id' => $article_type->id));
        
        if($this->delete($id))
        {
            if($del_child == FALSE)
            {
                //convert child to parent
                if(count($get_childs) > 0)
                {
                    // transfer child to parent
                    foreach ($get_childs as $child)
                    {
                        $this->update($child->id, array('parent_id' => 0), TRUE);
                        // set log
                        set_log('Converted to parent', $child);
                    }
                }
            }
            else
            {
                // delete all child
                $this->delete_by(array('parent_id' => $article_type->id));
            }
            
            // set log
            set_log('Deleted Atrticle Type', $article_type);
            
            $this->session->set_flashdata('message', $this->lang->line('del_article_type_report_success'));
        }
        else
        {
            $this->session->set_flashdata('message', $this->lang->line('del_article_type_report_error'));
        }
        redirect('article-types/'.$article_type->parent_id, 'refresh');
    }
    
    public function get($id, $array = FALSE)
    {
        if($array == TRUE){
            return $this->article_type->as_array()->get($id);
        }
        return $this->article_type->as_object()->get($id);
    }
    
    public function get_detail($where)
    {
        return $this->article_type->get_detail($where);
    }
    
    public function get_by($where, $array = FALSE)
    {
        if($array == TRUE){
            return $this->article_type->as_array()->get_by($where);
        }
        return $this->article_type->as_object()->get_by($where);
    }
    
    public function get_list($where = FALSE)
    {
        return $this->article_type->get_list($where);
    }
    
    public function get_all()
    {
        return $this->article_type->get_all();
    }
    
    public function get_all_records($where = FALSE)
    {
        return $this->article_type->get_all_records($where);
    }
    
    public function get_many_by($where)
    {
        return $this->article_type->get_many_by($where);
    }
    
    public function insert($data, $skip_validation = FALSE)
    {
        return $this->article_type->insert($data, $skip_validation);
    }
    
    public function insert_many($data, $skip_validation = FALSE)
    {
        return $this->article_type->insert_many($data, $skip_validation);
    }
    
    public function update($id, $data, $skip_validation = FALSE)
    {
        return $this->article_type->update($id, $data, $skip_validation);
    }
    
    public function delete($id)
    {
        return $this->article_type->delete($id);
    }
    
    public function delete_by($where)
    {
        return $this->article_type->delete_by($where);
    }
    
    public function count_all()
    {
        return $this->article_type->count_all();
    }
    
    public function count_by($where)
    {
        return $this->article_type->count_by($where);
    }
    
    public function get_dropdown($where = FALSE)
    {
        return $this->article_type->get_dropdown($where);
    }
    
    public function dropdown($key, $value, $option_label = NULL, $where = NULL)
    {
        if($where != NULL){
            $this->db->where($where);
        }
        
        return $this->article_type->dropdown($key, $value,$option_label);
    }
    
    public function order_by($criteria, $order = NULL)
    {
        $this->article_type->order_by($criteria,$order);
    }
    
    public function get_next_order($field, $where = FALSE)
    {
        return $this->article_type->get_next_order($field, $where);
    }
}