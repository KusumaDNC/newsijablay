{{View::make('claravel::portal.header')}}<?php $rolebahasa = \Session::get('bahasa');?><section id="home-cta" class="well well-lg wow fadeInDown" data-wow-delay="1s">    <!-- slider -->    <div class="camera_wrap camera_orange_skin" id="slider1">        <?php $rssliders = \DB::table('image_slider')->where('flag_portal', 1)->orderBy('order', 'asc')->get(); ?>        @if(count($rssliders) > 0)            @foreach($rssliders as $rsslider)                <div data-src="{{asset('/packages/upload/slider/'.$rsslider->img)}}">                    {{-- <div class="camera_caption fadeIn">                         <a href="{{$rsslider->link}}">{{$rsslider->caption}}                        </a>                       {{$rsslider->caption}}                    </div>--}}                </div>            @endforeach        @endif    </div><!-- #slider1 --></section><section class="dento-about-us-area section-padding-50">    <div class="container">        <div class="row align-items-center">            <!-- About Us Thumbnail -->            <div class="col-12">                <div class="section-heading text-center wow bounceIn" data-wow-delay=".5">                    <h3>BERITA TERBARU</h3>                    <div class="line"></div>                </div>            </div>        </div>        <div class="row slick-carousel-1 wow fadeInDown" data-wow-delay=".5s" data-wow-offset="360">            <?php $posts = get_posts_by_cat('Berita',6,'tgl_publish','desc'); ?>            @foreach($posts as $post)                <?php                if(@$post->fav != ''){                    if(file_exists('./packages/photo/'.@$post->fav)){                        $img = asset('/packages/photo/'.@$post->fav);                    }else{                        $img = asset('/packages/photo/noimage.jpg');                    }                }else{                    $img = asset('/packages/photo/noimage.jpg');                }                ?>                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">                    <figure class="materi-item" style="background-image:url({{$img}});">                        <figcaption>                            <h3 class="materi-judul"><a href="{{url()."/p/".$post->id."/".$post->url}}">{{($rolebahasa=='en')?$post->titel_english:$post->titel}}</a></h3>                            <span class="waktu-upload"><i class="fa fa-fw fa-calendar-plus-o"></i> {{@tanggal($post->tgl_publish)}} {{@jam(substr($post->tgl_publish,11,5))}}</span> &nbsp;&nbsp;                            <a href="{{url()}}" class="materi-kategori"><i class="fa fa-fw fa-tag"></i> {{$post->category}} </a>                                                  </figcaption>                    </figure>                </div>            @endforeach        </div>        <div class="col-12">            <div class="more-btn text-center mt-50 mb-50 wow bounceIn" data-wow-delay=".5">                <a href="{{url()}}/category/berita%20lain" class="btn dento-btn" target="_blank">Berita Lain <i class="fa fa-angle-double-right"></i></a>            </div>        </div>    </div></section><section class="dento-cta-area bg-img bg-gradient-overlay jarallax clearfix section-padding-100 " style="background-image: url('assets/images/simpanglima.jpg');">    <div class="more-btn text-center wow bounceIn" data-wow-delay=".5">        <a href="http://perizinan.jatengprov.go.id/portal" class="btn dento-btn-x" target="_blank">Lacak Perizinan <i class="fa fa-angle-double-right"></i></a>    </div></section><!-- Cool Facts Area End --><section class="dento-blog-area section-padding-50 clearfix">    <div class="container">        <div class="row">            <!-- Section Heading -->            <div class="col-12">                <div class="section-heading text-center wow bounceIn" data-wow-delay=".5">                    <h3>SOSIAL MEDIA</h3>                    <div class="line"></div>                </div>            </div>        </div>        <div class="row">            <!-- Single Blog Item -->            <div class="col-12 col-md-6 col-lg-4 wow fadeInUp" data-wow-delay=".5s">                <div class="single-blog-item mb-100">                    <!-- Blog Content -->                    <div class="blog-content">                        <div id="social-fb">                            <script>(function(d, s, id) {                                    var js, fjs = d.getElementsByTagName(s)[0];                                    if (d.getElementById(id)) return;                                    js = d.createElement(s); js.id = id;                                    js.src = 'https://connect.facebook.net/id_ID/sdk.js#xfbml=1&version=v3.2';                                    fjs.parentNode.insertBefore(js, fjs);                                }(document, 'script', 'facebook-jssdk'));</script>                            <div class="fb-page" data-href="https://www.facebook.com/Dinas-Penanaman-Modal-dan-Pelayanan-Terpadu-Satu-Pintu-Jawa-Tengah-981841568616758/" data-tabs="timeline" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/facebook" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/facebook">Facebook</a></blockquote></div>                        </div>                    </div>                </div>            </div>            <!-- Single Blog Item -->            <div class="col-12 col-md-6 col-lg-4 wow fadeInUp" data-wow-delay=".75s">                <div class="single-blog-item mb-100">                    <!-- Blog Content -->                    <div class="blog-content">                        <div id="social-twitter">                            <a class="twitter-timeline" href="https://twitter.com/DPMPTSPJateng" data-widget-id="724824588186701827">Tweets by @DPMPTSPJateng</a>                            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>                        </div>                    </div>                </div>            </div>            <!-- Single Blog Item -->            <div class="col-12 col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="1s">                <div class="single-blog-item mb-100">                    <!-- Blog Content -->                    <div class="blog-content">                        <div id="social-instagram">                            <h4>Instagram (@ptspjateng)</h4>                        <!-- LightWidget WIDGET --><script src="https://cdn.lightwidget.com/widgets/lightwidget.js"></script><iframe src="//lightwidget.com/widgets/aa8d82ca27f75c1284397cb8cc7ddfbf.html" scrolling="no" allowtransparency="true" class="lightwidget-widget" style="width:100%;border:0;overflow:hidden;"></iframe>                        </div>                    </div>                </div>            </div>            <!-- Single Blog Item -->            <div class="col-12 wow fadeInUp" data-wow-delay="1s">                <div class="single-blog-item mb-100">                        <div id="social-youtube" align="center">                          {{--<script src="https://cdn.lightwidget.com/widgets/lightwidget.js"></script>--}}                            <iframe width="560" height="315" src="https://www.youtube.com/embed/videoseries?list=PL7rzjjxI1j8O1rugiXVfEVFuCyBGF1zL6" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>                        </div>                </div>            </div>        </div>    </div></section><section class="dento-cta-area bg-img bg-gradient-overlay jarallax clearfix section-padding-100 " style="background-image: url('assets/images/tugumuda.jpg');">    <div class="more-btn text-center wow bounceIn" data-wow-delay=".5">        <a href="http://web.dpmptsp.jatengprov.go.id/pengajuan_informasi/" class="btn dento-btn-x" target="_blank">Permohonan Informasi Publik <i class="fa fa-angle-double-right"></i></a>    </div></section><section class="testimonials-area section-padding-50 clearfix">    <div class="container">        <div class="col-12">            <div class="section-heading text-center wow bounceIn mb-50" data-wow-delay=".5s">                <h3>MAKLUMAT PELAYANAN</h3>                <div class="line"></div>            </div>        </div>        <div class="col-12">            <div class="testimonial-content wow bounceIn" data-wow-delay=".5s">                <?php                $row = \DB::table('main_menu')->where('id', 84)->first();                echo $row->konten;                ?>            </div>        </div>    </div></section><section class="dento-services-area bg-img bg-gradient-overlay jarallax clearfix section-padding-0 " style="background-image: url('assets/images2/415126.jpg');">    <div class="container">        <div class="col-12 col-sm-6 col-lg-3 col-md-offset-0 col-sm-offset-2">            <div class="single-service--area text-center mb-50 mt-50 wow bounceIn" data-wow-delay=".25s">                <div class="icon--">                    <a href="http://perizinan.jatengprov.go.id/portal" target="_blank"><img src="/assets/images2/iconfinder_18_2958204.png" alt=""></a>                </div>                <h5>PERIZINAN</h5>            </div>        </div>        <!-- Single Service Area -->        <div class="col-12 col-sm-6 col-lg-2">            <div class="single-service--area text-center mb-50 mt-50 wow bounceIn" data-wow-delay=".5s">                <div class="icon--">                    <a href="http://cjip.jatengprov.go.id" target="_blank"><img src="/assets/images2/iconfinder_19_2958203.png" alt=""></a>                </div>                <h5>INVESTASI</h5>            </div>        </div>        <!-- Single Service Area -->        <div class="col-12 col-sm-6 col-lg-2">            <div class="single-service--area text-center mb-50 mt-50 wow bounceIn" data-wow-delay=".75s">                <div class="icon--">                    <a href="https://www.oss.go.id/oss/" target="_blank"><img src="/assets/images2/iconfinder_13_2958199.png" alt=""></a>                </div>                <h5>OSS</h5>            </div>        </div>        <!-- Single Service Area -->        <div class="col-12 col-sm-6 col-lg-2">            <div class="single-service--area text-center mb-50 mt-50 wow bounceIn" data-wow-delay="1s">                <div class="icon--">                    <a href="https://www.lapor.go.id/" target="_blank"><img src="/assets/images2/iconfinder_4_2958190.png" alt=""></a>                </div>                <h5>PENGADUAN</h5>            </div>        </div><!-- Single Service Area -->        <div class="col-12 col-sm-6 col-lg-3">            <div class="single-service--area text-center mb-50 mt-50 wow bounceIn" data-wow-delay=".5s">                <div class="icon--">                    <a href="https://1drv.ms/xs/s!AgOgGJpeJu53cUUFO0lEjxRqeLs" target="_blank"><img src="/assets/images2/28510 [Converted].png" alt=""></a>                </div>                <h5>LAPOR LOI</h5>            </div>        </div>    </div></section><!-- Dento Pricing Table Area Start --><section class="dento-pricing-table-area section-padding-50">    <div class="container">        <!-- Section Heading -->        <div class="col-12">            <div class="section-heading text-center wow bounceIn" data-wow-delay=".5s">                <h3>STATISTIK</h3>                <div class="line"></div>            </div>        </div>        <div class="section-heading">            Statistik Perizinan            <span class="indeks"><a href="{{url()}}/statistik_perizinan">indeks</a></span>        </div>        <div>            <?php            $rschart = \DB::table('statistik_perizinan')->orderBy('tanggal', 'desc')->first();            $label = explode(";",$rschart->label);            $value = explode(";",$rschart->value);            $n  =  count($label);            ?>            <div class="table-responsive wow bounceIn" data-wow-delay="1s">                <div id="container" style="min-width: 450px; height: 400px; margin: 0 auto"></div>                <table class="table table-hover" id='datatable' style="display: none">                    <tr>                        <td>Perizinan</td>                        <td>Jumlah</td>                    </tr>                    <?php  for($i = 0; $i < $n; $i++){?>                    <tr>                        <td>{{$label[$i]}}</td>                        <td>{{$value[$i]}}</td>                    </tr>                    <?php } ?>                </table>            </div>        </div>        <div class="section-heading">            Statistik Realisasi Investasi            <span class="indeks"><a href="{{url()}}/statistik_realisasi">indeks</a></span>        </div>        <form action="" method="post">            <div>                Kategori {{\jenisRealisasi('jenisrealisasi')}}            </div>            <div id="realisasi" class="table-responsive wow bounceIn" data-wow-delay="1s">                <?php                $kat = \DB::table('statistik_realisasi')->orderBy('id')->groupBy('kategori')->first();                $rschart = \DB::table('statistik_realisasi')->where('kategori', @$kat->kategori)->orderBy('tanggal', 'desc')->first();                $label = explode(";",$rschart->label);                $value = explode(";",$rschart->value);                $n  =  count($label);                ?>                <div class="table-responsive">                    <div id="container2" style="min-width: 450px; height: 400px; margin: 0 auto"></div>                    <table class="table table-hover" id='datatable2' style="display: none">                        <tr>                            <td>Perizinan</td>                            <td>Jumlah</td>                        </tr>                        <?php for($i = 0; $i < $n; $i++){?>                        <tr>                            <td>{{$label[$i]}}</td>                            <td>{{$value[$i]}}</td>                            <td>{{$value[$i]}}</td>                        </tr>                        <?php } ?>                    </table>                </div>            </div>        </form>    </div></section><section class="dento-service-area section-padding-100 bg-img bg-gradient-overlay jarallax clearfix" style="background-image: url('assets/images2/502276.jpg');">    <div class="container">        <?php $rstautan_imgs = \DB::table('tautan')->where('jnstautan', 1)->where('flag', 1)->orderBy('order', 'asc')->get(); ?>        <section class="customer-logos slider">            @foreach($rstautan_imgs as $rstautan)                <?php                if(@$rstautan->foto != ''){                    if (file_exists('./packages/upload/galeri/'.@$rstautan->foto)) {                        $img = asset('/packages/upload/galeri/'.@$rstautan->foto);                    } else {                        $img = asset('/assets/images/banner-pranala.jpg');                    }                }else {                    $img = asset('/assets/images/banner-pranala.jpg');                }                ?>                <div class="slide"><a href="{{$rstautan->url}}" target="_blank"><img src="{{$img}}"></a></div>            @endforeach        </section>    </div></section><section class="dento-contact-area mt-30">    <div class="container">        <div class="col-12 col-md-3">            <div class="contact-information wow bounceIn" data-wow-delay=".25s">                <h5>Layanan Pengaduan dan Informasi Perizinan</h5>                <p align="left"><i class="fa fa-phone"></i>&nbsp;08112915173</p>            </div>        </div>        <div class="col-12 col-md-3">            <div class="contact-information wow bounceIn" data-wow-delay=".5s">                <h5>Layanan Informasi OSS</h5>                <p><i class="fa fa-phone"></i>&nbsp;08112915171</p>            </div>        </div>        <div class="col-12 col-md-3">            <div class="contact-information wow bounceIn" data-wow-delay=".75s">                <h5>Layanan Informasi LKPM</h5>                <p><i class="fa fa-phone"></i>&nbsp;08112915172</p>            </div>        </div>        <div class="col-12 col-md-3">            <div class="contact-information wow bounceIn" data-wow-delay="1s">                <h5>Layanan Gangguan Sistem Informasi</h5>                <p><i class="fa fa-phone"></i>&nbsp;08112915174</p>            </div>        </div>                  </div></section>                <section class="dento-contact-area mt-30">                  <div class="container">                	<div class="col-12" align="center">                 		<h4>(Pelayanan pada jam kerja)</h4>                    </div>                  </div>                </section>{{View::make('claravel::portal.footer')}}