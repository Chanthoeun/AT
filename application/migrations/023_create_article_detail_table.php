<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_article_detail_table extends CI_Migration
{

     public function up()
     {
         // set default engine
         $this->db->query('SET storage_engine=MYISAM;');

         // drop table article_detail
         if ($this->db->table_exists('article_detail'))
         {
             $this->dbforge->drop_table('article_detail');
         }


         // Create table article_detail
         $this->dbforge->add_field(array(
             'id' => array(
                 'type' => 'BIGINT',
                 'unsigned' => TRUE,
                 'auto_increment' => TRUE
             ),
             'title' => array(
                 'type' => 'VARCHAR',
                 'constraint' => 250,
                 'null' => TRUE
             ),
             'detail' => array(
                 'type' => 'LONGTEXT',
                 'null' => TRUE
             ),
             'pcaption' => array(
                 'type' => 'VARCHAR',
                 'constraint' => 250,
                 'null' => TRUE
             ),
             'picture' => array(
                 'type' => 'VARCHAR',
                 'constraint' => 250,
                 'null' => TRUE
             ),
             'article_id' => array(
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
         $this->dbforge->create_table('article_detail');
         $this->db->query('ALTER TABLE `article_detail` ADD CONSTRAINT `fk_article_detail_article` FOREIGN KEY `article_detail`(`article_id`) REFERENCES `article`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;');
     }

     public function down()
     {
         $this->dbforge->drop_table('article_detail');
     }
}