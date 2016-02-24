<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_Article extends CI_Migration {

    public function up()
    {
        // set default engine
        $this->db->query('SET storage_engine=MYISAM;');

        // drop table article
        if ($this->db->table_exists('article'))
        {
         $this->dbforge->drop_table('article');
        }

         // Create table article
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'title' => array(
                'type' => 'TEXT'
            ),
            'slug' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'detail' => array(
                'type'  => 'LONGTEXT',
                'null'  => TRUE
            ),
            'published_on' => array(
                'type' => 'DATE',
                'null' => TRUE
            ),
            'source' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'pcaption' => array(
                'type' => 'VARCHAR',
                'constraint' => 250,
                'null' => TRUE
            ),
            'picture'   => array(
                'type' => 'VARCHAR',
                'constraint' => 250,
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
            'article_type_id'  => array(
                'type' => 'TINYINT',
                'constraint' => 4,
                'unsigned' => TRUE,
            ),
            'category_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0,
            ),
            'location_id' => array(
                'type' => 'VARCHAR',
                'constraint' => 15,
                'null' => TRUE
            ),

        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('article');
        $this->db->query('ALTER TABLE `article` ADD CONSTRAINT `fk_article_article_type` FOREIGN KEY `article`(`article_type_id`) REFERENCES `article_type`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;');         
    }

    public function down()
    {
        $this->dbforge->drop_table('article');
    }
}