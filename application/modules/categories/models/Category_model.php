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
class Category_model extends MY_Model {
    public $_table = 'category';
    public $protected_attributes = array( 'id');
    
    public $before_create = array( 'created_at', 'updated_at' );
    public $before_update = array( 'updated_at' );
    
    public $validate = array(
        array(
            'field' => 'caption',
            'label' => 'lang:form_cagetory_validation_caption_label',
            'rules' => 'trim|required|is_unique[category.caption]|xss_clean',
            'errors'=> array(
                'required'  => '%s តម្រូវឲ្យ​មាន',
                'is_unique' => '%s មាន​រូចហើយ'
                )
        ),
        array(
            'field' => 'parent',
            'label' => 'lang:form_cagetory_validation_parent_label',
            'rules' => 'trim|is_natural_no_zero|xss_clean'
        ),
        array(
            'field' => 'article',
            'label' => 'lang:form_cagetory_validation_article_label',
            'rules' => 'trim|is_natural_no_zero|xss_clean'
        ),
        array(
            'field' => 'market',
            'label' => 'lang:form_cagetory_validation_market_label',
            'rules' => 'trim|is_natural_no_zero|xss_clean'
        ),
        array(
            'field' => 'real_estate',
            'label' => 'lang:form_cagetory_validation_real_estate_label',
            'rules' => 'trim|is_natural_no_zero|xss_clean'
        ),
        array(
            'field' => 'job',
            'label' => 'lang:form_cagetory_validation_job_label',
            'rules' => 'trim|is_natural_no_zero|xss_clean'
        )
    );
    
    public function get_detail($where)
    {
        $this->db->select($this->_table.'.*, p.caption as p_caption');
        $this->db->join('category as p', $this->_table.'.parent_id = p.id', 'left');
        if(is_numeric($where))
        {
            $where = array($this->_table.'.id' => $where);
        }
        return parent::get_by($where);
    }
    
    public function get_all_records($where = FALSE)
    {
        $this->db->select($this->_table.'.*, p.caption as p_caption');
        $this->db->join('category as p', $this->_table.'.parent_id = p.id', 'left');
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
        
        $this->db->select($this->_table.'.id, '.$this->_table.'.caption, '.$this->_table.'.slug, '.$this->_table.'.parent_id');
        if($where != FALSE)
        {
            return parent::as_array()->get_many_by($where);
        }
        return parent::as_array()->get_all();
    }
    
    public function get_news_categories($where = FALSE)
    {
        $this->db->select($this->_table.'.*, p.caption as p_caption, count(article.id) as article_count');
        $this->db->join('category as p', $this->_table.'.parent_id = p.id', 'left');
        $this->db->join('article', 'article.category_id = '.$this->_table.'.id AND article.article_type_id = 1', 'left');
        $this->db->group_by($this->_table.'.caption');
        $this->db->order_by($this->_table.'.id');
        if($where != FALSE)
        {
            return parent::get_many_by($where);
        }
        return parent::get_all();
    }
    
    public function get_technique_categories($where = FALSE)
    {
        $this->db->select($this->_table.'.*, p.caption as p_caption, count(article.id) as article_count');
        $this->db->join('category as p', $this->_table.'.parent_id = p.id', 'left');
        $this->db->join('article', 'article.category_id = '.$this->_table.'.id AND article.article_type_id = 2', 'left');
        $this->db->group_by($this->_table.'.caption');
        $this->db->order_by($this->_table.'.id');
        if($where != FALSE)
        {
            return parent::get_many_by($where);
        }
        return parent::get_all();
    }
    
    public function get_publication_categories($where = FALSE)
    {
        $this->db->select($this->_table.'.*, p.caption as p_caption, count(article.id) as article_count');
        $this->db->join('category as p', $this->_table.'.parent_id = p.id', 'left');
        $this->db->join('article', 'article.category_id = '.$this->_table.'.id AND article.article_type_id = 3', 'left');
        $this->db->group_by($this->_table.'.caption');
        $this->db->order_by($this->_table.'.id');
        if($where != FALSE)
        {
            return parent::get_many_by($where);
        }
        return parent::get_all();
    }
    
    public function get_product_categories($where = FALSE)
    {
        $this->db->select($this->_table.'.*, p.caption as p_caption, count(product.id) as product_count');
        $this->db->join('category as p', $this->_table.'.parent_id = p.id', 'left');
        $this->db->join('product', 'product.category_id = '.$this->_table.'.id', 'left');
        $this->db->group_by($this->_table.'.caption');
        $this->db->order_by($this->_table.'.id');
        if($where != FALSE)
        {
            return parent::get_many_by($where);
        }
        return parent::get_all();
    }
    
    public function get_land_categories($where = FALSE)
    {
        $this->db->select($this->_table.'.*, p.caption as p_caption, count(real_estate.id) as land_count');
        $this->db->join('category as p', $this->_table.'.parent_id = p.id', 'left');
        $this->db->join('real_estate', 'real_estate.category_id = '.$this->_table.'.id', 'left');
        $this->db->group_by($this->_table.'.caption');
        $this->db->order_by($this->_table.'.id');
        if($where != FALSE)
        {
            return parent::get_many_by($where);
        }
        return parent::get_all();
    }
    
    public function get_job_categories($where = FALSE)
    {
        $this->db->select($this->_table.'.*, p.caption as p_caption, count(job.id) as job_count');
        $this->db->join('category as p', $this->_table.'.parent_id = p.id', 'left');
        $this->db->join('job', "job.expire_date >= '".date('Y-m-d')."' AND job.category_id = ".$this->_table.".id", 'left');
        $this->db->group_by($this->_table.'.caption');
        $this->db->order_by($this->_table.'.id');
        if($where != FALSE)
        {
            return parent::get_many_by($where);
        }
        return parent::get_all();
    }
    
    public function get_video_categories($where = FALSE)
    {
        $this->db->select($this->_table.'.*, p.caption as p_caption, count(video.id) as video_count');
        $this->db->join('category as p', $this->_table.'.parent_id = p.id', 'left');
        $this->db->join('video', 'video.category_id = '.$this->_table.'.id', 'left');
        $this->db->group_by($this->_table.'.caption');
        $this->db->order_by($this->_table.'.id');
        if($where != FALSE)
        {
            return parent::get_many_by($where);
        }
        return parent::get_all();
    }
}
