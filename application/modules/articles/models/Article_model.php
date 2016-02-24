<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of article_model
 *
 * @author Chanthoeun
 */
class Article_model extends MY_Model {
    public $_table = 'article';
    public $protected_attributes = array( 'id');
    
    public $before_create = array( 'created_at', 'updated_at' );
    public $before_update = array( 'updated_at' );
    
    public $validate = array(
        array(
            'field' => 'title',
            'label' => 'lang:form_article_validation_title_label',
            'rules' => 'trim|required|is_unique[article.title]|xss_clean',
            'errors'=> array(
                'required'  => '%s តម្រូវឲ្យ​មាន',
                'is_unique' => '%s មាន​រូចហើយ'
                )
        ),
        array(
            'field' => 'detail',
            'label' => 'lang:form_article_validation_detail_label',
            'rules' => 'trim|required|xss_clean',
            'errors'=> array(
                'required'  => '%s តម្រូវឲ្យ​មាន'
                )
        ),
        array(
            'field' => 'publish',
            'label' => 'lang:form_article_validation_publish_label',
            'rules' => 'trim|xss_clean'
        ),
        array(
            'field' => 'source',
            'label' => 'lang:form_article_validation_source_label',
            'rules' => 'trim|xss_clean'
        ),
        array(
            'field' => 'type',
            'label' => 'lang:form_article_validation_type_label',
            'rules' => 'trim|required|xss_clean',
            'errors'=> array(
                'required'  => '%s តម្រូវឲ្យ​មាន',
                )
        ),
        array(
            'field' => 'category',
            'label' => 'lang:form_article_validation_category_label',
            'rules' => 'trim|xss_clean'
        ),
        array(
            'field' => 'pcaption',
            'label' => 'lang:form_article_validation_pcaption_label',
            'rules' => 'trim|xss_clean'
        ),
        array(
            'field' => 'province',
            'label' => 'lang:form_article_validation_province_label',
            'rules' => 'trim|xss_clean'
        ),
        array(
            'field' => 'khan',
            'label' => 'lang:form_article_validation_khan_label',
            'rules' => 'trim|xss_clean'
        ),
        array(
            'field' => 'sangkat',
            'label' => 'lang:form_article_validation_sangkat_label',
            'rules' => 'trim|xss_clean'
        ),
        array(
            'field' => 'phum',
            'label' => 'lang:form_article_validation_phum_label',
            'rules' => 'trim|xss_clean'
        ),
        array(
            'field' => 'fb',
            'label' => 'lang:form_article_validation_fb_label',
            'rules' => 'trim|xss_clean'
        ),
        array(
            'field' => 'fbp',
            'label' => 'lang:form_article_validation_fbp_label',
            'rules' => 'trim|xss_clean'
        )
    );
    
    public function get_detail($where)
    {
        $this->db->select($this->_table.'.*, article_type.caption as artcaption, category.caption as catcaption');
        $this->db->join('article_type', $this->_table.'.article_type_id = article_type.id', 'left');
        $this->db->join('category', $this->_table.'.category_id = category.id', 'left');
        if(is_numeric($where))
        {
            $where = array($this->_table.'.id' => $where);
        }
        return parent::get_by($where);
    }
    
    public function get_all_records($where = FALSE)
    {
        $this->db->select($this->_table.'.*, article_type.caption as artcaption, category.caption as catcaption');
        $this->db->join('article_type', $this->_table.'.article_type_id = article_type.id', 'left');
        $this->db->join('category', $this->_table.'.category_id = category.id', 'left');
        
        if($where != FALSE)
        {
            return parent::get_many_by($where);
        }
        return parent::get_all();
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
