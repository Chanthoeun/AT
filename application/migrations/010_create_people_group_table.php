<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_people_group_table extends CI_Migration {

	public function up()
	{
            // set default engine
            $this->db->query('SET storage_engine=MYISAM;');

            // Drop table 'people_group' if it exists		
            if ($this->db->table_exists('people_group'))
            {
                $this->dbforge->drop_table('people_group');
            }

            // Table structure for table 'people_group'
            $this->dbforge->add_field(array(
                'id' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
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
                    'constraint' => 4,
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
            $this->dbforge->create_table('people_group');

            // Dumping data for table 'people_group'
            $data = array(
                array(
                    'caption' => 'បុគ្គលទូទៅ',
                    'slug' => 'បុគ្គលទូទៅ',
                    'order' => 1,
                    'created_at' => time(),
                    'updated_at' => time()
                ),
                array(
                    'caption' => 'មន្ត្រី​រាជការ',
                    'slug' => 'មន្ត្រី​រាជការ',
                    'order' => 2,
                    'created_at' => time(),
                    'updated_at' => time()
                ),
                array(
                    'caption' => 'បុគ្គលិក​អង្គការ',
                    'slug' => 'បុគ្គលិក​អង្គការ',
                    'order' => 3,
                    'created_at' => time(),
                    'updated_at' => time()
                ),
                array(
                    'caption' => 'បុគ្គលិក​ក្រុម​ហ៊ុន​ឯកជន',
                    'slug' => 'បុគ្គលិក​ក្រុម​ហ៊ុន​ឯកជន',
                    'order' => 4,
                    'created_at' => time(),
                    'updated_at' => time()
                ),
                array(
                    'caption' => 'កសិករ​គំរូ',
                    'slug' => 'កសិករ​គំរូ',
                    'order' => 5,
                    'created_at' => time(),
                    'updated_at' => time()
                ),
            );
            $this->db->insert_batch('people_group', $data);

	}

	public function down()
	{
            $this->dbforge->drop_table('people_group');
	}
}