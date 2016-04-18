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
class Advertiser_model extends MY_Model {
    public $_table = 'advertiser';
    public $protected_attributes = array( 'id');
    
    public $before_create = array( 'created_at', 'updated_at' );
    public $before_update = array( 'updated_at' );
    
    public $validate = array(
        array(
            'field' => 'name',
            'label' => 'lang:form_advertiser_validation_name_label',
            'rules' => 'trim|required|is_unique[advertiser.name]|xss_clean',
            'errors' => array(
                'required' => '%s តម្រូវ​ឲ្យមាន',
                'is_unique'=> '%s មាន​រួច​ហើយ'
            )
        ),
        array(
            'field' => 'address',
            'label' => 'lang:form_advertiser_validation_address_label',
            'rules' => 'trim|xss_clean'
        ),
        array(
            'field' => 'telephone',
            'label' => 'lang:form_advertiser_validation_telephone_label',
            'rules' => 'trim|required|xss_clean',
            'errors' => array(
                'required' => '%s តម្រូវ​ឲ្យមាន'
            )
        ),
        array(
            'field' => 'email',
            'label' => 'lang:form_advertiser_validation_email_label',
            'rules' => 'trim|valid_email|xss_clean',
            'errors' => array(
                'valid_email' => '%s មិនត្រឹម​ត្រូវ​ទេ'
            )
        ),
    );
    
    public function get_like($like, $condition = 'both') {
        $this->db->like($like, $condition);
        return parent::get_all();
    }
    
    public function get_field($field, $where = FALSE, $array = FALSE)
    {
        if(is_array($field))
        {
            $selectField = $this->_table.'.'.array_shift($field);
            foreach ($field as $f)
            {
                $selectField .= ', '.$this->_table.'.'.$f;
            }
        }
        else
        {
            $selectField = $this->_table.'.'.$field;
        }
        $this->db->select($selectField);
        
        if($where != FALSE)
        {
            return $array == TRUE ? parent::as_array()->get_many_by($where)  : parent::as_object()->get_many_by($where);
        }
        return $array == TRUE ? parent::as_array()->get_all() : parent::as_object()->get_all();
    }
}
