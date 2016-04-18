<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of agribook
 *
 * @author Chanthoeun
 */
class Agribooks extends Admin_Controller {
    public  $validation_errors =  array();
    
    public function __construct() {
        parent::__construct();
        $this->load->model('agribook_model', 'agribook');
        $this->lang->load('agribook');
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
        $this->data['abs'] = $this->get_all_records(FALSE, array('created_at' => 'desc'), 300);
        
        // process template
        $title = $this->lang->line('index_agribook_heading');
        $this->data['title'] = $title;
        
        $layout_property = parent::load_index_script();
        
        $layout_property['breadcrumb'] = array($title);
        
        $layout_property['content']  = 'index';
        
        // menu
        $this->data['agribook_group_menu'] = TRUE; $this->data['agribook_menu'] = TRUE;
        generate_template($this->data, $layout_property); 
    }

    // create
    public function create($memberid = FALSE)
    {
        parent::check_login(FALSE);
        
        if($memberid != FALSE)
        {
            $this->data['members'] = array('members' => $memberid);
            $organization = $this->session->userdata('organization');
        }
        else
        {
            $this->data['members'] = array('members' => FALSE);
            $organization = FALSE;
        }
        
        // display form
        $this->data['member_type'] = form_dropdown('member_type', Modules::run('agribook_member_types/dropdown', 'id', 'caption'), empty($this->validation_errors['post_data']['member_type']) ? NULL : $this->validation_errors['post_data']['member_type'], array('class' => 'form-control', 'id' => 'member_type'));
        $this->data['parent'] = form_dropdown('parent', Modules::run('agribooks/dropdown', 'id', 'name', $this->lang->line('form_agribook_validation_parent_label'), array('parent' => TRUE)), empty($this->validation_errors['post_data']['parent']) ? NULL : $this->validation_errors['post_data']['parent'], array('class' => 'form-control', 'id' => 'parent'));
        
        $this->data['set_parent'] = array(
            'name'          => 'set_parent',
            'id'            => 'set_parent',
            'value'         => 1,
            'checked'       => empty($this->validation_errors['post_data']['set_parent']) ? FALSE : $this->validation_errors['post_data']['set_parent']
        );
        
        $this->data['name'] = array(
            'name'  => 'name',
            'id'    => 'name',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['name']) ? (is_english($organization) == FALSE ? $organization : NULL) : $this->validation_errors['post_data']['name']
        );
        
        $this->data['name_en'] = array(
            'name'  => 'name_en',
            'id'    => 'name_en',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['name_en']) ? (is_english($organization) == TRUE ? $organization : NULL) : $this->validation_errors['post_data']['name_en']
        );
        
        $this->data['profile'] = array(
            'name'  => 'profile',
            'id'    => 'profile',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['profile']) ? NULL : $this->validation_errors['post_data']['profile']
        );
        
        $this->data['contact_person'] = array(
            'name'  => 'contact_person',
            'id'    => 'contact_person',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['contact_person']) ? NULL : $this->validation_errors['post_data']['contact_person']
        );
        
        $this->data['address'] = array(
            'name'  => 'address',
            'id'    => 'address',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['address']) ? NULL : $this->validation_errors['post_data']['address']
        );
        
        $this->data['telephone'] = array(
            'name'  => 'telephone',
            'id'    => 'telephone',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['telephone']) ? NULL : $this->validation_errors['post_data']['telephone']
        );
        
        $this->data['fax'] = array(
            'name'  => 'fax',
            'id'    => 'fax',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['fax']) ? NULL : $this->validation_errors['post_data']['fax']
        );
        
        $this->data['email'] = array(
            'name'  => 'email',
            'id'    => 'email',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['email']) ? NULL : $this->validation_errors['post_data']['email']
        );
        
        $this->data['website'] = array(
            'name'  => 'website',
            'id'    => 'website',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['website']) ? NULL : $this->validation_errors['post_data']['website']
        );
        
        $this->data['social'] = array(
            'name'  => 'social',
            'id'    => 'social',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['social']) ? NULL : $this->validation_errors['post_data']['social']
        );
        
        $this->data['pobox'] = array(
            'name'  => 'pobox',
            'id'    => 'pobox',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['pobox']) ? NULL : $this->validation_errors['post_data']['pobox']
        );
        
        $this->data['picture'] = array(
            'name'  => 'picture',
            'id'    => 'picture',
            'accept' => 'image/*'
        );
        
        $group = get_dropdown(prepareList(Modules::run('agribook_group/get_dropdown')), 'ជ្រើស​'.$this->lang->line('agribook_group_menu_label'));
        $this->data['group'] = form_dropdown('group', $group, empty($this->validation_errors['post_data']['group']) ? FALSE : $this->validation_errors['post_data']['group'], 'class="form-control" id="group"');
        
        $this->data['province'] = form_dropdown('province', Modules::run('locations/dropdown', 'id', 'caption', 'ជ្រើស'.$this->lang->line('province_label'), array('parent_id' => FALSE)), empty($this->validation_errors['post_data']['province']) ? FALSE : $this->validation_errors['post_data']['province'], array('class' => 'form-control', 'id' => 'province'));
        
        if(!empty($this->validation_errors['post_data']['province']))
        {
            $this->data['khan'] = form_dropdown('khan', Modules::run('locations/dropdown', 'id', 'caption', 'ជ្រើស'.$this->lang->line('khan_label'), array('parent_id' => $this->validation_errors['post_data']['province'])), empty($this->validation_errors['post_data']['khan']) ? FALSE : $this->validation_errors['post_data']['khan'], array('class' => 'form-control', 'id' => 'khan'));
        }
        else
        {
            $this->data['khan'] = form_dropdown('khan', array('ជ្រើស'.$this->lang->line('khan_label')), empty($this->validation_errors['post_data']['khan']) ? FALSE : $this->validation_errors['post_data']['khan'], array('class' => 'form-control', 'id' => 'khan'));
        }
        
        if(!empty($this->validation_errors['post_data']['khan']))
        {
            $this->data['sangkat'] = form_dropdown('sangkat', Modules::run('locations/dropdown', 'id', 'caption', 'ជ្រើស'.$this->lang->line('sangkat_label'), array('parent_id' => $this->validation_errors['post_data']['khan'])), empty($this->validation_errors['post_data']['sangkat']) ? FALSE : $this->validation_errors['post_data']['sangkat'], array('class' => 'form-control', 'id' => 'sangkat'));
        }
        else
        {
            $this->data['sangkat'] = form_dropdown('sangkat', array('ជ្រើស'.$this->lang->line('sangkat_label')), empty($this->validation_errors['post_data']['sangkat']) ? FALSE : $this->validation_errors['post_data']['sangkat'], array('class' => 'form-control', 'id' => 'sangkat'));
        }
        
        if(!empty($this->validation_errors['post_data']['sangkat']))
        {
            $this->data['phum'] = form_dropdown('phum', Modules::run('locations/dropdown', 'id', 'caption', 'ជ្រើស'.$this->lang->line('phum_label'), array('parent_id' => $this->validation_errors['post_data']['sangkat'])), empty($this->validation_errors['post_data']['phum']) ? FALSE : $this->validation_errors['post_data']['phum'], array('class' => 'form-control', 'id' => 'phum'));
        }
        else
        {
            $this->data['phum'] = form_dropdown('phum', array('ជ្រើស'.$this->lang->line('phum_label')), empty($this->validation_errors['post_data']['phum']) ? FALSE : $this->validation_errors['post_data']['phum'], array('class' => 'form-control', 'id' => 'phum'));
        }
        
        
        $latlng = empty($this->validation_errors['post_data']['latlng']) ? NULL : $this->validation_errors['post_data']['latlng'];
        $this->data['latlng'] = array(
            'name'  => 'latlng',
            'id'    => 'map',
            'class' => 'form-control',
            'placeholder' => $this->lang->line('drop_map_label'),
            'value' => $latlng
        );
        
        // map
        $config['minifyJS'] = TRUE;
        $config['center']   = '12.485542832326306, 105.18771788773529';
        $config['zoom']     = '7';
        
        $marker[] = array(
            'position'  => '12.485542832326306, 105.18771788773529',
            'draggable' => TRUE,
            'ondragend' => 'document.getElementById(\'map\').value =  event.latLng.lat() + \', \' + event.latLng.lng();',
            'animation' => 'DROP'            
        );        
        
        $this->data['map'] = get_google_map($config, $marker);
        
        // process template
        $title = $this->lang->line('form_agribook_create_heading');
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
        $layout_property['optional_js'] = base_url('assets/ckeditor/ckeditor.js');
        
        $layout_property['breadcrumb'] = array('agribook' => $this->lang->line('index_agribook_heading'), $title);
        
        $layout_property['content']  = 'create';
        
        // menu
        $this->data['agribook_group_menu'] = TRUE; $this->data['agribook_create_menu'] = TRUE;
        generate_template($this->data, $layout_property);
    }

    // save
    public function store()
    {
        parent::check_login(FALSE);
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
        
        $name_en = trim($this->input->post('name_en'));
        
        $data = array(
            'name'   => trim($this->input->post('name')),
            'name_en'  => $name_en,
            'profile' => trim($this->input->post('profile')),
            'contact_person' => trim($this->input->post('contact_person')),
            'address' => trim($this->input->post('address')),
            'telephone'   => trim($this->input->post('telephone')),
            'fax' => trim($this->input->post('fax')),
            'email'    => trim($this->input->post('email')),
            'website' => trim($this->input->post('website')),
            'social_media'   => trim($this->input->post('social')),
            'pobox' => trim($this->input->post('pobox')),
            'map' => trim($this->input->post('latlng')),
            'agribook_group_id'       => trim($this->input->post('group')),
            'location_id'    => $getLoc,
            'parent' => trim($this->input->post('set_parent')),
            'parent_id' => trim($this->input->post('parent')),
            'member_type_id' => trim($this->input->post('member_type'))
        );
        
        if(check_empty_field('picture'))
        {
            $uploaded = upload_file('picture', 'image', url_title($name_en, '-', TRUE));

            if($uploaded == FALSE)
            {
                $this->session->set_flashdata('message', print_upload_error());
                redirect_form_validation(validation_errors(), $this->input->post(), 'agribooks/create');
            }
            else
            {
                $data['logo'] = $uploaded;
            }
        }

        if(($abid = $this->insert($data)) != FALSE)
        {
            // set log
            array_unshift($data, $abid);
            set_log('Created Agribook', $data); 

            $this->session->set_flashdata('message', $this->lang->line('form_agribook_report_success'));
            
            $member = $this->input->post('members');
            if($member != FALSE)
            {
                redirect('members/'.$member, 'refresh');
            }
            else
            {
                redirect('agribooks/view/'.$abid, 'refresh');
            }
        }
        else
        {
            if(isset($data['logo']) && $data['logo'] != FALSE){
                delete_uploaded_file($data['logo']);
            }
            redirect_form_validation(validation_errors(), $this->input->post(), 'agribooks/create');
        }
    }

    // edit
    public function edit($id)
    {
        parent::check_login();
        // get agribook
        $agribook = $this->get_detail($id);
        
        $this->data['agribook_id'] = array('agribook_id' => $agribook->id);
        $this->data['agribook'] = $agribook;
            
        // set log
        set_log('View for Update Agribook', $agribook);
        
        // display form
        $this->data['member_type'] = form_dropdown('member_type', Modules::run('agribook_member_types/dropdown', 'id', 'caption'), empty($this->validation_errors['post_data']['member_type']) ? $agribook->member_type_id : $this->validation_errors['post_data']['member_type'], array('class' => 'form-control', 'id' => 'member_type'));
        $this->data['parent'] = form_dropdown('parent', Modules::run('agribooks/dropdown', 'id', 'name', $this->lang->line('form_agribook_validation_parent_label'), array('parent' => TRUE)), empty($this->validation_errors['post_data']['parent']) ? $agribook->parent_id : $this->validation_errors['post_data']['parent'], array('class' => 'form-control', 'id' => 'parent'));
        
        $this->data['set_parent'] = array(
            'name'          => 'set_parent',
            'id'            => 'set_parent',
            'value'         => 1,
            'checked'       => empty($this->validation_errors['post_data']['set_parent']) ? $agribook->parent : $this->validation_errors['post_data']['set_parent']
        );
        
        $this->data['name'] = array(
            'name'  => 'name',
            'id'    => 'name',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['name']) ? $agribook->name : $this->validation_errors['post_data']['name']
        );
        
        $this->data['name_en'] = array(
            'name'  => 'name_en',
            'id'    => 'name_en',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['name_en']) ? $agribook->name_en : $this->validation_errors['post_data']['name_en']
        );
        
        $this->data['profile'] = array(
            'name'  => 'profile',
            'id'    => 'profile',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['profile']) ? $agribook->profile : $this->validation_errors['post_data']['profile']
        );
        
        $this->data['contact_person'] = array(
            'name'  => 'contact_person',
            'id'    => 'contact_person',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['contact_person']) ? $agribook->contact_person : $this->validation_errors['post_data']['contact_person']
        );
        
        $this->data['address'] = array(
            'name'  => 'address',
            'id'    => 'address',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['address']) ? $agribook->address : $this->validation_errors['post_data']['address']
        );
        
        $this->data['telephone'] = array(
            'name'  => 'telephone',
            'id'    => 'telephone',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['telephone']) ? $agribook->telephone : $this->validation_errors['post_data']['telephone']
        );
        
        $this->data['fax'] = array(
            'name'  => 'fax',
            'id'    => 'fax',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['fax']) ? $agribook->fax : $this->validation_errors['post_data']['fax']
        );
        
        $this->data['email'] = array(
            'name'  => 'email',
            'id'    => 'email',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['email']) ? $agribook->email : $this->validation_errors['post_data']['email']
        );
        
        $this->data['website'] = array(
            'name'  => 'website',
            'id'    => 'website',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['website']) ? $agribook->website : $this->validation_errors['post_data']['website']
        );
        
        $this->data['social'] = array(
            'name'  => 'social',
            'id'    => 'social',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['social']) ? $agribook->social_media : $this->validation_errors['post_data']['social']
        );
        
        $this->data['pobox'] = array(
            'name'  => 'pobox',
            'id'    => 'pobox',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['pobox']) ? $agribook->pobox : $this->validation_errors['post_data']['pobox']
        );
        
        $this->data['picture'] = array(
            'name'  => 'picture',
            'id'    => 'picture',
            'accept' => 'image/*'
        );
        
        $group = get_dropdown(prepareList(Modules::run('agribook_group/get_dropdown')), 'ជ្រើស​'.$this->lang->line('agribook_group_menu_label'));
        $this->data['group'] = form_dropdown('group', $group, empty($this->validation_errors['post_data']['group']) ? $agribook->agribook_group_id : $this->validation_errors['post_data']['group'], 'class="form-control" id="group"');
        
        $getLoc = explode('/', $agribook->location_id);
        
        switch (count($getLoc))
        {
            case 1:
                $province = $getLoc[0];
                $this->data['province'] = form_dropdown('province', Modules::run('locations/dropdown', 'id', 'caption', 'ជ្រើស'.$this->lang->line('province_label'), array('parent_id' => FALSE)), empty($this->validation_errors['post_data']['province']) ? $province : $this->validation_errors['post_data']['province'], array('class' => 'form-control', 'id' => 'province'));
                
                $this->data['khan'] = form_dropdown('khan', Modules::run('locations/dropdown', 'id', 'caption', 'ជ្រើស'.$this->lang->line('khan_label'), array('parent_id' => $province)), empty($this->validation_errors['post_data']['khan']) ? FALSE : $this->validation_errors['post_data']['khan'], array('class' => 'form-control', 'id' => 'khan'));

                $this->data['sangkat'] = form_dropdown('sangkat', array('ជ្រើស'.$this->lang->line('sangkat_label')), empty($this->validation_errors['post_data']['sangkat']) ? FALSE : $this->validation_errors['post_data']['sangkat'], array('class' => 'form-control', 'id' => 'sangkat'));

                $this->data['phum'] = form_dropdown('phum', array('ជ្រើស'.$this->lang->line('phum_label')), empty($this->validation_errors['post_data']['phum']) ? FALSE : $this->validation_errors['post_data']['phum'], array('class' => 'form-control', 'id' => 'phum'));
                break;
            case 2:
                $province = $getLoc[0];
                $khan = $getLoc[1];
                $this->data['province'] = form_dropdown('province', Modules::run('locations/dropdown', 'id', 'caption', 'ជ្រើស'.$this->lang->line('province_label'), array('parent_id' => FALSE)), empty($this->validation_errors['post_data']['province']) ? $province : $this->validation_errors['post_data']['province'], array('class' => 'form-control', 'id' => 'province'));
              
                $this->data['khan'] = form_dropdown('khan', Modules::run('locations/dropdown', 'id', 'caption', 'ជ្រើស'.$this->lang->line('province_label'), array('parent_id' => $province)), empty($this->validation_errors['post_data']['khan']) ? $khan : $this->validation_errors['post_data']['khan'], array('class' => 'form-control', 'id' => 'khan'));
                
                $this->data['sangkat'] = form_dropdown('sangkat', Modules::run('locations/dropdown', 'id', 'caption', 'ជ្រើស'.$this->lang->line('sangkat_label'), array('parent_id' => $khan)), empty($this->validation_errors['post_data']['sangkat']) ? FALSE : $this->validation_errors['post_data']['sangkat'], array('class' => 'form-control', 'id' => 'sangkat'));

                $this->data['phum'] = form_dropdown('phum', array('ជ្រើស'.$this->lang->line('phum_label')), empty($this->validation_errors['post_data']['phum']) ? FALSE : $this->validation_errors['post_data']['phum'], array('class' => 'form-control', 'id' => 'phum'));
                break;
            case 3:
                $province = $getLoc[0];
                $khan = $getLoc[1];
                $sangkat = $getLoc[2];
                $this->data['province'] = form_dropdown('province', Modules::run('locations/dropdown', 'id', 'caption', 'ជ្រើស'.$this->lang->line('province_label'), array('parent_id' => FALSE)), empty($this->validation_errors['post_data']['province']) ? $province : $this->validation_errors['post_data']['province'], array('class' => 'form-control', 'id' => 'province'));
              
                $this->data['khan'] = form_dropdown('khan', Modules::run('locations/dropdown', 'id', 'caption', 'ជ្រើស'.$this->lang->line('province_label'), array('parent_id' => $province)), empty($this->validation_errors['post_data']['khan']) ? $khan : $this->validation_errors['post_data']['khan'], array('class' => 'form-control', 'id' => 'khan'));

                $this->data['sangkat'] = form_dropdown('sangkat', Modules::run('locations/dropdown', 'id', 'caption', 'ជ្រើស'.$this->lang->line('province_label'), array('parent_id' => $khan)), empty($this->validation_errors['post_data']['sangkat']) ? $sangkat : $this->validation_errors['post_data']['sangkat'], array('class' => 'form-control', 'id' => 'sangkat'));
                
                $this->data['phum'] = form_dropdown('phum', Modules::run('locations/dropdown', 'id', 'caption', 'ជ្រើស'.$this->lang->line('phum_label'), array('parent_id' => $sangkat)), empty($this->validation_errors['post_data']['phum']) ? FALSE : $this->validation_errors['post_data']['phum'], array('class' => 'form-control', 'id' => 'phum'));

                break;
            case 4:
                $province = $getLoc[0];
                $khan = $getLoc[1];
                $sangkat = $getLoc[2];
                $phum = $getLoc[3];
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
        
        $latlng = empty($this->validation_errors['post_data']['latlng']) ? $agribook->map : $this->validation_errors['post_data']['latlng'];
        $this->data['latlng'] = array(
            'name'  => 'latlng',
            'id'    => 'map',
            'class' => 'form-control',
            'placeholder' => $this->lang->line('drop_map_label'),
            'value' => $latlng
        );
        
        // map
        $config['minifyJS'] = TRUE;
        $config['center']   = $latlng == FALSE ? '12.485542832326306, 105.18771788773529' : $latlng;
        $config['zoom']     = '13';
        
        $marker[] = array(
            'position'  => $latlng == FALSE ? '12.485542832326306, 105.18771788773529' : $latlng,
            'draggable' => TRUE,
            'ondragend' => 'document.getElementById(\'map\').value =  event.latLng.lat() + \', \' + event.latLng.lng();',
            'animation' => 'DROP'            
        );        
        
        $this->data['map'] = get_google_map($config, $marker);
        
        // process template
        $title = $this->lang->line('form_agribook_edit_heading');
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
        
        $layout_property['optional_js'] = base_url('assets/ckeditor/ckeditor.js');
        
        $layout_property['breadcrumb'] = array('agribooks' => $this->lang->line('index_agribook_heading'), $title);
        
        $layout_property['content']  = 'edit';
        
        // menu
        $this->data['agribook_group_menu'] = TRUE; $this->data['agribook_menu'] = TRUE;
        generate_template($this->data, $layout_property);
    }

    // update
    public function modify()
    {
        parent::check_login();
        $id = $this->input->post('agribook_id');
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
        
        $name_en = trim($this->input->post('name_en'));
        
        $data = array(
            'name'   => trim($this->input->post('name')),
            'name_en'  => $name_en,
            'profile' => trim($this->input->post('profile')),
            'contact_person' => trim($this->input->post('contact_person')),
            'address' => trim($this->input->post('address')),
            'telephone'   => trim($this->input->post('telephone')),
            'fax' => trim($this->input->post('fax')),
            'email'    => trim($this->input->post('email')),
            'website' => trim($this->input->post('website')),
            'social_media'   => trim($this->input->post('social')),
            'pobox' => trim($this->input->post('pobox')),
            'map' => trim($this->input->post('latlng')),
            'agribook_group_id'       => trim($this->input->post('group')),
            'location_id'    => $getLoc,
            'parent' => trim($this->input->post('set_parent')),
            'parent_id' => trim($this->input->post('parent')),
            'member_type_id' => trim($this->input->post('member_type'))
        );
        
        if(check_empty_field('picture'))
        {
            $uploaded = upload_file('picture', 'image', url_title($name_en, '-', TRUE));

            if($uploaded == FALSE)
            {
                $this->session->set_flashdata('message', print_upload_error());
                redirect_form_validation(validation_errors(), $this->input->post(), 'agribooks/edit/'.$id);
            }
            else
            {
                $data['logo'] = $uploaded;
            }
        }
        
        $this->agribook->validate[1]['rules'] = 'trim|required|xss_clean';
        $this->agribook->validate[2]['rules'] = 'trim|required|xss_clean';

        if($this->update($id, $data))
        {
            // set log
            array_unshift($data, $id);
            set_log('Updated Agribook',$data);

            $this->session->set_flashdata('message', $this->lang->line('form_agribook_report_success'));

            redirect('agribooks/view/'.$id, 'refresh');
        }
        else
        {
            if(isset($data['logo']) && $data['logo'] != FALSE){
                delete_uploaded_file($data['logo']);
            }
            redirect_form_validation(validation_errors(), $this->input->post(), 'agribooks/edit/'.$id);
        }
    }

    // delete
    public function destroy($id)
    {
        parent::check_login();       
        $agribook = $this->get($id);
        
        // delete agribook
        if($this->delete($id))
        {
            if($agribook->logo != FALSE)
            {
                delete_uploaded_file($agribook->logo);
            }
            
            // set log
            set_log('Deleted Agribook', $agribook);
            
            $this->session->set_flashdata('message', $this->lang->line('del_agribook_report_success'));
        }
        else
        {
            $this->session->set_flashdata('message', $this->lang->line('del_agribook_report_error'));
        }
        redirect('agribooks', 'refresh');
    }
    
    public function view($id)
    {
        parent::check_login();
        $this->data['agribook'] = $this->get_detail($id);
        $getLoc = explode('/', $this->data['agribook']->location_id);
        
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
            'center' => $this->data['agribook']->map,
            'zoom'  => '13',
            'height' => '300px'
        );
        
        $marker = array(
            'position' => $this->data['agribook']->map,
            'animation'=> 'Drop'
        );
        $this->data['map'] = get_google_map($map_config, $marker);
        
        // process template
        $title = $this->data['agribook']->name;
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
        $layout_property['breadcrumb'] = array('agribook' => $this->lang->line('index_agribook_heading'), $title);
        
        $layout_property['content']  = 'view';
        
        // menu
        $this->data['agribook_group_menu'] = TRUE; $this->data['agribook_menu'] = TRUE;
        generate_template($this->data, $layout_property); 
    }
    
    // activate
    public function activate($id)
    {
        parent::check_login();
        $agribook = $this->get($id);
        if($this->update($agribook->id, array('status' => 1), TRUE))
        {
            // set log
            set_log('Activated Agribook', array($agribook->id, 1));
            $this->session->set_flashdata('message', $this->lang->line('index_agribook_heading').'នេះ​ត្រូវ​បាន​ដាក់​ឲ្យ​ដំណើរ​ឡើង​វិញ!');
        }
        else
        {
            $this->session->set_flashdata('message', 'ការ​ដាក់​ឲ្យ​ដំណើរ​ការ​ឡើង​វិញ​ មាន​បញ្ហា​! សូម​ព្យាយាម​ម្តង​ទៀត!');
        }
        redirect('agribooks/view/'.$agribook->id, 'refresh');
    }
    
    // Deactivate
    public function deactivate($id)
    {
        parent::check_login();
        $agribook = $this->get($id);
        if($this->update($agribook->id, array('status' => 0), TRUE))
        {
            // set log
            set_log('Deactivated Agribook', array($agribook->id, 0));
            $this->session->set_flashdata('message', $this->lang->line('index_agribook_heading').'នេះ​បញ្ឈប់​ដំណើរ​ការ​រួចរាល់​ហើយ!');
        }
        else
        {
            $this->session->set_flashdata('message', 'ការ​បញ្ឈប់​ដំណើរ​ការ​ក្រុម​អត្ថ​បទ​នេះ​ មាន​បញ្ហា​! សូម​ព្យាយាម​ម្តង​ទៀត!');
        }
        redirect('agribooks/view/'.$agribook->id, 'refresh');
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
                $this->data['abs'] = $this->get_like(array('telephone' => $search)); 
            }
            else if(valid_email($search))
            {
                $this->data['abs'] = $this->get_like(array('email' => $search)); 
            }
            else
            {
                $khmer = $this->get_like(array('name' => $search));
                $this->data['abs'] = $khmer != FALSE ? $khmer : $this->get_like(array('name_en' => $search)); 
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
        $field2 = array_to_string($this->get_field('name_en'),'name_en');
        $field3 = array_to_string($this->get_field('telephone'),'telephone');
        $field4 = array_to_string($this->get_field('email'),'email');
        $layout_property['script'] = '$(function() { var availableTags = ['.$field1.$field2.$field3.$field4.'];  $( "#search" ).autocomplete({ source: availableTags }); });';
        
        $layout_property['breadcrumb'] = array('agribooks' => $this->lang->line('index_agribook_heading'), $title);
        
        $layout_property['content']  = 'search';
        
        // menu
        $this->data['agribook_group_menu'] = TRUE; $this->data['agribook_search_menu'] = TRUE;
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
                $this->data['abs'] = $this->get_like(array('location_id' => $getLoc),FALSE, 'after'); 
            }
            else
            {
                $this->data['abs'] = $this->get_all_records(array('location_id' => $getLoc)); 
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
        $title = $this->lang->line('agribook_fillter_by_location_menu_label');
        $this->data['title'] = $title;
        
        $layout_property = parent::load_index_script();
        
        $layout_property['breadcrumb'] = array('agribooks' => $this->lang->line('index_agribook_heading'), $title);
        
        $layout_property['content']  = 'filter_location';
        
        // menu
        $this->data['agribook_group_menu'] = TRUE; $this->data['agribook_filter_location_menu'] = TRUE;
        generate_template($this->data, $layout_property); 
    }
    
    public function filter_by_group()
    {
        parent::check_login();
        $this->form_validation->set_rules('group', $this->lang->line('form_agribook_validation_group_label'), 'trim|required|xss_clean', array('required' => '%s តម្រូវ​ឲ្យ​មាន'));
        if($this->form_validation->run() == TRUE)
        {
            $group = trim($this->input->post('group'));
            $this->data['abs'] = $this->get_all_records(array('agribook_group_id' => $group));
        }
        
        // message error
        $this->data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
        
        $group = get_dropdown(prepareList(Modules::run('agribook_group/get_dropdown')), 'ជ្រើស​'.$this->lang->line('agribook_group_menu_label'));
        $this->data['group'] = form_dropdown('group', $group, set_value('group'), 'class="form-control" id="group"');
        
        // process template
        $title = $this->lang->line('agribook_filter_by_group_menu_label');
        $this->data['title'] = $title;
        
        $layout_property = parent::load_index_script();
        
        $layout_property['breadcrumb'] = array('agribooks' => $this->lang->line('index_agribook_heading'), $title);
        
        $layout_property['content']  = 'filter_group';
        
        // menu
        $this->data['agribook_group_menu'] = TRUE; $this->data['agribook_filter_group_menu'] = TRUE;
        generate_template($this->data, $layout_property);
    }
    
    public function get($id, $array = FALSE)
    {
        if($array == TRUE){
            return $this->agribook->as_array()->get($id);
        }
        return $this->agribook->as_object()->get($id);
    }
    
    public function get_detail($where)
    {
        return $this->agribook->get_detail($where);
    }
    
    public function get_by($where, $array = FALSE)
    {
        if($array == TRUE){
            return $this->agribook->as_array()->get_by($where);
        }
        return $this->agribook->as_object()->get_by($where);
    }
    
    public function get_all($order_by = FALSE, $limit = FALSE, $offset = 0)
    {
        if($order_by != FALSE)
        {
            $this->agribook->order_by($order_by);
        }
        
        if($limit != FALSE)
        {
            $this->agribook->limit($limit, $offset);
        }
        return $this->agribook->get_all();
    }
    
    public function get_many_by($where, $order_by = FALSE, $limit = FALSE, $offset = 0)
    {
        if($order_by != FALSE)
        {
            $this->agribook->order_by($order_by);
        }
        
        if($limit != FALSE)
        {
            $this->agribook->limit($limit, $offset);
        }
        return $this->agribook->get_many_by($where);
    }
    
    public function get_all_records($where = FALSE)
    {
        return $this->agribook->get_all_records($where);
    }
    
    public function get_like($like, $where = FALSE, $condition = 'both', $order_by = FALSE, $limit = FALSE, $offset = 0)
    {
        if($order_by != FALSE)
        {
            $this->order_by($order_by);
        }
        
        if($limit != FALSE)
        {
            $this->agribook->limit($limit, $offset);
        }
        
        return $this->agribook->get_like($like, $where, $condition);
    }
    
    public function get_field($field, $where = FALSE, $array = FALSE)
    {
        return $this->agribook->get_field($field, $where, $array);
    }
    
    public function insert($data, $skip_validation = FALSE)
    {
        return $this->agribook->insert($data, $skip_validation);
    }
    
    public function insert_many($data, $skip_validation = FALSE)
    {
        return $this->agribook->insert_many($data, $skip_validation);
    }
    
    public function update($id, $data, $skip_validation = FALSE)
    {
        return $this->agribook->update($id, $data, $skip_validation);
    }
    
    public function delete($id)
    {
        return $this->agribook->delete($id);
    }
    
    public function delete_by($where)
    {
        return $this->agribook->delete_by($where);
    }
    
    public function count_all()
    {
        return $this->agribook->count_all();
    }
    
    public function count_by($where)
    {
        return $this->agribook->count_by($where);
    }
    
    public function dropdown($key, $value, $option_label = NULL, $where = NULL)
    {
        if($where != NULL){
            $this->db->where($where);
        }
        
        return $this->agribook->dropdown($key, $value,$option_label);
    }
    
    public function order_by($criteria, $order = NULL)
    {
        $this->agribook->order_by($criteria,$order);
    }
    
    public function get_next_order($field, $where)
    {
        return $this->agribook->get_next_order($field, $where);
    }
}