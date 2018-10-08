<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class kategoriseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
        $id=DB::table("kategori")->insertGetId(['kategori_adi'=>'Elektronik','slug'=>'elekt']);   
        DB::table("kategori")->insert(['kategori_adi'=>'Bilgisayar/Tablet','slug'=>'tel','ust_id'=>$id]);
        DB::table("kategori")->insertGetId(['kategori_adi'=>'Kitab','slug'=>'nns']);   
        DB::table("kategori")->insert(['kategori_adi'=>'Edebiyyat','slug'=>'edeb','ust_id'=>$id]); 
        DB::table("kategori")->insert(['kategori_adi'=>'Cocuk','slug'=>'cocuk','ust_id'=>$id]); 
        DB::table("kategori")->insertGetId(['kategori_adi'=>'Dergi','slug'=>'dergi']);   


   }
}
