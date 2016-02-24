<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_video_table extends CI_Migration {

    public function up()
    {
        // set default engine
        $this->db->query('SET storage_engine=MYISAM;');

        // drop table video
        if ($this->db->table_exists('video'))
        {
         $this->dbforge->drop_table('video');
        }

         // Create table article
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'title' => array(
                'type' => 'VARCHAR',
                'constraint' => 250
            ),
            'slug' => array(
                'type' => 'VARCHAR',
                'constraint' => 250,
            ),
            'detail' => array(
                'type'  => 'LONGTEXT',
                'null'  => TRUE
            ),
            'published_at' => array(
                'type' => 'DATE',
                'null' => TRUE
            ),
            'source' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'view'   => array(
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0
            ),
            'fb_quote' => array(
                'type'  => 'TEXT',
                'null'  => TRUE
            ),
            'created_at' => array(
                'type'  => 'INT',
                'constraint' => 11
            ),
            'updated_at'   => array(
               'type'  => 'INT',
                'constraint' => 11
            ),
            'category_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0,
            )
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('video');
    }

    public function down()
    {
        $this->dbforge->drop_table('video');
    }
}