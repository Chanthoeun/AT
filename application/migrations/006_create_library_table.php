<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_library_table extends CI_Migration
{

     public function up()
     {
         // set default engine
         $this->db->query('SET storage_engine=MYISAM;');

         // drop table library
         if ($this->db->table_exists('library'))
         {
             $this->dbforge->drop_table('library');
         }


         // Create table media
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'caption' => array(
                'type' => 'VARCHAR',
                'constraint' => 250
            ),
            'slug' => array(
                'type' => 'VARCHAR',
                'constraint' => 250
            ),
            'file' => array(
                'type' => 'TEXT',
            ),
            'picture' => array(
                'type'  => 'VARCHAR',
                'constraint' => 250,
                'null' => TRUE
            ),
            'library_group_id' => array(
                'type'  => 'TINYINT',
                'constraint' => 4,
                'unsigned' => TRUE,
            ),
            'view'   => array(
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0
            ),
            'created_at' => array(
                'type'  => 'INT',
                'constraint' => 11
            ),
            'updated_at'   => array(
               'type'  => 'INT',
                'constraint' => 11
            )
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('library');
        $this->db->query('ALTER TABLE `library` ADD CONSTRAINT `fk_library_library_group` FOREIGN KEY `library`(`library_group_id`) REFERENCES `library_group`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;');         
     }

     public function down()
     {
         $this->dbforge->drop_table('library');
     }

}