<?php

namespace App\Http\Controllers\yonetim;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
class Anasehifecontroller extends Controller
{
    public function index(){
            
            $cok_satan_urunler=DB::select("
                   SELECT u.urun_adi, SUM(su.adet) as 'adet'
                   FROM sifaris si
                   INNER JOIN sepet s ON s.id=si.sepet_id
                   INNER JOIN sepet_urun su ON s.id=su.sepet_id
                   INNER JOIN urun u ON u.id=su.urun_id
                   GROUP BY u.urun_adi
                   ORDER BY SUM(su.adet) DESC


            	");
             $aylara_gore_satislar=DB::select("
                   SELECT
                   DATE_FORMAT(si.yaratma_tarixi, '%Y-%m') ay, sum(su.adet) adet
                   FROM sifaris si
                   INNER JOIN sepet s ON s.id=si.sepet_id
                   INNER JOIN sepet_urun su ON s.id=su.sepet_id
                   
                   GROUP BY DATE_FORMAT(si.yaratma_tarixi, '%Y-%m')
                   ORDER BY DATE_FORMAT(si.yaratma_tarixi, '%Y-%m') 

              ");
            
    	return view('yonetim.anasehife',compact('cok_satan_urunler','aylara_gore_satislar'));
    }
}
