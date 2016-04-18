<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_real_estate_table extends CI_Migration
{

     public function up()
     {
         // set default engine
         $this->db->query('SET storage_engine=MYISAM;');

         // drop table real_estate
         if ($this->db->table_exists('real_estate'))
         {
             $this->dbforge->drop_table('real_estate');
         }


         // Create table real_estate
         $this->dbforge->add_field(array(
             'id' => array(
                 'type' => 'BIGINT',
                 'unsigned' => TRUE,
                 'auto_increment' => TRUE
             ),
             'title' => array(
                 'type' => 'VARCHAR',
                 'constraint' => '150',
             ),
             'slug' => array(
                 'type' => 'VARCHAR',
                 'constraint' => 150,
             ),
             'description' => array(
                 'type' => 'TEXT',
                 'null' => TRUE,
             ),
             'price' => array(
                 'type' => 'VARCHAR',
                 'constraint' => 50,
             ),
             'address' => array(
                 'type' => 'VARCHAR',
                 'constraint' => 250,
                 'null' => TRUE
             ),
             'map' => array(
                 'type' => 'VARCHAR',
                 'constraint' => 250,
                 'null' => TRUE
             ),
             'status' => array( // 0 is not yet sell, 1 is sell
                 'type' => 'TINYINT',
                 'constraint' => 1,
                 'default' => 0
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
             'location_id' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 250,
                    'null' => TRUE
                ),
             'user_id' => array(
                 'type' =>  'INT',
                 'constraint' => 11, 
                 'null' => TRUE
             )
         ));
         $this->dbforge->add_key('id', TRUE);
         $this->dbforge->create_table('real_estate');
         $this->db->query('ALTER TABLE `real_estate` ADD CONSTRAINT `fk_real_estate_category` FOREIGN KEY `real_estate`(`category_id`) REFERENCES `category`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;');         
     }

     public function down()
     {
         $this->dbforge->drop_table('real_estate');
     }

}