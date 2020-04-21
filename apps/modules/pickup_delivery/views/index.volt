{% extends "../layouts/base.volt" %}

{% block title %}Dashboard Admin{% endblock %}

{% block content %}
<div id="page-container" class="sidebar-inverse side-scroll page-header-fixed main-content-boxed">
    <main id="main-container" style="padding-top: 5vw">
        <div class="content" style="padding-top: 0">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><h2>Kelola <b>Pickup Delivery Laundry</b></h2></div>
                </div>
                <div class="row">
                    <div class="col-sm-6"></div>
                    <div class="col-sm-6">
                        <a href="#tambahDeliveryModal"  class="btn btn-success" data-toggle="modal"><i class="fa fa-plus"></i><span>Tambah Pickup Delivery</span></a>
                        <a href="#hapusDeliveryModal" id="coba2" class="btn btn-danger" data-toggle="modal"><i class="fa fa-trash-o"></i><span>Hapus</span></a>						
                    </div>
                </div>
            </div>
            {% if page.items != null %}
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th></th>
                        <th>No.</th>
                        <th>Kepemilikan Pesanan</th>
                        <th>Status Pengantaran</th>
                        <th>Nama Pengantar</th>
                        <th>Tipe Pengantaran</th>
                        <th>Estimasi Waktu</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                {% set i = 1, skipped = (page.current-1) * page.limit %}
                    {% for t in page.items %}
                        <tr>
                            <td>
                                <span class="custom-checkbox">
                                    <input type="checkbox" id="checkbox1" name="options" value="{{t.getId()}}">
                                    <label for="checkbox1"></label>
                                </span>
                            </td>
                            <td>{{skipped + i}}</td>
                            <td>{{t.getOrderId()}}</td>
                            <td>{{t.getPdStatus()}}</td>
                            <td>{{t.getPdDriver()}}</td>
                            <td>{{t.getPdType()}}</td>
                            <td>{{t.getPdEstimasi()}}</td>
                            <td>
                                <a href="#editDeliveryModal{{t.getId()}}" class="edit" data-toggle="modal" data-remote="{{url('edit/pickup_delivery?')}}"><i class="fa fa-pencil" data-toggle="tooltip" title="Ubah" value="{{t.getId()}}"></i></a>
                                <a href="#deleteDeliveryModal{{t.getId()}}" class="delete" data-toggle="modal"><i class="fa fa-trash-o" data-toggle="tooltip"  title="Hapus" value='{{t.getId()}}'></i></a>
                            </td>
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
    </main>
</div>

<div id="tambahDeliveryModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form>
                <div class="modal-header">						
                    <h4 class="modal-title">Tambah Pickup Delivery</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label><b>{{form.getLabel('pd_status')}}</b></label>
                        {{form.render('pd_status')}}
                    </div>
                    <div class="form-group">
                        <label><b>{{form.getLabel('pd_driver')}}</b></label>
                        {{form.render('pd_driver')}}
                    </div>
                    <div class="form-group">
                        <label><b>{{form.getLabel('pd_type')}}</b></label>
                        {{form.render('pd_type')}}
                    </div>
                    <div class="form-group">
                        <label><b>{{form.getLabel('pd_time_est')}}</b></label>
                        {{form.render('pd_time_est')}}
                    </div>							
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Batal">
                    {{form.render('Simpan')}}
                </div>
            </form>
        </div>
    </div>
</div>

<div id="hapusDeliveryModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form>
                <div class="modal-header">						
                    <h4 class="modal-title">Hapus Pickup Delivery</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">				
                    <input type='hidden' value='' name='id_laporans' id='hiddens'>
                    <p>Apakah Anda yakin untuk menghapus data yang telah dipilih ?</p>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Batal">
                    <input type="submit" class="btn btn-danger" value="Hapus">
                </div>
            </form>
        </div>
    </div>
</div>
{% endblock %}