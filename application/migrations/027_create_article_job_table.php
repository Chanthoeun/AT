<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_article_job_table extends CI_Migration
{

     public function up()
     {
         // set default engine
         $this->db->query('SET storage_engine=MYISAM;');

         // drop article_job 
         if ($this->db->table_exists('article_job'))
         {
             $this->dbforge->drop_table('article_job');
         }


         // Create article_job
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
             'job_id' => array(
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
         $this->dbforge->create_table('article_job');
         $this->db->query('ALTER TABLE `article_job` ADD CONSTRAINT `fk_article_job_article` FOREIGN KEY `article_job`(`article_id`) REFERENCES `article`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;');
         $this->db->query('ALTER TABLE `article_job` ADD CONSTRAINT `fk_article_job_job` FOREIGN KEY `article_job`(`job_id`) REFERENCES `job`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;');
     }

     public function down()
     {
         $this->dbforge->drop_table('article_job');
     }

}