<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_product_discount_table extends CI_Migration
{

     public function up()
     {
         // set default engine
         $this->db->query('SET storage_engine=MYISAM;');

         // drop product_discount 
         if ($this->db->table_exists('product_discount'))
         {
             $this->dbforge->drop_table('product_discount');
         }

         // Create product_discount
         $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'percent' => array(
                'type' => 'INT',
                'constraint' => 4,
                'null' => TRUE,
            ),
            'start_date' => array(
                'type' => 'DATE',
                'null'  => TRUE
            ),
             'end_date' => array(
                'type' => 'DATE',
                'null'=> TRUE
            ),
            'product_price_id' => array(
                'type' => 'BIGINT',
                'null' => TRUE
            ),
            'created_at' => array(
                'type' => 'INT',
                'constraint' => 11
            ),
            'updated_at' => array(
                'type' => 'INT',
                'constraint' => 11
            )
         ));
         $this->dbforge->add_key('id', TRUE);
         $this->dbforge->create_table('product_discount');
     }

     public function down()
     {
         $this->dbforge->drop_table('product_discount');
     }

}