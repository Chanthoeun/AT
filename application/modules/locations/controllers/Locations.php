<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of location
 *
 * @author Chanthoeun
 */
class Locations extends Admin_Controller {
    public  $validation_errors =  array();
    
    public function __construct() {
        parent::__construct();
        $this->load->model('location_model', 'location');
        $this->lang->load('location');
        
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
    
    /**
     * List all locations
     */
    public function index()
    {
        parent::check_login();
        
        $this->data['locations'] = $this->get_all_records(array('location.parent_id' => 0));
        
        // process template
        $title = $this->lang->line('index_location_heading');
        $this->data['title'] = $title;
        
        $layout_property = parent::load_index_script();
        
        $layout_property['breadcrumb'] = array($title);
        
        $layout_property['content']  = 'index';
        
        // menu
        $this->data['setting_menu'] = TRUE; $this->data['location_menu'] = TRUE;
        generate_template($this->data, $layout_property); 
    }
    
    public function get_index($id)
    {
        parent::check_login();
        $parent = $this->get($id);
        $this->data['locations'] = $this->get_all_records(array('location.parent_id' => $parent->id));
        
        // process template
        $title = $parent->caption;
        $this->data['title'] = $title;
        
        $layout_property = parent::load_index_script();
        $layout_property['breadcrumb'] = array_merge(array('locations' => $this->lang->line('index_location_heading')), generate_breadcrumb($id, 'locations', 'locations', 'location'));
        
        $layout_property['content']  = 'index';
        
        // menu
        $this->data['setting_menu'] = TRUE; $this->data['location_menu'] = TRUE;
        generate_template($this->data, $layout_property); 
    }
    
    // create
    public function create($pid = FALSE)
    {
        parent::check_login();
        $this->load->helper('menu');
        
        //get parent
        if($pid != FALSE)
        {
            $parent = $this->get($pid);
        }
        
        
        // display form 
        $this->data['parent'] = form_dropdown('parent', get_dropdown(prepareList($this->get_dropdown()), 'ជ្រើស​​ក្រុម'), empty($this->validation_errors['post_data']['parent']) ? $pid : $this->validation_errors['post_data']['parent'], 'class="form-control" id="parent"');
        
        $this->data['caption'] = array(
            'name'  => 'caption',
            'id'    => 'caption',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['caption']) ? NULL : $this->validation_errors['post_data']['caption']
        );
        
        $this->data['caption_en'] = array(
            'name'  => 'caption_en',
            'id'    => 'caption_en',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['caption_en']) ? NULL : $this->validation_errors['post_data']['caption_en']
        );
        
        $this->data['area_code'] = array(
            'name'  => 'area_code',
            'id'    => 'area_code',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['area_code']) ? NULL : $this->validation_errors['post_data']['area_code']
        );
        
        $this->data['postal'] = array(
            'name'  => 'postal',
            'id'    => 'postal',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['postal']) ? NULL : $this->validation_errors['post_data']['postal']
        );
        
        $this->data['reference'] = array(
            'name'  => 'reference',
            'id'    => 'reference',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['reference']) ? 'ប្រកាសលេខ ៤៩៣ ប្រ.ក តាមប្រកាសក្រសួងមហាផ្ទៃ' : $this->validation_errors['post_data']['reference']
        );
        
        $this->data['issue'] = array(
            'name'  => 'issue',
            'id'    => 'issue',
            'class' => 'form-control',
            'data-date-format' => 'yyyy-mm-dd',
            'data-date' => date('Y-m-d'),
            'value' => empty($this->validation_errors['post_data']['issue']) ? '2001-04-30' : $this->validation_errors['post_data']['issue']
        );
        
        $this->data['note'] = array(
            'name'  => 'note',
            'id'    => 'note',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['note']) ? NULL : $this->validation_errors['post_data']['note']
        );
        
        $this->data['east'] = array(
            'name'  => 'east',
            'id'    => 'east',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['east']) ? NULL : $this->validation_errors['post_data']['east']
        );
        
        $this->data['west'] = array(
            'name'  => 'west',
            'id'    => 'west',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['west']) ? NULL : $this->validation_errors['post_data']['west']
        );
        
        $this->data['south'] = array(
            'name'  => 'south',
            'id'    => 'south',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['south']) ? NULL : $this->validation_errors['post_data']['south']
        );
        
        $this->data['north'] = array(
            'name'  => 'north',
            'id'    => 'north',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['north']) ? NULL : $this->validation_errors['post_data']['north']
        );
        
        $latlng = empty($this->validation_errors['post_data']['latlng']) ? NULL : $this->validation_errors['post_data']['latlng'];
        $this->data['latlng'] = array(
            'name'  => 'latlng',
            'id'    => 'map',
            'class' => 'form-control',
            'placeholder' => $this->lang->line('drop_map_label'),
            'value' => $latlng
        );
        
        // map
        $defaultMap = isset($parent) && $parent->latlng != FALSE ? $parent->latlng : '12.485542832326306, 105.18771788773529';
        $config['minifyJS'] = TRUE;
        $config['center']   = $latlng == NULL ? $defaultMap : $latlng;
        $config['zoom']     = isset($parent) && $parent->latlng != FALSE ? '12' : '7';
        
        $marker[] = array(
            'position'  => $latlng == NULL ? $defaultMap : $latlng,
            'draggable' => TRUE,
            'ondragend' => 'document.getElementById(\'map\').value =  event.latLng.lat() + \', \' + event.latLng.lng();',
            'animation' => 'DROP'            
        );        
        
        $this->data['map'] = get_google_map($config, $marker);
        
        // process template
        $title = $this->lang->line('form_location_create_heading');
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
        $layout_property['script'] = '$(\'#issue\').datepicker()';
        
        if($pid == FALSE)
        {
            $layout_property['breadcrumb'] = array('locations' => $this->lang->line('index_location_heading'), $title);
        }
        else
        {
            $layout_property['breadcrumb'] = array_merge(array('locations' => $this->lang->line('index_location_heading')),
                                                generate_breadcrumb($pid, 'locations', 'locations', 'location'),
                                                array($title)
                                            );
        }
        
        $layout_property['content']  = 'create';
        
        // menu
        $this->data['setting_menu'] = TRUE; $this->data['location_menu'] = TRUE;
        generate_template($this->data, $layout_property); 
    }
    
    // save
    public function store()
    {
        parent::check_login();
        $parentId = trim($this->input->post('parent'));
        $data = array(
            'parent_id' => $parentId,
            'caption'       => trim($this->input->post('caption')),
            'caption_en'    => ucwords(trim($this->input->post('caption_en'))),
            'area_code'    => trim($this->input->post('area_code')),
            'postal_code'    => trim($this->input->post('postal')),
            'reference'    => trim($this->input->post('reference')),
            'issue_date'    => trim($this->input->post('issue')),
            'note'    => trim($this->input->post('note')),
            'east'    => trim($this->input->post('east')),
            'west'    => trim($this->input->post('west')),
            'south'    => trim($this->input->post('south')),
            'north'    => trim($this->input->post('north')),
            'latlng'    => trim($this->input->post('latlng')),
            'order'     => $this->get_next_order('order', array('parent_id' => $parentId))
        );
        
        if(($lid = $this->insert($data)) != FALSE)
        {
            // set log
            array_unshift($data, $lid);
            set_log('Created Location', $data);

            $this->session->set_flashdata('message', $this->lang->line('form_location_report_success'));
            redirect('locations/'.$parentId, 'refresh');
        }
        else
        {
            redirect_form_validation(validation_errors(), $this->input->post(), 'locations/create/'.$parentId);
        }
    }
    
    // edit
    public function edit($id)
    {
        parent::check_login();
        
        $location = $this->get($id);
        $this->data['location'] = $location;
        
        if($location->parent_id != FALSE)
        {
            $parent = $this->get($location->parent_id);
        }
        
        $this->data['location_id'] = array('location_id' => $location->id);
        // set log
        set_log('View for update Location', $location);
        
        $this->load->helper('menu');
        
        // display form 
        $this->data['parent'] = form_dropdown('parent', get_dropdown(prepareList($this->get_dropdown()), 'ជ្រើស​ក្រុម'), empty($this->validation_errors['post_data']['parent']) ? $location->parent_id : $this->validation_errors['post_data']['parent'], 'class="form-control" id="parent"');
        
        $this->data['caption'] = array(
            'name'  => 'caption',
            'id'    => 'caption',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['caption']) ? $location->caption : $this->validation_errors['post_data']['caption']
        );
        
        $this->data['caption_en'] = array(
            'name'  => 'caption_en',
            'id'    => 'caption_en',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['caption_en']) ? $location->caption_en : $this->validation_errors['post_data']['caption_en']
        );
        
        $this->data['area_code'] = array(
            'name'  => 'area_code',
            'id'    => 'area_code',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['area_code']) ? $location->area_code : $this->validation_errors['post_data']['area_code']
        );
        
        $this->data['postal'] = array(
            'name'  => 'postal',
            'id'    => 'postal',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['postal']) ? $location->postal_code : $this->validation_errors['post_data']['postal']
        );
        
        $this->data['reference'] = array(
            'name'  => 'reference',
            'id'    => 'reference',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['reference']) ? $location->reference : $this->validation_errors['post_data']['reference']
        );
        
        $this->data['issue'] = array(
            'name'  => 'issue',
            'id'    => 'issue',
            'class' => 'form-control',
            'data-date-format' => 'yyyy-mm-dd',
            'data-date' => date('Y-m-d'),
            'value' => empty($this->validation_errors['post_data']['issue']) ? $location->issue_date : $this->validation_errors['post_data']['issue']
        );
        
        $this->data['note'] = array(
            'name'  => 'note',
            'id'    => 'note',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['note']) ? $location->note : $this->validation_errors['post_data']['note']
        );
        
        $this->data['east'] = array(
            'name'  => 'east',
            'id'    => 'east',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['east']) ? $location->east : $this->validation_errors['post_data']['east']
        );
        
        $this->data['west'] = array(
            'name'  => 'west',
            'id'    => 'west',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['west']) ? $location->west : $this->validation_errors['post_data']['west']
        );
        
        $this->data['south'] = array(
            'name'  => 'south',
            'id'    => 'south',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['south']) ? $location->south : $this->validation_errors['post_data']['south']
        );
        
        $this->data['north'] = array(
            'name'  => 'north',
            'id'    => 'north',
            'class' => 'form-control',
            'value' => empty($this->validation_errors['post_data']['north']) ? $location->north : $this->validation_errors['post_data']['north']
        );
        
        $latlng = empty($this->validation_errors['post_data']['latlng']) ? $location->latlng : $this->validation_errors['post_data']['latlng'];
        $this->data['latlng'] = array(
            'name'  => 'latlng',
            'id'    => 'map',
            'class' => 'form-control',
            'placeholder' => $this->lang->line('drop_map_label'),
            'value' => $latlng
        );
        
        // map
        $defaultMap = isset($parent) && $parent->latlng != FALSE ? $parent->latlng : '12.485542832326306, 105.18771788773529';
                
        
        $config['minifyJS'] = TRUE;
        $config['center']   = $latlng == NULL ? $defaultMap : $latlng;
        $config['zoom']     = $latlng == FALSE ? '7' : '13';
        
        $marker[] = array(
            'position'  => $latlng == NULL ? $defaultMap : $latlng,
            'draggable' => TRUE,
            'ondragend' => 'document.getElementById(\'map\').value =  event.latLng.lat() + \', \' + event.latLng.lng();',
            'animation' => 'DROP'            
        );        
        
        $this->data['map'] = get_google_map($config, $marker);
        
        // process template
        $title = $this->lang->line('form_location_edit_heading');
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
        $layout_property['breadcrumb'] = array_merge(array('locations' => $this->lang->line('index_location_heading')), generate_breadcrumb($location->parent_id, 'locations', 'locations', 'location'), array($title));
        
        $layout_property['content']  = 'edit';
        
        // menu
        $this->data['setting_menu'] = TRUE; $this->data['location_menu'] = TRUE;
        generate_template($this->data, $layout_property); 
    }
    
    // update
    public function modify()
    {
        parent::check_login();
        $id = $this->input->post('location_id');
        $parentId = trim($this->input->post('parent'));
        $data = array(
            'parent_id' => $parentId,
            'caption'   => trim($this->input->post('caption')),
            'caption_en'    => ucwords(trim($this->input->post('caption_en'))),
            'area_code'    => trim($this->input->post('area_code')),
            'postal_code'    => trim($this->input->post('postal')),
            'reference'    => trim($this->input->post('reference')),
            'issue_date'    => trim($this->input->post('issue')),
            'note'    => trim($this->input->post('note')),
            'east'    => trim($this->input->post('east')),
            'west'    => trim($this->input->post('west')),
            'south'    => trim($this->input->post('south')),
            'north'    => trim($this->input->post('north')),
            'latlng'    => trim($this->input->post('latlng'))
        );
        
        if($this->update($id, $data))
        {
            // set log
            array_unshift($data, $id);
            set_log('Updated Location', $data);

            $this->session->set_flashdata('message', $this->lang->line('form_location_report_success'));
            redirect('locations/'.$parentId, 'refresh');
        }
        else
        {
            redirect_form_validation(validation_errors(), $this->input->post(), 'locations/edit/'.$id);
        }
    }
    
    // delete
    public function destroy($id, $del_child = FALSE)
    {
        parent::check_login();
        $location = $this->get($id);
        
        // do they have childs
        $get_childs = $this->get_many_by(array('parent_id' => $location->id));
        
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
                $this->delete_by(array('parent_id' => $location->id));
            }
            
            // set log
            set_log('Deleted Location', $location);
            $this->session->set_flashdata('message', $this->lang->line('del_location_report_success'));
        }
        else
        {
            $this->session->set_flashdata('message', $this->lang->line('del_location_report_success'));
        }
        redirect('locations/'.$location->parent_id, 'refresh');
    }
    
    // get khan
    public function get_ajax()
    {
        $pid = $this->input->post('pid');
        $label = $this->input->post('label');
        $khan = form_dropdown('khan', Modules::run('locations/dropdown', 'id', 'caption', 'ជ្រើស'.$this->lang->line($label.'_label'), array('parent_id' => $pid)), empty($this->validation_errors['post_data'][$label]) ? FALSE : $this->validation_errors['post_data'][$label], array('class' => 'form-control', 'id' => $label));
        echo $khan;
        $this->output->enable_profiler(FALSE);
    }
    
    public function get($id, $array = FALSE)
    {
        if($array == TRUE){
            return $this->location->as_array()->get($id);
        }
        return $this->location->as_object()->get($id);
    }
    
    public function get_detail($where)
    {
        return $this->location->get_detail($where);
    }
    
    public function get_by($where, $array = FALSE)
    {
        if($array == TRUE){
            return $this->location->as_array()->get_by($where);
        }
        return $this->location->as_object()->get_by($where);
    }
    
    public function get_list($where = FALSE)
    {
        return $this->location->get_list($where);
    }
    
    public function get_all()
    {
        return $this->location->get_all();
    }
    
    public function get_all_records($where = FALSE)
    {
        return $this->location->get_all_records($where);
    }
    
    public function get_many_by($where, $order_by = FALSE, $limit = FALSE, $offset = 0)
    {
        if($order_by != FALSE)
        {
            $this->location->order_by($order_by);
        }
        
        if($limit != FALSE)
        {
            $this->location->limit($limit, $offset);
        }
        return $this->location->get_many_by($where);
    }
    
    public function get_field($field, $where = FALSE, $array = FALSE)
    {
        return $this->location->get_field($field, $where, $array);
    }
    
    public function insert($data, $skip_validation = FALSE)
    {
        return $this->location->insert($data, $skip_validation);
    }
    
    public function update($id, $data, $skip_validation = FALSE)
    {
        return $this->location->update($id, $data, $skip_validation);
    }
    
    public function delete($id)
    {
        return $this->location->delete($id);
    }
    
    public function get_dropdown($where = FALSE)
    {
        return $this->location->get_dropdown($where);
    }
    
    public function dropdown($key, $value, $option_label = NULL, $where = NULL)
    {
        if($where != NULL){
            $this->db->where($where);
        }
        
        return $this->location->dropdown($key, $value,$option_label);
    }
    
    public function order_by($criteria, $order = NULL)
    {
        $this->location->order_by($criteria,$order);
    }
    
    public function get_next_order($field, $where = FALSE)
    {
        return $this->location->get_next_order($field, $where);
    }
}