<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of product
 *
 * @author Chanthoeun
 */
class Products extends Admin_Controller {
    public  $validation_errors =  array();
    
    public function __construct() {
        parent::__construct();
        $this->load->model('product_model', 'product');
        $this->lang->load(array('members/member','product'));
        $this->load->helper(array('string', 'menu', 'upload'));
        
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
        
        $this->data['products'] = $this->get_all_records(array('user_id' => $this->data['user']->id));
        
        // process template
        $title = $this->lang->line('index_product_heading');
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
        $this->data['product_group_menu'] = TRUE; $this->data['product_menu'] = TRUE;
        generate_template($this->data, $layout_property); 
    }
    
    public function get_index($id)
    {
        $checkLogin = parent::check_login(FALSE);
        $userId = $checkLogin == 'admin' ? $id : $checkLogin;
        $this->data['user'] = $this->ion_auth->user($userId)->row();
        
        $this->data['products'] = $this->get_all_records(array('user_id' => $this->data['user']->id));
        
        // process template
        $title = $this->lang->line('index_product_heading');
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
        $this->data['product_group_menu'] = TRUE; $this->data['product_menu'] = TRUE;
        generate_template($this->data, $layout_property); 
    }
    
    public function list_all()
    {
        parent::check_login();
        
        $this->data['products'] = $this->get_all_records(FALSE, array('created_at' => 'desc', 300));
        
        // process template
        $title = $this->lang->line('index_product_heading');
        $this->data['title'] = $title;
        
        $layout_property = parent::load_index_script();
        
        $layout_property['breadcrumb'] = array($title);
        
        $layout_property['content']  = 'index';
        
        // menu
        $this->data['product_group_menu'] = TRUE; $this->data['product_menu'] = TRUE;
        generate_template($this->data, $layout_property); 
    }
    
    public function search()
    {
        parent::check_login();
        $this->form_validation->set_rules('search', $this->lang->line('search_caption_label'), 'trim|required|xss_clean', array('required' => '%s តម្រូវឲ្យ​មាន'));
        if($this->form_validation->run() == TRUE)
        {
            $search = trim($this->input->post('search'));
            $searchTitle = $this->get_like(array('title' => $search));
            $this->data['products'] = $search != FALSE ? $searchTitle : $this->get_like(array('username' => $search)); 
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
        $this->data['product_group_menu'] = TRUE; $this->data['product_search_menu'] = TRUE;
        generate_template($this->data, $layout_property); 
    }
    
    // create
    public function create($id)
    {
        $checkLogin = parent::check_login(FALSE);
        $userId = $checkLogin == 'admin' ? $id : $checkLogin;
        $this->data['user'] = $this->ion_auth->user($userId)->row();
        
        $this->data['userId'] = array('userId' => $this->data['user']->id);
        
        // display form
        $categories = get_dropdown(prepareList(Modules::run('categories/get_dropdown', array('market' => TRUE))), 'ជ្រើស​ក្រុម');
        $this->data['category'] = form_dropdown('category', $categories, empty($this->validation_errors['post_data']['category']) ? NULL : $this->validation_errors['post_data']['category'], 'class="form-control" id="category"');
        
        $this->data['product_title'] = array(
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
        
        $this->data['price_type'] = array(
            'name'  => 'price_type',
            'id'    => 'price_type',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['price_type']) ? NULL : $this->validation_errors['post_data']['price_type']
        );
        
        $this->data['discount'] = array(
            'name'  => 'discount',
            'id'    => 'discount',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['discount']) ? NULL : $this->validation_errors['post_data']['discount']
        );

        $this->data['start'] = array(
            'name'  => 'start',
            'id'    => 'start',
            'class' => 'form-control',
            'data-date-format' => 'yyyy-mm-dd',
            'data-date' => date('Y-m-d'),
            'value' => empty($this->validation_errors['post_data']['start']) ? NULL : $this->validation_errors['post_data']['start']
        );
        
        $this->data['end'] = array(
            'name'  => 'end',
            'id'    => 'end',
            'class' => 'form-control',
            'data-date-format' => 'yyyy-mm-dd',
            'data-date' => date('Y-m-d'),
            'value' => empty($this->validation_errors['post_data']['end']) ? NULL : $this->validation_errors['post_data']['end']
        );
        
        $this->data['picture'] = array(
            'name'  => 'picture[]',
            'id'    => 'picture',
            'multiple' => 'multiple',
            'accept'=> 'image/*'
        );
        
        // process template
        $title = $this->lang->line('form_product_create_heading');
        $this->data['title'] = $title;
        $layout_property['css'] = array('https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css' => FALSE,
                                        'css/plugins/metisMenu/metisMenu.min.css',
                                        'css/sb-admin-2.css',
                                        'font-awesome-4.1.0/css/font-awesome.min.css',
                                        'css/datepicker.min.css'
                                        );
        $layout_property['js']  = array('https://code.jquery.com/jquery-1.11.1.min.js' => FALSE,
                                        'https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js' => FALSE,
                                        'js/plugins/metisMenu/metisMenu.min.js',
                                        'js/sb-admin-2.js',
                                        'js/bootstrap-datepicker.min.js'
                                        );
        $layout_property['optional_js'] = base_url('assets/ckeditor/ckeditor.js');
        $layout_property['script'] = '$(\'#start\').datepicker(); $(\'#end\').datepicker(); ';
        
        if($checkLogin == 'admin')
        {
            $layout_property['breadcrumb'] = array('auth/members' => $this->lang->line('member_label'), 'members/'.$this->data['user']->id => $this->data['user']->username, 'products/'.$this->data['user']->id => $this->lang->line('index_product_heading'),  $title);
        }
        else 
        {
            $layout_property['breadcrumb'] = array('products/'.$this->data['user']->id => $this->lang->line('index_product_heading'), $title);
        }
        
        $layout_property['content']  = 'create';
        $layout_property['sidebar'] = 'members/sidebar';
        
        // menu
        $this->data['product_group_menu'] = TRUE; $this->data['product_create_menu'] = TRUE;
        generate_template($this->data, $layout_property); 
    }
    
    // save
    public function store()
    {
        parent::check_login(FALSE);
        $userId = trim($this->input->post('userId'));
        // check discount
        $discount = trim($this->input->post('discount'));
        if($discount != FALSE)
        {
            $this->product->validate[6]['rules'] = 'trim|required|xss_clean';
            $this->product->validate[7]['rules'] = 'trim|required|xss_clean';
        }
        
        $data = array(
            'title' => trim($this->input->post('title')),
            'slug'  => str_replace(' ', '-', trim($this->input->post('title'))),
            'description' => trim($this->input->post('desc')),
            'price' => trim($this->input->post('price')),
            'price_type' => trim($this->input->post('price_type')),
            'percent'   => $discount,
            'start_date'    => trim($this->input->post('start')),
            'end_date'  => trim($this->input->post('end')),
            'category_id' => trim($this->input->post('category'))
        );
        
        if($this->product->validate($data))
        {
            $pData = array(
                'title' => $data['title'],
                'slug'  => $data['slug'],
                'description' => $data['description'],
                'category_id' => $data['category_id'],
                'user_id' => $userId
            );
            
            if(($pid = $this->insert($pData, TRUE)) != FALSE)
            {
                // insert price
                $PriceData = array(
                    'price' => $data['price'],
                    'price_type' => $data['price_type'],
                    'set' => 1,
                    'product_id' => $pid
                );
                if(($ppid = $this->_insert_price($PriceData)) == FALSE)
                {
                    //roll back data
                    $this->delete($pid);
                    
                    $this->session->set_flashdata('message', $this->lang->line('form_product_report_error'));
                    redirect_form_validation(validation_errors(), $this->input->post(), 'products/create/'.$userId);
                }
                else
                {
                    // insert discount
                    if($discount != FALSE)
                    {
                        $discountData = array(
                            'percent'   => $data['percent'],
                            'start_date'=> $data['start_date'],
                            'end_date'  => $data['end_date'],
                            'product_price_id' => $ppid
                        );
                        
                        //insert discount
                        $pdid = $this->_insert_discount($discountData);
                        if($pdid == FALSE)
                        {
                            //roll back data
                            $this->delete($pid);
                            Modules::run('product_prices/delete', $ppid);
                            
                            $this->session->set_flashdata('message', print_upload_error());
                            redirect_form_validation(validation_errors(), $this->input->post(), 'products/create/'.$userId);
                        }
                    }
                }
                
                // check and upload picture
                if(check_empty_field('picture'))
                {
                    $uploaded = upload_file('picture', 'image', random_string());
                    if($uploaded == FALSE)
                    {
                        //roll back data
                        $this->delete($pid);
                        
                        $this->session->set_flashdata('message', print_upload_error());
                        redirect_form_validation(validation_errors(), $this->input->post(), 'products/create/'.$userId);
                    }
                    else
                    {
                        if(is_array($uploaded))
                        {
                            foreach ($uploaded as $picture)
                            {
                                // set watermark
                                watermark('./assets/uploaded/image/'.$picture, 'overlay', 'copyrights.png');

                                $data_picture = array(
                                    'file'  => $picture,
                                    'set'  => (bool) check_primary_product_picture($pid),
                                    'product_id' => $pid
                                );

                                //insert picture
                                if($this->_insert_picture($data_picture) == FALSE)
                                {
                                    //roll back data
                                    delete_uploaded_file($picture);
                                    $this->delete($pid);
                                    Modules::run('product_prices/delete', $ppid);
                                    if($pdid != FALSE)
                                    {
                                        Modules::run('product_discounts/delete', $pdid);
                                    }

                                    $this->session->set_flashdata('message', print_upload_error());
                                    redirect_form_validation(validation_errors(), $this->input->post(), 'products/create/'.$userId);
                                }
                            }
                        }
                        else
                        {
                            // set watermark
                            watermark('./assets/uploaded/image/'.$picture, 'overlay', 'copyrights.png');

                            $data_picture = array(
                                'file'  => $uploaded,
                                'set'  => (bool) check_primary_product_picture($pid),
                                'product_id' => $pid
                            );

                            //insert picture
                            if($this->_insert_picture($data_picture) == FALSE)
                            {
                                //roll back data
                                delete_uploaded_file($uploaded);
                                $this->delete($pid);
                                Modules::run('product_prices/delete', $ppid);
                                if($pdid != FALSE)
                                {
                                    Modules::run('product_discounts/delete', $pdid);
                                }

                                $this->session->set_flashdata('message', print_upload_error());
                                redirect_form_validation(validation_errors(), $this->input->post(), 'products/create/'.$userId);
                            }
                        }
                    }
                }
                
                
                // set log 
                array_unshift($data, $pid);
                set_log('Created Product', $data);

                $this->session->set_flashdata('message', $this->lang->line('form_product_report_success'));
                redirect('products/view/'.$pid, 'refresh');
            }
            else
            {
                //delete picture upload
                delete_uploaded_file($uploaded);
                redirect_form_validation(validation_errors(), $this->input->post(), 'products/create/'.$userId);
            }
        }
        else
        {
            redirect_form_validation(validation_errors(), $this->input->post(), 'products/create/'.$userId);
        }
    }
    
    // edit
    public function edit($id)
    {
        $checkLogin = parent::check_login(FALSE);
        $this->data['product'] = $this->get_detail($id);
        $this->data['user'] = $this->ion_auth->user($this->data['product']->user_id)->row();
        
        $this->data['product_id'] = array('product_id' => $this->data['product']->id);
        
        // display form
        $categories = get_dropdown(prepareList(Modules::run('categories/get_dropdown', array('market' => TRUE))), 'ជ្រើស​ក្រុម');
        $this->data['category'] = form_dropdown('category', $categories, empty($this->validation_errors['post_data']['category']) ? $this->data['product']->category_id : $this->validation_errors['post_data']['category'], 'class="form-control" id="category"');
        
        $this->data['product_title'] = array(
            'name'  => 'title',
            'id'    => 'title',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['title']) ? $this->data['product']->title : $this->validation_errors['post_data']['title']
        );
        
        $this->data['desc'] = array(
            'name'  => 'desc',
            'id'    => 'desc',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['desc']) ? $this->data['product']->description : $this->validation_errors['post_data']['desc']
        );
        
        // process template
        $title = $this->lang->line('form_product_edit_heading');
        $this->data['title'] = $title;
        $layout_property['css'] = array('https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css' => FALSE,
                                        'css/plugins/metisMenu/metisMenu.min.css',
                                        'css/sb-admin-2.css',
                                        'font-awesome-4.1.0/css/font-awesome.min.css',
                                        );
        $layout_property['js']  = array('https://code.jquery.com/jquery-1.11.1.min.js' => FALSE,
                                        'https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js' => FALSE,
                                        'js/plugins/metisMenu/metisMenu.min.js',
                                        'js/sb-admin-2.js',
                                        );
        $layout_property['optional_js'] = base_url('assets/ckeditor/ckeditor.js');
        
        if($checkLogin == 'admin')
        {
            $layout_property['breadcrumb'] = array('auth/members' => $this->lang->line('member_label'), 'members/'.$this->data['user']->id => $this->data['user']->username, 'products/'.$this->data['user']->id => $this->lang->line('index_product_heading'), 'products/view/'.$this->data['product']->id => $this->data['product']->title,  $title);
        }
        else 
        {
            $layout_property['breadcrumb'] = array('products/'.$this->data['user']->id => $this->lang->line('index_product_heading'), 'products/view/'.$this->data['product']->id => $this->data['product']->title, $title);
        }
        
        $layout_property['content']  = 'edit';
        $layout_property['sidebar'] = 'members/sidebar';
        
        // menu
        $this->data['product_group_menu'] = TRUE; $this->data['product_menu'] = TRUE;
        generate_template($this->data, $layout_property);
    }
    
    // update
    public function modify()
    {
        parent::check_login();
        $pid = trim($this->input->post('product_id'));
        
        $data = array(
            'title' => trim($this->input->post('title')),
            'slug'  => str_replace(' ', '-', trim($this->input->post('title'))),
            'description' => trim($this->input->post('desc')),
            'category_id' => trim($this->input->post('category'))
        );
        
        $this->product->validate[3]['rules'] = 'trim|xss_clean';
        $this->product->validate[4]['rules'] = 'trim|xss_clean';
        if($this->update($pid, $data))
        {
            // set log 
                array_unshift($data, $pid);
                set_log('Updated Product', $data);

                $this->session->set_flashdata('message', $this->lang->line('form_product_report_success'));
                redirect('products/view/'.$pid, 'refresh');
        }
        else
        {
            redirect_form_validation(validation_errors(), $this->input->post(), 'products/edit/'.$pid);
        }
    }
    
    // view
    public function view($id)
    {
        $checkLogin = parent::check_login(FALSE);
        
        $this->data['product'] = $this->get_detail($id);
        
        $this->data['product_id'] = array('product_id' => $this->data['product']->id);
        
        $this->data['user'] = $this->ion_auth->user($this->data['product']->user_id)->row();
        
        $this->data['prices'] = Modules::run('product_prices/get_all_records', array('product_id' => $this->data['product']->id));
        
        $this->data['pictures'] = Modules::run('product_pictures/get_many_by', array('product_id' => $this->data['product']->id));
        
        $this->form_validation->set_rules('product_id', 'Product Id', 'trim|xss_clean');
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
                        'set'  => check_primary_product_picture($this->data['product']->id),
                        'product_id' => $this->data['product']->id
                    );

                    $this->_insert_picture($data_picture);
                }
                $this->session->set_flashdata('message', $this->lang->line('picture_upload_successful'));
                redirect(current_url(), 'refresh');
            }
        }
        
        $this->data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
        
        //form data
        $this->data['price'] = array(
            'name'  => 'price',
            'id'    => 'price',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['price']) ? NULL : $this->validation_errors['post_data']['price']
        );
        
        $this->data['price_type'] = array(
            'name'  => 'price_type',
            'id'    => 'price_type',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['price_type']) ? NULL : $this->validation_errors['post_data']['price_type']
        );
        
        $this->data['discount'] = array(
            'name'  => 'discount',
            'id'    => 'discount',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['discount']) ? NULL : $this->validation_errors['post_data']['discount']
        );

        $this->data['start'] = array(
            'name'  => 'start',
            'id'    => 'start',
            'class' => 'form-control',
            'data-date-format' => 'yyyy-mm-dd',
            'data-date' => date('Y-m-d'),
            'value' => empty($this->validation_errors['post_data']['start']) ? NULL : $this->validation_errors['post_data']['start']
        );
        
        $this->data['end'] = array(
            'name'  => 'end',
            'id'    => 'end',
            'class' => 'form-control',
            'data-date-format' => 'yyyy-mm-dd',
            'data-date' => date('Y-m-d'),
            'value' => empty($this->validation_errors['post_data']['end']) ? NULL : $this->validation_errors['post_data']['end']
        );
        
        $this->data['picture'] = array(
            'name'  => 'picture[]',
            'id'    => 'picture',
            'multiple' => 'multiple',
            'accept'=> 'image/*'
        );
        
        // process template
        $title = $this->data['product']->title;
        $this->data['title'] = $title;
        $layout_property['css'] = array('https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css' => FALSE,
                                        'css/plugins/metisMenu/metisMenu.min.css',
                                        'css/sb-admin-2.css',
                                        'font-awesome-4.1.0/css/font-awesome.min.css',
                                        'css/colorbox/colorbox.min.css',
                                        'css/datepicker.min.css'
                                        );
        $layout_property['js']  = array('https://code.jquery.com/jquery-1.11.1.min.js' => FALSE,
                                        'https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js' => FALSE,
                                        'js/plugins/metisMenu/metisMenu.min.js',
                                        'js/sb-admin-2.js',
                                        'js/jquery.colorbox.min.js',
                                        'js/bootstrap-datepicker.min.js'
                                        );
        $layout_property['script'] = '$(document).ready(function(){$(".color-box").colorbox({rel:"color-box",transition:"fade"})}); $(\'#start\').datepicker(); $(\'#end\').datepicker();';
        if($checkLogin == 'admin')
        {
            $layout_property['breadcrumb'] = array('auth/members' => $this->lang->line('member_label'), 'members/'.$this->data['user']->id => $this->data['user']->username, 'products/'.$this->data['user']->id => $this->lang->line('index_product_heading'),  $title);
        }
        else 
        {
            $layout_property['breadcrumb'] = array('products/'.$this->data['user']->id => $this->lang->line('index_product_heading'), $title);
        }
        
        $layout_property['content']  = 'view';
        $layout_property['sidebar'] = 'members/sidebar';
        
        // menu
        $this->data['product_group_menu'] = TRUE; $this->data['product_menu'] = TRUE;
        generate_template($this->data, $layout_property); 
    }
    
    // delete
    public function destroy($id)
    {
        parent::check_login(FALSE);
        $product = $this->get_detail($id);
        $product_price = Modules::run('product_prices/get_all_records', array('product_id' => $product->id));
        $pictures = Modules::run('product_pictures/get_many_by', array('product_id' => $product->id));
        if($this->delete($product->id))
        {
            // delete price
            Modules::run('product_prices/delete_by', array('product_id' => $product->id));
            
            // delete discount
            foreach ($product_price as $price){
                Modules::run('product_discounts/delete_by', array('product_price_id' => $price->id));
            }
            
            
            if($pictures != FALSE)
            {
                foreach ($pictures as $picture)
                {
                    delete_uploaded_file($picture->file);
                }
                // delete product media
                Modules::run('product_pictures/delete_by', array('product_id' => $product->id));
            }
            
            // set log
            set_log('Deleted Product', $product);
            $this->session->set_flashdata('message', $this->lang->line('del_product_report_success'));
        }
        else
        {
            $this->session->set_flashdata('message', $this->lang->line('del_product_report_error'));
        }
        redirect('products/'.$product->user_id, 'refresh');
    }
     
    public function add_price()
    {
        parent::check_login(FALSE);
        $pid = $this->input->post('product_id');
        $data = array(
            'price' => $this->input->post('price'),
            'price_type' => $this->input->post('price_type'),
            'set' => (bool) check_primary_product_price($pid),
            'product_id' => $pid
        );
        
        if(($ppid = Modules::run('product_prices/insert', $data, TRUE)) != FALSE)
        {
            $discount = array(
                'percent'   => $this->input->post('discount'),
                'start_date'=> $this->input->post('start'),
                'end_date'  => $this->input->post('end'),
                'product_price_id' => $ppid
            );
            
            Modules::run('product_discounts/insert', $discount, TRUE);
            
            $this->session->set_flashdata('message', $this->lang->line('view_add_price_success_lable'));
            redirect('products/view/'.$pid, 'refresh');
        }
        else
        {
            redirect_form_validation(validation_errors(), $this->input->post(), 'products/view/'.$pid);
        }
    }
    
    public function edit_price($prid)
    {
        $checkLogin = parent::check_login(FALSE);
        $price = Modules::run('product_prices/get_detail', $prid);
        $this->data['product'] = $this->get($price->product_id);
        $this->data['user'] = $this->ion_auth->user($this->data['product']->user_id)->row();
        
        $this->form_validation->set_rules('price', $this->lang->line('form_product_price_label'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('price_type', $this->lang->line('form_product_price_type_label'), 'trim|xss_clean');
        $this->form_validation->set_rules('discount', $this->lang->line('form_product_discount_label'), 'trim|xss_clean');
        $this->form_validation->set_rules('start', $this->lang->line('form_product_discount_start_label'), 'trim|xss_clean');
        $this->form_validation->set_rules('end', $this->lang->line('form_product_discount_end_label'), 'trim|xss_clean');
        
        if($this->form_validation->run() == TRUE)
        {
            $data = array(
                'price' => $this->input->post('price'),
                'price_type' => $this->input->post('price_type')
            );
            
            if(Modules::run('product_prices/update', $price->id, $data, TRUE) != FALSE)
            {
                //update discount
                $discount = array(
                    'percent'   => $this->input->post('discount'),
                    'start_date'=> $this->input->post('start'),
                    'end_date'  => $this->input->post('end')
                );
                if($price->discount_id != FALSE)
                {
                    Modules::run('product_discounts/update', $price->discount_id, $discount, TRUE);
                }
                else
                {
                    $discount['product_price_id'] = $price->id;
                    Modules::run('product_discounts/insert', $discount, TRUE);
                }
                
                
                $this->session->set_flashdata('message', $this->lang->line('view_update_price_success_lable'));
                redirect('products/view/'.$this->data['product']->id, 'refresh');
            }
        }
        
        $this->data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
        
        //form data
        $this->data['price'] = array(
            'name'  => 'price',
            'id'    => 'price',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['price']) ? $price->price : $this->validation_errors['post_data']['price']
        );
        
        $this->data['price_type'] = array(
            'name'  => 'price_type',
            'id'    => 'price_type',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['price_type']) ? $price->price_type : $this->validation_errors['post_data']['price_type']
        );
        
        $this->data['discount'] = array(
            'name'  => 'discount',
            'id'    => 'discount',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['discount']) ? $price->discount : $this->validation_errors['post_data']['discount']
        );

        $this->data['start'] = array(
            'name'  => 'start',
            'id'    => 'start',
            'class' => 'form-control',
            'data-date-format' => 'yyyy-mm-dd',
            'data-date' => date('Y-m-d'),
            'value' => empty($this->validation_errors['post_data']['start']) ? $price->start_date : $this->validation_errors['post_data']['start']
        );
        
        $this->data['end'] = array(
            'name'  => 'end',
            'id'    => 'end',
            'class' => 'form-control',
            'data-date-format' => 'yyyy-mm-dd',
            'data-date' => date('Y-m-d'),
            'value' => empty($this->validation_errors['post_data']['end']) ? $price->end_date : $this->validation_errors['post_data']['end']
        );
        
        // process template
        $title = $this->lang->line('veiw_edit_price_label');
        $this->data['title'] = $title;
        $layout_property['css'] = array('https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css' => FALSE,
                                        'css/plugins/metisMenu/metisMenu.min.css',
                                        'css/sb-admin-2.css',
                                        'font-awesome-4.1.0/css/font-awesome.min.css',
                                        'css/datepicker.min.css'
                                        );
        $layout_property['js']  = array('https://code.jquery.com/jquery-1.11.1.min.js' => FALSE,
                                        'https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js' => FALSE,
                                        'js/plugins/metisMenu/metisMenu.min.js',
                                        'js/sb-admin-2.js',
                                        'js/bootstrap-datepicker.min.js'
                                        );
        
        $layout_property['script'] = '$(document).ready(function(){$(".color-box").colorbox({rel:"color-box",transition:"fade"})}); $(\'#start\').datepicker(); $(\'#end\').datepicker();';
        if($checkLogin == 'admin')
        {
            $layout_property['breadcrumb'] = array('auth/members' => $this->lang->line('member_label'), 'members/'.$this->data['user']->id => $this->data['user']->username, 'products/'.$this->data['user']->id => $this->lang->line('index_product_heading'), 'products/view/'.$this->data['product']->id => $this->data['product']->title,  $title);
        }
        else 
        {
            $layout_property['breadcrumb'] = array('products/'.$this->data['user']->id => $this->lang->line('index_product_heading'), 'products/view/'.$this->data['product']->id => $this->data['product']->title, $title);
        }
        
        $layout_property['content']  = 'edit_price';
        $layout_property['sidebar'] = 'members/sidebar';
        
        // menu
        $this->data['product_group_menu'] = TRUE; $this->data['product_menu'] = TRUE;
        generate_template($this->data, $layout_property);
    }
    
    public function delete_price($prid)
    {
        parent::check_login(FALSE);
        $price = Modules::run('product_prices/get_detail', $prid);
        if(Modules::run('product_prices/delete', $price->id))
        {
            //delete discount
            Modules::run('product_discounts/delete', $price->discount_id);
            
            set_log('Deleted Product Price', $price);
            $this->session->set_flashdata('message', $this->lang->line('view_delete_price_success_label'));
        }
        else
        {
            $this->session->set_flashdata('message', $this->lang->line('view_delete_price_error_label'));
        }
        redirect('products/view/'.$price->product_id, 'refresh');
    }
    
    public function set($prid)
    {
        parent::check_login(FALSE);
        $price = Modules::run('product_prices/get', $prid);
        $product_prices = Modules::run('product_prices/get_many_by', array('product_id' => $price->product_id));
        //reset to false;
        foreach ($product_prices as $product_price)
        {
            Modules::run('product_prices/update', $product_price->id, array('set' => 0), TRUE);
        }
        
        // update
        Modules::run('product_prices/update', $price->id, array('set' => 1), TRUE);
        
        $this->session->set_flashdata('message', $this->lang->line('view_set_price_label'));
        redirect('products/view/'.$price->product_id);
        
    }

    // delete media
    public function delete_media($id)
    {
        parent::check_login(FALSE);
        $meida = Modules::run('product_pictures/get', $id);
        if(Modules::run('product_pictures/delete', $meida->id))
        {
            delete_uploaded_file($meida->file);
            
            // set log
            set_log('Delete Product Picture', $meida);
            $this->session->set_flashdata('message', $this->lang->line('view_delete_picture_success'));
        }
        else
        {
            $this->session->set_flashdata('message', $this->lang->line('view_delete_picture_error'));
        }
        redirect('products/view/'.$meida->product_id, 'refresh');
    }
    
    public function get($id, $array = FALSE)
    {
        if($array == TRUE){
            return $this->product->as_array()->get($id);
        }
        return $this->product->as_object()->get($id);
    }
    
    public function get_by($where, $array = FALSE)
    {
        if($array == TRUE){
            return $this->product->as_array()->get_by($where);
        }
        return $this->product->as_object()->get_by($where);
    }
    
    public function get_detail($where)
    {
        return $this->product->get_detail($where);
    }
    
    public function get_contact($id)
    {
        return $this->product->get_contact($id);
    }

    public function get_all($order_by = FALSE, $limit = FALSE, $offset = 0)
    {
        if($order_by != FALSE)
        {
            $this->order_by($order_by);
        }
        if($limit != FALSE)
        {
            $this->product->limit($limit, $offset);
        }
        return $this->product->get_all();
    }
    
    public function get_all_records($where, $order_by = FALSE, $limit = FALSE, $offset = 0)
    {
        if($order_by != FALSE)
        {
            $this->order_by($order_by);
        }
        if($limit != FALSE)
        {
            $this->product->limit($limit, $offset);
        }
        return $this->product->get_all_records($where);
    }
    
    public function get_many_by($where, $order_by = FALSE, $limit = FALSE, $offset = 0)
    {
        if($order_by != FALSE)
        {
            $this->order_by($order_by);
        }
        if($limit != FALSE)
        {
            $this->product->limit($limit, $offset);
        }
        return $this->product->get_many_by($where);
    }
    
    public function get_like($like, $where = FALSE, $condition = 'both')
    {
       return $this->product->get_like($like, $where, $condition);
    }
    
    public function get_field($field, $where = FALSE, $array = FALSE)
    {
        return $this->product->get_field($field, $where, $array);
    }
    
    public function insert($data, $skip_validation = FALSE)
    {
        return $this->product->insert($data, $skip_validation);
    }
    
    public function insert_many($data, $skip_validation = FALSE)
    {
        return $this->product->insert_many($data, $skip_validation);
    }
    
    public function update($id, $data, $skip_validation = FALSE)
    {
        return $this->product->update($id, $data, $skip_validation);
    }
    
    public function delete($id)
    {
        return $this->product->delete($id);
    }
    
    public function delete_by($where)
    {
        return $this->product->delete_by($where);
    }
    
    public function count_all()
    {
        return $this->product->count_all();
    }
    
    public function count_by($where)
    {
        return $this->product->count_by($where);
    }
    
    public function dropdown($key, $value, $option_label = NULL, $where = NULL)
    {
        if($where != NULL){
            $this->db->where($where);
        }
        
        return $this->product->dropdown($key, $value,$option_label);
    }
    
    public function order_by($criteria, $order = NULL)
    {
        $this->product->order_by($criteria,$order);
    }
    
    public function get_next_order($field, $where = FALSE)
    {
        return $this->product->get_next_order($field, $where);
    }
    
    public function _insert_price($data)
    {
        $priceId = Modules::run('product_prices/insert', $data, TRUE);
        if(is_numeric($priceId))
        {
            return $priceId;
        }
        else
        {
            return FALSE;
        }
    }
    
    public function _insert_discount($data)
    {
        $discountId = Modules::run('product_discounts/insert', $data, TRUE);
        if(is_numeric($discountId))
        {
            return $discountId;
        }
        else
        {
            return FALSE;
        }
    }
    
    public function _insert_picture($data)
    {
        $ppicid = Modules::run('product_pictures/insert', $data, TRUE);
        if(is_numeric($ppicid))
        {
            return $ppicid;
        }
        else
        {
            return FALSE;
        }
    }
}