<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of media_model
 *
 * @author Chanthoeun
 */
class Library_model extends MY_Model {
    public $_table = 'library';
    public $protected_attributes = array( 'id');
    
    public $before_create = array( 'created_at', 'updated_at' );
    public $before_update = array( 'updated_at' );
    
    public $validate = array(
        array(
            'field' => 'caption',
            'label' => 'lang:form_library_validation_caption_label',
            'rules' => 'trim|required|is_unique[library.caption]|xss_clean',
            'errors'=> array(
                'required'  => '%s តម្រូវឲ្យ​មាន',
                'is_unique' => '%s មាន​រូចហើយ'
                )
        ),
        array(
            'field' => 'group',
            'label' => 'lang:form_library_validation_group_label',
            'rules' => 'trim|required|is_natural_no_zero|xss_clean',
            'errors'=> array('required'  => '%s តម្រូវឲ្យ​មាន')
        ),
        array(
            'field' => 'url',
            'label' => 'lang:form_library_validation_url_label',
            'rules' => 'trim|xss_clean',
            'errors'=> array('required'  => '%s តម្រូវឲ្យ​មាន')
        )
    );
    
    public function get_detail($where)
    {
        $this->db->select($this->_table.'.*, g.caption as group');
        $this->db->join('library_group as g', $this->_table.'.library_group_id = g.id', 'left');
        if(is_numeric($where))
        {
            $where = array($this->_table.'.id' => $where);
        }
        return parent::get_by($where);
    }
    
    public function get_all_records($where = FALSE)
    {
        $this->db->select($this->_table.'.*, g.caption as group');
        $this->db->join('library_group as g', $this->_table.'.library_group_id = g.id', 'left');
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
