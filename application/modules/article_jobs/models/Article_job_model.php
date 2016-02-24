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
class Article_job_model extends MY_Model {
    public $_table = 'article_job';
    public $protected_attributes = array( 'id');
    
    public $before_create = array( 'created_at', 'updated_at' );
    public $before_update = array( 'updated_at' );
    
    public function get_all_records($where = FALSE, $get_job = TRUE)
    {
        if($get_job == TRUE)
        {
            $this->db->select($this->_table.'.*, job.title, job.expire_date, job.company, category.caption as category');
            $this->db->join('job', $this->_table.'.job_id = job.id', 'left');
            $this->db->join('category', 'job.category_id = category.id', 'left');
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
