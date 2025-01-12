<?php

namespace Database\Seeders;

use App\Models\Mahasiswa;
use App\Models\Supervisi;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        //superadmin
        $superadmin = User::firstOrNew(
        [
            'email' => 'superadmin@demo.test',
        ],
            [
            'name' => 'Super Admin Role',
            'password' => bcrypt('12345678'),
        ]);

        if (!$superadmin->exists) {
            $superadmin->save();
            $superadmin->assignRole('superadmin');
        }

        //supervisor
        $spv = Supervisi::create([
            'email' => 'supervisirole@demo.test',
            'nama' => 'Supervisi'
        ]);

        $spv = User::firstOrNew(
        [
            'email' => 'supervisirole@demo.test',
        ],
            [
            'name' => 'Supervisor',
            'password' => bcrypt('12345678'),
        ]);

        if (!$spv->exists) {
            $spv->save();
            $spv->assignRole('supervisi');
        }
    }
}
