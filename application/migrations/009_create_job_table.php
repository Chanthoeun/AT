<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_job_table extends CI_Migration
{

     public function up()
     {
         // set default engine
         $this->db->query('SET storage_engine=MYISAM;');

         // drop table job
         if ($this->db->table_exists('job'))
         {
             $this->dbforge->drop_table('job');
         }


         // Create table job
         $this->dbforge->add_field(array(
             'id' => array(
                 'type' => 'INT',
                 'constraint' => 11,
                 'unsigned' => TRUE,
                 'auto_increment' => TRUE
             ),
             'title' => array(
                 'type' => 'VARCHAR',
                 'constraint' => 250,
                 'unsigned' => TRUE
             ),
             'description' => array(
                 'type' => 'TEXT',
                 'unsigned' => TRUE
             ),
             'requirement' => array(
                 'type' => 'LONGTEXT',
                 'unsigned' => TRUE
             ),
             'apply' => array(
                 'type' => 'TEXT',
                 'unsigned' => TRUE
             ),
             'expire_date' => array(
                 'type' => 'DATE',
                 'unsigned' => TRUE
             ),
             'category_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0,
             ),
             'company' => array(
                 'type' => 'VARCHAR',
                 'constraint' => 100,
                 'unsigned' => TRUE
             ),
             'logo' => array(
                 'type' => 'VARCHAR',
                 'constraint' => 250,
                 'null' => TRUE
             ),
             'user_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null'  => TRUE
             ),
             'agri_position' => array(
                 'type' => 'TINYINT',
                 'constraint' => 1,
                 'default' => 0
             ),
             'agri_cat_id' => array(
                 'type' => 'INT',
                'constraint' => 11,
                'default' => 0,
             ),
             'status' => array(
                 'type' => 'TINYINT',
                 'constraint' => 1,
                 'default' => 1
             ),
             'fb_quote' => array(
                'type'  => 'TEXT',
                'null'  => TRUE
             ),
             'created_at' => array(
                 'type' => 'INT',
                 'constraint' => '11'
             ),
             'updated_at' => array(
                 'type' => 'INT',
                 'constraint' => '11'
             )
         ));
         $this->dbforge->add_key('id', TRUE);
         $this->dbforge->create_table('job');
     }

     public function down()
     {
         $this->dbforge->drop_table('job');
     }

}