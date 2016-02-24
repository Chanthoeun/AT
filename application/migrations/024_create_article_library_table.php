<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_article_library_table extends CI_Migration
{

     public function up()
     {
         // set default engine
         $this->db->query('SET storage_engine=MYISAM;');

         // drop article_library 
         if ($this->db->table_exists('article_library'))
         {
             $this->dbforge->drop_table('article_library');
         }


         // Create article_media
         $this->dbforge->add_field(array(
             'id' => array(
                 'type' => 'BIGINT',
                 'unsigned' => TRUE,
                 'auto_increment' => TRUE
             ),
             'article_id' => array(
                 'type' => 'BIGINT',
                 'unsigned' => TRUE,
             ),
             'library_id' => array(
                 'type' => 'INT',
                 'constraint' => 11,
                 'unsigned' => TRUE,
             ),
             'order' => array(
                'type'  => 'TINYINT',
                'constraint' => 6,
                'default'   => 0,
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
         $this->dbforge->create_table('article_library');
         $this->db->query('ALTER TABLE `article_library` ADD CONSTRAINT `fk_article_library_article` FOREIGN KEY `article_library`(`article_id`) REFERENCES `article`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;');
         $this->db->query('ALTER TABLE `article_library` ADD CONSTRAINT `fk_article_library_library` FOREIGN KEY `article_library`(`library_id`) REFERENCES `library`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;');
     }

     public function down()
     {
         $this->dbforge->drop_table('article_library');
     }

}