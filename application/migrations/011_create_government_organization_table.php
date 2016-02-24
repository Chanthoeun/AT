<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_government_organization_table extends CI_Migration {

	public function up()
	{
            // set default engine
            $this->db->query('SET storage_engine=MYISAM;');

            // Drop table 'government_organization' if it exists		
            if ($this->db->table_exists('government_organization'))
            {
                $this->dbforge->drop_table('government_organization');
            }

            // Table structure for table 'government_organization'
            $this->dbforge->add_field(array(
                'id' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ),
                'parent_id' => array(
                    'type'  => 'INT',
                    'constraint' => 11,
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
            $this->dbforge->create_table('government_organization');
	}

	public function down()
	{
            $this->dbforge->drop_table('government_organization');
	}
}