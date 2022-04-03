<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Reset extends Migration
{
    public function up()
    {
        $fields = [
            'id' => [
                'type' => 'INT',
                'constraint' => '11',
                'unsigned' => true,
                'auto_increment' => true
            ],
            'user_id' => [
                'type' => 'INT',
                'unsigned' => true
            ],
            'token' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'null' => false
            ],
            'expires_at DATETIME NOT NULL',
            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL',
            'updated_at DATETIME',
            'deleted_at DATETIME'
        ];

        $this->forge->addField($fields);
        $this->forge->addPrimaryKey('id', true);
        $this->forge->addForeignKey('user_id', 'users', 'user_id', '', 'CASCADE');
        $this->forge->createTable('password_reset');
    }

    public function down()
    {
        $this->forge->dropTable('password_reset');
    }
}
