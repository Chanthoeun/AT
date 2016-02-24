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
class Article_product_model extends MY_Model {
    public $_table = 'article_product';
    public $protected_attributes = array( 'id');
    
    public $before_create = array( 'created_at', 'updated_at' );
    public $before_update = array( 'updated_at' );
    
    public function get_all_records($where = FALSE, $get_product = TRUE)
    {
        if($get_product == TRUE)
        {
            $this->db->select($this->_table.'.*, product.title, product_price.price, category.caption as category, product_picture.file');
            $this->db->join('product', $this->_table.'.product_id = product.id', 'left');
            $this->db->join('category', 'product.category_id = category.id', 'left');
            $this->db->join('product_price', 'product.id = product_price.product_id AND product_price.set = 1', 'left');
            $this->db->join('product_picture', 'product.id = product_picture.product_id AND product_picture.set = 1', 'left');
        }
        else
        {
            $this->db->select($this->_table.'.*, a.title as atitle, a.source as asource, a.picture as apicture, at.caption as atype, ac.caption as acategory');
            $this->db->join('article as a', $this->_table.'.article_id = a.id', 'left');
            $this->db->join('article_type as at', 'a.article_type_id = at.id', 'left');
            $this->db->join('category as ac', 'a.category_id = ac.id', 'left');
        }
        
        if($where == FALSE){
            return parent::get_all();
        }
        return parent::get_many_by($where);        
    }
}
