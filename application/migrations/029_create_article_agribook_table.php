<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_article_agribook_table extends CI_Migration
{

     public function up()
     {
         // set default engine
         $this->db->query('SET storage_engine=MYISAM;');

         // drop article_agribook 
         if ($this->db->table_exists('article_agribook'))
         {
             $this->dbforge->drop_table('article_agribook');
         }


         // Create article_agribook
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
             'agribook_id' => array(
                 'type' => 'INT',
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
         $this->dbforge->create_table('article_agribook');
         $this->db->query('ALTER TABLE `article_agribook` ADD CONSTRAINT `fk_article_agribook_article` FOREIGN KEY `article_agribook`(`article_id`) REFERENCES `article`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;');
         $this->db->query('ALTER TABLE `article_agribook` ADD CONSTRAINT `fk_article_agribook_agribook` FOREIGN KEY `article_agribook`(`agribook_id`) REFERENCES `agribook`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;');
     }

     public function down()
     {
         $this->dbforge->drop_table('article_agribook');
     }

}