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
class Agribook_member_type_model extends MY_Model {
    public $_table = 'agribook_member_type';
    public $protected_attributes = array( 'id');
    
    public $before_create = array( 'created_at', 'updated_at' );
    public $before_update = array( 'updated_at' );
    
    public $validate = array(
        array(
            'field' => 'caption',
            'label' => 'lang:form_agribook_member_type_validation_caption_label',
            'rules' => 'trim|required|is_unique[agribook_member_type.caption]|xss_clean',
            'errors'=> array(
                'required'  => '%s តម្រូវឲ្យ​មាន',
                'is_unique' => '%s មាន​រូចហើយ'
                )
        ),
        array(
            'field' => 'price',
            'label' => 'lang:form_agribook_member_type_validation_price_label',
            'rules' => 'trim|required|xss_clean',
            'errors'=> array(
                'required'  => '%s តម្រូវឲ្យ​មាន'
                )
        )
    );
}
