<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_article_type_table extends CI_Migration
{

     public function up()
     {
         // set default engine
         $this->db->query('SET storage_engine=MYISAM;');

         // drop table article_type
         if ($this->db->table_exists('article_type'))
         {
             $this->dbforge->drop_table('article_type');
         }

         // Create table article_type
         $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'TINYINT',
                'constraint' => 4,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'parent_id' => array(
                'type' => 'TINYINT',
                'constraint' => 4, 
                'default' => 0
            ),
            'caption' => array(
                'type' => 'VARCHAR',
                'constraint' => 100
            ),
            'slug' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
		'null' => TRUE
            ),
            'order' => array(
                'type' => 'INT',
                'constraint' => 11
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
        $this->dbforge->create_table('article_type');

        // inster data
        $data = array(
            array(
                'caption' => 'ព័ត៌មានពេញនិយម',
                'slug'  => 'ព័ត៌មានពេញនិយម',
		'parent_id' => 0,
                'order' => 1,
                'created_at' => time(),
                'updated_at' => time()
            ),
            array(
                'caption' => 'សម្រង់​បច្ចេកទេស',
                'slug'  => 'សម្រង់​បច្ចេកទេស',
		'parent_id' => 0,
                'order' => 2,
                'created_at' => time(),
                'updated_at' => time()
            ),
            array(
                'caption' => 'ឯកសារផ្សព្វផ្សាយ',
                'slug'  => 'ឯកសារផ្សព្វផ្សាយ',
		'parent_id' => 0,
                'order' => 3,
                'created_at' => time(),
                'updated_at' => time()
            )
        );

        $this->db->insert_batch('article_type', $data);
     }

     public function down()
     {
         $this->dbforge->drop_table('article_type');
     }

}