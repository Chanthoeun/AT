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
class Article_library_model extends MY_Model {
    public $_table = 'article_library';
    public $protected_attributes = array( 'id');
    
    public $before_create = array( 'created_at', 'updated_at' );
    public $before_update = array( 'updated_at' );
    
    public function get_detail($where)
    {
        $this->db->select($this->_table.'.*, l.caption, l.file, l.library_group_id, lg.caption as group, a.title, a.article_type_id, a.category_id, cat.caption as category, at.caption as article_type');
        $this->db->join('library as l', $this->_table.'.library_id = l.id', 'left');
        $this->db->join('library_group as lg', 'l.library_group_id = lg.id', 'left');
        $this->db->join('article as a', $this->_table.'.article_id = a.id', 'left');
        $this->db->join('category as cat', 'a.category_id = cat.id', 'left');
        $this->db->join('article_type as at', 'a.article_type_id = at.id', 'left');
        
        if(is_numeric($where)){
            return parent::get_by(array($this->_table.'.id' => $where));
        }
        return parent::get_by($where);
    }
    
    public function get_all_records($where = FALSE, $where_in = FALSE)
    {
        $this->db->select($this->_table.'.*, l.id as lid, l.caption, l.file, l.picture, l.library_group_id, lg.caption as group, a.title, a.article_type_id, a.category_id, cat.caption as category, at.caption as article_type');
        $this->db->join('library as l', $this->_table.'.library_id = l.id', 'left');
        $this->db->join('library_group as lg', 'l.library_group_id = lg.id', 'left');
        $this->db->join('article as a', $this->_table.'.article_id = a.id', 'left');
        $this->db->join('category as cat', 'a.category_id = cat.id', 'left');
        $this->db->join('article_type as at', 'a.article_type_id = at.id', 'left');
        
        if($where_in != FALSE)
        {
            $this->db->where_in('l.library_group_id', $where_in);
        }
        
        if($where == FALSE){
            return parent::get_all();
        }
        return parent::get_many_by($where);
    }
}
