<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Product_price_model
 *
 * @author Chanthoeun
 */
class Product_price_model extends MY_Model {
    public $_table = 'product_price';
    public $protected_attributes = array( 'id');
    
    public $before_create = array( 'created_at', 'updated_at' );
    public $before_update = array( 'updated_at' );
    
    public $validate = array(
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
            'rules' => 'trim||xss_clean'
        )
    );
    
    public function get_detail($where)
    {
        $this->db->select($this->_table.'.*, pd.id as discount_id, pd.percent as discount, pd.start_date, pd.end_date');
        $this->db->join('product_discount as pd', $this->_table.'.id = pd.product_price_id', 'left');
        if(is_array($where))
        {
            return parent::get_by($where);
        }
        return parent::get_by(array($this->_table.'.id' => $where));
    }


    public function get_all_records($where = FALSE)
    {
        $this->db->select($this->_table.'.*, pd.percent as discount, pd.start_date, pd.end_date');
        $this->db->join('product_discount as pd', $this->_table.'.id = pd.product_price_id', 'left');
        if($where == FALSE)
        {
            return parent::get_all();
        }
        return parent::get_many_by($where);
    }
}
