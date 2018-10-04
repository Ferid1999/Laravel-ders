<h1>{{config('app.name')}}</h1>
<p>Kayd basarili sekilde yapildi.</p>
<p>Kaydinizi aktivlesdirmek icin <a href="{{ config('app.url')}}/kullanici/aktiflestir/{{ $kullanici->aktivasyon_anahtari}}">tiklayin</a> ve ya asagiaki baglanitiyi tarayicida ac</p>
<p>{{ config('app.url')}}/kullanici/aktiflestir/{{ $kullanici->aktivasyon_anahtari}}</p>