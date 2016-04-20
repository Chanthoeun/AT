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
        
        $this->data['locations'] = $this->get_all_records(array('location.parent_id' => 0), array('area_code'));
        
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
        $this->data['locations'] = $this->get_all_records(array('location.parent_id' => $parent->id), array('area_code'));
        
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
        
        $this->data['parent'] = array('parent' => $pid);
        
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
        
        $latlng = empty($this->validation_errors['post_data']['latlng']) ? FALSE : $this->validation_errors['post_data']['latlng'];
        $this->data['latlng'] = array(
            'name'  => 'latlng',
            'id'    => 'map',
            'class' => 'form-control',
            'placeholder' => $this->lang->line('drop_map_label'),
            'value' => $latlng
        );
        
        // map
        $config['minifyJS'] = TRUE;
        if($latlng == FALSE)
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

            $marker[] = array(
                'draggable' => TRUE,
                'ondragend' => 'document.getElementById(\'map\').value =  event.latLng.lat() + \', \' + event.latLng.lng();',
                'animation' => 'DROP'            
            );
        }
        else
        {
            $config['center']   = $latlng;
            $config['zoom']   = '13';

            $marker[] = array(
                'position' => $latlng,
                'draggable' => TRUE,
                'ondragend' => 'document.getElementById(\'map\').value =  event.latLng.lat() + \', \' + event.latLng.lng();',
                'animation' => 'DROP'            
            );
        }
                
        
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
        
        $layout_property['breadcrumb'] = array_merge(array('locations' => $this->lang->line('index_location_heading')),
                                                generate_breadcrumb($pid, 'locations', 'locations', 'location'),
                                                array($title)
                                            );
        
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
            redirect($parentId == FALSE ? 'locations' : 'locations/'.$parentId, 'refresh');
        }
        else
        {
            redirect_form_validation(validation_errors(), $this->input->post(), $parentId == FALSE ? 'locations/create' : 'locations/create/'.$parentId);
        }
    }
    
    // edit
    public function edit($id)
    {
        parent::check_login();
        
        $location = $this->get($id);
        $this->data['location'] = $location;
        $this->data['location_id'] = array('location_id' => $location->id);
        // set log
        set_log('View for update Location', $location);
        
        // display form         
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
        if($latlng == FALSE)
        {
            $config['minifyJS'] = TRUE;
            $config['center']   = 'auto';
            $config['onboundschanged'] = 'if (!centreGot) {
                                    var mapCentre = map.getCenter();
                                    marker_0.setOptions({
                                            position: new google.maps.LatLng(mapCentre.lat(), mapCentre.lng()) 
                                    });
                                    document.getElementById(\'map\').value = mapCentre.lat() + \', \' + mapCentre.lng();
                            }
                            centreGot = true;';

            $marker[] = array(
                'draggable' => TRUE,
                'ondragend' => 'document.getElementById(\'map\').value =  event.latLng.lat() + \', \' + event.latLng.lng();',
                'animation' => 'DROP'            
            );
        }
        else
        {
            $config['minifyJS'] = TRUE;
            $config['center']   = $latlng;
            $config['zoom']     = '13';

            $marker[] = array(
                'position'  => $latlng,
                'draggable' => TRUE,
                'ondragend' => 'document.getElementById(\'map\').value =  event.latLng.lat() + \', \' + event.latLng.lng();',
                'animation' => 'DROP'            
            );       
        }

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
        $location = $this->get($this->input->post('location_id'));
        $data = array(
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
        
        if($this->update($location->id, $data))
        {
            // set log
            array_unshift($data, $location->id);
            set_log('Updated Location', $data);

            $this->session->set_flashdata('message', $this->lang->line('form_location_report_success'));
            redirect($location->parent_id == FALSE ? 'locations' : 'locations/'.$location->parent_id, 'refresh');
        }
        else
        {
            redirect_form_validation(validation_errors(), $this->input->post(), 'locations/edit/'.$location->id);
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
        redirect($location->parent_id == FALSE ? 'locations' : 'locations/'.$location->parent_id, 'refresh');
    }
    
    public function import($id = FALSE) 
    {
        parent::check_login();
        $this->load->library(array('excel', 'table'));
        $this->form_validation->set_rules('province', $this->lang->line('import_location_validation_province_label'), 'trim|required|xss_clean', array('required' => 'សូម​ជ្រើស​រើស​%s'));
        if($this->form_validation->run() == TRUE)
        {
            $province = $this->input->post('province');
            
            $uploaded = upload_file('excel', 'document', 'import');
            if($uploaded == FALSE)
            {
                $this->session->set_flashdata('message', print_upload_error());
                redirect(current_url(), 'refresh');
            }
            else
            {
                $file = get_uploaded_file($uploaded);

                //read file from path
                $objPHPExcel = PHPExcel_IOFactory::load($file);

                //get only the Cell Collection
                $cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();

                //extract to a PHP readable array format
                foreach ($cell_collection as $cell) {
                    $columns = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
                    $row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
                    $data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();

                    //header will/should be in row 1 only. of course this can be modified to suit your need.
//                    if ($row == 1) {
//                        $header[$row][$columns] = $data_value;
//                    } else {
//                        $arr_data[$row][$columns] = $data_value;
//                    }
                    if($row != 1)
                    {
                       $arr_data[$row][$columns] = $data_value; 
                    }
                }

                //send the data in an array format
                //echo $this->table->generate($arr_data);
                
            }
            foreach ($arr_data as $excelrow)
            {
                switch ($excelrow['A']) {
                    case 'ក្រុង':
                        $parentId = $this->_parent_id($excelrow['B']);
                        if($province != $parentId)
                        {
                            $this->session->set_flashdata('message', 'សុំទោស​ File ដែល​បាន​ upload មិនត្រូវនិង​ទីតាំង​ដែល​អ្នក​បាន​ជ្រើស​រើសទេ។');
                            redirect(current_url(), 'refresh');
                        }
                        
                        $caption = 'ក្រុង'.$excelrow['C'];
                        $caption_en = ucwords($excelrow['D'].' Municipality');
                        break;
                    case 'ស្រុក':
                        $parentId = $this->_parent_id($excelrow['B']);
                        if($province != $parentId)
                        {
                            $this->session->set_flashdata('message', 'សុំទោស​ File ដែល​បាន​ upload មិនត្រូវនិង​ទីតាំង​ដែល​អ្នក​បាន​ជ្រើស​រើសទេ។');
                            redirect(current_url(), 'refresh');
                        }
                        
                        $caption = 'ស្រុក'.$excelrow['C'];
                        $caption_en = ucwords($excelrow['D'].' District');
                        break;
                    case 'ខណ្ឌ':
                        $parentId = $this->_parent_id($excelrow['B']);
                        if($province != $parentId)
                        {
                            $this->session->set_flashdata('message', 'សុំទោស​ File ដែល​បាន​ upload មិនត្រូវនិង​ទីតាំង​ដែល​អ្នក​បាន​ជ្រើស​រើសទេ។');
                            redirect(current_url(), 'refresh');
                        }
                        $caption = 'ខណ្ឌ'.$excelrow['C'];
                        $caption_en = ucwords($excelrow['D'].' Khan');
                        break;
                    case 'សង្កាត់':
                        $parentId = $this->_parent_id($excelrow['B']);
                        $caption = 'សង្កាត់'.$excelrow['C'];
                        $caption_en = ucwords($excelrow['D'].' Sangkat');
                        break;
                    case 'ឃុំ':
                        $parentId = $this->_parent_id($excelrow['B']);
                        $caption = 'ឃុំ'.$excelrow['C'];
                        $caption_en = ucwords($excelrow['D'].' Commune');
                        break;
                    default:
                        $parentId = $this->_parent_id($excelrow['B']);
                        $caption = 'ភូមិ'.$excelrow['C'];
                        $caption_en = ucwords($excelrow['D'].' Village');
                        break;
                }
                $data = array(
                    'parent_id' => $parentId,
                    'caption'       => $caption,
                    'caption_en'    => $caption_en,
                    'area_code'    => $this->_add_zero($excelrow['B']),
                    'reference'    => $excelrow['E'] == 'ប្រកាសលេខ ៤៩៣ ប្រ.ក របស់ក្រសួងមហាផ្ទៃ' ? 'ប្រកាសលេខ ៤៩៣ ប្រ.ក តាមប្រកាសក្រសួងមហាផ្ទៃ' : $excelrow['E'],
                    'issue_date'    => $excelrow['E'] == 'ប្រកាសលេខ ៤៩៣ ប្រ.ក របស់ក្រសួងមហាផ្ទៃ' ? '2001-04-30' : '',
                    'note'    => $excelrow['F'],
                    'order'     => $this->get_next_order('order', array('parent_id' => $parentId))
                );
                
                $get_location = $this->get_by(array('caption' => $data['caption'], 'area_code' => $data['area_code']));
                if($get_location == FALSE)
                {
                    $this->insert($data, TRUE);
                }
                else
                {
                    $update_data = array(
                        'parent_id' => $parentId,
                        'caption'       => $caption,
                        'caption_en'    => $caption_en,
                        'area_code'    => $this->_add_zero($excelrow['B'])
                    );
                    $this->update($get_location->id, $update_data, TRUE);
                }
            }            
            delete_uploaded_file($file);
            
            $this->session->set_flashdata('message', 'Import ទីតាំង​ជោគជ័យ');
           redirect('locations/'.$province, 'refresh');
        }
        //message
        $this->data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
        
        //display form
        $this->data['province'] = form_dropdown('province', $this->dropdown('id', 'caption', 'ជ្រើស​រើស​ខេត្ត/ក្រុង', array('parent_id' => FALSE)), set_value('province', $id), array('id' => 'province', 'class' => 'form-control'));
        $this->data['excel'] = array(
            'name' => 'excel',
            'id' => 'excel',
            'accept' => '.csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel'
        );
        
        // process template
        $title = $this->lang->line('index_location_import_link');
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
        
        $layout_property['breadcrumb'] = array('locations' => $this->lang->line('index_location_heading'), $title);
        
        $layout_property['content']  = 'import';
        
        // menu
        $this->data['setting_menu'] = TRUE; $this->data['location_menu'] = TRUE;
        generate_template($this->data, $layout_property); 
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
    
    public function get_all_records($where = FALSE, $order_by = FALSE, $limit = FALSE, $offset = 0)
    {
        if($order_by != FALSE)
        {
            $this->location->order_by($order_by);
        }
        
        if($limit != FALSE)
        {
            $this->location->limit($limit, $offset);
        }
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
    
    public function get_job_locations($where = FALSE)
    {
        return $this->location->get_job_locations($where);
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
    
    public function _parent_id($code) {
        parent::check_login();
        if(strlen($code) == 3 || strlen($code) == 5 || strlen($code) == 7 )
        {
            $num_padded = '0'.$code;
        }
        else
        {
            $num_padded = $code;
        }
        
        switch (strlen($num_padded)) {
            case 4:
                $parent_code = substr($num_padded, 0, 2);
                break;
            case 6:
                $parent_code = substr($num_padded, 0, 4);
                break;
            case 8:
                $parent_code = substr($num_padded, 0, 6);
                break;
        }
        
        $location = $this->get_by(array('area_code' => $parent_code));
        if($location != FALSE)
        {
            return $location->id;
        }
        return FALSE;
    }
    
    public function _add_zero($number) {
        parent::check_login();
        if(strlen($number) == 3 || strlen($number) == 5 || strlen($number) == 7 )
        {
            return '0'.$number;
        }
        return $number;
    }
}