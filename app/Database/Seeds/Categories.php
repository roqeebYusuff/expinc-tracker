<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Categories extends Seeder
{
    public function run()
    {
        $data = array(
            ['category' => 'Food'],
            ['category' => 'Housing'],
            ['category' => 'Bills'],
            ['category' => 'Travel'],
            ['category' => 'Party'],
            ['category' => 'Salary'],
            ['category' => 'Other'],
        );

        foreach ($data as $d) {
            $this->db->table('categories')->insert($d);
        }
    }
}
