<?php defined('BASEPATH') OR exit('No direct script access allowed');


/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of groups_model
 *
 * @author chanthoeun
 */
class Member_type_model extends MY_Model {
    //put your code here
    public $_table = 'member_type';
    public $protected_attributes = array( 'id');
    //protected $return_type = 'array';
    
    public $before_create = array( 'created_at', 'updated_at' );
    public $before_update = array( 'updated_at' );
    
    public $validate = array(
        array( 'field' => 'caption', 
               'label' => 'lang:form_member_type_validation_caption_label',
               'rules' => 'trim|required|alpha_dash|is_unique[member_type.caption]|xss_clean' )
    );
}
