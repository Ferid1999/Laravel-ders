<?php

use Illuminate\Database\Seeder;
use App\Models\users;
use App\Models\kullanicidetay;
class Kullaniciseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker\Generator $faker)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        users::truncate();
        kullanicidetay::truncate();

        $kullanici_yonetici=users::create([
             
             'adsoyad'=>'Ferid Ehmedov',
             'email'=>'feridehmedov1999@gmail.com',
             'sifre'=>bcrypt("123456"),
             'aktif_mi'=>1,
             'yonetici_mi'=>1
        ]);
         $kullanici_yonetici->detay()->create([
          'adres'=>'Ankara',
          'telefon'=>'54666666666',
          'ceptelefon'=>'648798789489'
         ]);

         for ($i=0; $i <50 ; $i++) { 
         	
         	$kullanici_musteri=users::create([
             'adsoyad'=>$faker->name,
             'email'=>$faker->unique()->safeEmail,
             'sifre'=>bcrypt("123456"),
             'aktif_mi'=>1,
             
         	]);
         	$kullanici_musteri->detay()->create([
          'adres'=>$faker->address,
          'telefon'=>$faker->e164PhoneNumber,
          'ceptelefon'=>$faker->e164PhoneNumber
               ]);

           
         }
          DB::statement('SET FOREIGN_KEY_CHECKS=1;');


    }
}
