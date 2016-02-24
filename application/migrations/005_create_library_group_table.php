<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_library_group_table extends CI_Migration
{

     public function up()
     {
         // set default engine
         $this->db->query('SET storage_engine=MYISAM;');

         // drop table library_group
         if ($this->db->table_exists('library_group'))
         {
             $this->dbforge->drop_table('library_group');
         }


         // Create table library_group
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'TINYINT',
                'constraint' => 4,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'caption' => array(
                'type' => 'VARCHAR',
                'constraint' => 100
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
        $this->dbforge->create_table('library_group');
        
        //insert data
        $data = array(
            array(
                'caption' => 'ឯកសារ',
                'created_at' => time(),
                'updated_at' => time()
            ),
            array(
                'caption' => 'សម្លេង',
                'created_at' => time(),
                'updated_at' => time()
            ),
            array(
                'caption' => 'វីដេអូ',
                'created_at' => time(),
                'updated_at' => time()
            ),
        );
        $this->db->insert_batch('library_group', $data);
     }

     public function down()
     {
         $this->dbforge->drop_table('library_group');
     }

}