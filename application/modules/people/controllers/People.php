<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of people
 *
 * @author Chanthoeun
 */
class People extends Admin_Controller {
    public  $validation_errors =  array();
    
    public function __construct() {
        parent::__construct();
        $this->load->model('people_model', 'people');
        $this->lang->load('people');
        $this->load->helper('menu');
        
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
        $this->data['ps'] = $this->get_all_records(FALSE, array('created_at' => 'desc'), 300);
        
        // process template
        $title = $this->lang->line('index_people_heading');
        $this->data['title'] = $title;
        
        $layout_property = parent::load_index_script();
        
        $layout_property['breadcrumb'] = array($title);
        
        $layout_property['content']  = 'index';
        
        // menu
        $this->data['people_group_menu'] = TRUE; $this->data['people_menu'] = TRUE;
        generate_template($this->data, $layout_property); 
    }

    // create
    public function create()
    {
        parent::check_login();        
        // display form
        $this->data['name'] = array(
            'name'  => 'name',
            'id'    => 'name',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['name']) ? NULL : $this->validation_errors['post_data']['name']
        );
        
        $this->data['organization'] = array(
            'name'  => 'organization',
            'id'    => 'organization',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['organization']) ? NULL : $this->validation_errors['post_data']['organization']
        );
        
        $this->data['position'] = array(
            'name'  => 'position',
            'id'    => 'position',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['position']) ? NULL : $this->validation_errors['post_data']['position']
        );
        
        $this->data['telephone'] = array(
            'name'  => 'telephone',
            'id'    => 'telephone',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['telephone']) ? NULL : $this->validation_errors['post_data']['telephone']
        );
        
        $this->data['email'] = array(
            'name'  => 'email',
            'id'    => 'email',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['email']) ? NULL : $this->validation_errors['post_data']['email']
        );
        
        $this->data['social'] = array(
            'name'  => 'social',
            'id'    => 'social',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['social']) ? NULL : $this->validation_errors['post_data']['social']
        );
        
        $this->data['group'] = form_dropdown('group', Modules::run('people_groups/dropdown', 'id', 'caption', 'ជ្រើស​ក្រុម'), empty($this->validation_errors['post_data']['group']) ? NULL : $this->validation_errors['post_data']['group'], 'class="form-control" id="group"');
        
        $gos = get_dropdown(prepareList(Modules::run('government_organization/get_dropdown')), 'ជ្រើស​'.$this->lang->line('government_organization_menu_label'));
        $this->data['go'] = form_dropdown('go', $gos, empty($this->validation_errors['post_data']['go']) ? FALSE : $this->validation_errors['post_data']['go'], 'class="form-control" id="go"');
        
        $this->data['province'] = form_dropdown('province', Modules::run('locations/dropdown', 'id', 'caption', 'ជ្រើស'.$this->lang->line('province_label'), array('parent_id' => FALSE)), empty($this->validation_errors['post_data']['province']) ? FALSE : $this->validation_errors['post_data']['province'], array('class' => 'form-control', 'id' => 'province'));
              
        $this->data['khan'] = form_dropdown('khan', array('ជ្រើស'.$this->lang->line('khan_label')), empty($this->validation_errors['post_data']['khan']) ? FALSE : $this->validation_errors['post_data']['khan'], array('class' => 'form-control', 'id' => 'khan'));
        
        $this->data['sangkat'] = form_dropdown('sangkat', array('ជ្រើស'.$this->lang->line('sangkat_label')), empty($this->validation_errors['post_data']['sangkat']) ? FALSE : $this->validation_errors['post_data']['sangkat'], array('class' => 'form-control', 'id' => 'sangkat'));
        
        $this->data['phum'] = form_dropdown('phum', array('ជ្រើស'.$this->lang->line('phum_label')), empty($this->validation_errors['post_data']['phum']) ? FALSE : $this->validation_errors['post_data']['phum'], array('class' => 'form-control', 'id' => 'phum'));
        
        // process template
        $title = $this->lang->line('form_people_create_heading');
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
        
        $layout_property['breadcrumb'] = array('people' => $this->lang->line('index_people_heading'), $title);
        
        $layout_property['content']  = 'create';
        
        // menu
        $this->data['people_group_menu'] = TRUE; $this->data['people_create_menu'] = TRUE;
        generate_template($this->data, $layout_property);
    }

    // save
    public function store()
    {
        parent::check_login();
        
        $province = trim($this->input->post('province'));
        $khan = trim($this->input->post('khan'));
        $sangkat = trim($this->input->post('sangkat'));
        $phum = trim($this->input->post('phum'));
        
        if($province != FALSE)
        {
            $getPLoc = $province;
            if($khan != FALSE)
            {
                $getPLoc .= '/'.$khan;
                if($sangkat != FALSE)
                {
                    $getPLoc .= '/'.$sangkat;
                    if($phum != FALSE)
                    {
                        $getPLoc .= '/'.$phum;
                    }
                }
            }
        }
        else
        {
            $getPLoc = FALSE;
        }
        
        $data = array(
            'name'   => trim($this->input->post('name')),
            'organization'  => trim($this->input->post('organization')),
            'position' => trim($this->input->post('position')),
            'telephone'   => trim($this->input->post('telephone')),
            'email'    => trim($this->input->post('email')),
            'social_media'   => trim($this->input->post('social')),
            'people_group_id'       => trim($this->input->post('group')),
            'go_id'     => trim($this->input->post('go')),
            'location_id'    => $getPLoc
        );

        if(($pid = $this->insert($data)) != FALSE)
        {
            // set log
            array_unshift($data, $pid);
            set_log('Created People', $data);

            $this->session->set_flashdata('message', $this->lang->line('form_people_report_success'));
            redirect('people/view/'.$pid, 'refresh');
        }
        else
        {
            redirect_form_validation(validation_errors(), $this->input->post(), 'people/create');
        }
    }

    // edit
    public function edit($id)
    {
        parent::check_login();
        // get people
        $people = $this->get_detail($id);
        
        $this->data['people_id'] = array('people_id' => $people->id);
        $this->data['people'] = $people;
            
        // set log
        set_log('View for Update People', $people);
        
        // display form
        $this->data['name'] = array(
            'name'  => 'name',
            'id'    => 'name',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['name']) ? $people->name : $this->validation_errors['post_data']['name']
        );
        
        $this->data['organization'] = array(
            'name'  => 'organization',
            'id'    => 'organization',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['organization']) ? $people->organization : $this->validation_errors['post_data']['organization']
        );
        
        $this->data['position'] = array(
            'name'  => 'position',
            'id'    => 'position',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['position']) ? $people->position : $this->validation_errors['post_data']['position']
        );
        
        $this->data['telephone'] = array(
            'name'  => 'telephone',
            'id'    => 'telephone',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['telephone']) ? $people->telephone : $this->validation_errors['post_data']['telephone']
        );
        
        $this->data['email'] = array(
            'name'  => 'email',
            'id'    => 'email',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['email']) ? $people->email : $this->validation_errors['post_data']['email']
        );
        
        $this->data['social'] = array(
            'name'  => 'social',
            'id'    => 'social',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['social']) ? $people->social_media : $this->validation_errors['post_data']['social']
        );
        
        $this->data['group'] = form_dropdown('group', Modules::run('people_groups/dropdown', 'id', 'caption', 'ជ្រើស​ក្រុម'), empty($this->validation_errors['post_data']['group']) ? $people->people_group_id : $this->validation_errors['post_data']['group'], 'class="form-control" id="group"');
        
        $gos = get_dropdown(prepareList(Modules::run('government_organization/get_dropdown')), 'ជ្រើស​'.$this->lang->line('government_organization_menu_label'));
        $this->data['go'] = form_dropdown('go', $gos, empty($this->validation_errors['post_data']['go']) ? $people->go_id : $this->validation_errors['post_data']['go'], 'class="form-control" id="go"');
        
        $getPLoc = explode('/', $people->location_id);
        
        switch (count($getPLoc))
        {
            case 1:
                $province = $getPLoc[0];
                $this->data['province'] = form_dropdown('province', Modules::run('locations/dropdown', 'id', 'caption', 'ជ្រើស'.$this->lang->line('province_label'), array('parent_id' => FALSE)), empty($this->validation_errors['post_data']['province']) ? $province : $this->validation_errors['post_data']['province'], array('class' => 'form-control', 'id' => 'province'));
                
                $this->data['khan'] = form_dropdown('khan', Modules::run('locations/dropdown', 'id', 'caption', 'ជ្រើស'.$this->lang->line('khan_label'), array('parent_id' => $province)), empty($this->validation_errors['post_data']['khan']) ? FALSE : $this->validation_errors['post_data']['khan'], array('class' => 'form-control', 'id' => 'khan'));

                $this->data['sangkat'] = form_dropdown('sangkat', array('ជ្រើស'.$this->lang->line('sangkat_label')), empty($this->validation_errors['post_data']['sangkat']) ? FALSE : $this->validation_errors['post_data']['sangkat'], array('class' => 'form-control', 'id' => 'sangkat'));

                $this->data['phum'] = form_dropdown('phum', array('ជ្រើស'.$this->lang->line('phum_label')), empty($this->validation_errors['post_data']['phum']) ? FALSE : $this->validation_errors['post_data']['phum'], array('class' => 'form-control', 'id' => 'phum'));
                break;
            case 2:
                $province = $getPLoc[0];
                $khan = $getPLoc[1];
                $this->data['province'] = form_dropdown('province', Modules::run('locations/dropdown', 'id', 'caption', 'ជ្រើស'.$this->lang->line('province_label'), array('parent_id' => FALSE)), empty($this->validation_errors['post_data']['province']) ? $province : $this->validation_errors['post_data']['province'], array('class' => 'form-control', 'id' => 'province'));
              
                $this->data['khan'] = form_dropdown('khan', Modules::run('locations/dropdown', 'id', 'caption', 'ជ្រើស'.$this->lang->line('province_label'), array('parent_id' => $province)), empty($this->validation_errors['post_data']['khan']) ? $khan : $this->validation_errors['post_data']['khan'], array('class' => 'form-control', 'id' => 'khan'));
                
                $this->data['sangkat'] = form_dropdown('sangkat', Modules::run('locations/dropdown', 'id', 'caption', 'ជ្រើស'.$this->lang->line('sangkat_label'), array('parent_id' => $khan)), empty($this->validation_errors['post_data']['sangkat']) ? FALSE : $this->validation_errors['post_data']['sangkat'], array('class' => 'form-control', 'id' => 'sangkat'));

                $this->data['phum'] = form_dropdown('phum', array('ជ្រើស'.$this->lang->line('phum_label')), empty($this->validation_errors['post_data']['phum']) ? FALSE : $this->validation_errors['post_data']['phum'], array('class' => 'form-control', 'id' => 'phum'));
                break;
            case 3:
                $province = $getPLoc[0];
                $khan = $getPLoc[1];
                $sangkat = $getPLoc[2];
                $this->data['province'] = form_dropdown('province', Modules::run('locations/dropdown', 'id', 'caption', 'ជ្រើស'.$this->lang->line('province_label'), array('parent_id' => FALSE)), empty($this->validation_errors['post_data']['province']) ? $province : $this->validation_errors['post_data']['province'], array('class' => 'form-control', 'id' => 'province'));
              
                $this->data['khan'] = form_dropdown('khan', Modules::run('locations/dropdown', 'id', 'caption', 'ជ្រើស'.$this->lang->line('province_label'), array('parent_id' => $province)), empty($this->validation_errors['post_data']['khan']) ? $khan : $this->validation_errors['post_data']['khan'], array('class' => 'form-control', 'id' => 'khan'));

                $this->data['sangkat'] = form_dropdown('sangkat', Modules::run('locations/dropdown', 'id', 'caption', 'ជ្រើស'.$this->lang->line('province_label'), array('parent_id' => $khan)), empty($this->validation_errors['post_data']['sangkat']) ? $sangkat : $this->validation_errors['post_data']['sangkat'], array('class' => 'form-control', 'id' => 'sangkat'));
                
                $this->data['phum'] = form_dropdown('phum', Modules::run('locations/dropdown', 'id', 'caption', 'ជ្រើស'.$this->lang->line('phum_label'), array('parent_id' => $sangkat)), empty($this->validation_errors['post_data']['phum']) ? FALSE : $this->validation_errors['post_data']['phum'], array('class' => 'form-control', 'id' => 'phum'));

                break;
            case 4:
                $province = $getPLoc[0];
                $khan = $getPLoc[1];
                $sangkat = $getPLoc[2];
                $phum = $getPLoc[3];
                $this->data['province'] = form_dropdown('province', Modules::run('locations/dropdown', 'id', 'caption', 'ជ្រើស'.$this->lang->line('province_label'), array('parent_id' => FALSE)), empty($this->validation_errors['post_data']['province']) ? $province : $this->validation_errors['post_data']['province'], array('class' => 'form-control', 'id' => 'province'));
              
                $this->data['khan'] = form_dropdown('khan', Modules::run('locations/dropdown', 'id', 'caption', 'ជ្រើស'.$this->lang->line('province_label'), array('parent_id' => $province)), empty($this->validation_errors['post_data']['khan']) ? $khan : $this->validation_errors['post_data']['khan'], array('class' => 'form-control', 'id' => 'khan'));

                $this->data['sangkat'] = form_dropdown('sangkat',Modules::run('locations/dropdown', 'id', 'caption', 'ជ្រើស'.$this->lang->line('province_label'), array('parent_id' => $khan)), empty($this->validation_errors['post_data']['sangkat']) ? $sangkat : $this->validation_errors['post_data']['sangkat'], array('class' => 'form-control', 'id' => 'sangkat'));

                $this->data['phum'] = form_dropdown('phum', Modules::run('locations/dropdown', 'id', 'caption', 'ជ្រើស'.$this->lang->line('province_label'), array('parent_id' => $sangkat)), empty($this->validation_errors['post_data']['phum']) ? $phum : $this->validation_errors['post_data']['phum'], array('class' => 'form-control', 'id' => 'phum'));
                break;

            default:
                $this->data['province'] = form_dropdown('province', Modules::run('locations/dropdown', 'id', 'caption', 'ជ្រើស'.$this->lang->line('province_label'), array('parent_id' => FALSE)), empty($this->validation_errors['post_data']['province']) ? FALSE : $this->validation_errors['post_data']['province'], array('class' => 'form-control', 'id' => 'province'));
              
                $this->data['khan'] = form_dropdown('khan', array('ជ្រើស'.$this->lang->line('khan_label')), empty($this->validation_errors['post_data']['khan']) ? FALSE : $this->validation_errors['post_data']['khan'], array('class' => 'form-control', 'id' => 'khan'));

                $this->data['sangkat'] = form_dropdown('sangkat', array('ជ្រើស'.$this->lang->line('sangkat_label')), empty($this->validation_errors['post_data']['sangkat']) ? FALSE : $this->validation_errors['post_data']['sangkat'], array('class' => 'form-control', 'id' => 'sangkat'));

                $this->data['phum'] = form_dropdown('phum', array('ជ្រើស'.$this->lang->line('phum_label')), empty($this->validation_errors['post_data']['phum']) ? FALSE : $this->validation_errors['post_data']['phum'], array('class' => 'form-control', 'id' => 'phum'));
                break;
        }

        // process template
        $title = $this->lang->line('form_people_edit_heading');
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
        
        $layout_property['breadcrumb'] = array('people' => $this->lang->line('index_people_heading'), $title);
        
        $layout_property['content']  = 'edit';
        
        // menu
        $this->data['people_group_menu'] = TRUE; $this->data['people_menu'] = TRUE;
        generate_template($this->data, $layout_property);
    }

    // update
    public function modify()
    {
        parent::check_login();
        $id = $this->input->post('people_id');
        $province = trim($this->input->post('province'));
        $khan = trim($this->input->post('khan'));
        $sangkat = trim($this->input->post('sangkat'));
        $phum = trim($this->input->post('phum'));
        
        if($province != FALSE)
        {
            $getPLoc = $province;
            if($khan != FALSE)
            {
                $getPLoc .= '/'.$khan;
                if($sangkat != FALSE)
                {
                    $getPLoc .= '/'.$sangkat;
                    if($phum != FALSE)
                    {
                        $getPLoc .= '/'.$phum;
                    }
                }  
            }
        }
        else
        {
            $getPLoc = FALSE;
        }
        
        $data = array(
            'name'   => trim($this->input->post('name')),
            'organization'  => trim($this->input->post('organization')),
            'position' => trim($this->input->post('position')),
            'telephone'   => trim($this->input->post('telephone')),
            'email'    => trim($this->input->post('email')),
            'social_media'   => trim($this->input->post('social')),
            'people_group_id'       => trim($this->input->post('group')),
            'go_id'     => trim($this->input->post('go')),
            'location_id'    => $getPLoc
        );

        if($this->update($id, $data))
        {
            // set log
            array_unshift($data, $id);
            set_log('Updated People',$data);

            $this->session->set_flashdata('message', $this->lang->line('form_people_report_success'));

            redirect('people/view/'.$id, 'refresh');
        }
        else
        {
            redirect_form_validation(validation_errors(), $this->input->post(), 'people/edit/'.$id);
        }
    }

    // delete
    public function destroy($id)
    {
        parent::check_login();       
        $people = $this->get($id);
        
        // delete people
        if($this->delete($id))
        {
            // set log
            set_log('Deleted People', $people);
            
            $this->session->set_flashdata('message', $this->lang->line('del_people_report_success'));
            redirect('people', 'refresh');
        }
        else
        {
            $this->session->set_flashdata('message', $this->lang->line('del_people_report_error'));
            redirect('people', 'refresh');
        }
    }
    
    public function view($id)
    {
        parent::check_login();
        $this->data['people'] = $this->get_detail($id);
        $this->data['organization'] = Modules::run('agribooks/get_detail', "name = '{$this->data['people']->organization}' OR name_en ='{$this->data['people']->organization}'");
        
        if($this->data['people']->location_id != FALSE){
            $getPLoc = explode('/', $this->data['people']->location_id);
            switch (count($getPLoc))
            {
                case 1:
                    $province = Modules::run('locations/get',$getPLoc[0])->caption;
                    $this->data['plocation'] = $province;
                    break;
                case 2:
                    $province = Modules::run('locations/get',$getPLoc[0])->caption;
                    $khan = Modules::run('locations/get',$getPLoc[1])->caption;
                    $this->data['plocation'] = $khan.' / '.$province;
                    break;
                case 3:
                    $province = Modules::run('locations/get',$getPLoc[0])->caption;
                    $khan = Modules::run('locations/get',$getPLoc[1])->caption;
                    $sangkat = Modules::run('locations/get',$getPLoc[2])->caption;
                    $this->data['plocation'] = $sangkat.' / '.$khan.' / '.$province;
                    break;
                default:
                    $province = Modules::run('locations/get',$getPLoc[0])->caption;
                    $khan = Modules::run('locations/get',$getPLoc[1])->caption;
                    $sangkat = Modules::run('locations/get',$getPLoc[2])->caption;
                    $phum = Modules::run('locations/get',$getPLoc[3])->caption;
                    $this->data['plocation'] = $phum.' / '.$sangkat.' / '.$khan.' / '.$province;
                    break;
            }
        }
        
        // if it's has organization
        if($this->data['organization'] != FALSE)
        {
            $getOLoc = explode('/', $this->data['organization']->location_id);
        
            switch (count($getOLoc))
            {
                case 1:
                    $province = Modules::run('locations/get',$getOLoc[0])->caption;
                    $this->data['olocation'] = $province;
                    break;
                case 2:
                    $province = Modules::run('locations/get',$getOLoc[0])->caption;
                    $khan = Modules::run('locations/get',$getOLoc[1])->caption;
                    $this->data['olocation'] = $khan.' / '.$province;
                    break;
                case 3:
                    $province = Modules::run('locations/get',$getOLoc[0])->caption;
                    $khan = Modules::run('locations/get',$getOLoc[1])->caption;
                    $sangkat = Modules::run('locations/get',$getOLoc[2])->caption;
                    $this->data['olocation'] = $sangkat.' / '.$khan.' / '.$province;
                    break;
                default:
                    $province = Modules::run('locations/get',$getOLoc[0])->caption;
                    $khan = Modules::run('locations/get',$getOLoc[1])->caption;
                    $sangkat = Modules::run('locations/get',$getOLoc[2])->caption;
                    $phum = Modules::run('locations/get',$getOLoc[3])->caption;
                    $this->data['olocation'] = $phum.' / '.$sangkat.' / '.$khan.' / '.$province;
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
        
        // process template
        $title = $this->data['people']->name;
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
        $layout_property['breadcrumb'] = array('people' => $this->lang->line('index_people_heading'), $title);
        
        $layout_property['content']  = 'view';
        
        // menu
        $this->data['people_group_menu'] = TRUE; $this->data['people_menu'] = TRUE;
        generate_template($this->data, $layout_property); 
    }
    
    // activate
    public function activate($id)
    {
        parent::check_login();
        $people = $this->get($id);
        if($this->update($people->id, array('status' => 1), TRUE))
        {
            // set log
            set_log('Activated People', array($people->id, 1));
            $this->session->set_flashdata('message', $this->lang->line('index_people_heading').'នេះ​ត្រូវ​បាន​ដាក់​ឲ្យ​ដំណើរ​ឡើង​វិញ!');
        }
        else
        {
            $this->session->set_flashdata('message', 'ការ​ដាក់​ឲ្យ​ដំណើរ​ការ​ឡើង​វិញ​ មាន​បញ្ហា​! សូម​ព្យាយាម​ម្តង​ទៀត!');
        }
        redirect('people/view/'.$people->id, 'refresh');
    }
    
    // Deactivate
    public function deactivate($id)
    {
        parent::check_login();
        $people = $this->get($id);
        if($this->update($people->id, array('status' => 0), TRUE))
        {
            // set log
            set_log('Deactivated People', array($people->id, 0));
            $this->session->set_flashdata('message', $this->lang->line('index_people_heading').'នេះ​បញ្ឈប់​ដំណើរ​ការ​រួចរាល់​ហើយ!');
        }
        else
        {
            $this->session->set_flashdata('message', 'ការ​បញ្ឈប់​ដំណើរ​ការ​ក្រុម​អត្ថ​បទ​នេះ​ មាន​បញ្ហា​! សូម​ព្យាយាម​ម្តង​ទៀត!');
        }
        redirect('people/view/'.$people->id, 'refresh');
    }
    
    // search
    public function search()
    {
        parent::check_login();
        $this->load->helper('email');
        $this->form_validation->set_rules('search', $this->lang->line('search_caption_label'), 'trim|required|xss_clean', array('required' => '%s តម្រូវឲ្យ​មាន'));
        if($this->form_validation->run() == TRUE)
        {
            $search = trim($this->input->post('search'));
            if(is_numeric($search))
            {
                $this->data['ps'] = $this->get_like(array('telephone' => $search)); 
            }
            else if(valid_email($search))
            {
                $this->data['ps'] = $this->get_like(array('email' => $search)); 
            }
            else
            {
                $this->data['ps'] = $this->get_like(array('name' => $search)); 
            }
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
        
        $field1 = array_to_string($this->get_field('name'),'name');
        $field2 = array_to_string($this->get_field('telephone'),'telephone');
        $field3 = array_to_string($this->get_field('email'),'email');
        $layout_property['script'] = '$(function() { var availableTags = ['.$field1.$field2.$field3.'];  $( "#search" ).autocomplete({ source: availableTags }); });';
        
        $layout_property['breadcrumb'] = array('people' => $this->lang->line('index_people_heading'), $title);
        
        $layout_property['content']  = 'search';
        
        // menu
        $this->data['people_group_menu'] = TRUE; $this->data['people_search_menu'] = TRUE;
        generate_template($this->data, $layout_property); 
    }
    
    public function filter_by_location()
    {
        parent::check_login();
        $this->form_validation->set_rules('province', $this->lang->line('form_agribook_validation_province_label'), 'trim|required|xss_clean', array('required' => '%s តម្រូវឲ្យ​មាន')) ;
        $this->form_validation->set_rules('khan', $this->lang->line('form_agribook_validation_khan_label'), 'trim|xss_clean');
        $this->form_validation->set_rules('sangkat', $this->lang->line('form_agribook_validation_sangkat_label'), 'trim|xss_clean');
        $this->form_validation->set_rules('phum', $this->lang->line('form_agribook_validation_phum_label'), 'trim|xss_clean');
        if($this->form_validation->run() == TRUE)
        {
            $province = trim($this->input->post('province'));
            $khan = trim($this->input->post('khan'));
            $sangkat = trim($this->input->post('sangkat'));
            $phum = trim($this->input->post('phum'));

            if($province != FALSE)
            {
                $getLoc = $province;
                if($khan != FALSE)
                {
                    $getLoc .= '/'.$khan;
                    if($sangkat != FALSE)
                    {
                        $getLoc .= '/'.$sangkat;
                        if($phum != FALSE)
                        {
                            $getLoc .= '/'.$phum;
                        }
                    }
                }
            }
            else
            {
                $getLoc = FALSE;
            }
            
            if(strlen($getLoc) > 2)
            {
                $this->data['ps'] = $this->get_like(array('location_id' => $getLoc),FALSE, 'after'); 
            }
            else
            {
                $this->data['ps'] = $this->get_all_records(array('location_id' => $getLoc)); 
            }
        }
        
        // message error
        $this->data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
        
        if(isset($province) && $province != FALSE)
        {
            $this->data['province'] = form_dropdown('province', Modules::run('locations/dropdown', 'id', 'caption', 'ជ្រើស'.$this->lang->line('province_label'), array('parent_id' => FALSE)), set_value('province'), array('class' => 'form-control', 'id' => 'province'));

            $this->data['khan'] = form_dropdown('khan', Modules::run('locations/dropdown', 'id', 'caption', 'ជ្រើស'.$this->lang->line('khan_label'), array('parent_id' => $province)), set_value('khan'), array('class' => 'form-control', 'id' => 'khan'));

            $this->data['sangkat'] = form_dropdown('sangkat', array('ជ្រើស'.$this->lang->line('sangkat_label')), set_value('sangkat'), array('class' => 'form-control', 'id' => 'sangkat'));

            $this->data['phum'] = form_dropdown('phum', array('ជ្រើស'.$this->lang->line('phum_label')), set_value('phum'), array('class' => 'form-control', 'id' => 'phum'));
            
            if(isset($khan) && $khan != FALSE)
            {
                $this->data['province'] = form_dropdown('province', Modules::run('locations/dropdown', 'id', 'caption', 'ជ្រើស'.$this->lang->line('province_label'), array('parent_id' => FALSE)), set_value('province'), array('class' => 'form-control', 'id' => 'province'));

                $this->data['khan'] = form_dropdown('khan', Modules::run('locations/dropdown', 'id', 'caption', 'ជ្រើស'.$this->lang->line('province_label'), array('parent_id' => $province)), set_value('khan'), array('class' => 'form-control', 'id' => 'khan'));

                $this->data['sangkat'] = form_dropdown('sangkat', Modules::run('locations/dropdown', 'id', 'caption', 'ជ្រើស'.$this->lang->line('sangkat_label'), array('parent_id' => $khan)), set_value('sangkat'), array('class' => 'form-control', 'id' => 'sangkat'));

                $this->data['phum'] = form_dropdown('phum', array('ជ្រើស'.$this->lang->line('phum_label')), set_value('phum'), array('class' => 'form-control', 'id' => 'phum'));
                
                if(isset($sangkat) && $sangkat != FALSE)
                {
                    $this->data['province'] = form_dropdown('province', Modules::run('locations/dropdown', 'id', 'caption', 'ជ្រើស'.$this->lang->line('province_label'), array('parent_id' => FALSE)), set_value('province'), array('class' => 'form-control', 'id' => 'province'));

                    $this->data['khan'] = form_dropdown('khan', Modules::run('locations/dropdown', 'id', 'caption', 'ជ្រើស'.$this->lang->line('province_label'), array('parent_id' => $province)), set_value('khan'), array('class' => 'form-control', 'id' => 'khan'));

                    $this->data['sangkat'] = form_dropdown('sangkat', Modules::run('locations/dropdown', 'id', 'caption', 'ជ្រើស'.$this->lang->line('province_label'), array('parent_id' => $khan)), set_value('sangkat'), array('class' => 'form-control', 'id' => 'sangkat'));

                    $this->data['phum'] = form_dropdown('phum', Modules::run('locations/dropdown', 'id', 'caption', 'ជ្រើស'.$this->lang->line('phum_label'), array('parent_id' => $sangkat)), set_value('phum'), array('class' => 'form-control', 'id' => 'phum'));
                }
            }
        }
        else
        {
            $this->data['province'] = form_dropdown('province', Modules::run('locations/dropdown', 'id', 'caption', 'ជ្រើស'.$this->lang->line('province_label'), array('parent_id' => FALSE)), set_value('province'), array('class' => 'form-control', 'id' => 'province'));
              
            $this->data['khan'] = form_dropdown('khan', array('ជ្រើស'.$this->lang->line('khan_label')), set_value('khan'), array('class' => 'form-control', 'id' => 'khan'));

            $this->data['sangkat'] = form_dropdown('sangkat', array('ជ្រើស'.$this->lang->line('sangkat_label')), set_value('sangkat'), array('class' => 'form-control', 'id' => 'sangkat'));

            $this->data['phum'] = form_dropdown('phum', array('ជ្រើស'.$this->lang->line('phum_label')), set_value('phum'), array('class' => 'form-control', 'id' => 'phum'));
        }
     
        // process template
        $title = $this->lang->line('people_fillter_by_location_menu_label');
        $this->data['title'] = $title;
        
        $layout_property = parent::load_index_script();
        
        $layout_property['breadcrumb'] = array('people' => $this->lang->line('index_people_heading'), $title);
        
        $layout_property['content']  = 'filter_location';
        
        // menu
        $this->data['people_group_menu'] = TRUE; $this->data['people_filter_location_menu'] = TRUE;
        generate_template($this->data, $layout_property); 
    }
    
    public function filter_by_group()
    {
        parent::check_login();
        $this->form_validation->set_rules('group', $this->lang->line('form_people_validation_group_label'), 'trim|required|xss_clean', array('required' => '%s តម្រូវ​ឲ្យ​មាន'));
        $this->form_validation->set_rules('go', $this->lang->line('form_people_validation_go_label'), 'trim|xss_clean');
        if($this->form_validation->run() == TRUE)
        {
            $group = trim($this->input->post('group'));
            $go = trim($this->input->post('go'));
            $this->data['ps'] = $this->get_all_records(array('people_group_id' => $group, 'go_id' => $go));
        }
        
        // message error
        $this->data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
        
        
        $this->data['group'] = form_dropdown('group', Modules::run('people_groups/dropdown', 'id', 'caption', 'ជ្រើស​ក្រុម'), set_value('group'), 'class="form-control" id="group"');
        
        $gos = get_dropdown(prepareList(Modules::run('government_organization/get_dropdown')), 'ជ្រើស​'.$this->lang->line('government_organization_menu_label'));
        $this->data['go'] = form_dropdown('go', $gos, set_value('go'), 'class="form-control" id="go"');
        
        // process template
        $title = $this->lang->line('people_filter_by_group_menu_label');
        $this->data['title'] = $title;
        
        $layout_property = parent::load_index_script();
        
        $layout_property['breadcrumb'] = array('people' => $this->lang->line('index_people_heading'), $title);
        
        $layout_property['content']  = 'filter_group';
        
        // menu
        $this->data['people_group_menu'] = TRUE; $this->data['people_filter_group_menu'] = TRUE;
        generate_template($this->data, $layout_property);
    }
    
    public function get($id, $array = FALSE)
    {
        if($array == TRUE){
            return $this->people->as_array()->get($id);
        }
        return $this->people->as_object()->get($id);
    }
    
    public function get_detail($where)
    {
        return $this->people->get_detail($where);
    }
    
    public function get_by($where, $array = FALSE)
    {
        if($array == TRUE){
            return $this->people->as_array()->get_by($where);
        }
        return $this->people->as_object()->get_by($where);
    }
    
    public function get_all($order_by = FALSE, $limit = FALSE, $offset = 0)
    {
        if($order_by != FALSE)
        {
            $this->people->order_by($order_by);
        }
        
        if($limit != FALSE)
        {
            $this->people->limit($limit, $offset);
        }
        return $this->people->get_all();
    }
    
    public function get_many_by($where, $order_by = FALSE, $limit = FALSE, $offset = 0)
    {
        if($order_by != FALSE)
        {
            $this->people->order_by($order_by);
        }
        
        if($limit != FALSE)
        {
            $this->people->limit($limit, $offset);
        }
        return $this->people->get_many_by($where);
    }
    
    public function get_all_records($where = FALSE)
    {
        return $this->people->get_all_records($where);
    }
    
    public function get_like($like, $order_by = FALSE, $limit = FALSE, $offset = 0)
    {
        if($order_by != FALSE)
        {
            $this->order_by($order_by);
        }
        
        if($limit != FALSE)
        {
            $this->people->limit($limit, $offset);
        }
        
        return $this->people->get_like($like);
    }
    
    public function get_field($field, $where = FALSE, $array = FALSE)
    {
        return $this->people->get_field($field, $where, $array);
    }
    
    public function insert($data, $skip_validation = FALSE)
    {
        return $this->people->insert($data, $skip_validation);
    }
    
    public function insert_many($data, $skip_validation = FALSE)
    {
        return $this->people->insert_many($data, $skip_validation);
    }
    
    public function update($id, $data, $skip_validation = FALSE)
    {
        return $this->people->update($id, $data, $skip_validation);
    }
    
    public function delete($id)
    {
        return $this->people->delete($id);
    }
    
    public function delete_by($where)
    {
        return $this->people->delete_by($where);
    }
    
    public function count_all()
    {
        return $this->people->count_all();
    }
    
    public function count_by($where)
    {
        return $this->people->count_by($where);
    }
    
    public function dropdown($key, $value, $option_label = NULL, $where = NULL)
    {
        if($where != NULL){
            $this->db->where($where);
        }
        
        return $this->people->dropdown($key, $value,$option_label);
    }
    
    public function order_by($criteria, $order = NULL)
    {
        $this->people->order_by($criteria,$order);
    }
    
    public function get_next_order($field, $where)
    {
        return $this->people->get_next_order($field, $where);
    }
}