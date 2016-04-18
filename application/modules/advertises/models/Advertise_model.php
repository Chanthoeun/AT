<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Advert_model
 *
 * @author Chanthoeun
 */
class Advertise_model extends MY_Model {
    public $_table = 'advertise';
    public $protected_attributes = array( 'id');
    
    public $before_create = array( 'created_at', 'updated_at' );
    public $before_update = array( 'updated_at' );
    
    public $validate = array(
        array(
            'field' => 'advertiser',
            'label' => 'lang:form_advertise_validation_advertiser_label',
            'rules' => 'trim|required|xss_clean',
            'errors'=> array(
                'required' => '%s តម្រូវឲ្យ​មាន'
            )
        ),
        array(
            'field' => 'page',
            'label' => 'lang:form_advertise_validation_page_label',
            'rules' => 'trim|required|xss_clean',
            'errors'=> array(
                'required' => 'សូម​ជ្រើស​%s ដែល​ចង់​ផ្សាយ'
            )
        ),
        array(
            'field' => 'layout',
            'label' => 'lang:form_advertise_validation_layout_label',
            'rules' => 'trim|required|xss_clean',
            'errors'=> array(
                'required' => 'សូមជ្រើស%s ដែល​ចង់​ផ្សាយ'
            )
        ),
        array(
            'field' => 'price',
            'label' => 'lang:form_advertise_validation_price_label',
            'rules' => 'trim|required|xss_clean',
            'errors'=> array(
                'required' => 'សូម​បញ្ចូល​%s ដែល​ត្រូវ​បង់​ក្នុង​មួយ​ខែ'
            )
        ),
        array(
            'field' => 'discount',
            'label' => 'lang:form_advertise_validation_discount_label',
            'rules' => 'trim|xss_clean'
        ),
        array(
            'field' => 'start_date',
            'label' => 'lang:form_advertise_validation_start_date_label',
            'rules' => 'trim|required|xss_clean',
            'errors'=> array(
                'required' => 'សូម​ជ្រើស​រើស​%sផ្សាយ'
            )
        ),
        array(
            'field' => 'end_date',
            'label' => 'lang:form_advertise_validation_end_date_label',
            'rules' => 'trim|required|xss_clean',
            'errors'=> array(
                'required' => 'សូម​ជ្រើស​រើស​%sផ្សាយ'
            )
        ),
        array(
            'field' => 'link',
            'label' => 'lang:form_advertise_validation_link_label',
            'rules' => 'trim|required|xss_clean',
            'errors'=> array(
                'required' => 'សូម​បញ្ចូល%s'
            )
        ),
        array(
            'field' => 'payment_type',
            'label' => 'lang:form_advertise_validation_payment_type_label',
            'rules' => 'trim|xss_clean'
        )
    );
    
    public function get_detail($where)
    {
        $this->db->select($this->_table.'.*, advertiser.name as advertiser, ap.caption as page, al.caption as layout, aprice.price, aprice.discount, aprice.start_date, aprice.end_date, aprice.status as payment, aprice.payment_type');
        $this->db->join('advertiser', $this->_table.'.advertiser_id = advertiser.id', 'left');
        $this->db->join('advertise_page as ap', $this->_table.'.page_id = ap.id', 'left');
        $this->db->join('advertise_layout as al', $this->_table.'.layout_id = al.id', 'left');
        $this->db->join('advertise_price as aprice', $this->_table.'.id = aprice.advertise_id', 'left');
        if(is_numeric($where))
        {
            $where = array($this->_table.'.id' => $where);
        }
        return parent::get_by($where);
    }
    
    public function get_all_records($where = FALSE)
    {
        $this->db->select($this->_table.'.*, advertiser.name as advertiser, ap.caption as page, al.caption as layout, aprice.price, aprice.discount, aprice.start_date, aprice.end_date, aprice.status as payment, aprice.payment_type, TIMESTAMPDIFF(DAY, CURDATE(), aprice.end_date) as day_remains');
        $this->db->join('advertiser', $this->_table.'.advertiser_id = advertiser.id', 'left');
        $this->db->join('advertise_page as ap', $this->_table.'.page_id = ap.id', 'left');
        $this->db->join('advertise_layout as al', $this->_table.'.layout_id = al.id', 'left');
        $this->db->join('advertise_price as aprice', $this->_table.'.id = aprice.advertise_id', 'left');
        if($where != FALSE)
        {
            return parent::get_many_by($where);
        }
        return parent::get_all();
    }
    
    public function get_advertises($where = FALSE) {
        $this->db->select($this->_table.'.*, ap.slug as page, al.caption as layout, al.position, aprice.end_date as expire');
        $this->db->join('advertise_page as ap', $this->_table.'.page_id = ap.id', 'left');
        $this->db->join('advertise_layout as al', $this->_table.'.layout_id = al.id', 'left');
        $this->db->join('advertise_price as aprice', $this->_table.'.id = aprice.advertise_id AND aprice.end_date >= CURDATE()', 'left');
        $this->db->where($this->_table.'.status', TRUE);
        if($where != FALSE)
        {
            return parent::get_many_by($where);
        }
        return parent::get_all();
    }
}
