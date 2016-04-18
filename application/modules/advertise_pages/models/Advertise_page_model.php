<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of copy_model
 *
 * @author Chanthoeun
 */
class Advertise_page_model extends MY_Model {
    public $_table = 'advertise_page';
    public $protected_attributes = array( 'id');
    
    public $before_create = array( 'created_at', 'updated_at' );
    public $before_update = array( 'updated_at' );
    
    public $validate = array(
        array(
            'field' => 'caption',
            'label' => 'lang:form_advertise_page_validation_caption_label',
            'rules' => 'trim|required|is_unique[advertise_page.caption]|xss_clean',
            'errors'=> array(
                'required' => '%s តម្រូវ​ឲ្យ​មាន',
                'is_unique'=> '%s មាន​រួច​ហើយ'
            )
        ),
        array(
            'field' => 'layout[]',
            'label' => 'lang:form_advertise_layout_label',
            'rules' => 'trim|required|xss_clean',
            'errors'=> array(
                'required' => '%s តម្រូវ​ឲ្យ​មាន'
            )
        )
    );
}
