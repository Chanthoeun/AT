<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_product_price_table extends CI_Migration
{

     public function up()
     {
         // set default engine
         $this->db->query('SET storage_engine=MYISAM;');

         // drop product_price 
         if ($this->db->table_exists('product_price'))
         {
             $this->dbforge->drop_table('product_price');
         }


         // Create product_price
         $this->dbforge->add_field(array(
             'id' => array(
                 'type' => 'BIGINT',
                 'unsigned' => TRUE,
                 'auto_increment' => TRUE
             ),
             'price' => array(
                 'type' => 'VARCHAR',
                 'constraint' => 20,
                 'unsigned' => TRUE,
             ),
             'price_type' => array(
                'type' => 'VARCHAR',
                'constraint' => 50,
                'unsigned' => TRUE
             ),
             'set' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0
            ),
             'product_id' => array(
                 'type' => 'BIGINT',
                 'unsigned' => TRUE
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
         $this->dbforge->create_table('product_price');
         $this->db->query('ALTER TABLE `product_price` ADD CONSTRAINT `fk_product_price_product` FOREIGN KEY `product_price`(`product_id`) REFERENCES `product_price`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;');         
     }

     public function down()
     {
         $this->dbforge->drop_table('product_price');
     }

}