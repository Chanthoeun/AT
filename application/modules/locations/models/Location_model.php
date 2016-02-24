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
class Location_model extends MY_Model {
    public $_table = 'location';
    public $protected_attributes = array( 'id');
    
    public $before_create = array( 'created_at', 'updated_at' );
    public $before_update = array( 'updated_at' );
    
    public $validate = array(
        array(
            'field' => 'parent',
            'label' => 'lang:form_location_validation_parent_label',
            'rules' => 'trim|xss_clean'
        ),
        array(
            'field' => 'caption',
            'label' => 'lang:form_location_validation_caption_label',
            'rules' => 'trim|required|xss_clean',
            'errors'=> array(
                'required' => '%s តម្រូវ​ឲ្យ​មាន'
            )
        ),
        array(
            'field' => 'caption_en',
            'label' => 'lang:form_location_validation_caption_en_label',
            'rules' => 'trim|xss_clean'
        ),
        array(
            'field' => 'area_code',
            'label' => 'lang:form_location_validation_area_code_label',
            'rules' => 'trim|xss_clean'
        ),
        array(
            'field' => 'postal',
            'label' => 'lang:form_location_validation_postal_label',
            'rules' => 'trim|xss_clean'
        ),
        array(
            'field' => 'reference',
            'label' => 'lang:form_location_validation_reference_label',
            'rules' => 'trim|xss_clean'
        ),
        array(
            'field' => 'issue',
            'label' => 'lang:form_location_validation_issue_label',
            'rules' => 'trim|xss_clean'
        ),
        array(
            'field' => 'note',
            'label' => 'lang:form_location_validation_note_label',
            'rules' => 'trim|xss_clean'
        ),
        array(
            'field' => 'east',
            'label' => 'lang:form_location_validation_ease_label',
            'rules' => 'trim|xss_clean'
        ),
        array(
            'field' => 'west',
            'label' => 'lang:form_location_validation_west_label',
            'rules' => 'trim|xss_clean'
        ),
        array(
            'field' => 'south',
            'label' => 'lang:form_location_validation_south_label',
            'rules' => 'trim|xss_clean'
        ),
        array(
            'field' => 'north',
            'label' => 'lang:form_location_validation_nort_label',
            'rules' => 'trim|xss_clean'
        ),
        array(
            'field' => 'latlng',
            'label' => 'lang:form_location_validation_latlng_label',
            'rules' => 'trim|xss_clean'
        ),
    );
    
    public function get_detail($where)
    {
        $this->db->select($this->_table.'.*, p.caption as parent');
        $this->db->join('location as p', $this->_table.'.parent_id = p.id', 'left');
        if(is_numeric($where))
        {
            $where = array($this->_table.'.id' => $where);
        }
        return parent::get_by($where);
    }
    
    public function get_all_records($where = FALSE)
    {
        $this->db->select($this->_table.'.*, p.caption as parent');
        $this->db->join('location as p', $this->_table.'.parent_id = p.id', 'left');
        if($where != FALSE)
        {
            return parent::get_many_by($where);
        }
        return parent::get_all();
    }
    
    function get_dropdown($where = FALSE){
        $this->db->select($this->_table.'.id, '.$this->_table.'.caption, '.$this->_table.'.parent_id');
        if($where != FALSE)
        {
            return parent::as_array()->get_many_by($where);
        }
        return parent::as_array()->get_all();
    }
    
    function get_list($where = FALSE)
    {
        // cache 
        $this->db->cache_on();
        
        $this->db->select($this->_table.'.id, '.$this->_table.'.caption, '.$this->_table.'.parent_id');
        if($where != FALSE)
        {
            return parent::as_array()->get_many_by($where);
        }
        return parent::as_array()->get_all();
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
