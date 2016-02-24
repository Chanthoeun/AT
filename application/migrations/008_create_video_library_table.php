<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_video_library_table extends CI_Migration {

    public function up()
    {
        // set default engine
        $this->db->query('SET storage_engine=MYISAM;');

        // drop table video_library
        if ($this->db->table_exists('video_library'))
        {
         $this->dbforge->drop_table('video_library');
        }

         // Create table video_library
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => '11',
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'video_id' => array(
                'type' => 'INT',
                 'constraint' => 11,
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
                'unsigned'  => TRUE,
                'default'   => 0,
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
        $this->dbforge->create_table('video_library');
        $this->db->query('ALTER TABLE `video_library` ADD CONSTRAINT `fk_video_library_video` FOREIGN KEY `video_library`(`video_id`) REFERENCES `video`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;');
        $this->db->query('ALTER TABLE `video_library` ADD CONSTRAINT `fk_video_library_library` FOREIGN KEY `video_library`(`library_id`) REFERENCES `library`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;');
    }

    public function down()
    {
        $this->dbforge->drop_table('video_library');
    }
}