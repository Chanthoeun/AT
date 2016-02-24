<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of category_model
 *
 * @author Chanthoeun
 */
class People_model extends MY_Model {
    public $_table = 'people';
    public $protected_attributes = array( 'id');
    
    public $before_create = array( 'created_at', 'updated_at' );
    public $before_update = array( 'updated_at' );
    
    public $validate = array(
        array(
            'field' => 'name',
            'label' => 'lang:form_people_validation_name_label',
            'rules' => 'trim|required|xss_clean',
            'errors'=> array(
                'required'  => '%s តម្រូវឲ្យ​មាន'
                )
        ),
        array(
            'field' => 'organization',
            'label' => 'lang:form_people_validation_organization_label',
            'rules' => 'trim|xss_clean'
        ),
        array(
            'field' => 'position',
            'label' => 'lang:form_people_validation_position_label',
            'rules' => 'trim|xss_clean'
        ),
        array(
            'field' => 'telephone',
            'label' => 'lang:form_people_validation_telephone_label',
            'rules' => 'trim|xss_clean'
        ),
        array(
            'field' => 'email',
            'label' => 'lang:form_people_validation_email_label',
            'rules' => 'trim|valid_emails|xss_clean'
        ),
        array(
            'field' => 'social',
            'label' => 'lang:form_people_validation_social_label',
            'rules' => 'trim|xss_clean'
        ),
        array(
            'field' => 'group',
            'label' => 'lang:form_people_validation_group_label',
            'rules' => 'trim|required|xss_clean',
            'errors'=> array(
                'required'  => '%s តម្រូវឲ្យ​មាន'
                )
        ),
        array(
            'field' => 'go',
            'label' => 'lang:form_people_validation_go_label',
            'rules' => 'trim|xss_clean'
        ),
        array(
            'field' => 'province',
            'label' => 'lang:form_people_validation_province_label',
            'rules' => 'trim|xss_clean'
        ),
        array(
            'field' => 'khan',
            'label' => 'lang:form_people_validation_khan_label',
            'rules' => 'trim|xss_clean'
        ),
        array(
            'field' => 'sangkat',
            'label' => 'lang:form_people_validation_sangkat_label',
            'rules' => 'trim|xss_clean'
        ),
        array(
            'field' => 'phum',
            'label' => 'lang:form_people_validation_phum_label',
            'rules' => 'trim|xss_clean'
        )
    );
    
    public function get_detail($where)
    {
        $this->db->select($this->_table.'.*, g.caption as group, go.caption as gocaption');
        $this->db->join('people_group as g', $this->_table.'.people_group_id = g.id', 'left');
        $this->db->join('government_organization as go', $this->_table.'.go_id = go.id', 'left');
        if(is_numeric($where))
        {
            $where = array($this->_table.'.id' => $where);
        }
        return parent::get_by($where);
    }
    
    public function get_all_records($where = FALSE)
    {
        $this->db->select($this->_table.'.*, g.caption as group, go.caption as gocaption');
        $this->db->join('people_group as g', $this->_table.'.people_group_id = g.id', 'left');
        $this->db->join('government_organization as go', $this->_table.'.go_id = go.id', 'left');
        if($where != FALSE)
        {
            return parent::get_many_by($where);
        }
        return parent::get_all();
    }
    
    public function get_like($like)
    {
        $this->db->like($like);
        return $this->get_all_records();
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
