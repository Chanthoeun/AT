<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of agribook_group
 *
 * @author Chanthoeun
 */
class Agribook_group extends Admin_Controller {
    public  $validation_errors =  array();
    
    public function __construct() {
        parent::__construct();
        $this->load->model('agribook_group_model', 'agribook_group');
        $this->lang->load('agribook_group');
        
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
        $this->data['ags'] = $this->get_all_records(array('agribook_group.parent_id' => 0));
        
        // process template
        $title = $this->lang->line('index_agribook_group_heading');
        $this->data['title'] = $title;
        
        $layout_property = parent::load_index_script();
        
        $layout_property['breadcrumb'] = array($title);
        
        $layout_property['content']  = 'index';
        
        // menu
        $this->data['setting_menu'] = TRUE; $this->data['agribook_groups_menu'] = TRUE;
        generate_template($this->data, $layout_property); 
    }
    
    public function get_index($pid)
    {
        parent::check_login();
        $pag = $this->get($pid);
        $this->data['ags'] = $this->get_all_records(array('agribook_group.parent_id' => $pid));
        
        // process template
        $title = $pag->caption;
        $this->data['title'] = $title;
        
        $layout_property = parent::load_index_script();
        
        $layout_property['breadcrumb'] = array_merge(array('agribook-group' => $this->lang->line('index_agribook_group_heading')), generate_breadcrumb($pid, 'agribook-group', 'agribook_group', 'agribook_group'));
        
        $layout_property['content']  = 'index';
        
        // menu
        $this->data['setting_menu'] = TRUE; $this->data['agribook_groups_menu'] = TRUE;
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
        $title = $this->lang->line('form_agribook_group_create_heading');
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
            $layout_property['breadcrumb'] = array('agribook-group' => $this->lang->line('index_agribook_group_heading'), $title);
        }
        else
        {
            $layout_property['breadcrumb'] = array_merge(array('agribook-group' => $this->lang->line('index_agribook_group_heading')), generate_breadcrumb($pid, 'agribook-group'), array($title));
        }
        
        
        $layout_property['content']  = 'create';
        
        // menu
        $this->data['setting_menu'] = TRUE; $this->data['agribook_groups_menu'] = TRUE;
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
            'order'     => $this->get_next_order('order', array('parent_id' => $parentId)),
        );

        if(($agid = $this->insert($data)) != FALSE)
        {
            // set log
            array_unshift($data, $agid);
            set_log('Created Agribook Group', $data);

            $this->session->set_flashdata('message', $this->lang->line('form_agribook_group_report_success'));
            redirect($parentId == FALSE ? 'agribook-group' : 'agribook-group/'.$parentId, 'refresh');
        }
        else
        {
            redirect_form_validation(validation_errors(), $this->input->post(), 'agribook-group/create/'.$parentId);
        }
    }

    // edit
    public function edit($id)
    {
        parent::check_login();
        $this->load->helper('menu');
        
        // get agribook_group
        $ag = $this->get_detail($id);
        
        $this->data['ag_id'] = array('ag_id' => $ag->id);
        $this->data['ag'] = $ag;
            
        // set log
        set_log('View for Update Agribook Group', $ag);
        
        // display form
        $this->data['caption'] = array(
            'name'  => 'caption',
            'id'    => 'caption',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['caption']) ? $ag->caption : $this->validation_errors['post_data']['caption']
        );
        
        $this->data['parent'] = form_dropdown('parent', get_dropdown(prepareList($this->get_dropdown()), 'ជ្រើស​ក្រុម'), empty($this->validation_errors['post_data']['parent']) ? $ag->parent_id : $this->validation_errors['post_data']['parent'], 'class="form-control" id="parent"');
        
        // process template
        $title = $this->lang->line('form_agribook_group_edit_heading');
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
        $layout_property['breadcrumb'] = array_merge(array('agribook-group' => $this->lang->line('index_agribook_group_heading')), generate_breadcrumb($ag->parent_id, 'agribook-group', 'agribook_group', 'agribook_group'), array($title));
        
        $layout_property['content']  = 'edit';
        
        // menu
        $this->data['setting_menu'] = TRUE; $this->data['agribook_groups_menu'] = TRUE;
        generate_template($this->data, $layout_property);
    }

    // update
    public function modify()
    {
        parent::check_login();
        $id = $this->input->post('ag_id');
        $parentId = trim($this->input->post('parent'));
        $data = array(
            'caption'   => trim($this->input->post('caption')),
            'slug'      => str_replace(' ', '-', strtolower(trim($this->input->post('caption')))),
            'parent_id' => $parentId
        );
        
        $this->agribook_group->validate[0]['rules'] = 'trim|required|xss_clean';

        if($this->update($id, $data))
        {
            // set log
            array_unshift($data, $id);
            set_log('Updated Agribook Group',$data);

            $this->session->set_flashdata('message', $this->lang->line('form_agribook_group_report_success'));

            redirect($parentId == FALSE ? 'agribook-group' : 'agribook-group/'.$parentId, 'refresh');
        }
        else
        {
            redirect_form_validation(validation_errors(), $this->input->post(), 'agribook-group/edit/'.$id);
        }
    }

    // delete
    public function destroy($id, $del_child = FALSE)
    {
        parent::check_login();       
        $ag = $this->get($id);
        
        // do they have childs
        $get_childs = $this->get_many_by(array('parent_id' => $ag->id));
        
        // delete agribook_group
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
                $this->delete_by(array('parent_id' => $ag->id));
            }
            // set log
            set_log('Deleted Agribook Group', $ag);
            
            $this->session->set_flashdata('message', $this->lang->line('del_agribook_group_report_success'));
        }
        else
        {
            $this->session->set_flashdata('message', $this->lang->line('del_agribook_group_report_error'));
        }
        redirect($ag->parent_id == 0 ? 'agribook-group' : 'agribook-group/'. $ag->parent_id, 'refresh');
    }
    
    public function get($id, $array = FALSE)
    {
        if($array == TRUE){
            return $this->agribook_group->as_array()->get($id);
        }
        return $this->agribook_group->as_object()->get($id);
    }
    
    public function get_detail($where)
    {
        return $this->agribook_group->get_detail($where);
    }
    
    public function get_by($where, $array = FALSE)
    {
        if($array == TRUE){
            return $this->agribook_group->as_array()->get_by($where);
        }
        return $this->agribook_group->as_object()->get_by($where);
    }
    
    public function get_all($order_by = FALSE, $limit = FALSE, $offset = 0)
    {
        if($order_by != FALSE)
        {
            $this->agribook_group->order_by($order_by);
        }
        
        if($limit != FALSE)
        {
            $this->agribook_group->limit($limit, $offset);
        }
        return $this->agribook_group->get_all();
    }
    
    public function get_many_by($where, $order_by = FALSE, $limit = FALSE, $offset = 0)
    {
        if($order_by != FALSE)
        {
            $this->agribook_group->order_by($order_by);
        }
        
        if($limit != FALSE)
        {
            $this->agribook_group->limit($limit, $offset);
        }
        return $this->agribook_group->get_many_by($where);
    }
    
    public function get_all_records($where = FALSE)
    {
        return $this->agribook_group->get_all_records($where);
    }
    
    public function get_dropdown($where = FALSE)
    {
        return $this->agribook_group->get_dropdown($where);
    }
    
    public function get_list($where = FALSE)
    {
        return $this->agribook_group->get_list($where);
    }
    
    public function insert($data, $skip_validation = FALSE)
    {
        return $this->agribook_group->insert($data, $skip_validation);
    }
    
    public function insert_many($data, $skip_validation = FALSE)
    {
        return $this->agribook_group->insert_many($data, $skip_validation);
    }
    
    public function update($id, $data, $skip_validation = FALSE)
    {
        return $this->agribook_group->update($id, $data, $skip_validation);
    }
    
    public function delete($id)
    {
        return $this->agribook_group->delete($id);
    }
    
    public function delete_by($where)
    {
        return $this->agribook_group->delete_by($where);
    }
    
    public function count_all()
    {
        return $this->agribook_group->count_all();
    }
    
    public function count_by($where)
    {
        return $this->agribook_group->count_by($where);
    }
    
    public function dropdown($key, $value, $option_label = NULL, $where = NULL)
    {
        if($where != NULL){
            $this->db->where($where);
        }
        
        return $this->agribook_group->dropdown($key, $value,$option_label);
    }
    
    public function order_by($criteria, $order = NULL)
    {
        $this->agribook_group->order_by($criteria,$order);
    }
    
    public function get_next_order($field, $where)
    {
        return $this->agribook_group->get_next_order($field, $where);
    }
}