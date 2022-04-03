<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration
{
    public function up()
    {
        $fields = [
            'user_id' => [
                'type' => 'INT',
                'constraint' => '11',
                'unsigned' => true,
                'auto_increment' => true
            ],
            'first_name' =>[
                'type' => 'varchar',
                'constraint' => '50',
                'null' => false
            ],
            'last_name' =>[
                'type' => 'varchar',
                'constraint' => '50',
                'null' => false
            ],
            'user_name' =>[
                'type' => 'varchar',
                'constraint' => '50',
                'null' => false
            ],
            'email' =>[
                'type' => 'varchar',
                'constraint' => '100',
                'null' => false
            ],
            'password' =>[
                'type' => 'varchar',
                'constraint' => '60',
                'null' => false
            ],
            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL',
            'updated_at DATETIME',
            'deleted_at DATETIME'
        ];

        $this->forge->addField($fields);
        $this->forge->addPrimaryKey('user_id', true);
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
