<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of category
 *
 * @author Chanthoeun
 */
class Categories extends Admin_Controller {
    public  $validation_errors =  array();
    
    public function __construct() {
        parent::__construct();
        $this->load->model('category_model', 'category');
        $this->lang->load('category');
        
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
        $this->data['categories'] = $this->get_all_records(array('category.parent_id' => 0));
        
        // process template
        $title = $this->lang->line('index_cagetory_heading');
        $this->data['title'] = $title;
        
        $layout_property = parent::load_index_script();
        
        $layout_property['breadcrumb'] = array($title);
        
        $layout_property['content']  = 'index';
        
        // menu
        $this->data['setting_menu'] = TRUE; $this->data['category_menu'] = TRUE;
        generate_template($this->data, $layout_property); 
    }
    
    public function get_index($pid)
    {
        parent::check_login();
        $parent_category = $this->get($pid);
        $this->data['categories'] = $this->get_all_records(array('category.parent_id' => $pid));
        
        // process template
        $title = $parent_category->caption;
        $this->data['title'] = $title;
        
        $layout_property = parent::load_index_script();
        
        $layout_property['breadcrumb'] = array_merge(array('categories' => $this->lang->line('index_cagetory_heading')), generate_breadcrumb($pid, 'categories', 'categories', 'category'));
        
        $layout_property['content']  = 'index';
        
        // menu
        $this->data['setting_menu'] = TRUE; $this->data['category_menu'] = TRUE;
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
        
        $this->data['article'] = array(
            'name'          => 'article',
            'id'            => 'article',
            'value'         => 1,
            'checked'       => empty($this->validation_errors['post_data']['article']) ? FALSE : $this->validation_errors['post_data']['article']
        );
        
        $this->data['market'] = array(
            'name'          => 'market',
            'id'            => 'market',
            'value'         => 1,
            'checked'       => empty($this->validation_errors['post_data']['market']) ? FALSE : $this->validation_errors['post_data']['market']
        );
        
        $this->data['real_estate'] = array(
            'name'          => 'real_estate',
            'id'            => 'real_estate',
            'value'         => 1,
            'checked'       => empty($this->validation_errors['post_data']['real_estate']) ? FALSE : $this->validation_errors['post_data']['real_estate']
        );
        
        $this->data['job'] = array(
            'name'          => 'job',
            'id'            => 'job',
            'value'         => 1,
            'checked'       => empty($this->validation_errors['post_data']['job']) ? FALSE : $this->validation_errors['post_data']['job']
        );
        
        $this->data['parent'] = form_dropdown('parent', get_dropdown(prepareList($this->get_dropdown()), 'ជ្រើស​ក្រុម'), empty($this->validation_errors['post_data']['parent']) ? $pid : $this->validation_errors['post_data']['parent'], 'class="form-control" id="parent"');
        
        // process template
        $title = $this->lang->line('form_cagetory_create_heading');
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
            $layout_property['breadcrumb'] = array('categories' => $this->lang->line('index_cagetory_heading'), $title);
        }
        else
        {
            $layout_property['breadcrumb'] = array_merge(array('categories' => $this->lang->line('index_cagetory_heading')), generate_breadcrumb($pid, 'categories', 'categories', 'category'), array($title));
        }
        
        
        $layout_property['content']  = 'create';
        
        // menu
        $this->data['setting_menu'] = TRUE; $this->data['category_menu'] = TRUE;
        generate_template($this->data, $layout_property);
    }

    // save
    public function store()
    {
        parent::check_login();
        $parentId = trim($this->input->post('parent'));
        $data = array(
            'caption'   => trim($this->input->post('caption')),
            'slug'      => str_replace(' ', '-', strtolower(trim($this->input->post('caption')))),
            'parent_id' => $parentId,
            'article'   => trim($this->input->post('article')),
            'market'    => trim($this->input->post('market')),
            'real_estate'   => trim($this->input->post('real_estate')),
            'job'       => trim($this->input->post('job')),
            'order'     => $this->get_next_order('order', array('parent_id' => trim($this->input->post('parent')))),
            'status'    => 1
        );

        if(($cid = $this->insert($data)) != FALSE)
        {
            // set log
            array_unshift($data, $cid);
            set_log('Created Category', $data);

            $this->session->set_flashdata('message', $this->lang->line('form_cagetory_report_success'));
            redirect($parentId == FALSE ? 'categories' : 'categories/'.$parentId, 'refresh');
        }
        else
        {
            redirect_form_validation(validation_errors(), $this->input->post(), 'categories/create/'.$parentId);
        }
    }

    // edit
    public function edit($id)
    {
        parent::check_login();
        $this->load->helper('menu');
        
        // get category
        $category = $this->get_detail($id);
        
        $this->data['category_id'] = array('category_id' => $category->id);
        $this->data['category'] = $category;
            
        // set log
        set_log('View for Update Category', $category);
        
        // display form
        $this->data['caption'] = array(
            'name'  => 'caption',
            'id'    => 'caption',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['caption']) ? $category->caption : $this->validation_errors['post_data']['caption']
        );
        
        $this->data['article'] = array(
            'name'          => 'article',
            'id'            => 'article',
            'value'         => 1,
            'checked'       => empty($this->validation_errors['post_data']['article']) ? $category->article : $this->validation_errors['post_data']['article']
        );
        
        $this->data['market'] = array(
            'name'          => 'market',
            'id'            => 'market',
            'value'         => 1,
            'checked'       => empty($this->validation_errors['post_data']['market']) ? $category->market : $this->validation_errors['post_data']['market']
        );
        
        $this->data['real_estate'] = array(
            'name'          => 'real_estate',
            'id'            => 'real_estate',
            'value'         => 1,
            'checked'       => empty($this->validation_errors['post_data']['real_estate']) ? $category->real_estate : $this->validation_errors['post_data']['real_estate']
        );
        
        $this->data['job'] = array(
            'name'          => 'job',
            'id'            => 'job',
            'value'         => 1,
            'checked'       => empty($this->validation_errors['post_data']['job']) ? $category->job : $this->validation_errors['post_data']['job']
        );
        
        $this->data['parent'] = form_dropdown('parent', get_dropdown(prepareList($this->get_dropdown()), 'ជ្រើស​ក្រុម'), empty($this->validation_errors['post_data']['parent']) ? $category->parent_id : $this->validation_errors['post_data']['parent'], 'class="form-control" id="parent"');
        
        // process template
        $title = $this->lang->line('form_cagetory_edit_heading');
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
        $layout_property['breadcrumb'] = array_merge(array('categories' => $this->lang->line('index_cagetory_heading')), generate_breadcrumb($category->parent_id, 'categories', 'categories', 'category'), array($title));
        
        $layout_property['content']  = 'edit';
        
        // menu
        $this->data['setting_menu'] = TRUE; $this->data['category_menu'] = TRUE;
        generate_template($this->data, $layout_property);
    }

    // update
    public function modify()
    {
        parent::check_login();
        $id = $this->input->post('category_id');
        $parentId = trim($this->input->post('parent'));
        $data = array(
            'caption'   => trim($this->input->post('caption')),
            'slug'      => str_replace(' ', '-', strtolower(trim($this->input->post('caption')))),
            'parent_id' => $parentId,
            'article'   => trim($this->input->post('article')),
            'market'    => trim($this->input->post('market')),
            'real_estate'=> trim($this->input->post('real_estate')),
            'job'       => trim($this->input->post('job'))
        );
        
        $this->category->validate[0]['rules'] = 'trim|required|xss_clean';

        if($this->update($id, $data))
        {
            // set log
            array_unshift($data, $id);
            set_log('Updated Category',$data);

            $this->session->set_flashdata('message', $this->lang->line('form_cagetory_report_success'));

            redirect($parentId == FALSE ? 'categories' : 'categories/'.$parentId, 'refresh');
        }
        else
        {
            redirect_form_validation(validation_errors(), $this->input->post(), 'categories/edit/'.$id);
        }
    }

    // delete
    public function destroy($id, $del_child = FALSE)
    {
        parent::check_login();       
        $category = $this->get($id);
        
        // do they have childs
        $get_childs = $this->get_many_by(array('parent_id' => $category->id));
        
        // delete category
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
                $this->delete_by(array('parent_id' => $category->id));
            }
            // set log
            set_log('Deleted Category', $category);
            
            $this->session->set_flashdata('message', $this->lang->line('del_cagetory_report_success'));
            redirect($category->parent_id == 0 ? 'categories' : 'categories/'. $category->parent_id, 'refresh');
        }
        else
        {
            $this->session->set_flashdata('message', $this->lang->line('del_cagetory_report_error'));
            redirect($category->parent_id == 0 ? 'categories' : 'categories/'. $category->parent_id, 'refresh');
        }
    }
    
    // activate
    public function activate($id)
    {
        parent::check_login();
        $category = $this->get($id);
        if($this->update($category->id, array('status' => 1), TRUE))
        {
            // set log
            set_log('Activated Category', array($category->id, 1));
            $this->session->set_flashdata('message', 'ក្រុមអត្ថបទ​នេះ​ត្រូវ​បាន​ដាក់​ឲ្យ​ដំណើរ​ឡើង​វិញ!');
            redirect($category->parent_id == 0 ? 'categories' : 'categories/'. $category->parent_id, 'refresh');
        }
        else
        {
            $this->session->set_flashdata('message', 'ការ​ដាក់​ឲ្យ​ដំណើរ​ការ​ឡើង​វិញ​ មាន​បញ្ហា​! សូម​ព្យាយាម​ម្តង​ទៀត!');
            redirect($category->parent_id == 0 ? 'categories' : 'categories/'. $category->parent_id, 'refresh');
        }
    }
    
    // Deactivate
    public function deactivate($id)
    {
        parent::check_login();
        $category = $this->get($id);
        if($this->update($category->id, array('status' => 0), TRUE))
        {
            // set log
            set_log('Deactivated Category', array($category->id, 0));
            $this->session->set_flashdata('message', 'ក្រុម​អត្ថបទ​នេះ​បញ្ឈប់​ដំណើរ​ការ​រួចរាល់​ហើយ!');
            redirect($category->parent_id == 0 ? 'categories' : 'categories/'. $category->parent_id, 'refresh');
        }
        else
        {
            $this->session->set_flashdata('message', 'ការ​បញ្ឈប់​ដំណើរ​ការ​ក្រុម​អត្ថ​បទ​នេះ​ មាន​បញ្ហា​! សូម​ព្យាយាម​ម្តង​ទៀត!');
            redirect($category->parent_id == 0 ? 'categories' : 'categories/'. $category->parent_id, 'refresh');
        }
    }
    
    public function get($id, $array = FALSE)
    {
        if($array == TRUE){
            return $this->category->as_array()->get($id);
        }
        return $this->category->as_object()->get($id);
    }
    
    public function get_detail($where)
    {
        return $this->category->get_detail($where);
    }
    
    public function get_by($where, $array = FALSE)
    {
        if($array == TRUE){
            return $this->category->as_array()->get_by($where);
        }
        return $this->category->as_object()->get_by($where);
    }
    
    public function get_all($order_by = FALSE, $limit = FALSE, $offset = 0)
    {
        if($order_by != FALSE)
        {
            $this->category->order_by($order_by);
        }
        
        if($limit != FALSE)
        {
            $this->category->limit($limit, $offset);
        }
        return $this->category->get_all();
    }
    
    public function get_many_by($where, $order_by = FALSE, $limit = FALSE, $offset = 0)
    {
        if($order_by != FALSE)
        {
            $this->category->order_by($order_by);
        }
        
        if($limit != FALSE)
        {
            $this->category->limit($limit, $offset);
        }
        return $this->category->get_many_by($where);
    }
    
    public function get_all_records($where = FALSE)
    {
        return $this->category->get_all_records($where);
    }
    
    public function get_dropdown($where = FALSE)
    {
        return $this->category->get_dropdown($where);
    }
    
    public function get_list($where = FALSE)
    {
        return $this->category->get_list($where);
    }
    
    public function insert($data, $skip_validation = FALSE)
    {
        return $this->category->insert($data, $skip_validation);
    }
    
    public function insert_many($data, $skip_validation = FALSE)
    {
        return $this->category->insert_many($data, $skip_validation);
    }
    
    public function update($id, $data, $skip_validation = FALSE)
    {
        return $this->category->update($id, $data, $skip_validation);
    }
    
    public function delete($id)
    {
        return $this->category->delete($id);
    }
    
    public function delete_by($where)
    {
        return $this->category->delete_by($where);
    }
    
    public function count_all()
    {
        return $this->category->count_all();
    }
    
    public function count_by($where)
    {
        return $this->category->count_by($where);
    }
    
    public function dropdown($key, $value, $option_label = NULL, $where = NULL)
    {
        if($where != NULL){
            $this->db->where($where);
        }
        
        return $this->category->dropdown($key, $value,$option_label);
    }
    
    public function order_by($criteria, $order = NULL)
    {
        $this->category->order_by($criteria,$order);
    }
    
    public function get_next_order($field, $where)
    {
        return $this->category->get_next_order($field, $where);
    }
}