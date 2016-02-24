<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_agribook_table extends CI_Migration {

	public function up()
	{
            // set default engine
            $this->db->query('SET storage_engine=MYISAM;');

            // Drop table 'agribook' if it exists		
            if ($this->db->table_exists('agribook'))
            {
                $this->dbforge->drop_table('agribook');
            }

            // Table structure for table 'agribook'
            $this->dbforge->add_field(array(
                'id' => array(
                    'type' => 'INT',
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ),
                'name' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 100,
                ),
                'name_en' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 100,
                    'null'  => TRUE
                ),
                'profile' => array(
                    'type' => 'LONGTEXT',
                    'null' => TRUE
                ),
                'contact_person' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 100,
                    'null' => TRUE
                ),
                'address' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 250,
                    'null' => TRUE
                ),
                'telephone' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 100,
                ),
                'fax' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 100,
                    'null' => TRUE
                ),
                'email' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 150,
                    'null'  => TRUE
                ),
                'website' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 150,
                    'null'  => TRUE
                ),
                'social_media' => array(
                    'type' => 'TEXT',
                    'null'  => TRUE
                ),
                'pobox' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 10,
                    'null'  => TRUE
                ),
                'logo' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 250,
                    'null'  => TRUE
                ),
                'map' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 250,
                    'null'  => TRUE
                ),
                'status' => array(
                    'type' => 'TINYINT',
                    'constraint' => 1,
                    'default'   => 1
                ),
                'view' => array(
                    'type' => 'INT',
                    'default'   => 0
                ),
                'created_at' => array(
                    'type'  => 'INT',
                    'constraint' => 11
                ),
                'updated_at'   => array(
                   'type'  => 'INT',
                    'constraint' => 11
                ),
                'agribook_group_id' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE
                ),
                'location_id' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 15,
                    'null' => TRUE
                ),
            ));
            $this->dbforge->add_key('id', TRUE);
            $this->dbforge->create_table('agribook');
            $this->db->query('ALTER TABLE `agribook` ADD CONSTRAINT `fk_agribook_agribook_group` FOREIGN KEY `agribook`(`agribook_group_id`) REFERENCES `agribook_group`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;');
	}

	public function down()
	{
            $this->dbforge->drop_table('agribook');
	}
}