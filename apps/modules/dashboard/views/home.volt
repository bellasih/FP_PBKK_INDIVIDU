{% extends "../layouts/base.volt" %}

{% block title %}Beranda{% endblock %}

{% block content %}
<div id="page-container" class="sidebar-inverse side-scroll page-header-fixed main-content-boxed">
    <main id="main-container" style="padding-top: 5vw">
        <div class="content" style="padding-top: 0">
            <h1 class="text-center text-secondary"><span class="text-danger">Selamat Datang</span><br> 
            di ServiceLaundry.com</h1>
            <hr id="line">
            <div class="row-center">
                <div id="demo" class="carousel slide" data-ride="carousel" data-interval="5000" data-pause="hover">
                    <ol class="carousel-indicators">
                        <li data-target="#demo" data-slide-to="0" class="active"></li>
                        <li data-target="#demo" data-slide-to="1"></li>
                        <li data-target="#demo" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner" style="margin-left:12vw;">
                        <div class="carousel-item active">
                            <img class="img img-fluid img-responsive" src="{{url('assets/gambar3.jpg')}}" alt="Gambar 1">
                        </div>
                        <div class="carousel-item">
                            <img class="img img-fluid img-responsive" src="{{url('assets/gambar1.jpg')}}" alt="Gambar 2">
                        </div>
                        <div class="carousel-item">
                            <img class="img img-fluid img-responsive" src="{{url('assets/gambar2.jpg')}}" alt="Gambar 3">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#demo" data-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#demo" data-slide="next">
                        <span class="carousel-control-next-icon"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </main>
</div>
{% endblock %}