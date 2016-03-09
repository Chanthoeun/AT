<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of government_organization
 *
 * @author Chanthoeun
 */
class Government_organization extends Admin_Controller {
    public  $validation_errors =  array();
    
    public function __construct() {
        parent::__construct();
        $this->load->model('government_organization_model', 'government_organization');
        $this->lang->load('government_organization');
        
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
        $this->data['gos'] = $this->get_all_records(array('government_organization.parent_id' => 0));
        
        // process template
        $title = $this->lang->line('index_go_heading');
        $this->data['title'] = $title;
        
        $layout_property = parent::load_index_script();
        
        $layout_property['breadcrumb'] = array($title);
        
        $layout_property['content']  = 'index';
        
        // menu
        $this->data['setting_menu'] = TRUE; $this->data['government_organization_menu'] = TRUE;
        generate_template($this->data, $layout_property); 
    }
    
    public function get_index($pid)
    {
        parent::check_login();
        $parent_government_organization = $this->get($pid);
        $this->data['gos'] = $this->get_all_records(array('government_organization.parent_id' => $pid));
        $this->data['people'] = Modules::run('people/get_all_records', array('go_id' => $pid));
        
        // process template
        $title = $parent_government_organization->caption;
        $this->data['title'] = $title;
        
        $layout_property = parent::load_index_script();
        
        $layout_property['breadcrumb'] = array_merge(array('government-organization' => $this->lang->line('index_go_heading')), generate_breadcrumb($pid, 'government-organization', 'government_organization', 'government_organization'));
        
        $layout_property['content']  = 'index';
        
        // menu
        $this->data['setting_menu'] = TRUE; $this->data['government_organization_menu'] = TRUE;
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
        $title = $this->lang->line('form_go_create_heading');
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
            $layout_property['breadcrumb'] = array('government-organization' => $this->lang->line('index_go_heading'), $title);
        }
        else
        {
            $layout_property['breadcrumb'] = array_merge(array('government-organization' => $this->lang->line('index_go_heading')), generate_breadcrumb($pid, 'government-organization'), array($title));
        }
        
        $layout_property['content']  = 'create';
        
        // menu
        $this->data['setting_menu'] = TRUE; $this->data['government_organization_menu'] = TRUE;
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
            'order'     => $this->get_next_order('order', array('parent_id' => trim($this->input->post('parent'))))
        );

        if(($cid = $this->insert($data)) != FALSE)
        {
            // set log
            array_unshift($data, $cid);
            set_log('Created Government Organization', $data);

            $this->session->set_flashdata('message', $this->lang->line('form_go_report_success'));
            redirect($parentId == FALSE ? 'government-organization' : 'government-organization/'.$parentId, 'refresh');
        }
        else
        {
            redirect_form_validation(validation_errors(), $this->input->post(), 'government-organization/create/'.$parentId);
        }
    }

    // edit
    public function edit($id)
    {
        parent::check_login();
        $this->load->helper('menu');
        
        // get government_organization
        $go = $this->get_detail($id);
        
        $this->data['go_id'] = array('go_id' => $go->id);
        $this->data['go'] = $go;
            
        // set log
        set_log('View for Update Government Organization', $go);
        
        // display form
        $this->data['caption'] = array(
            'name'  => 'caption',
            'id'    => 'caption',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['caption']) ? $go->caption : $this->validation_errors['post_data']['caption']
        );
        
        $this->data['parent'] = form_dropdown('parent', get_dropdown(prepareList($this->get_dropdown()), 'ជ្រើស​ក្រុម'), empty($this->validation_errors['post_data']['parent']) ? $go->parent_id : $this->validation_errors['post_data']['parent'], 'class="form-control" id="parent"');
        
        // process template
        $title = $this->lang->line('form_go_edit_heading');
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
        $layout_property['breadcrumb'] = array_merge(array('government-organization' => $this->lang->line('index_go_heading')), generate_breadcrumb($go->parent_id, 'government-organization'), array($title));
        
        $layout_property['content']  = 'edit';
        
        // menu
        $this->data['setting_menu'] = TRUE; $this->data['government_organization_menu'] = TRUE;
        generate_template($this->data, $layout_property);
    }

    // update
    public function modify()
    {
        parent::check_login();
        $id = $this->input->post('go_id');
        $parentId = trim($this->input->post('parent'));
        $data = array(
            'caption'   => trim($this->input->post('caption')),
            'slug'      => str_replace(' ', '-', strtolower(trim($this->input->post('caption')))),
            'parent_id' => $parentId
        );
        
        $this->government_organization->validate[0]['rules'] = 'trim|required|xss_clean';

        if($this->update($id, $data))
        {
            // set log
            array_unshift($data, $id);
            set_log('Updated Government Organization',$data);

            $this->session->set_flashdata('message', $this->lang->line('form_go_report_success'));

            redirect($parentId == FALSE ? 'government-organization' : 'government-organization/'.$parentId, 'refresh');
        }
        else
        {
            redirect_form_validation(validation_errors(), $this->input->post(), 'government-organization/edit/'.$id);
        }
    }

    // delete
    public function destroy($id, $del_child = FALSE)
    {
        parent::check_login();       
        $go = $this->get($id);
        
        // do they have childs
        $get_childs = $this->get_many_by(array('parent_id' => $go->id));
        
        // delete government_organization
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
                $this->delete_by(array('parent_id' => $go->id));
            }
            // set log
            set_log('Deleted Government Organization', $go);
            
            $this->session->set_flashdata('message', $this->lang->line('del_go_report_success'));
            redirect($go->parent_id == 0 ? 'government-organization' : 'government-organization/'. $go->parent_id, 'refresh');
        }
        else
        {
            $this->session->set_flashdata('message', $this->lang->line('del_go_report_error'));
            redirect($go->parent_id == 0 ? 'government-organization' : 'government-organization/'. $go->parent_id, 'refresh');
        }
    }
    
    public function add_staff($goid)
    {
        parent::check_login();
        $this->form_validation->set_rules('name', $this->lang->line('form_staff_name_label'), 'trim|required|xss_clean', array('required' => '%s តម្រូវ​ឲ្យ​មាន'));
        $this->form_validation->set_rules('position', $this->lang->line('form_staff_position_label'), 'trim|required|xss_clean', array('required' => '%s តម្រូវ​ឲ្យ​មាន'));
        $this->form_validation->set_rules('telephone', $this->lang->line('form_staff_telephone_label'), 'trim|required|xss_clean', array('required' => '%s តម្រូវ​ឲ្យ​មាន'));
        $this->form_validation->set_rules('email', $this->lang->line('form_staff_email_label'), 'trim|xss_clean');
        $this->form_validation->set_rules('social', $this->lang->line('form_staff_social_label'), 'trim|xss_clean');
        if($this->form_validation->run() === TRUE)
        {
            $data = array(
                'name'   => trim($this->input->post('name')),
                'organization' => 'ក្រសួង​កសិកម្ម រុក្ខាប្រមាញ់ និងនេសាទ',
                'position' => trim($this->input->post('position')),
                'telephone'   => trim($this->input->post('telephone')),
                'email'    => trim($this->input->post('email')),
                'social_media'   => trim($this->input->post('social')),
                'people_group_id' => 2,
                'go_id'     => $goid
            );
            
            if(($pid = Modules::run('people/insert', $data, TRUE)) != FALSE)
            {
                // set log
                array_unshift($data, $pid);
                set_log('Created People', $data);

                $this->session->set_flashdata('message', $this->lang->line('form_staff_report_success'));
                redirect('government-organization/'.$goid, 'refresh');
            }
        }
        
        $this->data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
        
        // display form
        $this->data['name'] = array(
            'name'  => 'name',
            'id'    => 'name',
            'class' => 'form-control',
            'value' => set_value('name')
        );
        
        $this->data['position'] = array(
            'name'  => 'position',
            'id'    => 'position',
            'class' => 'form-control',
            'value' => set_value('position')
        );
        
        $this->data['telephone'] = array(
            'name'  => 'telephone',
            'id'    => 'telephone',
            'class' => 'form-control',
            'value' => set_value('telephone')
        );
        
        $this->data['email'] = array(
            'name'  => 'email',
            'id'    => 'email',
            'class' => 'form-control',
            'value' => set_value('email')
        );
        
        $this->data['social'] = array(
            'name'  => 'social',
            'id'    => 'social',
            'class' => 'form-control',
            'value' => set_value('social')
        );
        
        // process template
        $title = $this->lang->line('form_staff_create_heading');
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
        if($goid == FALSE)
        {
            $layout_property['breadcrumb'] = array('government-organization' => $this->lang->line('index_go_heading'), $title);
        }
        else
        {
            $layout_property['breadcrumb'] = array_merge(array('government-organization' => $this->lang->line('index_go_heading')), generate_breadcrumb($goid, 'government-organization'), array($title));
        }
        
        $layout_property['content']  = 'add_staff';
        
        // menu
        $this->data['setting_menu'] = TRUE; $this->data['government_organization_menu'] = TRUE;
        generate_template($this->data, $layout_property);
    }
    
    public function edit_staff($id)
    {
        parent::check_login();
        $this->data['p'] = Modules::run('people/get_detail', $id);
        
        $this->form_validation->set_rules('name', $this->lang->line('form_staff_name_label'), 'trim|required|xss_clean', array('required' => '%s តម្រូវ​ឲ្យ​មាន'));
        $this->form_validation->set_rules('position', $this->lang->line('form_staff_position_label'), 'trim|required|xss_clean', array('required' => '%s តម្រូវ​ឲ្យ​មាន'));
        $this->form_validation->set_rules('telephone', $this->lang->line('form_staff_telephone_label'), 'trim|required|xss_clean', array('required' => '%s តម្រូវ​ឲ្យ​មាន'));
        $this->form_validation->set_rules('email', $this->lang->line('form_staff_email_label'), 'trim|xss_clean');
        $this->form_validation->set_rules('social', $this->lang->line('form_staff_social_label'), 'trim|xss_clean');
        if($this->form_validation->run() === TRUE)
        {
            $data = array(
                'name'   => trim($this->input->post('name')),
                'organization' => 'ក្រសួង​កសិកម្ម រុក្ខាប្រមាញ់ និងនេសាទ',
                'position' => trim($this->input->post('position')),
                'telephone'   => trim($this->input->post('telephone')),
                'email'    => trim($this->input->post('email')),
                'social_media'   => trim($this->input->post('social')),
            );
            
            if(Modules::run('people/update', $this->data['p']->id, $data, TRUE))
            {
                // set log
                array_unshift($data, $this->data['p']->id);
                set_log('Update People', $data);

                $this->session->set_flashdata('message', $this->lang->line('form_staff_update_report_success'));
                redirect('government-organization/'.$this->data['p']->go_id, 'refresh');
            }
        }
        
        $this->data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
        
        // display form
        $this->data['name'] = array(
            'name'  => 'name',
            'id'    => 'name',
            'class' => 'form-control',
            'value' => set_value('name', $this->data['p']->name)
        );
        
        $this->data['position'] = array(
            'name'  => 'position',
            'id'    => 'position',
            'class' => 'form-control',
            'value' => set_value('position', $this->data['p']->position)
        );
        
        $this->data['telephone'] = array(
            'name'  => 'telephone',
            'id'    => 'telephone',
            'class' => 'form-control',
            'value' => set_value('telephone', $this->data['p']->telephone)
        );
        
        $this->data['email'] = array(
            'name'  => 'email',
            'id'    => 'email',
            'class' => 'form-control',
            'value' => set_value('email', $this->data['p']->email)
        );
        
        $this->data['social'] = array(
            'name'  => 'social',
            'id'    => 'social',
            'class' => 'form-control',
            'value' => set_value('social', $this->data['p']->social_media)
        );
        
        // process template
        $title = $this->lang->line('form_staff_edit_heading');
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
        if($this->data['p']->go_id == FALSE)
        {
            $layout_property['breadcrumb'] = array('government-organization' => $this->lang->line('index_go_heading'), $title);
        }
        else
        {
            $layout_property['breadcrumb'] = array_merge(array('government-organization' => $this->lang->line('index_go_heading')), generate_breadcrumb($this->data['p']->go_id, 'government-organization'), array($title));
        }
        
        $layout_property['content']  = 'edit_staff';
        
        // menu
        $this->data['setting_menu'] = TRUE; $this->data['government_organization_menu'] = TRUE;
        generate_template($this->data, $layout_property);
        
    }
    
    public function del_staff($id)
    {
        parent::check_login();
        $p = Modules::run('people/get_detail', $id);
        
        if(Modules::run('people/delete', $p->id))
        {
            // set log
            set_log('Deleted People', $p);
            $this->session->set_flashdata('message', $this->lang->line('del_staff_report_success'));
        }
        else
        {
            $this->session->set_flashdata('message', $this->lang->line('del_staff_report_error'));
        }
        redirect('government-organization/'.$p->go_id, 'refresh');
    }
    
    public function get($id, $array = FALSE)
    {
        if($array == TRUE){
            return $this->government_organization->as_array()->get($id);
        }
        return $this->government_organization->as_object()->get($id);
    }
    
    public function get_detail($where)
    {
        return $this->government_organization->get_detail($where);
    }
    
    public function get_by($where, $array = FALSE)
    {
        if($array == TRUE){
            return $this->government_organization->as_array()->get_by($where);
        }
        return $this->government_organization->as_object()->get_by($where);
    }
    
    public function get_all($order_by = FALSE, $limit = FALSE, $offset = 0)
    {
        if($order_by != FALSE)
        {
            $this->government_organization->order_by($order_by);
        }
        
        if($limit != FALSE)
        {
            $this->government_organization->limit($limit, $offset);
        }
        return $this->government_organization->get_all();
    }
    
    public function get_many_by($where, $order_by = FALSE, $limit = FALSE, $offset = 0)
    {
        if($order_by != FALSE)
        {
            $this->government_organization->order_by($order_by);
        }
        
        if($limit != FALSE)
        {
            $this->government_organization->limit($limit, $offset);
        }
        return $this->government_organization->get_many_by($where);
    }
    
    public function get_all_records($where = FALSE)
    {
        return $this->government_organization->get_all_records($where);
    }
    
    public function get_dropdown($where = FALSE)
    {
        return $this->government_organization->get_dropdown($where);
    }
    
    public function get_list($where = FALSE)
    {
        return $this->government_organization->get_list($where);
    }
    
    public function insert($data, $skip_validation = FALSE)
    {
        return $this->government_organization->insert($data, $skip_validation);
    }
    
    public function insert_many($data, $skip_validation = FALSE)
    {
        return $this->government_organization->insert_many($data, $skip_validation);
    }
    
    public function update($id, $data, $skip_validation = FALSE)
    {
        return $this->government_organization->update($id, $data, $skip_validation);
    }
    
    public function delete($id)
    {
        return $this->government_organization->delete($id);
    }
    
    public function delete_by($where)
    {
        return $this->government_organization->delete_by($where);
    }
    
    public function count_all()
    {
        return $this->government_organization->count_all();
    }
    
    public function count_by($where)
    {
        return $this->government_organization->count_by($where);
    }
    
    public function dropdown($key, $value, $option_label = NULL, $where = NULL)
    {
        if($where != NULL){
            $this->db->where($where);
        }
        
        return $this->government_organization->dropdown($key, $value,$option_label);
    }
    
    public function order_by($criteria, $order = NULL)
    {
        $this->government_organization->order_by($criteria,$order);
    }
    
    public function get_next_order($field, $where)
    {
        return $this->government_organization->get_next_order($field, $where);
    }
}