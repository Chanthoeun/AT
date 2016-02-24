<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_agribook_group_table extends CI_Migration {

	public function up()
	{
            // set default engine
            $this->db->query('SET storage_engine=MYISAM;');

            // Drop table 'agribook_group' if it exists		
            if ($this->db->table_exists('agribook_group'))
            {
                $this->dbforge->drop_table('agribook_group');
            }

            // Table structure for table 'agribook_group'
            $this->dbforge->add_field(array(
                'id' => array(
                    'type' => 'TINYINT',
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ),
                'parent_id' => array(
                    'type'  => 'TINYINT',
                    'default'   => 0
                ),
                'caption' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 100,
                ),
                'slug' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 100,
                    'null' => TRUE
                ),
                'order' => array(
                    'type'  => 'TINYINT',
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
            $this->dbforge->create_table('agribook_group');

            // Dumping data for table 'agribook_group'
            $data = array(
                array(
                    'caption' => 'ក្រសួង',
                    'slug' => 'ក្រសួង',
                    'order' => 1,
                    'created_at' => time(),
                    'updated_at' => time()
                ),
                array(
                    'caption' => 'អង្គការ',
                    'slug' => 'អង្គការ',
                    'order' => 2,
                    'created_at' => time(),
                    'updated_at' => time()
                ),
                array(
                    'caption' => 'សមាគម',
                    'slug' => 'សមាគម',
                    'order' => 3,
                    'created_at' => time(),
                    'updated_at' => time()
                ),
                array(
                    'caption' => 'ក្រុមហ៊ុន​ឯកជន',
                    'slug' => 'ក្រុមហ៊ុន​ឯកជន',
                    'order' => 4,
                    'created_at' => time(),
                    'updated_at' => time()
                ),
                array(
                    'caption' => 'ស្ថាប័ន​ហិរញ្ញវត្ថុ',
                    'slug' => 'ស្ថាប័ន​ហិរញ្ញវត្ថុ',
                    'order' => 5,
                    'created_at' => time(),
                    'updated_at' => time()
                ),
                array(
                    'caption' => 'សាលាបណ្តុះបណ្តាល​ជំនាញ​កសិកម្ម',
                    'slug' => 'សាលាបណ្តុះបណ្តាល​ជំនាញ​កសិកម្ម',
                    'order' => 6,
                    'created_at' => time(),
                    'updated_at' => time()
                ),
                array(
                    'caption' => 'កសិដ្ឋាន',
                    'slug' => 'កសិដ្ឋាន',
                    'order' => 7,
                    'created_at' => time(),
                    'updated_at' => time()
                ),
                array(
                    'caption' => 'រោង​ម៉ាស៊ីន​កិន​ស្រូវ',
                    'slug' => 'រោង​ម៉ាស៊ីន​កិន​ស្រូវ',
                    'order' => 8,
                    'created_at' => time(),
                    'updated_at' => time()
                ),
                array(
                    'caption' => 'ហាង​លក់​កសិផល​កសិកម្ម',
                    'slug' => 'ហាង​លក់​កសិផល​កសិកម្ម',
                    'order' => 9,
                    'created_at' => time(),
                    'updated_at' => time()
                ),
                array(
                    'caption' => 'ហាង​លក់សម្ភារៈកសិកម្ម',
                    'slug' => 'ហាង​លក់សម្ភារៈកសិកម្ម',
                    'order' => 10,
                    'created_at' => time(),
                    'updated_at' => time()
                ),
            );
            $this->db->insert_batch('agribook_group', $data);

	}

	public function down()
	{
            $this->dbforge->drop_table('agribook_group');
	}
}