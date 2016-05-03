<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of membership
 *
 * @author Chanthoeun
 */
class Members extends Admin_Controller {
     public  $validation_errors =  array();

     public function __construct() {
        parent::__construct();
        $this->lang->load(array('auth/auth', 'people/people', 'agribooks/agribook', 'member'));
        
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
    
    // list all
    public function index()
    {
        $userId = parent::check_login(FALSE);
        $this->data['checkLogin'] = $userId;
        if($userId == 'admin')
        {
            show_error('This page is not valid!');
        }
        $this->data['user'] = $this->ion_auth->user($userId)->row();
        $this->data['people'] = Modules::run('people/get_detail', array('user_id' => $this->data['user']->id));
        
        //check personal information
        if($this->data['people'] == FALSE)
        {
            redirect('members/update-profile/'.$userId, 'refresh');
        }
        
        if($this->data['people'] != FALSE && $this->data['people']->organization != FALSE)
        {
            $this->data['organization'] = Modules::run('agribooks/get_detail', "name = '{$this->data['people']->organization}' OR name_en ='{$this->data['people']->organization}'");
            
            if($this->data['people']->people_group_id == 4 && $this->data['organization'] == FALSE)
            {
                $this->session->set_userdata('organization', $this->data['people']->organization);
                redirect('agribooks/create/'.$this->data['user']->id, 'refresh');
            }
            
            // if it's has organization
            if($this->data['organization'] != FALSE)
            {
                $getLoc = explode('/', $this->data['organization']->location_id);

                switch (count($getLoc))
                {
                    case 1:
                        $province = Modules::run('locations/get',$getLoc[0])->caption;
                        $this->data['location'] = $province;
                        break;
                    case 2:
                        $province = Modules::run('locations/get',$getLoc[0])->caption;
                        $khan = Modules::run('locations/get',$getLoc[1])->caption;
                        $this->data['location'] = $khan.' / '.$province;
                        break;
                    case 3:
                        $province = Modules::run('locations/get',$getLoc[0])->caption;
                        $khan = Modules::run('locations/get',$getLoc[1])->caption;
                        $sangkat = Modules::run('locations/get',$getLoc[2])->caption;
                        $this->data['location'] = $sangkat.' / '.$khan.' / '.$province;
                        break;
                    default:
                        $province = Modules::run('locations/get',$getLoc[0])->caption;
                        $khan = Modules::run('locations/get',$getLoc[1])->caption;
                        $sangkat = Modules::run('locations/get',$getLoc[2])->caption;
                        $phum = Modules::run('locations/get',$getLoc[3])->caption;
                        $this->data['location'] = $phum.' / '.$sangkat.' / '.$khan.' / '.$province;
                        break;
                }

                // map 
                $map_config = array(
                    'center' => $this->data['organization']->map,
                    'zoom'  => '13',
                    'height' => '300px'
                );

                $marker = array(
                    'position' => $this->data['organization']->map,
                    'animation'=> 'Drop'
                );
                $this->data['map'] = get_google_map($map_config, $marker);
            }
        }
        
        // process template
        $title = $this->data['user']->username;
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
        if($userId == 'admin')
        {
            $layout_property['breadcrumb'] = array('auth/members' => $this->lang->line('member_label'), $title);
        }
        else 
        {
            $layout_property['breadcrumb'] = array($title);
        }
        
        
        $layout_property['content']  = 'profile';
        $layout_property['sidebar'] = 'sidebar';
        
        $this->data['dashboad_menu'] = TRUE; 
        generate_template($this->data, $layout_property);
    }
    
    public function get_index($id)
    {
        $checkLogin = parent::check_login(FALSE);
        $this->data['checkLogin'] = $checkLogin;
        $userId = $checkLogin == 'admin' ? $id : $checkLogin;
        $this->data['user'] = $this->ion_auth->user($userId)->row();
        $this->data['people'] = Modules::run('people/get_detail', array('user_id' => $this->data['user']->id));
        
        //check personal information
        if($this->data['people'] == FALSE)
        {
            redirect('members/update-profile/'.$userId, 'refresh');
        }
        
        if($this->data['people'] != FALSE && $this->data['people']->organization != FALSE)
        {
            $this->data['organization'] = Modules::run('agribooks/get_detail', "name = '{$this->data['people']->organization}' OR name_en ='{$this->data['people']->organization}'");
            if($this->data['people']->people_group_id == 4 && $this->data['organization'] == FALSE)
            {
                $this->session->set_userdata('organization', $this->data['people']->organization);
                redirect('agribooks/create/'.$this->data['user']->id, 'refresh');
            }
            // if it's has organization
            if($this->data['organization'] != FALSE)
            {
                $getLoc = explode('/', $this->data['organization']->location_id);

                switch (count($getLoc))
                {
                    case 1:
                        $province = Modules::run('locations/get',$getLoc[0])->caption;
                        $this->data['location'] = $province;
                        break;
                    case 2:
                        $province = Modules::run('locations/get',$getLoc[0])->caption;
                        $khan = Modules::run('locations/get',$getLoc[1])->caption;
                        $this->data['location'] = $khan.' / '.$province;
                        break;
                    case 3:
                        $province = Modules::run('locations/get',$getLoc[0])->caption;
                        $khan = Modules::run('locations/get',$getLoc[1])->caption;
                        $sangkat = Modules::run('locations/get',$getLoc[2])->caption;
                        $this->data['location'] = $sangkat.' / '.$khan.' / '.$province;
                        break;
                    default:
                        $province = Modules::run('locations/get',$getLoc[0])->caption;
                        $khan = Modules::run('locations/get',$getLoc[1])->caption;
                        $sangkat = Modules::run('locations/get',$getLoc[2])->caption;
                        $phum = Modules::run('locations/get',$getLoc[3])->caption;
                        $this->data['location'] = $phum.' / '.$sangkat.' / '.$khan.' / '.$province;
                        break;
                }

                // map 
                $map_config = array(
                    'center' => $this->data['organization']->map,
                    'zoom'  => '13',
                    'height' => '300px'
                );

                $marker = array(
                    'position' => $this->data['organization']->map,
                    'animation'=> 'Drop'
                );
                $this->data['map'] = get_google_map($map_config, $marker);
            }
        }
        
        
        // process template
        $title = $this->data['user']->username;
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
        if($checkLogin == 'admin')
        {
            $layout_property['breadcrumb'] = array('auth/members' => $this->lang->line('member_label'), $title);
        }
        else 
        {
            $layout_property['breadcrumb'] = array($title);
        }
        
        $layout_property['content']  = 'profile';
        $layout_property['sidebar'] = 'sidebar';
        
        $this->data['dashboad_menu'] = TRUE; 
        generate_template($this->data, $layout_property);
    }
        
    public function edit_email($id)
    {
        $checkLogin = parent::check_login(FALSE);
        $userId = $checkLogin == 'admin' ? $id : $checkLogin;
        $this->data['user'] = $this->ion_auth->user($userId)->row();
        
        $emailFromPost = $this->input->post('email');
        if($this->data['user']->email == $emailFromPost)
        {
            $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'trim|required|valid_email|xss_clean', array('required' => '%s តម្រូវ​ឲ្យ​មាន', 'valid_email' => '%s មិន​ត្រឹម​ត្រូវ'));
        }
        else
        {
            $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'trim|required|valid_email|is_unique[users.email]|xss_clean', array('required' => '%s តម្រូវ​ឲ្យ​មាន', 'valid_email' => '%s មិន​ត្រឹម​ត្រូវ', 'is_unique' => '%s មាន​រួច​ហើយ'));
        }
        
        if($this->form_validation->run() == TRUE)
        {
            $data = array('email' => $emailFromPost);
            if($this->ion_auth->update($this->data['user']->id, $data))
            {
                $people = Modules::run('people/get_detail', array('user_id' => $this->data['user']->id));
                if($people)
                {
                    Modules::run('people/update', $people->id, $data, TRUE);
                }
            }
            
            $this->session->set_flashdata('message', $this->lang->line('update_email_label'));
            redirect('members/'.$this->data['user']->id, 'refresh');
        }
        
        // message error
        $this->data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
        
        $this->data['email'] = array(
            'name'  => 'email',
            'id'    => 'email',
            'class' => 'form-control',
            'value' => set_value('search', $this->data['user']->email)
        );
        
        // process template
        $title = $this->lang->line('edit_member_email_heading');
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
        if($checkLogin == 'admin')
        {
            $layout_property['breadcrumb'] = array('auth/members' => $this->lang->line('member_label'), 'members/'.$this->data['user']->id => $this->data['user']->username, $title);
        }
        else
        {
            $layout_property['breadcrumb'] = array('members' => $this->data['user']->username, $title);
        }
        
        $layout_property['content']  = 'edit_email';
        $layout_property['sidebar'] = 'sidebar';
        
        $this->data['dashboad_menu'] = TRUE; 
        generate_template($this->data, $layout_property); 
    }
    
    public function edit_password($id)
    {
        $checkLogin = parent::check_login(FALSE);
        $userId = $checkLogin == 'admin' ? $id : $checkLogin;
        $this->data['user'] = $this->ion_auth->user($userId)->row();
        
        $this->form_validation->set_rules('password', $this->lang->line('form_member_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[cpassword]', array('required' => '%s តម្រូវ​ឲ្យ​មាន', 'min_length' => '%s យ៉ាងតិច '.$this->config->item('min_password_length', 'ion_auth').'តួអក្សរ', 'max_length' => '%s ច្រើន​បំផុតមិនលើសពី '.$this->config->item('max_password_length', 'ion_auth').'តួអក្សរ', 'matches' => '%s មិនដូចគ្នា'));
        $this->form_validation->set_rules('cpassword', $this->lang->line('form_member_validation_confirm_password_label'), 'required', array('required' => '%s តម្រូវ​ឲ្យ​មាន'));
        if($this->form_validation->run() == TRUE)
        {
            $password = $this->input->post('password');
            $data = array('password' => $password);
            if($this->ion_auth->update($this->data['user']->id, $data))
            {
                $this->session->set_flashdata('message', $this->lang->line('update_password_label'));
                redirect('members/'.$this->data['user']->id, 'refresh');
            }            
        }
        
        // message error
        $this->data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
        
        $this->data['password'] = array(
            'name'  => 'password',
            'id'    => 'password',
            'class' => 'form-control',
            'value' => set_value('password')
        );
        
        $this->data['cpassword'] = array(
            'name'  => 'cpassword',
            'id'    => 'cpassword',
            'class' => 'form-control',
            'value' => set_value('cpassword')
        );
        
        // process template
        $title = $this->lang->line('edit_member_passwordl_heading');
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
        if($checkLogin == 'admin')
        {
            $layout_property['breadcrumb'] = array('auth/members' => $this->lang->line('member_label'), 'members/'.$this->data['user']->id => $this->data['user']->username, $title);
        }
        else
        {
            $layout_property['breadcrumb'] = array('members' => $this->data['user']->username, $title);
        }
        
        $layout_property['content']  = 'edit_password';
        $layout_property['sidebar'] = 'sidebar';
        
        $this->data['dashboad_menu'] = TRUE; 
        generate_template($this->data, $layout_property);
    }
    
    public function update_profile($id)
    {
        $checkLogin = parent::check_login(FALSE);
        $userId = $checkLogin == 'admin' ? $id : $checkLogin;
        $this->data['user'] = $this->ion_auth->user($userId)->row();
        $people = Modules::run('people/get_detail', array('user_id' => $this->data['user']->id));
        
        $this->form_validation->set_rules('name', $this->lang->line('form_member_validation_name_label'), 'trim|required|xss_clean', array('required' => '%s តម្រូវ​ឲ្យ​មាន'));
        $this->form_validation->set_rules('organization', $this->lang->line('form_member_validation_organization_label'), 'trim|xss_clean');
        $this->form_validation->set_rules('position', $this->lang->line('form_member_validation_position_label'), 'trim|xss_clean');
        $this->form_validation->set_rules('telephone', $this->lang->line('form_member_validation_telephone_label'), 'trim|required|xss_clean', array('required' => '%s តម្រូវ​ឲ្យ​មាន'));
        $this->form_validation->set_rules('social', $this->lang->line('form_member_validation_social_label'), 'trim|xss_clean');
        if($this->form_validation->run() === TRUE)
        {
            $data = array(
                'name'   => trim($this->input->post('name')),
                'organization'  => trim($this->input->post('organization')),
                'position' => trim($this->input->post('position')),
                'telephone'   => trim($this->input->post('telephone')),
                'social_media'   => trim($this->input->post('social')),
                'email' => $this->data['user']->email,
            );
            if($people != FALSE)
            {
                if(Modules::run('people/update', $people->id, $data, TRUE))
                {
                    array_unshift($data, $people->id);
                    set_log('User Profile Updated',$data);
                }
            }
            else
            {
                $data['user_id'] = $this->data['user']->id;
                if(($pid = Modules::run('people/insert', $data, TRUE)) == TRUE)
                {
                    array_unshift($data, $pid);
                    set_log('User Profile Updated', $data);
                }
            }
            
            $this->session->set_flashdata('message', $this->lang->line('updated_profile_label'));

            redirect('members/'.$this->data['user']->id, 'refresh');
        }
        
         // message error
        $this->data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
        
        // display form
        $this->data['name'] = array(
            'name'  => 'name',
            'id'    => 'name',
            'class' => 'form-control',
            'value' => set_value('name', isset($people) && $people != FALSE ? $people->name : FALSE)
        );
        
        $this->data['organization'] = array(
            'name'  => 'organization',
            'id'    => 'organization',
            'class' => 'form-control',
            'value' => set_value('organization', isset($people) && $people != FALSE ? $people->organization : FALSE)
        );
        
        $this->data['position'] = array(
            'name'  => 'position',
            'id'    => 'position',
            'class' => 'form-control',
            'value' => set_value('position', isset($people) && $people != FALSE ? $people->position : FALSE)
        );
        
        $this->data['telephone'] = array(
            'name'  => 'telephone',
            'id'    => 'telephone',
            'class' => 'form-control',
            'value' => set_value('telephone', isset($people) && $people != FALSE ? $people->telephone : FALSE)
        );
        
        $this->data['social'] = array(
            'name'  => 'social',
            'id'    => 'social',
            'class' => 'form-control',
            'value' => set_value('social', isset($people) && $people != FALSE ? $people->social_media : FALSE)
        );
        
        // process template
        $title = $this->lang->line('edit_member_profile_heading');
        $this->data['title'] = $title;
        
        $layout_property['css'] = array('https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css' => FALSE,
                                        'css/plugins/metisMenu/metisMenu.min.css',
                                        'css/sb-admin-2.css',
                                        'font-awesome-4.1.0/css/font-awesome.min.css',
                                        'css/jquery-ui.css'
                                        );
        $layout_property['js']  = array('https://code.jquery.com/jquery-1.11.1.min.js' => FALSE,
                                        'https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js' => FALSE,
                                        'js/plugins/metisMenu/metisMenu.min.js',
                                        'js/sb-admin-2.js',
                                        'js/jquery-ui.min.js'
                                        ); 
        $field1 = array_to_string(Modules::run('agribooks/get_field', 'name'), 'name');
        $field2 = array_to_string(Modules::run('agribooks/get_field', 'name_en'), 'name_en');
        $layout_property['script'] = '$(function() { var availableTags = ['.$field1.$field2.'];  $( "#organization" ).autocomplete({ source: availableTags }); });';
        
        if($checkLogin == 'admin')
        {
            $layout_property['breadcrumb'] = array('auth/members' => $this->lang->line('member_label'), 'members/'.$this->data['user']->id => $this->data['user']->username, $title);
        }
        else
        {
            $layout_property['breadcrumb'] = array('members' => $this->data['user']->username, $title);
        }
        
        $layout_property['content']  = 'update_profile';
        $layout_property['sidebar'] = 'sidebar';
        
        $this->data['dashboad_menu'] = TRUE; 
        generate_template($this->data, $layout_property);
    }
    
}