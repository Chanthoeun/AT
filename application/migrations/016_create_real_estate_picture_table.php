<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_real_estate_picture_table extends CI_Migration
{

     public function up()
     {
         // set default engine
         $this->db->query('SET storage_engine=MYISAM;');

         // drop table real_estate
         if ($this->db->table_exists('real_estate_picture'))
         {
             $this->dbforge->drop_table('real_estate_picture');
         }


         // Create table real_estate
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
             'real_estate_id' => array(
                 'type' => 'BIGINT',
                 'unsigned' => TRUE
             )
         ));
         $this->dbforge->add_key('id', TRUE);
         $this->dbforge->create_table('real_estate_picture');
         $this->db->query('ALTER TABLE `real_estate_picture` ADD CONSTRAINT `fk_real_estate_picture_real_estate` FOREIGN KEY `real_estate_picture`(`real_estate_id`) REFERENCES `real_estate`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;');
     }

     public function down()
     {
         $this->dbforge->drop_table('real_estate_picture');
     }

}