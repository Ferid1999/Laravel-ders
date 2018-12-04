 <div class="list-group">
                    <a href="{{ route('yonetim.anasehife')}}" class="list-group-item">
                        <span class="fa fa-fw fa-dashboard"></span> Giris</a>
                    <a href="{{ route('yonetim.urun')}}" class="list-group-item">
                        <span class="fa fa-fw fa-dashboard"></span> Urunler
                        <span class="badge badge-dark badge-pill pull-right">{{ $istatistikler['toplam_urun']}}</span>
                    </a>
                        <a href="{{ route('yonetim.kategori')}}" class="list-group-item">
                        <span class="fa fa-fw fa-dashboard"></span> Kategoriler
                        <span class="badge badge-dark badge-pill pull-right">{{ $istatistikler['toplam_kategori']}}</span>
                    </a>
                    <a href="#" class="list-group-item collapsed" data-target="#submenu1" data-toggle="collapse" data-parent="#sidebar"><span class="fa fa-fw fa-dashboard"></span> Kategori Urunleri<span class="caret arrow"></span></a>
				  <div class="list-group collapse" id="submenu1">
					<a href="#" class="list-group-item">Category</a>
					<a href="#" class="list-group-item">Category</a>
				  </div>
                    <a href="{{ route('yonetim.kullanici')}}" class="list-group-item">
                        <span class="fa fa-fw fa-dashboard"></span> Kullanicilar
                        <span class="badge badge-dark badge-pill pull-right">{{ $istatistikler['toplam_kullanici']}}</span>
                    </a>
                    <a href="{{ route('yonetim.sifaris')}}" class="list-group-item">
                        <span class="fa fa-fw fa-dashboard"></span> Sifarisler
                        <span class="badge badge-dark badge-pill pull-right">{{ $istatistikler['bekleyen_sifaris'] }}</span>
                    </a>
                    <a href="#" class="list-group-item">
                        <span class="fa fa-fw fa-dashboard"></span> Orders
                        <span class="badge badge-dark badge-pill pull-right">14</span>
                    </a>
                </div>