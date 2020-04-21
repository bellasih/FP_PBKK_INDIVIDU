{% extends "../layouts/base.volt" %}

{% block title %}Dashboard Admin{% endblock %}

{% block content %}
<div id="page-container" class="sidebar-inverse side-scroll page-header-fixed main-content-boxed">
    <main id="main-container" style="padding-top: 5vw">
        <div class="content" style="padding-top: 0">
            <h1 class="text-center text-secondary"><span class="text-danger">Selamat Datang</span> 
            <br>di Halaman Dashboard</h1>
            <hr id="line">
            <div class="row">
                <div class="col-sm">
                    <div class="card" style="height:12vw; background-color:#7ffadc">
                        <p class="text-center"><b>Pendapatan Hari Ini</b></p>
                        <div class="row">
                            <div class="col-sm"><p>{{completed_order}}</p></div>
                            <div class="col-sm"><img src={{url('assets/money.png')}} alt="money" style="height:15vh; float:right"></div>
                        </div>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="card" style="height:12vw; background-color:#facf7f">
                        <p class="text-center"><b>Pesanan Masuk</b></p>
                        <div class="row">
                            <div class="col-sm"><p>{{unprocessed_order}}</p></div>
                            <div class="col-sm"><img src={{url('assets/trolli.png')}} alt="trolli" style="height:15vh; float:right"></div>
                        </div>
                    </div>
                </div>
                <div class="col-sm">
                   <div class="card" style="height:12vw; background-color:#ccfa7f">
                        <p class="text-center"><b>Pesanan Selesai</b></p>
                        <div class="row">
                            <div class="col-sm"><p>{{completed_order}}</p></div>
                            <div class="col-sm"><img src={{url('assets/finish.png')}} alt="finish" style="height:15vh; float:right"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm">
                    <p>nanti disini chart</p>
                </div>
                <div class="col-sm">
                    <div class="table-wrapper">
                        <div class="table-title">
                            <div class="row">
                                <div class="col-sm-8"><h2>Daftar <b>Service Laundry</b></h2></div>
                            </div>
                        </div>
                        {% if datas != null %}
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Service</th>
                                    <th>Harga Service</th>
                                </tr>
                            </thead>
                            <tbody>
                            {% set i = 1 %}
                            {% for t in datas %}
                                <tr>
                                    <td>{{i}}</td>
                                    <td>{{t.getServiceName()}}</td>
                                    <td>{{t.getServicePrice()}}</td>
                                </tr>
                            {% set i = i + 1 %}
                            {% endfor %}
                            </tbody>
                        </table>
                        {% else %}
                            <h2 class="text-danger text-center">Tidak ada data yang dapat ditampilkan</h2>
                        {% endif %}
                    </div>
                </div>
            </div>
        </div>
    </main>
    <a href="#tambahAdminModal" class="tambah" data-toggle="modal"><button class="btn btn-primary btn-circle add-admin-btn" data-toggle="tooltip" title="Tambah Operator" style="width: 60px; height: 60px"><i class="fa fa-user-plus" style="font-size: 30px"></i></button></a>
</div>

<div id="tambahAdminModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">						
                <h4 class="modal-title text-center">Tambah Administrator</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body" style="height:70vh; overflow-y:auto;">
                <form>
                    <div class="form-group">
                        <label><b>{{form.getLabel('name')}}</b></label>
                        {{form.render('name')}}
                    </div>
                    <div class="form-group">
                        <label><b>{{form.getLabel('address')}}</b></label>
                        {{form.render('address')}}
                    </div>
                    <p><b>Jenis Kelamin</b></p>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                {{form.render('P')}}
                                <label>{{form.getLabel('P')}}</label> 
                            </div>	
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                {{form.render('L')}}
                                <label>{{form.getLabel('L')}}</label>
                            </div>	
                        </div>
                    </div>
                    <div class="form-group">
                        <label><b>{{form.getLabel('email')}}</b></label>
                        {{form.render('email')}}
                    </div>
                    <div class="form-group">
                        <label><b>{{form.getLabel('phone')}}</b></label>
                        {{form.render('phone')}}
                    </div>
                    <div class="form-group">
                        <label><b>{{form.getLabel('username')}}</b></label>
                        {{form.render('username')}}
                    </div>
                    <div class="form-group">
                        <label><b>{{form.getLabel('password')}}</b></label>
                        {{form.render('password')}}
                    </div>
                    <div class="form-group">
                        <label><b>{{form.getLabel('profile_img')}}</b></label>
                        {{form.render('profile_img')}}
                    </div>
            </div>
            <div class="modal-footer">
                    <div class="form-group">
                        <div class="text-center">
                            {{form.render('Simpan')}}
                        </div>
                    </div>
                </form>
            </div>
            </div>					
        </div>
    </div>
</div>

{% endblock %}