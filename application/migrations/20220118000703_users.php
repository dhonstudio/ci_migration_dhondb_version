<?php

class Migration_Users {

    public function __construct()
	{
        $this->migration =& get_instance();
        $this->migration->load->library('dhondb');
    }
    
    public function up()
    {
        $this->migration->dhondb->table = 'users';
        $this->migration->dhondb->constraint('11')->ai()->field('id_user', 'INT');
        $this->migration->dhondb->constraint('100')->field('fullName', 'VARCHAR');
        $this->migration->dhondb->constraint('100')->field('email', 'VARCHAR');
        $this->migration->dhondb->constraint('200')->field('password', 'VARCHAR');
        $this->migration->dhondb->field('stamp', 'INT');
        $this->migration->dhondb->add_key('id_user');   
        $this->migration->dhondb->create_table();
    }
}