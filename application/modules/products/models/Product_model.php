<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of product_model
 *
 * @author Chanthoeun
 */
class Product_model extends MY_Model {
    public $_table = 'product';
    public $protected_attributes = array('id');
    
    public $before_create = array( 'created_at', 'updated_at' );
    public $before_update = array( 'updated_at' );
    
    public $validate = array(
        array(
            'field' => 'category',
            'label' => 'lang:form_product_category_label',
            'rules' => 'trim|required|xss_clean',
            'errors'=> array(
                'required'  => '%s តម្រូវឲ្យ​មាន'
                )
        ),
        array(
            'field' => 'title',
            'label' => 'lang:form_product_title_label',
            'rules' => 'trim|required|xss_clean',
            'errors'=> array(
                'required'  => '%s តម្រូវឲ្យ​មាន'
                )
        ),
        array(
            'field' => 'desc',
            'label' => 'lang:form_product_desc_label',
            'rules' => 'trim|required|xss_clean',
            'errors'=> array(
                'required'  => '%s តម្រូវឲ្យ​មាន'
                )
        ),
        array(
            'field' => 'price',
            'label' => 'lang:form_product_price_label',
            'rules' => 'trim|required|xss_clean',
            'errors'=> array(
                'required'  => '%s តម្រូវឲ្យ​មាន'
                )
        ),
        array(
            'field' => 'price_type',
            'label' => 'lang:form_product_price_type_label',
            'rules' => 'trim|xss_clean',
            'errors'=> array(
                'required'  => '%s តម្រូវឲ្យ​មាន'
                )
        ),
        array(
            'field' => 'discount',
            'label' => 'lang:form_product_discount_label',
            'rules' => 'trim|is_natural|xss_clean',
            'errors'=> array(
                'is_natural'  => '%s ត្រូវជាលេខ'
                )
        ),
        array(
            'field' => 'start',
            'label' => 'lang:form_product_discount_start_label',
            'rules' => 'trim|xss_clean'
        ),
        array(
            'field' => 'end',
            'label' => 'lang:form_product_discount_end_label',
            'rules' => 'trim|xss_clean'
        ),
    );
    
    public function get_detail($where)
    {
        $this->db->select($this->_table.'.*, pp.price, pp.price_type, pd.percent as discount, pd.start_date, pd.end_date, cat.caption as catcaption, ppic.file, users.username');
        $this->db->join('product_price as pp', $this->_table.'.id = pp.product_id AND pp.set = 1', 'left');
        $this->db->join('product_discount as pd', 'pp.id = pd.product_price_id', 'left');
        $this->db->join('category as cat', $this->_table.'.category_id = cat.id', 'left');
        $this->db->join('product_picture as ppic', $this->_table.'.id = ppic.product_id AND ppic.set = 1', 'left');
        $this->db->join('users', $this->_table.'.user_id = users.id', 'left');
        if(is_array($where))
        {
            return parent::get_by($where);
        }
        return parent::get_by(array($this->_table.'.id' => $where));
    }


    public function get_all_records($where = FALSE)
    {
        $this->db->select($this->_table.'.*, pp.price, pp.price_type, pd.percent as discount, pd.start_date, pd.end_date, cat.caption as catcaption, ppic.file, users.username');
        $this->db->join('product_price as pp', $this->_table.'.id = pp.product_id AND pp.set = 1', 'left');
        $this->db->join('product_discount as pd', 'pp.id = pd.product_price_id', 'left');
        $this->db->join('category as cat', $this->_table.'.category_id = cat.id', 'left');
        $this->db->join('product_picture as ppic', $this->_table.'.id = ppic.product_id AND ppic.set = 1', 'left');
        $this->db->join('users', $this->_table.'.user_id = users.id', 'left');
        if($where == FALSE)
        {
            return parent::get_all();
        }
        return parent::get_many_by($where);
    }
    
    public function get_like($like, $where = FALSE)
    {
        $this->db->like($like);
        
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
