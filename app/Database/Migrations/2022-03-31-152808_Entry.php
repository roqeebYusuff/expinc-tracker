<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Entry extends Migration
{
    public function up()
    {
        $fields = [
            'entry_id' => [
                'type' => 'INT',
                'constraint' => '11',
                'unsigned' => true,
                'auto_increment' => true
            ],
            'user_id' => [
                'type' => 'INT',
                'unsigned' => true
            ],
            'type' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
                'null' => false
            ],
            'category' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => false
            ],
            'amount' => [
                'type' => 'DECIMAL',
                'constraint' => '18,2',
                'null' => false
            ],
            'date_added DATE DEFAULT CURRENT_TIMESTAMP NOT NULL',
            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL',
            'updated_at DATETIME',
            'deleted_at DATETIME'
        ];

        $this->forge->addField($fields);
        $this->forge->addPrimaryKey('entry_id', true);
        $this->forge->addForeignKey('user_id', 'users', 'user_id', '', 'CASCADE');
        $this->forge->createTable('entries');
    }

    public function down()
    {
        $this->forge->dropTable('entries');
    }
}
