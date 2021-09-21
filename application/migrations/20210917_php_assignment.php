<?php defined('BASEPATH') or exit('No direct script access allowed');
class Migration_Initial_Schema extends CI_Migration
{

    public function up()
    {
        $this->dbforge->add_field(array(
            'company_id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true
            ) ,
            'company_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
            ) ,
            'company_email' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
            ) ,
            'logo' => array(
                'type' => 'VARCHAR',
                'constraint' => '255'
            ) ,
            'Website' => array(
                'type' => 'VARCHAR',
                'constraint' => '255'
            ) ,
        ));
        $this->dbforge->add_key('company_id', true);
        $this->dbforge->create_table('company');

        $this
            ->dbforge
            ->add_field(array(
            'employee_id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true
            ) ,
            'first_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
            ) ,
            'last_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
            ) ,
            'company_id' => array(
                'type' => 'INT',
                'constraint' => '5'
            ) ,
            'email' => array(
                'type' => 'VARCHAR',
                'constraint' => '255'
            ) ,
            'phone' => array(
                'type' => 'VARCHAR',
                'constraint' => '10'
            ) ,
        ));

        $this->dbforge->add_key('employee_id', true);
        $this->dbforge->create_table('employee');

        $this->db->query(add_foreign_key('employee', 'company_id', 'company(company_id)', 'CASCADE', 'CASCADE'));
    }

    public function down()
    {
        $this->dbforge->drop_table('company');
        $this->dbforge->drop_table('employee');
        $this->db->query(drop_foreign_key('employee', 'company_id'));
    }
}

