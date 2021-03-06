<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of people_group_model
 *
 * @author Chanthoeun
 */
class People_group_model extends MY_Model {
    public $_table = 'people_group';
    public $protected_attributes = array( 'id');
    
    public $before_create = array( 'created_at', 'updated_at' );
    public $before_update = array( 'updated_at' );
    
    public $validate = array(
        array(
            'field' => 'caption',
            'label' => 'lang:form_cagetory_validation_caption_label',
            'rules' => 'trim|required|is_unique[people_group.caption]|xss_clean',
            'errors'=> array(
                'required'  => '%s តម្រូវឲ្យ​មាន',
                'is_unique' => '%s មាន​រូចហើយ'
                )
        ),
        array(
            'field' => 'display',
            'label' => 'lang:form_people_group_validation_display_label',
            'rules' => 'trim|xss_clean'
        )
    );
}
