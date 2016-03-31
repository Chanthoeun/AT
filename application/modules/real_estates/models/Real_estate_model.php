<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of real_estate_model
 *
 * @author Chanthoeun
 */
class Real_estate_model extends MY_Model {
    public $_table = 'real_estate';
    public $protected_attributes = array( 'id');
    
    public $before_create = array( 'created_at', 'updated_at' );
    public $before_update = array( 'updated_at' );
    
    public $validate = array(
        array(
            'field' => 'title',
            'label' => 'lang:form_real_estate_title_label',
            'rules' => 'trim|required|xss_clean',
            'errors'=> array(
                'required'  => '%s តម្រូវឲ្យ​មាន'
                )
        ),
        array(
            'field' => 'desc',
            'label' => 'lang:form_real_estate_desc_label',
            'rules' => 'trim|required|xss_clean',
            'errors'=> array(
                'required'  => '%s តម្រូវឲ្យ​មាន'
                )
        ),
        array(
            'field' => 'price',
            'label' => 'lang:form_real_estate_price_label',
            'rules' => 'trim|required|xss_clean',
            'errors'=> array(
                'required'  => '%s តម្រូវឲ្យ​មាន'
                )
        ),
        array(
            'field' => 'category',
            'label' => 'lang:form_real_estate_category_label',
            'rules' => 'trim|required|xss_clean',
            'errors'=> array(
                'required'  => '%s តម្រូវឲ្យ​មាន'
                )
        ),
        array(
            'field' => 'address',
            'label' => 'lang:form_real_estate_address_label',
            'rules' => 'trim|xss_clean'
        ),
        array(
            'field' => 'map',
            'label' => 'lang:form_real_estate_map_label',
            'rules' => 'trim|xss_clean'
        ),
        array(
            'field' => 'province',
            'label' => 'lang:form_real_estate_province_label',
            'rules' => 'trim|xss_clean'
        ),
        array(
            'field' => 'khan',
            'label' => 'lang:form_real_estate_khan_label',
            'rules' => 'trim|xss_clean'
        ),
        array(
            'field' => 'sangkat',
            'label' => 'lang:form_real_estate_sangkat_label',
            'rules' => 'trim|xss_clean'
        ),
        array(
            'field' => 'phum',
            'label' => 'lang:form_real_estate_phum_label',
            'rules' => 'trim|xss_clean'
        )
    );
    
    public function get_detail($where)
    {
        $this->db->select($this->_table.'.*, rep.file, rep.set, category.caption as catcaption, users.username');
        $this->db->join('real_estate_picture as rep', $this->_table.'.id = rep.real_estate_id AND rep.set = 1', 'left');
        $this->db->join('category', $this->_table.'.category_id = category.id', 'left');
        $this->db->join('users', $this->_table.'.user_id = users.id', 'left');
        
        if(is_numeric($where))
        {
            return parent::get_by(array($this->_table.'.id' => $where));
        }
        return parent::get_by($where);
    }
    
    public function get_all_records($where = FALSE)
    {
        $this->db->select($this->_table.'.*, rep.file, rep.set, category.caption as catcaption, users.username');
        $this->db->join('real_estate_picture as rep', $this->_table.'.id = rep.real_estate_id AND rep.set = 1', 'left');
        $this->db->join('category', $this->_table.'.category_id = category.id', 'left');
        $this->db->join('users', $this->_table.'.user_id = users.id', 'left');
        
        if($where == FALSE)
        {
            return parent::get_all();
        }
        return parent::get_many_by($where);
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
    
    public function get_contact($id)
    {
        $this->db->select($this->_table.'.id, people.id as people_id, people.name, people.telephone');
        $this->db->join('users', $this->_table.'.user_id = users.id', 'left');
        $this->db->join('people', 'users.id = people.user_id', 'left');
        
        return parent::get_by(array($this->_table.'.id' => $id));
    }
}
