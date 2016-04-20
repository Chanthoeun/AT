<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of real_estate
 *
 * @author Chanthoeun
 */
class Real_estates extends Admin_Controller {
    public  $validation_errors =  array();
    
    public function __construct() {
        parent::__construct();
        $this->load->model('real_estate_model', 'real_estate');
        $this->lang->load(array('members/member','real_estate'));
        $this->load->helper(array('menu', 'upload', 'string'));
        
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
        $checkLogin = parent::check_login(FALSE); 
        if($checkLogin == 'admin')
        {
            show_error($this->lang->line('page_not_valid_label'));
        }
        
        $this->data['user'] = $this->ion_auth->user($checkLogin)->row();
        
        $this->data['real_estates'] = $this->get_all_records(array('user_id' => $this->data['user']->id), array('created_at' => 'desc', 300));
        
        // process template
        $title = $this->lang->line('index_real_estate_heading');
        $this->data['title'] = $title;
        
        $layout_property = parent::load_index_script();
        
        if($checkLogin == 'admin')
        {
            $layout_property['breadcrumb'] = array('auth/members' => $this->lang->line('member_label'), 'members/'.$this->data['user']->id => $this->data['user']->username, $title);
        }
        else 
        {
            $layout_property['breadcrumb'] = array($title);
        }
        
        $layout_property['content']  = 'index';
        $layout_property['sidebar'] = 'members/sidebar';
        
        // menu
        $this->data['real_estate_group_menu'] = TRUE; $this->data['real_estate_menu'] = TRUE;
        generate_template($this->data, $layout_property);
    }
    
    public function get_index($id)
    {
        $checkLogin = parent::check_login(FALSE);
        $userId = $checkLogin == 'admin' ? $id : $checkLogin;
        $this->data['user'] = $this->ion_auth->user($userId)->row();
        
        $this->data['real_estates'] = $this->get_all_records(array('user_id' => $this->data['user']->id), array('created_at' => 'desc', 300));
        
        // process template
        $title = $this->lang->line('index_real_estate_heading');
        $this->data['title'] = $title;
        
        $layout_property = parent::load_index_script();
        
        if($checkLogin == 'admin')
        {
            $layout_property['breadcrumb'] = array('auth/members' => $this->lang->line('member_label'), 'members/'.$this->data['user']->id => $this->data['user']->username, $title);
        }
        else 
        {
            $layout_property['breadcrumb'] = array($title);
        }
        
        $layout_property['content']  = 'index';
        $layout_property['sidebar'] = 'members/sidebar';
        
        // menu
        $this->data['real_estate_group_menu'] = TRUE; $this->data['real_estate_menu'] = TRUE;
        generate_template($this->data, $layout_property); 
    }
    
    public function list_all()
    {
        parent::check_login();
        
        $this->data['real_estates'] = $this->get_all_records(FALSE, array('created_at' => 'desc', 300));
        
        // process template
        $title = $this->lang->line('index_real_estate_heading');
        $this->data['title'] = $title;
        
        $layout_property = parent::load_index_script();
        
        $layout_property['breadcrumb'] = array($title);
        
        $layout_property['content']  = 'index';
        
        // menu
        $this->data['real_estate_group_menu'] = TRUE; $this->data['real_estate_menu'] = TRUE;
        generate_template($this->data, $layout_property); 
    }
    
    // create
    public function create($id = FALSE)
    {
        $checkLogin = parent::check_login(FALSE);
        
        // display form        
        $this->data['real_estate_title'] = array(
            'name'  => 'title',
            'id'    => 'title',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['title']) ? NULL : $this->validation_errors['post_data']['title']
        );
        
        $this->data['desc'] = array(
            'name'  => 'desc',
            'id'    => 'desc',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['desc']) ? NULL : $this->validation_errors['post_data']['desc']
        );
        
        $this->data['price'] = array(
            'name'  => 'price',
            'id'    => 'price',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['price']) ? NULL : $this->validation_errors['post_data']['price']
        );
        
        $this->data['category'] = form_dropdown('category', Modules::run('categories/dropdown', 'id','caption', 'ជ្រើស​ក្រុម', array('real_estate' => TRUE, 'parent_id !=' => FALSE)), empty($this->validation_errors['post_data']['category']) ? NULL : $this->validation_errors['post_data']['category'], 'class="form-control" id="category"');
        
        $this->data['picture'] = array(
            'name'  => 'picture[]',
            'id'    => 'picture',
            'multiple' => 'multiple',
            'accept'=> 'image/*'
        );
        
        $this->data['address'] = array(
            'name'  => 'address',
            'id'    => 'address',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['address']) ? NULL : $this->validation_errors['post_data']['address']
        );
        
        $this->data['province'] = form_dropdown('province', Modules::run('locations/dropdown', 'id', 'caption', 'ជ្រើស'.$this->lang->line('province_label'), array('parent_id' => FALSE)), empty($this->validation_errors['post_data']['province']) ? FALSE : $this->validation_errors['post_data']['province'], array('class' => 'form-control', 'id' => 'province'));
              
        $this->data['khan'] = form_dropdown('khan', array('ជ្រើស'.$this->lang->line('khan_label')), empty($this->validation_errors['post_data']['khan']) ? FALSE : $this->validation_errors['post_data']['khan'], array('class' => 'form-control', 'id' => 'khan'));
        
        $this->data['sangkat'] = form_dropdown('sangkat', array('ជ្រើស'.$this->lang->line('sangkat_label')), empty($this->validation_errors['post_data']['sangkat']) ? FALSE : $this->validation_errors['post_data']['sangkat'], array('class' => 'form-control', 'id' => 'sangkat'));
        
        $this->data['phum'] = form_dropdown('phum', array('ជ្រើស'.$this->lang->line('phum_label')), empty($this->validation_errors['post_data']['phum']) ? FALSE : $this->validation_errors['post_data']['phum'], array('class' => 'form-control', 'id' => 'phum'));        
        
        $map_value = empty($this->validation_errors['post_data']['map']) ? FALSE : $this->validation_errors['post_data']['map'];
        $this->data['location_map'] = array(
            'name'  => 'map',
            'id'    => 'map',
            'class' => 'form-control',
            'placeholder'=> lang('drop_map_label'),
            'value' => $map_value
        );
        
        // google map
        $config['minifyJS'] = TRUE;
        if($map_value == FALSE)
        {
            $config['center']   = 'auto';
            $config['onboundschanged'] = 'if (!centreGot) {
                                    var mapCentre = map.getCenter();
                                    marker_0.setOptions({
                                            position: new google.maps.LatLng(mapCentre.lat(), mapCentre.lng()) 
                                    });
                                    document.getElementById(\'map\').value = mapCentre.lat() + \', \' + mapCentre.lng();
                            }
                            centreGot = true;';
            
            $marker = array(
                'draggable' => TRUE,
                'ondragend' => 'document.getElementById(\'map\').value =  event.latLng.lat() + \', \' + event.latLng.lng();',
                'animation' => 'DROP'            
            ); 
        }
        else
        {
            $config['center']   = $map_value;
            $config['zoom']   = '13';
            
            $marker = array(
                'position' => $map_value,
                'draggable' => TRUE,
                'ondragend' => 'document.getElementById(\'map\').value =  event.latLng.lat() + \', \' + event.latLng.lng();',
                'animation' => 'DROP'            
            );  
        }
        $this->data['map'] = get_google_map($config, $marker);
        
        // process template
        $title = $this->lang->line('form_real_estate_create_heading');
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
        
        // set breadcrumb
        if(is_numeric($checkLogin))
        {
            $this->data['user'] = $this->ion_auth->user($checkLogin)->row();
            $layout_property['breadcrumb'] = array('real-estates/'.$this->data['user']->id => $this->lang->line('index_real_estate_heading'), $title);
            $layout_property['sidebar'] = 'members/sidebar';
        }
        else
        {
            if($id != FALSE)
            {
                $this->data['user'] = $this->ion_auth->user($id)->row();
                $layout_property['breadcrumb'] = array('auth/members/'.$this->data['user']->id => $this->lang->line('member_label'), 'members/'.$this->data['user']->id => $this->data['user']->username, 'real-estates/'.$this->data['user']->id => $this->lang->line('index_real_estate_heading'), $title);
                $layout_property['sidebar'] = 'members/sidebar';
            }
            else
            {
                $this->data['user'] = FALSE;
                $layout_property['breadcrumb'] = array('real-estates/list-all' => $this->lang->line('index_real_estate_heading'), $title);
            }
        }
        $this->data['userId'] = array('userId' => isset($this->data['user']) && $this->data['user'] != FALSE ? $this->data['user']->id : FALSE);
        
        $layout_property['content']  = 'create';
        
        // menu
        $this->data['real_estate_group_menu'] = TRUE; $this->data['real_estate_create_menu'] = TRUE;
        generate_template($this->data, $layout_property); 
    }
    
    // save
    public function store()
    {
        parent::check_login(FALSE);
        $userId = trim($this->input->post('userId'));
        
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
        
        $data = array(
            'title' => trim($this->input->post('title')),
            'slug'  => url_title(trim($this->input->post('title')), '-', TRUE),
            'description' => trim($this->input->post('desc')),
            'price' => trim($this->input->post('price')),
            'category_id' => trim($this->input->post('category')),
            'address' => trim($this->input->post('address')),
            'map' => trim($this->input->post('map')),
            'location_id' => $getLoc,
            'user_id' => $userId,
            'expire_date' => get_expire_date()
        );
        
        if(($rsid = $this->insert($data)) != FALSE)
        {
            if(check_empty_field('picture'))
            {
                $uploaded = upload_file('picture', 'image', random_string());
                if($uploaded == FALSE)
                {
                    $this->session->set_flashdata('message', print_upload_error());
                    redirect_form_validation(validation_errors(), $this->input->post(), 'real-estates/create/'.$userId);
                }
                else
                {
                    foreach($uploaded as $picture)
                    {
                        // set watermark
                        watermark('./assets/uploaded/image/'.$picture, 'overlay', 'copyrights.png');
                        
                        $data_picture = array(
                            'file'  => $picture,
                            'set'  => (bool) check_primary_real_estate_picture($rsid),
                            'real_estate_id' => $rsid
                        );
                        
                        // insert picture
                        Modules::run('real_estate_pictures/insert', $data_picture, TRUE);
                    }
                }
            }
            
            // set log 
            array_unshift($data, $rsid);
            set_log('Created Real Estate', $data);
            
            $this->session->set_flashdata('message', $this->lang->line('form_real_estate_report_success'));
            redirect('real-estates/view/'.$rsid, 'refresh');
        }
        else
        {
            redirect_form_validation(validation_errors(), $this->input->post(), 'real_estates/create/'.$userId);
        }
    }
    
    // edit
    public function edit($id)
    {
        $checkLogin =  parent::check_login(FALSE);
        $this->data['real_estate'] = $this->get_detail($id);       
        $this->data['user'] = $this->ion_auth->user($this->data['real_estate']->user_id)->row();
        $this->data['rsId'] = array('real_estate_id' => $this->data['real_estate']->id);
        
        // display form        
        $this->data['real_estate_title'] = array(
            'name'  => 'title',
            'id'    => 'title',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['title']) ? $this->data['real_estate']->title : $this->validation_errors['post_data']['title']
        );
        
        $this->data['desc'] = array(
            'name'  => 'desc',
            'id'    => 'desc',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['desc']) ? $this->data['real_estate']->description : $this->validation_errors['post_data']['desc']
        );
        
        $this->data['price'] = array(
            'name'  => 'price',
            'id'    => 'price',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['price']) ? $this->data['real_estate']->price : $this->validation_errors['post_data']['price']
        );
        
        $this->data['category'] = form_dropdown('category', Modules::run('categories/dropdown', 'id','caption', 'ជ្រើស​ក្រុម', array('real_estate' => TRUE, 'parent_id !=' => FALSE)), empty($this->validation_errors['post_data']['category']) ? $this->data['real_estate']->category_id : $this->validation_errors['post_data']['category'], 'class="form-control" id="category"');
        
        
        $this->data['address'] = array(
            'name'  => 'address',
            'id'    => 'address',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['address']) ? $this->data['real_estate']->address : $this->validation_errors['post_data']['address']
        );
        
        $getLoc = explode('/', $this->data['real_estate']->location_id);
        
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
        
        $map_value = empty($this->validation_errors['post_data']['map']) ? $this->data['real_estate']->map : $this->validation_errors['post_data']['map'];
        $this->data['location_map'] = array(
            'name'  => 'map',
            'id'    => 'map',
            'class' => 'form-control',
            'placeholder'=> 'Drag and Drop on the map below',
            'value' => $map_value
        );
        
        // google map
        $config['minifyJS'] = TRUE;
        if($map_value == FALSE)
        {
            $config['center']   = 'auto';
            $config['onboundschanged'] = 'if (!centreGot) {
                                    var mapCentre = map.getCenter();
                                    marker_0.setOptions({
                                            position: new google.maps.LatLng(mapCentre.lat(), mapCentre.lng()) 
                                    });
                                    document.getElementById(\'map\').value = mapCentre.lat() + \', \' + mapCentre.lng();
                            }
                            centreGot = true;';

            $marker = array(
                'draggable' => TRUE,
                'ondragend' => 'document.getElementById(\'map\').value =  event.latLng.lat() + \', \' + event.latLng.lng();',
                'animation' => 'DROP'            
            );  
        }
        else
        {
            $config['center']   = $map_value;
            $config['zoom']     = '15';

            $marker = array(
                'position'  => $map_value,
                'draggable' => TRUE,
                'ondragend' => 'document.getElementById(\'map\').value =  event.latLng.lat() + \', \' + event.latLng.lng();',
                'animation' => 'DROP'            
            );  
        }
        $this->data['map'] = get_google_map($config, $marker);
        
        // process template
        $title = $this->lang->line('form_real_estate_edit_heading');
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
        
        if($this->data['real_estate']->user_id == FALSE)
        {
            $layout_property['breadcrumb'] = array('real-estates/list-all' => $this->lang->line('index_real_estate_heading'), $title);
        }
        else
        {
            if($checkLogin == 'admin')
            {
                $layout_property['breadcrumb'] = array('auth/members/'.$this->data['user']->id => $this->lang->line('member_label'), 'members/'.$this->data['user']->id => $this->data['user']->username, 'real-estates/'.$this->data['user']->id => $this->lang->line('index_real_estate_heading'), $title);
                $layout_property['sidebar'] = 'members/sidebar';
            }
            else
            {
                $layout_property['breadcrumb'] = array('real-estates/'.$this->data['user']->id => $this->lang->line('index_real_estate_heading'), $title);
                $layout_property['sidebar'] = 'members/sidebar';
            }
        }
        
        $layout_property['content']  = 'edit';
        
        // menu
        $this->data['real_estate_group_menu'] = TRUE; $this->data['real_estate_menu'] = TRUE;
        generate_template($this->data, $layout_property);
    }
    
    // update
    public function modify()
    {
        parent::check_login();
        $rsid = trim($this->input->post('real_estate_id'));
        
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
        
        
        $data = array(
            'title' => trim($this->input->post('title')),
            'slug'  => url_title(trim($this->input->post('title')), '-', TRUE),
            'description' => trim($this->input->post('desc')),
            'price' => trim($this->input->post('price')),
            'category_id' => trim($this->input->post('category')),
            'address' => trim($this->input->post('address')),
            'map' => trim($this->input->post('map')),
            'location_id' => $getLoc
        );
        
        if($this->update($rsid, $data))
        {
            // set log
            set_log('Updated Real Estate', $data);
            $this->session->set_flashdata('message', $this->lang->line('form_real_estate_report_success'));
            redirect('real-estates/view/'.$rsid, 'refresh');
        }
        else
        {
            redirect_form_validation(validation_errors(), $this->input->post(), 'real-estates/edit/'.$rsid);
        }
    }
    
    // view
    public function view($id)
    {
        $checkLogin = parent::check_login(FALSE);
        $this->data['real_estate'] = $this->get_detail($id);
        $this->data['real_estate_id'] = array('real_estate_id' => $this->data['real_estate']->id);
        $this->data['medias'] = Modules::run('real_estate_pictures/get_many_by', array('real_estate_id' => $this->data['real_estate']->id));
        $this->data['user'] = $this->ion_auth->user($this->data['real_estate']->user_id)->row();
        
        $getLoc = explode('/', $this->data['real_estate']->location_id);
        
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
        
        
        $this->form_validation->set_rules('real_estate_id', 'Real Estate Id', 'trim|xss_clean');
        if($this->form_validation->run() == TRUE)
        {
            $uploaded = upload_file('picture', 'image', random_string());
            if($uploaded == FALSE)
            {
                $this->session->set_flashdata('message', print_upload_error());
            }
            else
            {
                foreach($uploaded as $picture)
                {
                    // set watermark
                    watermark('./assets/uploaded/image/'.$picture, 'overlay', 'copyrights.png');
                    $data_picture = array(
                        'file'  => $picture,
                        'set'  => (bool) check_primary_real_estate_picture($this->data['real_estate']->id),
                        'real_estate_id' => $this->data['real_estate']->id
                    );

                    // insert picture
                    Modules::run('real_estate_pictures/insert', $data_picture, TRUE);
                }
                $this->session->set_flashdata('message', 'Upload Successful');
                redirect('real-estates/view/'.$this->data['real_estate']->id, 'refresh');
            }
        }
        
        $this->data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
        
        $this->data['picture'] = array(
            'name'  => 'picture[]',
            'id'    => 'picture',
            'multiple' => 'multiple',
            'accept'=> 'image/*'
        );
        
        // map 
        $map_config = array(
            'center' => $this->data['real_estate']->map,
            'zoom'  => '11',
            'height' => '300px'
        );
        
        $marker = array(
            'position' => $this->data['real_estate']->map,
            'animation'=> 'Drop'
        );
        $this->data['map'] = get_google_map($map_config, $marker);
        
        // process template
        $title = $this->data['real_estate']->title;
        $this->data['title'] = $title;
        $layout_property['css'] = array('https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css' => FALSE,
                                        'css/plugins/metisMenu/metisMenu.min.css',
                                        'css/sb-admin-2.css',
                                        'font-awesome-4.1.0/css/font-awesome.min.css',
                                        'css/colorbox/colorbox.min.css'
                                        );
        $layout_property['js']  = array('https://code.jquery.com/jquery-1.11.1.min.js' => FALSE,
                                        'https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js' => FALSE,
                                        'js/plugins/metisMenu/metisMenu.min.js',
                                        'js/sb-admin-2.js',
                                        'js/jquery.colorbox.min.js'
                                        );
        $layout_property['script'] = '$(document).ready(function(){$(".color-box").colorbox({rel:"color-box",transition:"fade"})});';
        
        if($this->data['real_estate']->user_id == FALSE)
        {
            $layout_property['breadcrumb'] = array('real-estates/list-all' => $this->lang->line('index_real_estate_heading'), $title);
        }
        else
        {
            if($checkLogin == 'admin')
            {
                $layout_property['breadcrumb'] = array('auth/members/'.$this->data['user']->id => $this->lang->line('member_label'), 'members/'.$this->data['user']->id => $this->data['user']->username, 'real-estates/'.$this->data['user']->id => $this->lang->line('index_real_estate_heading'), $title);
                $layout_property['sidebar'] = 'members/sidebar';
            }
            else
            {
                $layout_property['breadcrumb'] = array('real-estates/'.$this->data['user']->id => $this->lang->line('index_real_estate_heading'), $title);
                $layout_property['sidebar'] = 'members/sidebar';
            }
        }
        
        $layout_property['content']  = 'view';
        
        // menu
        $this->data['real_estate_group_menu'] = TRUE; $this->data['real_estate_menu'] = TRUE;
        generate_template($this->data, $layout_property); 
    }
    
    // delete
    public function destroy($id)
    {
        parent::check_login(FALSE);
        $real_estate = $this->get($id);
        $real_estate_pictures = Modules::run('real_estate_pictures/get_many_by', array('real_estate_id' => $real_estate->id));
        if($this->delete($real_estate->id))
        {
            // delete photo
            if($real_estate_pictures != FALSE)
            {
                foreach ($real_estate_pictures as $picture)
                {
                    delete_uploaded_file($picture->file);
                }
            }
            Modules::run('real_estate_pictures/delete_by', array('real_estate_id' => $real_estate->id));
            
            // set log
            set_log('Deleted Real Estate', $real_estate);
            $this->session->set_flashdata('message', $this->lang->line('del_real_estate_report_success'));
            redirect('real_estates/'.$real_estate->user_id, 'refresh');
        }
        else
        {
            $this->session->set_flashdata('message', $this->lang->line('del_real_estate_report_error'));
            redirect('real_estates/view/'.$real_estate->id, 'refresh');
        }
        
    }

    public function search()
    {
        parent::check_login();
        $this->form_validation->set_rules('search', $this->lang->line('search_caption_label'), 'trim|required|xss_clean', array('required' => '%s តម្រូវឲ្យ​មាន'));
        if($this->form_validation->run() == TRUE)
        {
            $search = trim($this->input->post('search'));
            $this->data['real_estates'] = $this->get_like(array('title' => $search)); 
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
        
        $layout_property['breadcrumb'] = array($title);
        
        $layout_property['content']  = 'search';
        
        // menu
        $this->data['real_estate_group_menu'] = TRUE; $this->data['real_estate_search_menu'] = TRUE;
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
                $this->data['real_estates'] = $this->get_like(array('location_id' => $getLoc), FALSE, 'after'); 
            }
            else
            {
                $this->data['real_estates'] = $this->get_all_records(array('location_id' => $getLoc)); 
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
        
        $layout_property['breadcrumb'] = array('real-estates/list-all' => $this->lang->line('index_real_estate_heading'), $title);
        
        $layout_property['content']  = 'filter_location';
        
        // menu
        $this->data['real_estate_group_menu'] = TRUE; $this->data['real_estate_filter_location_menu'] = TRUE;
        generate_template($this->data, $layout_property); 
    }
    
    public function refresh_expire_date($id)
    {
        parent::check_login(FALSE);
        $exprie_date = get_expire_date();
        $this->update($id, array('expire_date' => $exprie_date), TRUE);
        
        $this->session->set_flashdata('message', sprintf($this->lang->line('view_extend_expire_date_label'), $exprie_date));
        redirect('real-estates/view/'.$id, 'refresh');
    }
    
    // delete media
    public function delete_media($id)
    {
        parent::check_login(FALSE);
        $picture = Modules::run('real_estate_pictures/get', $id);
        if($picture != FALSE)
        {
            // delete photo
            if(Modules::run('real_estate_pictures/delete', $picture->id))
            {
                delete_uploaded_file($picture->file);
                $this->session->set_flashdata('message', 'Delete successful');
            }
            else
            {
                $this->session->set_flashdata('message', 'Delete is not successful');
            }
        }
        else
        {
            $this->session->set_flashdata('message', 'Delete is not successful');
        }
        redirect('real_estates/view/'.$picture->real_estate_id, 'refresh');
    }
    
    public function sold($id, $status = 0)
    {
        parent::check_login();
        if($this->update($id, array('status' => $status), TRUE))
        {
            $this->session->set_flashdata('message', 'Real estate status update successful.');
            redirect('real_estates/view/'.$id);
        }
        else
        {
            $this->session->set_flashdata('message', 'Real estate status error while updating.');
            redirect('real_estates/view/'.$id);
        } 
    }
    
    public function get($id, $array = FALSE)
    {
        if($array == TRUE){
            return $this->real_estate->as_array()->get($id);
        }
        return $this->real_estate->as_object()->get($id);
    }
    
    public function get_by($where, $array = FALSE)
    {
        if($array == TRUE){
            return $this->real_estate->as_array()->get_by($where);
        }
        return $this->real_estate->as_object()->get_by($where);
    }
    
    public function get_detail($where)
    {
        return $this->real_estate->get_detail($where);
    }
    
    public function get_contact($id)
    {
        return $this->real_estate->get_contact($id);
    }
    
    public function get_all($order_by = FALSE, $limit = FALSE, $offset = 0)
    {
        if($order_by != FALSE)
        {
            $this->order_by($order_by);
        }
        if($limit != FALSE)
        {
            $this->real_estate->limit($limit, $offset);
        }
        return $this->real_estate->get_all();
    }
    
    public function get_many_by($where, $order_by = FALSE, $limit = FALSE, $offset = 0)
    {
        if($order_by != FALSE)
        {
            $this->order_by($order_by);
        }
        if($limit != FALSE)
        {
            $this->real_estate->limit($limit, $offset);
        }
        return $this->real_estate->get_many_by($where);
    }
    
    public function get_all_records($where =  FALSE, $order_by = FALSE, $limit = FALSE, $offset = 0)
    {
        if($order_by != FALSE)
        {
            $this->order_by($order_by);
        }
        if($limit != FALSE)
        {
            $this->real_estate->limit($limit, $offset);
        }
        return $this->real_estate->get_all_records($where);
    }
    
    public function get_like($like, $where = FALSE, $condition = 'both')
    {
        return $this->real_estate->get_like($like, $where, $condition);
    }
    
    public function get_field($field, $where = FALSE, $array = FALSE)
    {
        return $this->real_estate->get_field($field, $where, $array);
    }
    
    public function insert($data, $skip_validation = FALSE)
    {
        return $this->real_estate->insert($data, $skip_validation);
    }
    
    public function insert_many($data, $skip_validation = FALSE)
    {
        return $this->real_estate->insert_many($data, $skip_validation);
    }
    
    public function update($id, $data, $skip_validation = FALSE)
    {
        return $this->real_estate->update($id, $data, $skip_validation);
    }
    
    public function delete($id)
    {
        return $this->real_estate->delete($id);
    }
    
    public function delete_by($where)
    {
        return $this->real_estate->delete_by($where);
    }
    
    public function count_all()
    {
        return $this->real_estate->count_all();
    }
    
    public function count_by($where)
    {
        return $this->real_estate->count_by($where);
    }
    
    public function dropdown($key, $value, $option_label = NULL, $where = NULL)
    {
        if($where != NULL){
            $this->db->where($where);
        }
        
        return $this->real_estate->dropdown($key, $value,$option_label);
    }
    
    public function order_by($criteria, $order = NULL)
    {
        $this->real_estate->order_by($criteria,$order);
    }
    
    public function get_next_order($field, $where = FALSE)
    {
        return $this->real_estate->get_next_order($field, $where);
    }
}