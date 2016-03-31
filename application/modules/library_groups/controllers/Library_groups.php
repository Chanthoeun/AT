<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of library_group
 *
 * @author Chanthoeun
 */
class Library_groups extends Admin_Controller {
    public  $validation_errors =  array();
    
    public function __construct() {
        parent::__construct();
        $this->load->model('library_group_model', 'library_group');
        $this->lang->load('library_group');
        
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
        $this->data['library_groups'] = $this->get_all_records(array('library_group.parent_id' => FALSE));
        
        // process template
        $title = $this->lang->line('index_library_group_heading');
        $this->data['title'] = $title;
        
        $layout_property = parent::load_index_script();
        
        $layout_property['breadcrumb'] = array($title);
        
        $layout_property['content']  = 'index';
        
        // menu
        $this->data['setting_menu'] = TRUE; $this->data['library_groups_menu'] = TRUE;
        generate_template($this->data, $layout_property); 
    }
    
    public function get_index($pid)
    {
        parent::check_login();
        $this->data['library_groups'] = $this->get_all_records(array('library_group.parent_id' => $pid));
        
        // process template
        $title = $this->lang->line('index_library_group_heading');
        $this->data['title'] = $title;
        
        $layout_property = parent::load_index_script();
        
        $layout_property['breadcrumb'] = array_merge(array('library_groups' => $this->lang->line('index_library_group_heading')), generate_breadcrumb($pid, 'library-groups', 'library_groups', 'library_group'));
        
        $layout_property['content']  = 'index';
        
        // menu
        $this->data['setting_menu'] = TRUE; $this->data['library_groups_menu'] = TRUE;
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
        $title = $this->lang->line('form_library_group_create_heading');
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
            $layout_property['breadcrumb'] = array('library-groups' => $this->lang->line('index_library_group_heading'), $title);
        }
        else
        {
            $layout_property['breadcrumb'] = array_merge(array('library-groups' => $this->lang->line('index_library_group_heading')), generate_breadcrumb($pid, 'library-groups', 'library_groups', 'library_group'), array($title));
        }
        
        
        
        $layout_property['content']  = 'create';
        
        // menu
        $this->data['setting_menu'] = TRUE; $this->data['library_groups_menu'] = TRUE;
        generate_template($this->data, $layout_property); 
    }

    // save
    public function store()
    {
        parent::check_login();
        $parentId = trim($this->input->post('parent'));
        $data = array(
            'caption' => trim($this->input->post('caption')),
            'parent_id' => $parentId
        );

        if (($atid = $this->insert($data)) != FALSE)
        {
            // set log
            array_unshift($data, $atid);
            set_log('Created Library Group', $data);

            $this->session->set_flashdata('message', $this->lang->line('form_library_group_report_success'));
            redirect('library-groups/'.$parentId, 'refresh');
        }
        else
        {
            redirect_form_validation(validation_errors(), $this->input->post(), 'library-groups/create/'.$parentId);
        }
    }

    // edit
    public function edit($id)
    {
        parent::check_login();
        $this->load->helper('menu');
        $library_group = $this->get($id);
        $this->data['library_group_id'] = array('library_group_id' => $library_group->id);
        $this->data['library_group'] = $library_group;

        // set log
        set_log('View Update Library Group', $library_group);
        
        // display form
        $this->data['caption'] = array(
            'name'  => 'caption',
            'id'    => 'caption',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['caption']) ? $library_group->caption : $this->validation_errors['post_data']['caption']
        );
        
        $this->data['parent'] = form_dropdown('parent', get_dropdown(prepareList($this->get_dropdown()), 'ជ្រើស​ក្រុម'), empty($this->validation_errors['post_data']['parent']) ? $library_group->parent_id : $this->validation_errors['post_data']['parent'], 'class="form-control" id="parent"');
        
        // process template
        $title = $this->lang->line('form_library_group_edit_heading');
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
        
        $layout_property['breadcrumb'] = array_merge(array('library-groups' => $this->lang->line('index_library_group_heading')), generate_breadcrumb($library_group->parent_id, 'library-groups', 'library_groups', 'library_group'), array($title));
        
        $layout_property['content']  = 'edit';
        
        // menu
        $this->data['setting_menu'] = TRUE; $this->data['library_groups_menu'] = TRUE;
        generate_template($this->data, $layout_property); 
    }
    
    // update
    public function modify()
    {
        parent::check_login();
        $id = $this->input->post('library_group_id');
        $parentId = trim($this->input->post('parent'));
        $data = array(
            'caption' => trim($this->input->post('caption')),
            'parent_id' => $parentId
        );
        
        $this->library_group->validate[0]['rules'] = 'trim|required|xss_clean';
        if($this->update($id, $data))
        {
            // set log
            array_unshift($data, $id);
            set_log('Updated Library Group', $data);

            $this->session->set_flashdata('message', $this->lang->line('form_library_group_report_success'));
            redirect('library-groups/'.$parentId, 'refresh');
        }
        else
        {
            redirect_form_validation(validation_errors(), $this->input->post(), 'library-groups/edit/'.$id);
        }
    }

    // delete
    public function destroy($id, $del_child = FALSE)
    {
        parent::check_login();
        $library_group = $this->get($id);
        
        // do they have childs
        $get_childs = $this->get_many_by(array('parent_id' => $library_group->id));
        
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
                $this->delete_by(array('parent_id' => $library_group->id));
            }
            
            // set log
            set_log('Deleted Library Group', $library_group);
            
            $this->session->set_flashdata('message', $this->lang->line('del_library_group_report_success'));
        }
        else
        {
            $this->session->set_flashdata('message', $this->lang->line('del_library_group_report_error'));
        }
        redirect('library-groups/'.$library_group->parent+_id, 'refresh');
    }
    
    public function get($id, $array = FALSE)
    {
        if($array == TRUE){
            return $this->library_group->as_array()->get($id);
        }
        return $this->library_group->as_object()->get($id);
    }
      
    public function get_by($where, $array = FALSE)
    {
        if($array == TRUE){
            return $this->library_group->as_array()->get_by($where);
        }
        return $this->library_group->as_object()->get_by($where);
    }
    
    public function get_detail($where)
    {
        return $this->library_group->get_detail($where);
    }
    
    public function get_all()
    {
        return $this->library_group->get_all();
    }
    
    public function get_many_by($where)
    {
        return $this->library_group->get_many_by($where);
    }
    
    public function get_all_records($where = FALSE)
    {
        return $this->library_group->get_all_records($where);
    }
    
    public function get_dropdown($where = FALSE)
    {
        return $this->library_group->get_dropdown($where);
    }
    
    public function get_list($where = FALSE)
    {
        return $this->library_group->get_list($where);
    }
    
    public function insert($data, $skip_validation = FALSE)
    {
        return $this->library_group->insert($data, $skip_validation);
    }
    
    public function insert_many($data, $skip_validation = FALSE)
    {
        return $this->library_group->insert_many($data, $skip_validation);
    }
    
    public function update($id, $data, $skip_validation = FALSE)
    {
        return $this->library_group->update($id, $data, $skip_validation);
    }
    
    public function delete($id)
    {
        return $this->library_group->delete($id);
    }
    
    public function delete_by($where)
    {
        return $this->library_group->delete_by($where);
    }
    
    public function count_all()
    {
        return $this->library_group->count_all();
    }
    
    public function count_by($where)
    {
        return $this->library_group->count_by($where);
    }
    
    public function dropdown($key, $value, $option_label = NULL, $where = NULL)
    {
        if($where != NULL){
            $this->db->where($where);
        }
        
        return $this->library_group->dropdown($key, $value,$option_label);
    }
    
    public function order_by($criteria, $order = NULL)
    {
        $this->library_group->order_by($criteria,$order);
    }

}