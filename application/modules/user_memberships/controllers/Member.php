<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of user_membership
 *
 * @author Chanthoeun
 */
class Member extends Admin_Controller {
    public  $validation_errors =  array();
    
    public function __construct() {
        parent::__construct();
        $this->load->model('user_membership_model', 'user_membership');
        $this->lang->load('user_membership');
        
        // message
        $this->validation_errors = $this->session->flashdata('validation_errors');
        $this->data['message'] = empty($this->validation_errors['errors']) ? $this->session->flashdata('message') : $this->validation_errors['errors'];
        
        if(parent::check_member_login() == FALSE)
        {
            redirect('membership_contacts/member/create/1', 'refresh');
        }
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
    
    // lists
    public function index()
    {
        $membership = parent::check_member_login();
        $this->data['membership'] = $membership;
        $this->data['users'] = $this->get_with_users(array('membership_id' => $membership->id));
        
        // process template
        $title = $this->lang->line('index_user_membership_heading');
        $this->data['title'] = $title;
        
        $layout_property = parent::load_index_script();
        
        $layout_property['breadcrumb'] = array($title);
        
        $layout_property['content']  = 'member_index';
        $layout_property['sidebar'] = 'memberships/member_sidebar';
        
        // menu
        $this->data['account_menu'] = TRUE; $this->data['user_menu'] = TRUE;
        generate_template($this->data, $layout_property);
    }

    // edit
    public function edit($id)
    {
        $membership = parent::check_member_login();
        $this->data['membership'] = $membership;        
        
        $user = $this->get_with_user(array('user_membership.id' => $id));
        
        $this->data['user_id']  = array(
            'user_id' => $user->id
        );
        
        // set log
        set_log('View Update Membership User', $user);
        
        // display form
        $this->data['username'] = array(
            'name'  => 'username',
            'id'    => 'username',
            'class' => 'form-control',
            'placeholder'=> 'Enter username',
            'value' => empty($this->validation_errors['post_data']['username']) ? $user->username : $this->validation_errors['post_data']['username']
        );
        
        $this->data['email'] = array(
            'name'  => 'email',
            'id'    => 'email',
            'class' => 'form-control',
            'type'  => 'email',
            'placeholder'=> 'Enter email address',
            'value' => empty($this->validation_errors['post_data']['email']) ? $user->email : $this->validation_errors['post_data']['email']
        );
        
        $this->data['password'] = array(
            'name'  => 'password',
            'id'    => 'password',
            'class' => 'form-control',
            'placeholder'=> 'Enter password',
            'value' => empty($this->validation_errors['post_data']['password']) ? NULL : $this->validation_errors['post_data']['password']
        );
        
        $this->data['cpassword'] = array(
            'name'  => 'cpassword',
            'id'    => 'cpassword',
            'class' => 'form-control',
            'placeholder'=> 'Enter comfirm password',
            'value' => empty($this->validation_errors['post_data']['cpassword']) ? NULL : $this->validation_errors['post_data']['cpassword']
        );
        
        
        // process template
        $title = $this->lang->line('form_user_membership_edit_heading');
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
        $layout_property['breadcrumb'] = array('user_memberships/member' => $this->lang->line('index_user_membership_heading'), $title);
        
        $layout_property['content']  = 'member_edit';
        $layout_property['sidebar'] = 'memberships/member_sidebar';
        
        // menu
        $this->data['account_menu'] = TRUE; $this->data['user_menu'] = TRUE;
        generate_template($this->data, $layout_property); 
    }

    // update
    public function modify()
    {
        parent::check_member_login();
        $id = $this->input->post('user_id');
        
        $data = array(
            'username' => $this->input->post('username'),
            'email' => $this->input->post('email'),
            
        );
        
        // $get company user 
        $user_membership = $this->get_by(array('user_membership.id' => $id));
        $user = $this->ion_auth->user($user_membership->user_id)->row();            

        // allow password field blank
        if ($this->input->post('password'))
        {
            $data['password'] = $this->input->post('password');
        }
        else 
        {
            $this->user_membership->validate[2]['rules'] = 'trim|min_length[6]|max_length[20]|matches[cpassword]';
            $this->user_membership->validate[3]['rules'] = 'trim';
        }

        // check username and email is changing
        if($user->username == $data['username'])
        {
            $this->user_membership->validate[0]['rules'] = 'trim|required|xss_clean';
        }

        if($user->email == $data['email'])
        {
            $this->user_membership->validate[1]['rules'] = 'trim|required|xss_clean';
        }

        // validate data
        if($this->user_membership->validate($data))
        {
            if($this->ion_auth->update($user_membership->user_id, $data))
            {
                // set log
                array_unshift($data, $user_membership->user_id);
                set_log('Update User Member', $data);

                $this->session->set_flashdata('message', $this->lang->line('form_user_membership_report_success'));
                redirect('user_memberships/member', 'refresh');
            }
            else
            {
                $this->session->set_flashdata('message', $this->lang->line('form_user_membership_report_error'));
                redirect_form_validation(validation_errors(), $this->input->post(), 'user_memberships/member/edit/'.$id);
            }
        }
        else
        {
            redirect_form_validation(validation_errors(), $this->input->post(), 'user_memberships/member/edit/'.$id);
        }
    }

    
    public function get($id, $array = FALSE)
    {
        if($array == TRUE){
            return $this->user_membership->as_array()->get($id);
        }
        return $this->user_membership->as_object()->get($id);
    }
    
    public function get_by($where, $array = FALSE)
    {
        if($array == TRUE){
            return $this->user_membership->as_array()->get_by($where);
        }
        return $this->user_membership->as_object()->get_by($where);
    }
    
    public function get_all($order_by = FALSE, $limit = FALSE, $offset = 0)
    {
        if($order_by != FALSE)
        {
            $this->order_by($order_by);
        }
        if($limit != FALSE)
        {
            $this->user_membership->limit($limit, $offset);
        }
        return $this->user_membership->get_all();
    }
    
    public function get_many_by($where, $order_by = FALSE, $limit = FALSE, $offset = 0)
    {
        if($order_by != FALSE)
        {
            $this->order_by($order_by);
        }
        if($limit != FALSE)
        {
            $this->user_membership->limit($limit, $offset);
        }
        return $this->user_membership->get_many_by($where);
    }
    
    public function get_with_user($where)
    {
        return $this->user_membership->get_with_user($where);
    }
    
    public function get_with_users($where = FALSE)
    {
        return $this->user_membership->get_with_users($where);
    }
    
    public function insert($data, $skip_validation = FALSE)
    {
        return $this->user_membership->insert($data, $skip_validation);
    }
    
    public function update($id, $data, $skip_validation = FALSE)
    {
        return $this->user_membership->update($id, $data, $skip_validation);
    }
    
    public function delete($id)
    {
        return $this->user_membership->delete($id);
    }
    
    public function delete_by($where)
    {
        return $this->user_membership->delete_by($where);
    }
}