<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_article_real_estate_table extends CI_Migration
{

     public function up()
     {
         // set default engine
         $this->db->query('SET storage_engine=MYISAM;');

         // drop article_real_estate 
         if ($this->db->table_exists('article_real_estate'))
         {
             $this->dbforge->drop_table('article_real_estate');
         }


         // Create article_real_estate
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
             'real_estate_id' => array(
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
         $this->dbforge->create_table('article_real_estate');
         $this->db->query('ALTER TABLE `article_real_estate` ADD CONSTRAINT `fk_article_real_estate_article` FOREIGN KEY `article_real_estate`(`article_id`) REFERENCES `article`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;');
         $this->db->query('ALTER TABLE `article_real_estate` ADD CONSTRAINT `fk_article_real_estate_real_estate` FOREIGN KEY `article_real_estate`(`real_estate_id`) REFERENCES `real_estate`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;');
         
     }

     public function down()
     {
         $this->dbforge->drop_table('article_real_estate');
     }

}