@extends('yonetim.layouts.master')
@section('title','Anasehife')
@section('content')

 <h1 class="page-header">Dashboard</h1>

                <section class="row text-center placeholders">
                    <div class="col-6 col-sm-3">
                        <div class="panel panel-primary">
                            <div class="panel-heading">Bekleyen sifaris</div>
                            <div class="panel-body">
                                <h4>{{ $istatistikler['bekleyen_sifaris'] }}</h4>

                                <p>adet</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-sm-3">
                        <div class="panel panel-primary">
                            <div class="panel-heading">Tamamlanan sifaris</div>
                            <div class="panel-body">
                                <h4>{{ $istatistikler['tamamlanan_sifaris'] }}</h4>
                                <p>adet</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-sm-3">
                        <div class="panel panel-primary">
                            <div class="panel-heading">Urun</div>
                            <div class="panel-body">
                                <h4>{{ $istatistikler['toplam_urun'] }}</h4>
                                <p>adet</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-sm-3">
                        <div class="panel panel-primary">
                            <div class="panel-heading">Kullanici</div>
                            <div class="panel-body">
                                <h4>{{ $istatistikler['bekleyen_sifaris'] }}{{ $istatistikler['toplam_kullanici'] }}</h4>
                                <p>kisi</p>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="row">
                    <div class="col-sm-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">Cok satan urunler</div>
                            <div class="panel-body">
                                <canvas id="Chartcoksatan" width="400" height="400"></canvas>
                            </div>
                            

                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">Aylara gore satislar</div>
                            <div class="panel-body">
                                <canvas id="Chartaylaragoresatis" width="400" height="400"></canvas>
                            </div>
                            

                        </div>
 
                    </div>
                </section>
@endsection()
@section('footer')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js"></script>


<script>
   
   
 @php 
     
        $labels="";
       $data="";
       foreach($cok_satan_urunler as $rapor){
        $labels .= "\"$rapor->urun_adi\" , ";
         $data .= " $rapor->adet, ";
       }

    @endphp
var ctx1 = document.getElementById("Chartcoksatan").getContext('2d');
var Chartcoksatan = new Chart(ctx1, {
    type: 'horizontalBar',
    data: {
        labels: [{!! $labels !!}],
        datasets: [{
            label: '# of Votes',
            data: [{!!  $data !!}],
           
            borderColor: 'rgb(255,99,132)',
            borderWidth: 1
        }]
    },
    options: {
        
        scales: {
            xAxes: [{
                ticks: {
                    beginAtZero:true,
                    stepSize:1
                }
            }]
        }
    }
});
@php 
     
        $labels="";
       $data="";
       foreach($aylara_gore_satislar as $rapor){
        $labels .= "\"$rapor->ay\" , ";
         $data .= " $rapor->adet, ";
       }

    @endphp
var ctx2 = document.getElementById("Chartaylaragoresatis").getContext('2d');
var Chartaylaragoresatis = new Chart(ctx2, {
    type: 'line',
    data: {
        labels: [{!! $labels !!}],
        datasets: [{
            label: '# of Votes',
            data: [{!!  $data !!}],
           
            borderColor: '#f4645f',
            borderWidth: 1
        }]
    },
    options: {
        
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true,
                    stepSize:1
                }
            }]
        }
    }
});
</script>
@endsection()