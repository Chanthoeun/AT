<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_product_table extends CI_Migration
{

     public function up()
     {
         // set default engine
         $this->db->query('SET storage_engine=MYISAM;');

         // drop table product
         if ($this->db->table_exists('product'))
         {
             $this->dbforge->drop_table('product');
         }


         // Create table product
         $this->dbforge->add_field(array(
             'id' => array(
                 'type' => 'BIGINT',
                 'unsigned' => TRUE,
                 'auto_increment' => TRUE
             ),
             'title' => array(
                 'type' => 'VARCHAR',
                 'constraint' => 250,
             ),
             'slug' => array(
                 'type' => 'VARCHAR',
                 'constraint' => 250,
             ),
             'description' => array(
                 'type' => 'TEXT',
                 'null' => TRUE,
             ),
             'status' => array(
                 'type' => 'TINYINT',
                 'constraint' => 1,
                 'default' => 1
             ),
             'view' => array(
                 'type' => 'INT',
                 'constraint' => 11,
                 'null' => TRUE
             ),
             'created_at' => array(
                 'type' => 'INT',
                 'constraint' => '11'
             ),
             'updated_at' => array(
                 'type' => 'INT',
                 'constraint' => '11'
             ),
             'category_id' => array(
                 'type' => 'INT',
                 'constraint' => 11,
                 'unsigned' => TRUE
             ),
             'user_id' => array(
                 'type' =>  'INT',
                 'constraint' => 11, 
                 'unsigned' => TRUE
             )
         ));
         $this->dbforge->add_key('id', TRUE);
         $this->dbforge->create_table('product');
         $this->db->query('ALTER TABLE `product` ADD CONSTRAINT `fk_product_category` FOREIGN KEY `product`(`category_id`) REFERENCES `category`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;');
         $this->db->query('ALTER TABLE `product` ADD CONSTRAINT `fk_product_user` FOREIGN KEY `product`(`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;');
     }

     public function down()
     {
         $this->dbforge->drop_table('product');
     }

}