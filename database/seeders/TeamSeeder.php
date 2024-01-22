<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($t=1;$t<=10;$t++){
            DB::table('team')->insert(
                [
                    'nama'=>uniqid('nama_'),
                    'jabatan'=>'Programmer',
                    'deskripsi'=>'Magni qui quod omnis unde et eos fuga et exercitationem. Odio veritatis perspiciatis quaerat qui aut aut aut',
                    'created_at'=> new \DateTime,
                ]
                );
        }
    }
}
