<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User Membership
 *
 * @author Chanthoeun
 */
class User_membership_model extends MY_Model {
    public $_table = 'user_membership';
    public $protected_attributes = array( 'id');
    
    public $before_create = array( 'created_at', 'updated_at' );
    public $before_update = array( 'updated_at' );
    
    public $validate = array(
        array(
            'field' => 'username',
            'label' => 'lang:form_user_membership_validation_username_label',
            'rules' => 'trim|required|is_unique[users.username]|xss_clean'
        ),
        array(
            'field' => 'email',
            'label' => 'lang:form_user_membership_validation_email_label',
            'rules' => 'trim|required|is_unique[users.email]|xss_clean'
        ),
        array(
            'field' => 'password',
            'label' => 'lang:form_user_membership_validation_password_label',
            'rules' => 'trim|required|min_length[8]|max_length[20]|matches[cpassword]'
        ),
        array(
            'field' => 'cpassword',
            'label' => 'lang:form_user_membership_validation_cpassword_label',
            'rules' => 'trim|required'
        ),
    );
    
    public function get_with_user($where)
    {
        $this->db->select($this->_table.'.*, users.username, users.email, users.active, users.last_login');
        $this->db->join('users', $this->_table.'.user_id = users.id', 'left');
        return parent::get_by($where);
    }
    
    public function get_with_users($where = FALSE)
    {
        $this->db->select($this->_table.'.*, users.username, users.email, users.active, users.last_login');
        $this->db->join('users', $this->_table.'.user_id = users.id', 'left');
        if($where != FALSE)
        {
            return parent::get_many_by($where);
        }
        return parent::get_all();
    }
    
   
}
