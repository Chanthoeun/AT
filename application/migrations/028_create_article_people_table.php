<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_article_people_table extends CI_Migration
{

     public function up()
     {
         // set default engine
         $this->db->query('SET storage_engine=MYISAM;');

         // drop article_people 
         if ($this->db->table_exists('article_people'))
         {
             $this->dbforge->drop_table('article_people');
         }


         // Create article_people
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
             'people_id' => array(
                 'type' => 'BIGINT',
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
         $this->dbforge->create_table('article_people');
         $this->db->query('ALTER TABLE `article_people` ADD CONSTRAINT `fk_article_people_article` FOREIGN KEY `article_people`(`article_id`) REFERENCES `article`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;');
         $this->db->query('ALTER TABLE `article_people` ADD CONSTRAINT `fk_article_people_people` FOREIGN KEY `article_people`(`people_id`) REFERENCES `people`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;');
     }

     public function down()
     {
         $this->dbforge->drop_table('article_people');
     }

}