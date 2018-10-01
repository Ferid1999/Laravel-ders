<?php

use Illuminate\Database\Seeder;

class kategoriseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("kategori")->insert([
          
        'kategori_adi'=>'nns'
       ]);    }
}
