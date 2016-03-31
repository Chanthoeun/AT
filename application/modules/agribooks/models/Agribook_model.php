<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of agribook_model
 *
 * @author Chanthoeun
 */
class Agribook_model extends MY_Model {
    public $_table = 'agribook';
    public $protected_attributes = array( 'id');
    
    public $before_create = array( 'created_at', 'updated_at' );
    public $before_update = array( 'updated_at' );
    
    public $validate = array(
        array(
            'field' => 'group',
            'label' => 'lang:form_agribook_validation_group_label',
            'rules' => 'trim|required|xss_clean',
            'errors'=> array(
                'required'  => '%s តម្រូវឲ្យ​មាន'
                )
        ),
        array(
            'field' => 'name',
            'label' => 'lang:form_agribook_validation_name_label',
            'rules' => 'trim|required|is_unique[agribook.name]|xss_clean',
            'errors'=> array(
                'required'  => '%s តម្រូវឲ្យ​មាន',
                'is_unique' => '%s មាន​រូចហើយ'
                )
        ),
        array(
            'field' => 'name_en',
            'label' => 'lang:form_agribook_validation_name_en_label',
            'rules' => 'trim|is_unique[agribook.name_en]|xss_clean',
            'errors'=> array(
                'is_unique' => '%s មាន​រូចហើយ'
                )
        ),
        array(
            'field' => 'profile',
            'label' => 'lang:form_agribook_validation_profile_label',
            'rules' => 'trim|xss_clean'
        ),
        array(
            'field' => 'contact_person',
            'label' => 'lang:form_agribook_validation_contact_person_label',
            'rules' => 'trim|xss_clean'
        ),
        array(
            'field' => 'address',
            'label' => 'lang:form_agribook_validation_address_label',
            'rules' => 'trim|required|xss_clean',
            'errors'=> array(
                'required'  => '%s តម្រូវឲ្យ​មាន'
                )
        ),
        array(
            'field' => 'telephone',
            'label' => 'lang:form_agribook_validation_telephone_label',
            'rules' => 'trim|required|xss_clean',
            'errors'=> array(
                'required'  => '%s តម្រូវឲ្យ​មាន'
                )
        ),
        array(
            'field' => 'fax',
            'label' => 'lang:form_agribook_validation_fax_label',
            'rules' => 'trim|xss_clean'
        ),
        array(
            'field' => 'email',
            'label' => 'lang:form_agribook_validation_email_label',
            'rules' => 'trim|valid_emails|xss_clean'
        ),
        array(
            'field' => 'website',
            'label' => 'lang:form_agribook_validation_website_label',
            'rules' => 'trim|xss_clean'
        ),
        array(
            'field' => 'social',
            'label' => 'lang:form_agribook_validation_social_label',
            'rules' => 'trim|xss_clean'
        ),
        array(
            'field' => 'pobox',
            'label' => 'lang:form_agribook_validation_pobox_label',
            'rules' => 'trim|xss_clean'
        ),
        array(
            'field' => 'map',
            'label' => 'lang:form_agribook_validation_map_label',
            'rules' => 'trim|xss_clean'
        ),
        array(
            'field' => 'province',
            'label' => 'lang:form_agribook_validation_province_label',
            'rules' => 'trim|xss_clean'
        ),
        array(
            'field' => 'khan',
            'label' => 'lang:form_agribook_validation_khan_label',
            'rules' => 'trim|xss_clean'
        ),
        array(
            'field' => 'sangkat',
            'label' => 'lang:form_agribook_validation_sangkat_label',
            'rules' => 'trim|xss_clean'
        ),
        array(
            'field' => 'phum',
            'label' => 'lang:form_agribook_validation_phum_label',
            'rules' => 'trim|xss_clean'
        ),
        array(
            'field' => 'set_parent',
            'label' => 'lang:form_agribook_validation_make_as_parent_label',
            'rules' => 'trim|xss_clean'
        ),
        array(
            'field' => 'parent',
            'label' => 'lang:form_agribook_validation_parent_label',
            'rules' => 'trim|xss_clean'
        ),
        array(
            'field' => 'member_type',
            'label' => 'lang:form_agribook_validation_member_type_label',
            'rules' => 'trim|xss_clean'
        )
    );
    
    public function get_detail($where, $or = FALSE)
    {
        $this->db->select($this->_table.'.*, g.caption as group, mt.caption as member_type, mt.price as price');
        $this->db->join('agribook_group as g', $this->_table.'.agribook_group_id = g.id', 'left');
        $this->db->join('agribook_member_type as mt', $this->_table.'.member_type_id = mt.id', 'left');
        if(is_numeric($where))
        {
            $where = array($this->_table.'.id' => $where);
        }
        return parent::get_by($where);
    }
    
    public function get_all_records($where = FALSE)
    {
        $this->db->select($this->_table.'.*, g.caption as group');
        $this->db->join('agribook_group as g', $this->_table.'.agribook_group_id = g.id', 'left');
        if($where != FALSE)
        {
            return parent::get_many_by($where);
        }
        return parent::get_all();
    }
    
    public function get_like($like, $where = FALSE, $condition = 'both')
    {
        $this->db->like($like, $condition);
        return $this->get_all_records($where);
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
