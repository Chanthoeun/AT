<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_location_table extends CI_Migration {

	public function up()
	{
            // set default engine
            $this->db->query('SET storage_engine=MYISAM;');

            // Drop table 'location' if it exists		
            if ($this->db->table_exists('location'))
            {
                $this->dbforge->drop_table('location');
            }

            // Table structure for table 'location'
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
                'caption_en' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 100,
                ),
                'area_code' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 10,
                    'null'  => TRUE,
                ),
                'postal_code' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 10,
                    'null'  => TRUE,
                ),
                'reference' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 100,
                    'null'  => TRUE,
                ),
                'issue_date' => array(
                    'type' => 'DATE',
                    'null'  => TRUE,
                ),
                'note' => array(
                    'type' => 'TEXT',
                    'null'  => TRUE,
                ),
                'east' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 100,
                    'null'  => TRUE,
                ),
                'west' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 100,
                    'null'  => TRUE,
                ),
                'south' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 100,
                    'null'  => TRUE,
                ),
                'north' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 100,
                    'null'  => TRUE,
                ),
                'latlng' => array(
                    'type'  => 'VARCHAR',
                    'constraint' => 50,
                    'null'  => TRUE
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
            $this->dbforge->create_table('location');

            // Dumping data for table 'location'
            $data = array(
                array(
                    'caption' => 'ភ្នំពេញ',
                    'caption_en' => 'Phnom Penh',
                    'area_code' => '12',
                    'reference' => '	ប្រកាសលេខ ៤៩៣ ប្រ.ក តាមប្រកាសក្រសួងមហាផ្ទៃ',
                    'issue_date' => '2001-04-30',
                    'note' => '',
                    'east' => 'ស្រុកខ្សាច់កណ្ដាល និងស្រុកល្វាឯម',
                    'west' => 'ស្រុកកណ្ដាលស្ទឹង និងស្រុកអង្គស្នួល',
                    'south' => 'ស្រុកកៀនស្វាយ និងស្រុកតាខ្មៅ',
                    'north' => 'ស្រុកពញាឮ និងស្រុកមុខកំពូល',
                    'latlng' => '11.55, 104.916667',
                    'order' => '1',
                    'created_at' => time(),
                    'updated_at' => time()
                ),
                array(
                    'caption' => 'បន្ទាយមានជ័យ',
                    'caption_en' => 'Banteay Meanchey',
                    'area_code' => '01',
                    'reference' => '	ប្រកាសលេខ ៤៩៣ ប្រ.ក តាមប្រកាសក្រសួងមហាផ្ទៃ',
                    'issue_date' => '2001-04-30',
                    'note' => '',
                    'east' => 'ខេត្តសៀមរាប',
                    'west' => 'ប្រទេសថៃឡង់ដ៍',
                    'south' => 'ខេត្តបាត់ដំបង និងខេត្តសៀមរាប',
                    'north' => 'ខេត្តឧត្តរមានជ័យ',
                    'latlng' => '13.75, 103',
                    'order' => '2',
                    'created_at' => time(),
                    'updated_at' => time()
                ),
                array(
                    'caption' => 'បាត់ដំបង',
                    'caption_en' => 'Battambang',
                    'area_code' => '02',
                    'reference' => '	ប្រកាសលេខ ៤៩៣ ប្រ.ក តាមប្រកាសក្រសួងមហាផ្ទៃ',
                    'issue_date' => '2001-04-30',
                    'note' => '',
                    'east' => 'ខេត្តសៀមរាប​និង​បឹងទន្លេសាប',
                    'west' => 'ប្រទេសថៃឡង់ដ៏',
                    'south' => 'ខេត្តពោធិសាត់',
                    'north' => 'ខេត្តបន្ទាយមានជ័យ',
                    'latlng' => '13.028611, 102.989444',
                    'order' => '3',
                    'created_at' => time(),
                    'updated_at' => time()
                ),
                array(
                    'caption' => 'កំពង់ចាម',
                    'caption_en' => 'Kampong Cham',
                    'area_code' => '03',
                    'reference' => '	ប្រកាសលេខ ៤៩៣ ប្រ.ក តាមប្រកាសក្រសួងមហាផ្ទៃ',
                    'issue_date' => '2001-04-30',
                    'note' => '',
                    'east' => 'ប្រទេសវៀតណាម',
                    'west' => 'ខេត្តកំពង់ឆ្នាំង',
                    'south' => 'ខេត្តព្រៃវែង និងខេត្តកណ្តាល',
                    'north' => 'ខេត្តកំពង់ធំ និងខេត្តក្រចេះ',
                    'latlng' => '11.983333, 105.45',
                    'order' => '4',
                    'created_at' => time(),
                    'updated_at' => time()
                ),
                array(
                    'caption' => 'កំពង់ឆ្នាំង',
                    'caption_en' => 'Kampong Chhnang',
                    'area_code' => '04',
                    'reference' => '	ប្រកាសលេខ ៤៩៣ ប្រ.ក តាមប្រកាសក្រសួងមហាផ្ទៃ',
                    'issue_date' => '2001-04-30',
                    'note' => '',
                    'east' => 'ខេត្តកំពង់ចាម',
                    'west' => 'ខេត្តពោធិសាត់',
                    'south' => 'ខេត្តកំពង់ស្ពឺ និងខេត្តកណ្តាល',
                    'north' => 'ខេត្តកំពង់ធំ',
                    'latlng' => '12.25, 104.666667',
                    'order' => '5',
                    'created_at' => time(),
                    'updated_at' => time()
                ),
                array(
                    'caption' => 'កំពង់ស្ពឺ',
                    'caption_en' => 'Kampong Speu',
                    'area_code' => '05',
                    'reference' => '	ប្រកាសលេខ ៤៩៣ ប្រ.ក តាមប្រកាសក្រសួងមហាផ្ទៃ',
                    'issue_date' => '2001-04-30',
                    'note' => '',
                    'east' => 'ខេត្តកណ្ដាល',
                    'west' => 'ខេត្តកោះកុង',
                    'south' => 'ខេត្តតាកែវ​និងខេត្តកំពត',
                    'north' => 'ខេត្តពោធិសាត់​និងខេត្តកំពង់ឆ្នាំង',
                    'latlng' => '12.25, 104.666667',
                    'order' => '6',
                    'created_at' => time(),
                    'updated_at' => time()
                ),
                array(
                    'caption' => 'កំពង់ធំ',
                    'caption_en' => 'Kampong Thom',
                    'area_code' => '06',
                    'reference' => '	ប្រកាសលេខ ៤៩៣ ប្រ.ក តាមប្រកាសក្រសួងមហាផ្ទៃ',
                    'issue_date' => '2001-04-30',
                    'note' => '',
                    'east' => 'ខេត្តក្រចេះ និងខេត្តស្ទឹងត្រែង',
                    'west' => 'ខេត្តសៀមរាប និងបឹងទន្លេសាប',
                    'south' => 'ខេត្តកំពង់ចាម និងខេត្តកំពង់ឆ្នាំង',
                    'north' => ' ខេត្តព្រះវិហារ',
                    'latlng' => '12.7, 104.883333',
                    'order' => '7',
                    'created_at' => time(),
                    'updated_at' => time()
                ),
                array(
                    'caption' => 'កំពត',
                    'caption_en' => 'Kampot',
                    'area_code' => '07',
                    'reference' => '	ប្រកាសលេខ ៤៩៣ ប្រ.ក តាមប្រកាសក្រសួងមហាផ្ទៃ',
                    'issue_date' => '2001-04-30',
                    'note' => '',
                    'east' => 'ខេត្តតាកែវ',
                    'west' => 'ខេត្តកោះកុង​ និងខេត្តព្រះសីហនុ',
                    'south' => 'ខេត្តកែប ​និងប្រទេសវៀតណាម',
                    'north' => 'ខេត្តកំពង់ស្ពឺ',
                    'latlng' => '10.6, 104.166667',
                    'order' => '8',
                    'created_at' => time(),
                    'updated_at' => time()
                ),
                array(
                    'caption' => 'កណ្តាល',
                    'caption_en' => 'Kandal',
                    'area_code' => '08',
                    'reference' => '	ប្រកាសលេខ ៤៩៣ ប្រ.ក តាមប្រកាសក្រសួងមហាផ្ទៃ',
                    'issue_date' => '2001-04-30',
                    'note' => '',
                    'east' => 'ខេត្តព្រៃវែង',
                    'west' => 'ខេត្តកំពង់ស្ពឺ',
                    'south' => 'ខេត្តតាកែង​និងប្រទេសវៀតណាម',
                    'north' => 'ខេត្តកំពង់ឆ្នាំង​និងខេត្តកំពង់ចាម',
                    'latlng' => '11.460260167049281, 104.94485247778323',
                    'order' => '9',
                    'created_at' => time(),
                    'updated_at' => time()
                ),
                array(
                    'caption' => 'កែប',
                    'caption_en' => 'Kep',
                    'area_code' => '23',
                    'reference' => '	ព្រះរាជក្រឹត្យលេខ នស/រកត/១២០៨/១៣៨៣',
                    'issue_date' => '2008-12-22',
                    'note' => 'បានប្តូរឈ្មោះក្រុងកែបទៅជាខេត្តកែប',
                    'east' => 'ខេត្តកំពត',
                    'west' => 'សមុទ្រ',
                    'south' => 'សមុទ្រ',
                    'north' => 'ខេត្តកំពត',
                    'latlng' => '10.483333, 104.3',
                    'order' => '10',
                    'created_at' => time(),
                    'updated_at' => time()
                ),
                array(
                    'caption' => 'កោះកុង',
                    'caption_en' => 'Koh Kong',
                    'area_code' => '09',
                    'reference' => '	ប្រកាសលេខ ៤៩៣ ប្រ.ក តាមប្រកាសក្រសួងមហាផ្ទៃ',
                    'issue_date' => '2001-04-30',
                    'note' => '',
                    'east' => 'ខេត្តកំពង់ស្ពឺ និងខេត្តកំពត',
                    'west' => 'ប្រទេសថៃឡង់ដ៏',
                    'south' => 'ខេត្តព្រះសីហនុ',
                    'north' => 'ខេត្តពោធិសាត់',
                    'latlng' => '11.399167, 103.494722',
                    'order' => '11',
                    'created_at' => time(),
                    'updated_at' => time()
                ),
                array(
                    'caption' => 'ក្រចេះ',
                    'caption_en' => 'Kratié',
                    'area_code' => '10',
                    'reference' => '	ប្រកាសលេខ ៤៩៣ ប្រ.ក តាមប្រកាសក្រសួងមហាផ្ទៃ',
                    'issue_date' => '2001-04-30',
                    'note' => '',
                    'east' => 'ខេត្តមណ្ឌលគិរី',
                    'west' => 'ខេត្តកំពង់ធំ',
                    'south' => 'ខេត្តកំពង់ចាម',
                    'north' => 'ខេត្តស្ទឹងត្រែង',
                    'latlng' => '12.483333, 106.016667',
                    'order' => '12',
                    'created_at' => time(),
                    'updated_at' => time()
                ),
                array(
                    'caption' => 'មណ្ឌលគីរី',
                    'caption_en' => 'Mondol Kiri',
                    'area_code' => '11',
                    'reference' => '	ប្រកាសលេខ ៤៩៣ ប្រ.ក តាមប្រកាសក្រសួងមហាផ្ទៃ',
                    'issue_date' => '2001-04-30',
                    'note' => '',
                    'east' => 'ប្រទេសវៀតណាម',
                    'west' => 'ខេត្តក្រចេះ',
                    'south' => 'ខេត្តក្រចេះ និងប្រទេសាវៀតណាម',
                    'north' => 'ខេត្តរតនគិរី និងខេត្តស្ទឹងត្រែង',
                    'latlng' => '12.45, 107.233333',
                    'order' => '13',
                    'created_at' => time(),
                    'updated_at' => time()
                ),
                array(
                    'caption' => 'ឧត្តរមានជ័យ',
                    'caption_en' => 'Otdar Meanchey',
                    'area_code' => '22',
                    'reference' => '	ប្រកាសលេខ ៤៩៣ ប្រ.ក តាមប្រកាសក្រសួងមហាផ្ទៃ',
                    'issue_date' => '2001-04-30',
                    'note' => '',
                    'east' => 'ខេត្តព្រះវិហារ',
                    'west' => 'ខេត្តបន្ទាយមានជ័យ និងប្រទេសថៃឡង់ដ៍',
                    'south' => 'ខេត្តសៀមរាប និងខេត្តបន្ទាយមានជ័យ',
                    'north' => 'ប្រទេសថៃឡង់ដ៍',
                    'latlng' => '14.166667, 103.5',
                    'order' => '14',
                    'created_at' => time(),
                    'updated_at' => time()
                ),
                array(
                    'caption' => 'បៃលិន',
                    'caption_en' => 'Pailin',
                    'area_code' => '24',
                    'reference' => '	ព្រះរាជក្រឹត្យលេខ នស/រកត/១២០៨/១៣៨៥',
                    'issue_date' => '2008-12-22',
                    'note' => 'ប្តូរក្រុងប៉ៃលិនទៅជាខេត្តប៉ៃលិន',
                    'east' => 'ខេត្ត​បាត់ដំបង',
                    'west' => 'ប្រទេសថៃឡង់ដ៏',
                    'south' => 'ខេត្ត​បាត់ដំបង',
                    'north' => 'ខេត្ត​បាត់ដំបង',
                    'latlng' => '12.850556, 102.609444',
                    'order' => '15',
                    'created_at' => time(),
                    'updated_at' => time()
                ),
                array(
                    'caption' => 'ព្រះសីហនុ',
                    'caption_en' => 'Preah Sihanouk',
                    'area_code' => '18',
                    'reference' => 'ព្រះរាជក្រឹត្យលេខ នស/រកត/១២០៨/១៣៨៥',
                    'issue_date' => '2001-04-30',
                    'note' => '',
                    'east' => 'សមុទ្រ',
                    'west' => 'ខេត្តកោះកុង និងសមុទ្រ',
                    'south' => 'សមុទ្រ',
                    'north' => 'ខេត្តកំពត',
                    'latlng' => '10.623333, 103.525',
                    'order' => '16',
                    'created_at' => time(),
                    'updated_at' => time()
                ),
                array(
                    'caption' => 'ព្រះវិហារ',
                    'caption_en' => 'Preah Vihear',
                    'area_code' => '13',
                    'reference' => '	ប្រកាសលេខ ៤៩៣ ប្រ.ក តាមប្រកាសក្រសួងមហាផ្ទៃ',
                    'issue_date' => '2001-04-30',
                    'note' => '',
                    'east' => 'ខេត្តស្ទឹងត្រែង',
                    'west' => 'ខេត្តសៀមរាប និងខេត្តឧត្តរមានជ័យ',
                    'south' => 'ខេត្តកំពង់ធំ',
                    'north' => 'ប្រទេសថៃឡង់ដ៏',
                    'latlng' => '13.783333, 104.966667',
                    'order' => '17',
                    'created_at' => time(),
                    'updated_at' => time()
                ),
                array(
                    'caption' => 'ព្រៃវែង',
                    'caption_en' => 'Prey Veng',
                    'area_code' => '14',
                    'reference' => '	ប្រកាសលេខ ៤៩៣ ប្រ.ក តាមប្រកាសក្រសួងមហាផ្ទៃ',
                    'issue_date' => '2001-04-30',
                    'note' => '',
                    'east' => 'ខេត្តស្វាយរៀង',
                    'west' => 'ខេត្តកណ្ដាល',
                    'south' => 'ប្រទេសវៀតណាម',
                    'north' => 'ខេត្តកំពង់ចាម',
                    'latlng' => '11.483333, 105.333333',
                    'order' => '18',
                    'created_at' => time(),
                    'updated_at' => time()
                ),
                array(
                    'caption' => 'ពោធិ៍សាត់',
                    'caption_en' => 'Pursat',
                    'area_code' => '15',
                    'reference' => '	ប្រកាសលេខ ៤៩៣ ប្រ.ក តាមប្រកាសក្រសួងមហាផ្ទៃ',
                    'issue_date' => '2001-04-30',
                    'note' => '',
                    'east' => 'ខេត្តកំពង់ស្ពឺ​ខេត្តកំពង់ឆ្នាំង​និងខេត្តកំពង់ធំ',
                    'west' => 'ខេត្តបាត់ដំបង',
                    'south' => 'ខេត្តកោះកុង​និងប្រទេសថៃឡង់ដ៏',
                    'north' => 'ខេត្តសៀមរាប',
                    'latlng' => '12.533333, 103.916667',
                    'order' => '19',
                    'created_at' => time(),
                    'updated_at' => time()
                ),
                array(
                    'caption' => 'រតនគីរី',
                    'caption_en' => 'Ratanak Kiri',
                    'area_code' => '16',
                    'reference' => '	ប្រកាសលេខ ៤៩៣ ប្រ.ក តាមប្រកាសក្រសួងមហាផ្ទៃ',
                    'issue_date' => '2001-04-30',
                    'note' => '',
                    'east' => 'ប្រទេសវៀតណាម',
                    'west' => 'ខេត្តស្ទឹងត្រែង',
                    'south' => 'ខេត្តមណ្ឌលគីរី និងប្រទេសវៀតណាម',
                    'north' => 'ប្រទេសឡាវ',
                    'latlng' => '13.733333, 107',
                    'order' => '20',
                    'created_at' => time(),
                    'updated_at' => time()
                ),
                array(
                    'caption' => 'សៀមរាប',
                    'caption_en' => 'Siem Reap',
                    'area_code' => '17',
                    'reference' => '	ប្រកាសលេខ ៤៩៣ ប្រ.ក តាមប្រកាសក្រសួងមហាផ្ទៃ',
                    'issue_date' => '2001-04-30',
                    'note' => '',
                    'east' => 'ខេត្តព្រះវិហារ',
                    'west' => 'ខេត្តបន្ទាយមានជ័យ និងខេត្តបាត់ដំបង',
                    'south' => 'បឹងទន្លេសាប និងខេត្តកំពង់ធំ',
                    'north' => 'ខេត្តឧត្តរមានជ័យ',
                    'latlng' => '13.35, 103.85',
                    'order' => '21',
                    'created_at' => time(),
                    'updated_at' => time()
                ),
                array(
                    'caption' => 'ស្ទឹងត្រែង',
                    'caption_en' => 'Stung Treng',
                    'area_code' => '19',
                    'reference' => '	ប្រកាសលេខ ៤៩៣ ប្រ.ក តាមប្រកាសក្រសួងមហាផ្ទៃ',
                    'issue_date' => '2001-04-30',
                    'note' => '',
                    'east' => 'ខេត្តរតនគិរី និងខេត្តមណ្ឌលគិរី',
                    'west' => 'ខេត្តព្រះវិហារ និងខេត្តកំពង់ធំ',
                    'south' => 'ខេត្តក្រចេះ',
                    'north' => 'ប្រទេសឡាវ',
                    'latlng' => '13.516667, 105.95',
                    'order' => '22',
                    'created_at' => time(),
                    'updated_at' => time()
                ),
                array(
                    'caption' => 'ស្វាយរៀង',
                    'caption_en' => 'Svay Rieng',
                    'area_code' => '20',
                    'reference' => '	ប្រកាសលេខ ៤៩៣ ប្រ.ក តាមប្រកាសក្រសួងមហាផ្ទៃ',
                    'issue_date' => '2001-04-30',
                    'note' => '',
                    'east' => 'ប្រទេសវៀតណាម',
                    'west' => 'ខេត្តព្រែវែង',
                    'south' => 'ប្រទេសវៀតណាម',
                    'north' => 'ខេត្តកំពង់ចាម',
                    'latlng' => '11.066667, 105.816667',
                    'order' => '23',
                    'created_at' => time(),
                    'updated_at' => time()
                ),
                array(
                    'caption' => 'តាកែវ',
                    'caption_en' => 'Takeo',
                    'area_code' => '21',
                    'reference' => '	ប្រកាសលេខ ៤៩៣ ប្រ.ក តាមប្រកាសក្រសួងមហាផ្ទៃ',
                    'issue_date' => '2001-04-30',
                    'note' => '',
                    'east' => 'ខេត្តកណ្ដាល',
                    'west' => 'ខេត្តកំពត',
                    'south' => 'ប្រទេសវៀតណាម',
                    'north' => 'ខេត្តកំពង់ស្ពឺ',
                    'latlng' => '10.983333, 104.783333',
                    'order' => '24',
                    'created_at' => time(),
                    'updated_at' => time()
                ),
                array(
                    'caption' => 'ត្បូងឃ្មុំ',
                    'caption_en' => 'Tbong Khmum',
                    'area_code' => '25',
                    'reference' => '	ព្រះរាជក្រឹក្យលេខ នស/រកត/១២១៣/១៤៤៥',
                    'issue_date' => '2014-01-06',
                    'note' => '',
                    'east' => 'ខេត្ត​ក្រចេះ និង​ប្រទេស​វៀតណាម',
                    'west' => 'ខេត្ត​កំពង់​ចាម',
                    'south' => 'ខេត្ត​ព្រៃ​វែង និង​ប្រទេស​វៀត​ណាម',
                    'north' => 'ខេត្ត​កំពង់​ចាម​ និង​ខេត្ត​ក្រចេះ',
                    'latlng' => '11.983333, 105.45',
                    'order' => '25',
                    'created_at' => time(),
                    'updated_at' => time()
                ),
            );
            $this->db->insert_batch('location', $data);

	}

	public function down()
	{
            $this->dbforge->drop_table('location');
	}
}