<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of advertise
 *
 * @author Chanthoeun
 */
class Advertises extends Admin_Controller {
    public  $validation_errors =  array();
    
    public function __construct() {
        parent::__construct();
        $this->load->model('advertise_model', 'advertise');
        $this->lang->load('advertise');
        
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
        $this->data['advertises'] = $this->get_all_records(array('advertise.status' => TRUE, 'aprice.end_date >=' => date('Y-m-d')));
        
        // process template
        $title = $this->lang->line('index_advertise_heading');
        $this->data['title'] = $title;
        
        $layout_property = parent::load_index_script('css/colorbox/colorbox.min.css', 'js/jquery.colorbox.min.js', '$(document).ready(function(){$(".color-box").colorbox({rel:"color-box",transition:"fade"})});');
        
        $layout_property['breadcrumb'] = array($title);
        
        $layout_property['content']  = 'index';
        
        // menu
        $this->data['advertise_group_menu'] = TRUE; $this->data['advertise_banner_group_menu'] = TRUE; $this->data['advertise_menu'] = TRUE;
        generate_template($this->data, $layout_property); 
    }
    
    // expired
    public function expired()
    {
        parent::check_login();
        $this->data['advertises'] = $this->get_all_records(array('aprice.end_date <' => date('Y-m-d')));
        
        // process template
        $title = $this->lang->line('index_advertise_expired_heading');
        $this->data['title'] = $title;
        
        $layout_property = parent::load_index_script('css/colorbox/colorbox.min.css', 'js/jquery.colorbox.min.js', '$(document).ready(function(){$(".color-box").colorbox({rel:"color-box",transition:"fade"})});');
        
        $layout_property['breadcrumb'] = array($title);
        
        $layout_property['content']  = 'index';
        
        // menu
        $this->data['advertise_group_menu'] = TRUE; $this->data['advertise_banner_group_menu'] = TRUE; $this->data['advertise_expired_menu'] = TRUE;
        generate_template($this->data, $layout_property); 
    }
    
    // paid
    public function paid()
    {
        parent::check_login();
        $this->data['advertises'] = $this->get_all_records(array('aprice.status' => TRUE));
        
        // process template
        $title = $this->lang->line('index_advertise_paid_heading');
        $this->data['title'] = $title;
        
        $layout_property = parent::load_index_script('css/colorbox/colorbox.min.css', 'js/jquery.colorbox.min.js', '$(document).ready(function(){$(".color-box").colorbox({rel:"color-box",transition:"fade"})});');
        
        $layout_property['breadcrumb'] = array($title);
        
        $layout_property['content']  = 'index';
        
        // menu
        $this->data['advertise_group_menu'] = TRUE; $this->data['advertise_banner_group_menu'] = TRUE; $this->data['advertise_expired_menu'] = TRUE;
        generate_template($this->data, $layout_property); 
    }
    
    // unpaid
    public function unpaid()
    {
        parent::check_login();
        $this->data['advertises'] = $this->get_all_records(array('aprice.status' => FALSE));
        
        // process template
        $title = $this->lang->line('index_advertise_unpaid_heading');
        $this->data['title'] = $title;
        
        $layout_property = parent::load_index_script('css/colorbox/colorbox.min.css', 'js/jquery.colorbox.min.js', '$(document).ready(function(){$(".color-box").colorbox({rel:"color-box",transition:"fade"})});');
        
        $layout_property['breadcrumb'] = array($title);
        
        $layout_property['content']  = 'index';
        
        // menu
        $this->data['advertise_group_menu'] = TRUE; $this->data['advertise_banner_group_menu'] = TRUE; $this->data['advertise_expired_menu'] = TRUE;
        generate_template($this->data, $layout_property); 
    }
    
    // expired
    public function deactivated()
    {
        parent::check_login();
        $this->data['advertises'] = $this->get_all_records(array('advertise.status' => FALSE));
        
        // process template
        $title = $this->lang->line('index_advertise_deactivated_heading');
        $this->data['title'] = $title;
        
        $layout_property = parent::load_index_script('css/colorbox/colorbox.min.css', 'js/jquery.colorbox.min.js', '$(document).ready(function(){$(".color-box").colorbox({rel:"color-box",transition:"fade"})});');
        
        $layout_property['breadcrumb'] = array($title);
        
        $layout_property['content']  = 'index';
        
        // menu
        $this->data['advertise_group_menu'] = TRUE; $this->data['advertise_banner_group_menu'] = TRUE; $this->data['advertise_expired_menu'] = TRUE;
        generate_template($this->data, $layout_property); 
    }
    
    
    // create
    public function create($aid = FALSE)
    {
        parent::check_login();
        if($aid == FALSE)
        {
            $advertiser = FALSE;
        }
        else
        {
            $advertiser = Modules::run('advertisers/get', $aid)->name;
        }
        
        // display form
        $this->data['advertiser'] = array(
            'name'  => 'advertiser',
            'id'    => 'advertiser',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['advertiser']) ? $advertiser : $this->validation_errors['post_data']['advertiser']
        );
        
        $this->data['page'] = form_dropdown('page', Modules::run('advertise_pages/dropdown', 'id', 'caption', $this->lang->line('index_advertise_page_th')), empty($this->validation_errors['post_data']['page']) ? NULL : $this->validation_errors['post_data']['page'], array('class' => 'form-control', 'id' => 'page'));
        if(! empty($this->validation_errors['post_data']['page']))
        {
            $this->data['layout'] = form_dropdown('layout', Modules::run('advertise_page_layouts/get_dropdown', 'layout_id', 'caption', 'ជ្រើស'.$this->lang->line('index_advertise_layout_th'), array('page_id' => $this->validation_errors['post_data']['page'])), empty($this->validation_errors['post_data']['layout']) ? NULL : $this->validation_errors['post_data']['layout'], array('class' => 'form-control', 'id' => 'layout'));
        }
        else
        {
            $this->data['layout'] = form_dropdown('layout', array(0 => 'ជ្រើស'.$this->lang->line('index_advertise_layout_th')), empty($this->validation_errors['post_data']['layout']) ? NULL : $this->validation_errors['post_data']['layout'], array('class' => 'form-control', 'id' => 'layout'));
        }
        
       
        $this->data['price'] = array(
            'name'  => 'price',
            'id'    => 'price',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['price']) ? NULL : $this->validation_errors['post_data']['price']
        );
        
        $this->data['discount'] = array(
            'name'  => 'discount',
            'id'    => 'discount',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['discount']) ? NULL : $this->validation_errors['post_data']['discount']
        );
        
        $this->data['start_date'] = array(
            'name'  => 'start_date',
            'id'    => 'start_date',
            'class' => 'form-control',
            'data-date-format' => 'yyyy-mm-dd',
            'data-date' => date('Y-m-d'),
            'value' => empty($this->validation_errors['post_data']['start_date']) ? NULL : $this->validation_errors['post_data']['start_date']
        );
        
        $this->data['end_date'] = array(
            'name'  => 'end_date',
            'id'    => 'end_date',
            'class' => 'form-control',
            'data-date-format' => 'yyyy-mm-dd',
            'data-date' => date('Y-m-d'),
            'value' => empty($this->validation_errors['post_data']['end_date']) ? NULL : $this->validation_errors['post_data']['end_date']
        );
        
        $this->data['link'] = array(
            'name'  => 'link',
            'id'    => 'link',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['link']) ? NULL : $this->validation_errors['post_data']['link']
        );
        
        $this->data['banner'] = array(
            'name'  => 'banner',
            'id'    => 'banner',
            'accept'=> 'image/*'
        );
       
        $this->data['payment_type'] = array(
            'name' => 'payment_type',
            'id' => 'payment_type',
            'value' => 1,
            'checked' => empty($this->validation_errors['post_data']['payment_type']) ? FALSE : $this->validation_errors['post_data']['payment_type']
        );
        if($aid == FALSE)
        {
            $layout_property['css'] = array('https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css' => FALSE,
                                            'css/plugins/metisMenu/metisMenu.min.css',
                                            'css/sb-admin-2.css',
                                            'font-awesome-4.1.0/css/font-awesome.min.css',
                                            'css/jquery-ui.css',
                                            'css/datepicker.min.css',
                                            );
            $layout_property['js']  = array('https://code.jquery.com/jquery-1.11.1.min.js' => FALSE,
                                            'https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js' => FALSE,
                                            'js/plugins/metisMenu/metisMenu.min.js',
                                            'js/sb-admin-2.js',
                                            'js/jquery-ui.min.js',
                                            'js/bootstrap-datepicker.min.js',
                                            );

            $field1 = array_to_string(Modules::run('advertisers/get_field', 'name'), 'name');
            $layout_property['script'] = '$(\'#start_date\').datepicker(); $(\'#end_date\').datepicker(); $(function() { var availableTags = ['.$field1.'];  $( "#advertiser" ).autocomplete({ source: availableTags }); }); ';
        }
        else 
        {
            $layout_property['css'] = array('https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css' => FALSE,
                                            'css/plugins/metisMenu/metisMenu.min.css',
                                            'css/sb-admin-2.css',
                                            'font-awesome-4.1.0/css/font-awesome.min.css',
                                            'css/datepicker.min.css',
                                            );
            $layout_property['js']  = array('https://code.jquery.com/jquery-1.11.1.min.js' => FALSE,
                                            'https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js' => FALSE,
                                            'js/plugins/metisMenu/metisMenu.min.js',
                                            'js/sb-admin-2.js',
                                            'js/bootstrap-datepicker.min.js',
                                            );

            $layout_property['script'] = '$(\'#start_date\').datepicker(); $(\'#end_date\').datepicker();';
        }
        // process template
        $title = $this->lang->line('form_advertise_create_heading');
        $this->data['title'] = $title;
        
        $layout_property['breadcrumb'] = array('advertises' => $this->lang->line('index_advertise_heading'), $title);
        
        $layout_property['content']  = 'create';
        
        // menu
        $this->data['advertise_group_menu'] = TRUE; $this->data['advertise_banner_group_menu'] = TRUE; $this->data['advertise_create_menu'] = TRUE;
        generate_template($this->data, $layout_property); 
    }

    // save
    public function store()
    {
        parent::check_login();
        $get_advertiser = Modules::run('advertisers/get_by', array('name' => trim($this->input->post('advertiser'))));
        if($get_advertiser == FALSE)
        {
            $this->session->set_flashdata('message', 'អ្នក​ផ្សព្វ​ផ្សាយ​មិន​ទាន់​មាន​នៅ​ក្នុង​ប្រព័ន្ទ​ទេ សូម​បង្កើត​អ្នក​ផ្សព្វ​ផ្សាយ​ជាមុន​សិន!');
            redirect_form_validation(validation_errors(), $this->input->post(), 'advertises/create');
        }
        
        $data = array(
            'advertiser' => $get_advertiser->name,
            'page'    => trim($this->input->post('page')),
            'layout'   => trim($this->input->post('layout')),
            'price'   => trim($this->input->post('price')),
            'discount'   => trim($this->input->post('discount')),
            'start_date'   => trim($this->input->post('start_date')),
            'end_date'   => trim($this->input->post('end_date')),
            'link'   => trim($this->input->post('link')),
            'payment_type'   => trim($this->input->post('payment_type')),
        );
        
        if($this->advertise->validate($data))
        {
            
            $layout = Modules::run('advertise_layouts/get', $data['layout']);
            
            $uploaded = upload_file('banner', 'image', $data['advertiser'].'-'.strtotime(date('Y-m-d')), FALSE, FALSE, $layout->width, $layout->height);
            if($uploaded == FALSE)
            {
                $this->session->set_flashdata('message', print_upload_error());
                redirect_form_validation(validation_errors(), $this->input->post(), 'advertises/create/'.$get_advertiser->id);
            }
            else
            {
                $data['banner'] = $uploaded;
            }
            
            $advertise = array(
                'advertiser_id' => $get_advertiser->id,
                'page_id'    => $data['page'],
                'layout_id'   => $data['layout'],
                'link'   => $data['link'],
                'banner'   => $data['banner'],
            );
            
            if (($advertiseid = $this->insert($advertise, TRUE)) != FALSE)
            {
                // set log
                array_unshift($advertise, $advertiseid);
                set_log('Created Advertise', $advertise);
                
                // add price
                $price = array(
                    'price' => $data['price'],
                    'discount' => $data['discount'],
                    'start_date'=> $data['start_date'],
                    'end_date'=> $data['end_date'],
                    'payment_type' => $data['payment_type'],
                    'advertise_id' => $advertiseid,
                );                
                Modules::run('advertise_prices/insert', $price, TRUE);

                
                $this->session->set_flashdata('message', $this->lang->line('form_advertise_report_success'));
                redirect('advertisers/view/'.$get_advertiser->id, 'refresh');
            }
            else
            {
                redirect_form_validation(validation_errors(), $this->input->post(), 'advertises/create/'.$get_advertiser->id);
            }
        }
        else
        {
            redirect_form_validation(validation_errors(), $this->input->post(), 'advertises/create/'.$get_advertiser->id);
        }
    }

    // edit
    public function edit($id)
    {
        parent::check_login();
        $advertise = $this->get_detail($id);
        $this->data['advertise_id'] = array('advertise_id' => $advertise->id);
        $this->data['advertise'] = $advertise;

        // set log
        set_log('View Update Advertise', $advertise);
        
        // display form        
        $this->data['page'] = form_dropdown('page', Modules::run('advertise_pages/dropdown', 'id', 'caption', $this->lang->line('index_advertise_page_th')), empty($this->validation_errors['post_data']['page']) ? $advertise->page_id : $this->validation_errors['post_data']['page'], array('class' => 'form-control', 'id' => 'page'));
        if(! empty($this->validation_errors['post_data']['page']))
        {
            $this->data['layout'] = form_dropdown('layout', Modules::run('advertise_page_layouts/get_dropdown', 'layout_id', 'caption', 'ជ្រើស'.$this->lang->line('index_advertise_layout_th'), array('page_id' => $this->validation_errors['post_data']['page'])), empty($this->validation_errors['post_data']['layout']) ? $advertise->layout_id : $this->validation_errors['post_data']['layout'], array('class' => 'form-control', 'id' => 'layout'));
        }
        else
        {
            $this->data['layout'] = form_dropdown('layout', Modules::run('advertise_page_layouts/get_dropdown', 'layout_id', 'caption', 'ជ្រើស'.$this->lang->line('index_advertise_layout_th'), array('page_id' => $advertise->page_id)), empty($this->validation_errors['post_data']['layout']) ? $advertise->layout_id : $this->validation_errors['post_data']['layout'], array('class' => 'form-control', 'id' => 'layout'));
        }
        
       
        $this->data['price'] = array(
            'name'  => 'price',
            'id'    => 'price',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['price']) ? $advertise->price : $this->validation_errors['post_data']['price']
        );
        
        $this->data['discount'] = array(
            'name'  => 'discount',
            'id'    => 'discount',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['discount']) ? $advertise->discount : $this->validation_errors['post_data']['discount']
        );
        
        $this->data['start_date'] = array(
            'name'  => 'start_date',
            'id'    => 'start_date',
            'class' => 'form-control',
            'data-date-format' => 'yyyy-mm-dd',
            'data-date' => date('Y-m-d'),
            'value' => empty($this->validation_errors['post_data']['start_date']) ? $advertise->start_date : $this->validation_errors['post_data']['start_date']
        );
        
        $this->data['end_date'] = array(
            'name'  => 'end_date',
            'id'    => 'end_date',
            'class' => 'form-control',
            'data-date-format' => 'yyyy-mm-dd',
            'data-date' => date('Y-m-d'),
            'value' => empty($this->validation_errors['post_data']['end_date']) ? $advertise->end_date : $this->validation_errors['post_data']['end_date']
        );
        
        $this->data['link'] = array(
            'name'  => 'link',
            'id'    => 'link',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['link']) ? $advertise->link : $this->validation_errors['post_data']['link']
        );
        
        $this->data['banner'] = array(
            'name'  => 'banner',
            'id'    => 'banner',
            'accept'=> 'image/*'
        );
       
        $this->data['payment_type'] = array(
            'name' => 'payment_type',
            'id' => 'payment_type',
            'value' => 1,
            'checked' => empty($this->validation_errors['post_data']['payment_type']) ? $advertise->payment_type : $this->validation_errors['post_data']['payment_type']
        );
        
        // process template
        $title = $this->lang->line('form_advertise_edit_heading');
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
        
        $layout_property['breadcrumb'] = array('advertises' => $this->lang->line('index_advertise_heading'), $title);
        
        $layout_property['content']  = 'edit';
        
        // menu
        $this->data['advertise_group_menu'] = TRUE; $this->data['advertise_banner_group_menu'] = TRUE; $this->data['advertise_menu'] = TRUE;
        generate_template($this->data, $layout_property); 
    }
    
    // update
    public function modify()
    {
        parent::check_login();
        $id = $this->input->post('advertise_id');
        $get_advertise = $this->get_detail($id);
        
        $data = array(
            'page'    => trim($this->input->post('page')),
            'layout'   => trim($this->input->post('layout')),
            'price'   => trim($this->input->post('price')),
            'discount'   => trim($this->input->post('discount')),
            'start_date'   => trim($this->input->post('start_date')),
            'end_date'   => trim($this->input->post('end_date')),
            'link'   => trim($this->input->post('link')),
            'payment_type'   => trim($this->input->post('payment_type')),
        );
        
        $this->advertise->validate[0]['rules'] = 'trim|xss_clean';
        if($this->advertise->validate($data))
        {
            $advertise = array(
                'page_id'    => $data['page'],
                'layout_id'   => $data['layout'],
                'link'   => $data['link'],
            );
            
            if(check_empty_field('banner'))
            {
                $layout = Modules::run('advertise_layouts/get', $data['layout']);
                $uploaded = upload_file('banner', 'image', $get_advertise->advertiser.'-'.strtotime(date('Y-m-d')), FALSE, FALSE, $layout->width, $layout->height);
                if($uploaded == FALSE)
                {
                    $this->session->set_flashdata('message', print_upload_error());
                    redirect_form_validation(validation_errors(), $this->input->post(), 'advertises/edit/'.$get_advertise->id);
                }
                else
                {
                    
                    if($get_advertise->banner != FALSE)
                    {
                        delete_uploaded_file($get_advertise->banner);
                    }
                    $advertise['banner'] = $uploaded;
                }
            }
            
            if ($this->update($get_advertise->id, $advertise, TRUE))
            {
                // set log
                array_unshift($advertise, $get_advertise->id);
                set_log('Updated Advertise', $advertise);
                
                // update price
                $price = array(
                    'price' => $data['price'],
                    'discount' => $data['discount'],
                    'start_date'=> $data['start_date'],
                    'end_date'=> $data['end_date'],
                    'payment_type' => $data['payment_type'],
                );
                // get price
                $get_price = Modules::run('advertise_prices/get_by', array('advertise_id' => $get_advertise->id));
                if($get_price == FALSE)
                {
                    $price['advertise_id'] = $get_advertise->id;
                    Modules::run('advertise_prices/insert', $price, TRUE);
                }
                else
                {
                    Modules::run('advertise_prices/update', $get_price->id, $price, TRUE);
                }
                                
                $this->session->set_flashdata('message', $this->lang->line('form_advertise_report_success'));
                redirect('advertisers/view/'.$get_advertise->advertiser_id, 'refresh');
            }
            else
            {
                redirect_form_validation(validation_errors(), $this->input->post(), 'advertises/edit/'.$id);
            }
        }
        else
        {
            redirect_form_validation(validation_errors(), $this->input->post(), 'advertises/edit/'.$id);
        }
    }

    // delete
    public function destroy($id)
    {
        parent::check_login();
        $advertise = $this->get($id);
        
        if($this->delete($id))
        {
            // delete banner
            delete_uploaded_file($advertise->banner);
            
            // delete price
            Modules::run('advertise_prices/delete_by', array('advertise_id' => $advertise->id));
            
            // set log
            set_log('Deleted Advertise', $advertise);
            
            $this->session->set_flashdata('message', $this->lang->line('del_advertise_report_success'));
        }
        else
        {
            $this->session->set_flashdata('message', $this->lang->line('del_advertise_report_error'));
        }
        redirect('advertisers/view/'.$advertise->advertiser_id, 'refresh');
    }
    
    public function status($id) {
        parent::check_login();
        $advertise = $this->get_detail($id);
        if($advertise->status == FALSE)
        {
            $this->update($id, array('status' => TRUE), TRUE);
            $this->session->set_flashdata('message', $this->lang->line('form_advertise_report_activeated_success'));
            redirect('advertisers/view/'.$advertise->advertiser_id, 'refresh');
        }
        
        $this->update($id, array('status' => FALSE), TRUE);
        $this->session->set_flashdata('message', $this->lang->line('form_advertise_report_deactiveated_success'));
        redirect('advertisers/view/'.$advertise->advertiser_id, 'refresh');
    }
    
    public function payment($id) {
        parent::check_login();
        $advertise = $this->get_detail($id);
        $price = Modules::run('advertise_prices/get_by', array('advertise_id' => $advertise->id));
        if($advertise->payment == FALSE)
        {
            Modules::run('advertise_prices/update', $price->id, array('status' => TRUE), TRUE);
            $this->session->set_flashdata('message', $this->lang->line('form_advertise_report_paid_success'));
            redirect('advertisers/view/'.$advertise->advertiser_id, 'refresh');
        }
        
        Modules::run('advertise_prices/update', $price->id, array('status' => FALSE), TRUE);
        $this->session->set_flashdata('message', $this->lang->line('form_advertise_report_unpaid_success'));
        redirect('advertisers/view/'.$advertise->advertiser_id, 'refresh');
    }
    
    public function payment_type($id) {
        parent::check_login();
        $advertise = $this->get_detail($id);
        $price = Modules::run('advertise_prices/get_by', array('advertise_id' => $advertise->id));
        if($advertise->payment_type == FALSE)
        {
            Modules::run('advertise_prices/update', $price->id, array('payment_type' => TRUE), TRUE);
            $this->session->set_flashdata('message', $this->lang->line('form_advertise_report_monthly_payment_success'));
            redirect('advertisers/view/'.$advertise->advertiser_id, 'refresh');
        }
        
        Modules::run('advertise_prices/update', $price->id, array('payment_type' => FALSE), TRUE);
        $this->session->set_flashdata('message', $this->lang->line('form_advertise_report_whole_payment_success'));
        redirect('advertisers/view/'.$advertise->advertiser_id, 'refresh');
    }
    
    public function get_layout() {
        $pid = $this->input->post('pid');
        $layout = form_dropdown('layout', Modules::run('advertise_page_layouts/get_dropdown', 'layout_id', 'caption', 'ជ្រើស'.$this->lang->line('index_advertise_layout_th'), array('page_id' => $pid)), empty($this->validation_errors['post_data'][$label]) ? FALSE : $this->validation_errors['post_data'][$label], array('class' => 'form-control', 'id' => 'layout'));
        echo $layout;
        $this->output->enable_profiler(FALSE);
    }
    
    public function get_price() {
        $lid = $this->input->post('lid');
        $layout = Modules::run('advertise_layouts/get', $lid);
        $price = $layout->price;
        echo $price;
        $this->output->enable_profiler(FALSE);
    }
    
    public function get($id, $array = FALSE)
    {
        if($array == TRUE){
            return $this->advertise->as_array()->get($id);
        }
        return $this->advertise->as_object()->get($id);
    }
    
    public function get_detail($where)
    {
        return $this->advertise->get_detail($where);
    }
    
    public function get_by($where, $array = FALSE)
    {
        if($array == TRUE){
            return $this->advertise->as_array()->get_by($where);
        }
        return $this->advertise->as_object()->get_by($where);
    }
    
    public function get_list($where = FALSE)
    {
        return $this->advertise->get_list($where);
    }
    
    public function get_all()
    {
        return $this->advertise->get_all();
    }
    
    public function get_all_records($where = FALSE)
    {
        return $this->advertise->get_all_records($where);
    }
    
    public function get_many_by($where)
    {
        return $this->advertise->get_many_by($where);
    }
    
    public function get_advertises($where = FALSE) {
        return $this->advertise->get_advertises($where);
    }
    
    public function insert($data, $skip_validation = FALSE)
    {
        return $this->advertise->insert($data, $skip_validation);
    }
    
    public function insert_many($data, $skip_validation = FALSE)
    {
        return $this->advertise->insert_many($data, $skip_validation);
    }
    
    public function update($id, $data, $skip_validation = FALSE)
    {
        return $this->advertise->update($id, $data, $skip_validation);
    }
    
    public function delete($id)
    {
        return $this->advertise->delete($id);
    }
    
    public function delete_by($where)
    {
        return $this->advertise->delete_by($where);
    }
    
    public function count_all()
    {
        return $this->advertise->count_all();
    }
    
    public function count_by($where)
    {
        return $this->advertise->count_by($where);
    }
    
    public function get_dropdown($where = FALSE)
    {
        return $this->advertise->get_dropdown($where);
    }
    
    public function dropdown($key, $value, $option_label = NULL, $where = NULL)
    {
        if($where != NULL){
            $this->db->where($where);
        }
        
        return $this->advertise->dropdown($key, $value,$option_label);
    }
    
    public function order_by($criteria, $order = NULL)
    {
        $this->advertise->order_by($criteria,$order);
    }
    
    public function get_next_order($field, $where = FALSE)
    {
        return $this->advertise->get_next_order($field, $where);
    }
}