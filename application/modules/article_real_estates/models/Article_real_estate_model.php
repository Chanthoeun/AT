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
class Article_real_estate_model extends MY_Model {
    public $_table = 'article_real_estate';
    public $protected_attributes = array( 'id');
    
    public $before_create = array( 'created_at', 'updated_at' );
    public $before_update = array( 'updated_at' );
    
    public function get_all_records($where = FALSE, $get_real_estate = TRUE)
    {
        if($get_real_estate == TRUE)
        {
            $this->db->select($this->_table.'.*, real_estate.title, real_estate.price, real_estate.status, category.caption as category, real_estate_picture.file');
            $this->db->join('real_estate', $this->_table.'.real_estate_id = real_estate.id', 'left');
            $this->db->join('category', 'real_estate.category_id = category.id', 'left');
            $this->db->join('real_estate_picture', 'real_estate.id = real_estate_picture.real_estate_id AND real_estate_picture.set = 1', 'left');
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
