<?php

Class DhonDB {
    public $db;
    public $table;
    public $constraint;
    public $unique;
    public $ai;
    public $fields = [];
    public $version;

    public function __construct()
	{
        $this->dhondb =& get_instance();

        $this->dhondb->load->dbutil();
        $this->dhondb->load->dbforge();

        $this->dbutil   = $this->dhondb->dbutil;
        $this->dbforge  = $this->dhondb->dbforge;
        $this->load     = $this->dhondb->load;
    }

    public function constraint(string $value)
    {
        $this->constraint = $value;
        return $this;
    }

    public function unique()
    {
        $this->unique = TRUE;
        return $this;
    }

    public function ai()
    {
        $this->ai = TRUE;
        return $this;
    }

    public function field(string $field_name, string $type, string $nullable = '')
    {
        $constraint = $this->constraint != '' ? $this->constraint : '';
        $unique     = $this->unique == TRUE ? TRUE : FALSE;
        $ai         = $this->ai == TRUE ? TRUE : FALSE;
        $null       = $nullable == 'nullable' ? TRUE : FALSE;

        $field_element = [
            $field_name => [
                'type' => $type,
                'constraint' => $constraint,
                'unique' => $unique,
                'auto_increment' => $ai,
                'null' => $null
            ]
        ];

        $this->fields = array_merge($this->fields, $field_element);
        $this->constraint = '';
        $this->unique = FALSE;
        $this->ai = FALSE;
    }

    public function add_key($field_name)
    {
        $this->dbforge->add_key($field_name, TRUE);
    }

    public function create_database()
    {
        $dbs = $this->dbutil->list_databases();
        if (!in_array($this->db['name'], $dbs)) $this->dbforge->create_database($this->db['name']);
        else {
            $this->dbforge->drop_database($this->db['name']);
            $this->dbforge->create_database($this->db['name']);
        }

        $this->create_table();
    }

    public function create_table()
    {
        if ($this->dhondb->db->table_exists($this->table)) $this->dbforge->drop_table($this->table);
        $this->dbforge->add_field($this->fields);
        $this->dbforge->create_table($this->table);

        $this->fields = [];
    }

    public function migrate($classname)
    {
        require APPPATH."migrations\\".$this->version.'_'.$classname.'.php';
        $migration_name = "Migration_{$classname}";
        $migration      = new $migration_name();
        $migration->up();
    }
}