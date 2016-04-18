<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_people_table extends CI_Migration {

	public function up()
	{
            // set default engine
            $this->db->query('SET storage_engine=MYISAM;');

            // Drop table 'people' if it exists		
            if ($this->db->table_exists('people'))
            {
                $this->dbforge->drop_table('people');
            }

            // Table structure for table 'people'
            $this->dbforge->add_field(array(
                'id' => array(
                    'type' => 'BIGINT',
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ),
                'name' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 100,
                ),
                'organization' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 100,
                    'null' => TRUE
                ),
                'position' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 50,
                    'null' => TRUE
                ),
                'telephone' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 100,
                ),
                'email' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 150,
                    'null'  => TRUE
                ),
                'social_media' => array(
                    'type' => 'TEXT',
                    'null'  => TRUE
                ),
                'status' => array(
                    'type' => 'TINYINT',
                    'constraint' => 1,
                    'default'   => 1
                ),
                'created_at' => array(
                    'type'  => 'INT',
                    'constraint' => 11
                ),
                'updated_at'   => array(
                   'type'  => 'INT',
                    'constraint' => 11
                ),
                'people_group_id' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE
                ),
                'go_id' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'null' => TRUE
                ),
                'location_id' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 250,
                    'null' => TRUE
                ),
                'user_id' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'null' => TRUE
                ),
            ));
            $this->dbforge->add_key('id', TRUE);
            $this->dbforge->create_table('people');
            $this->db->query('ALTER TABLE `people` ADD CONSTRAINT `fk_people_people_group` FOREIGN KEY `people`(`people_group_id`) REFERENCES `people_group`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;');
	}

	public function down()
	{
            $this->dbforge->drop_table('people');
	}
}