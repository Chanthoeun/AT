<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_product_picture_table extends CI_Migration
{

     public function up()
     {
         // set default engine
         $this->db->query('SET storage_engine=MYISAM;');

         // drop table product_picture
         if ($this->db->table_exists('product_picture'))
         {
             $this->dbforge->drop_table('product_picture');
         }


         // Create table product_picture
         $this->dbforge->add_field(array(
             'id' => array(
                 'type' => 'BIGINT',
                 'unsigned' => TRUE,
                 'auto_increment' => TRUE
             ),
             'file' => array(
                 'type' => 'VARCHAR',
                 'constraint' => 250,
                 'unsigned' => TRUE
             ),
             'set' => array(
                 'type' => 'TINYINT',
                 'constraint' => 1,
             ),
             'created_at' => array(
                 'type' => 'INT',
                 'constraint' => 11
             ),
             'updated_at' => array(
                 'type' => 'INT',
                 'constraint' => 11
             ),
             'product_id' => array(
                 'type' => 'BIGINT',
                 'unsigned' => TRUE
             )
         ));
         $this->dbforge->add_key('id', TRUE);
         $this->dbforge->create_table('product_picture');
         $this->db->query('ALTER TABLE `product_picture` ADD CONSTRAINT `fk_product_picture_product` FOREIGN KEY `product_picture`(`product_id`) REFERENCES `product`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;');
     }

     public function down()
     {
         $this->dbforge->drop_table('product_picture');
     }

}