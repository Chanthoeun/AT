<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Admin_Controller
 *
 * @author chanthoeun
 */
class Admin_Controller extends MY_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->library('template', array('layout' => 'backend', 'asset_location' => 'assets', 'site_name' => 'AgriToday', 'no_footer' =>TRUE));
        $this->load->library('form_validation');
        $this->load->helper('upload');
    }
    
    public function check_login($admin = TRUE, $rs = FALSE){
        if (!$this->ion_auth->logged_in())
        {
            $this->session->set_flashdata('message', lang('not_login_label'));
            redirect(site_url('auth/login'), 'refresh');
        }
        else
        {
            if($this->ion_auth->is_admin())
            {
                // set home breadcrumb
                $this->template->set_home_breadcrumb('control');
                if($rs == TRUE)
                {
                    $identity = $this->session->userdata('identity');
                    if(check_admin($identity) == FALSE)
                    {
                        $this->session->set_flashdata('message', lang('account_not_correct_label'));
                        redirect(site_url('control'), 'refresh');
                    }
                }
                return 'admin';
            }
            else
            {
                if($admin == FALSE && $this->ion_auth->in_group(2))
                {
                    $this->template->set_home_breadcrumb('members');
                    return $this->session->userdata('user_id');
                }
                else
                {
                    if($this->ion_auth->in_group(2))
                    {
                        $this->template->set_home_breadcrumb('members');
                        $this->session->set_flashdata('message', lang('account_not_correct_label'));
                        redirect(site_url('members'), 'refresh');
                    }
                    
                    //log the user out
                    $this->ion_auth->logout();     
                    redirect(site_url('auth/login'), 'refresh');
                }
            }
        }
    }
    
    public function load_index_script($css = FALSE, $script = FALSE, $js = FALSE)
    {
        if($this->agent->is_mobile())
        {
            $layout_property['css'] = $css == FALSE ?
                    array('https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css' => FALSE,
                                            'css/plugins/metisMenu/metisMenu.min.css',
                                            'css/sb-admin-2.css',
                                            'font-awesome-4.1.0/css/font-awesome.min.css'
                                            )
                    :
                    array('https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css' => FALSE,
                                            'css/plugins/metisMenu/metisMenu.min.css',
                                            'css/sb-admin-2.css',
                                            'font-awesome-4.1.0/css/font-awesome.min.css',
                                            $css
                                            );
            $layout_property['js']  = $script == FALSE ? 
                    array('https://code.jquery.com/jquery-1.11.1.min.js' => FALSE,
                                            'https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js' => FALSE,
                                            'js/plugins/metisMenu/metisMenu.min.js',
                                            'js/sb-admin-2.js'
                                            )
                    :
                    array('https://code.jquery.com/jquery-1.11.1.min.js' => FALSE,
                                            'https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js' => FALSE,
                                            'js/plugins/metisMenu/metisMenu.min.js',
                                            'js/sb-admin-2.js',
                                            $script
                                            );
            $layout_property['script']  = $js == FALSE ? FALSE : $js;
        }
        else
        {
            $layout_property['css'] = $css == FALSE ?
                    array('https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css' => FALSE,
                                            'css/plugins/metisMenu/metisMenu.min.css',
                                            'css/plugins/dataTables.bootstrap.css',
                                            'css/sb-admin-2.css',
                                            'font-awesome-4.1.0/css/font-awesome.min.css'
                                            )
                    :
                    array('https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css' => FALSE,
                                            'css/plugins/metisMenu/metisMenu.min.css',
                                            'css/plugins/dataTables.bootstrap.css',
                                            'css/sb-admin-2.css',
                                            'font-awesome-4.1.0/css/font-awesome.min.css',
                                            $css
                                            );
            $layout_property['js']  = $script == FALSE ?
                    array('https://code.jquery.com/jquery-1.11.1.min.js' => FALSE,
                                            'https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js' => FALSE,
                                            'js/plugins/metisMenu/metisMenu.min.js',
                                            'js/plugins/dataTables/jquery.dataTables.js', 
                                            'js/plugins/dataTables/dataTables.bootstrap.js',
                                            'js/sb-admin-2.js'
                                            )
                    :
                    array('https://code.jquery.com/jquery-1.11.1.min.js' => FALSE,
                                            'https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js' => FALSE,
                                            'js/plugins/metisMenu/metisMenu.min.js',
                                            'js/plugins/dataTables/jquery.dataTables.js', 
                                            'js/plugins/dataTables/dataTables.bootstrap.js',
                                            'js/sb-admin-2.js',
                                            $script
                                            );
            $layout_property['script']  = $js == FALSE ? '$(document).ready(function() {$(\'#dataTables-example\').dataTable();});' : '$(document).ready(function() {$(\'#dataTables-example\').dataTable();});'. $js;
        }
        return $layout_property;
    }
}