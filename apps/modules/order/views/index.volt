{% extends "../layouts/base.volt" %}

{% block title %}Order{% endblock %}

{% block content %}
<div id="page-container" class="sidebar-inverse side-scroll page-header-fixed main-content-boxed">
    <main id="main-container" style="padding-top: 5vw">
        <div class="content" style="padding-top: 0">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><h2>Kelola <b>Order Laundry</b></h2></div>
                </div>
                <div class="row">
                    <div class="col-sm-6"></div>
                    <div class="col-sm-6">
                        <a href="#tambahLaporanRekapModal"  class="btn btn-success" data-toggle="modal"><i class="fa fa-plus"></i><span>Tambah Order</span></a>
                        <a href="#deleteLaporanRekapModal" id="coba2" class="btn btn-danger" data-toggle="modal"><i class="fa fa-trash-o"></i><span>Hapus</span></a>						
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
                        <th>Nama Service</th>
                        <th>Total Pesanan</th>
                        <th>Tanggal Pesanan</th>
                        <th>Tanggal Selesai</th>
                        <th>Status Pesanan</th>
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
                            <td>{{t.getUserId()}}</td>
                            <td>{{t.getServiceId()}}</td>
                            <td>{{t.getOrderTotal()}}</td>
                            <td>{{t.getFinishDate()}}</td>
                            <td>{{t.getOrderStatus()}}</td>
                            <td>
                                <a href="#editOrderModal{{t.getId()}}" class="edit" data-toggle="modal" data-remote="{{url('edit/pickup_Order?')}}"><i class="fa fa-pencil" data-toggle="tooltip" title="Ubah" value="{{t.getId()}}"></i></a>
                                <a href="#deleteOrderModal{{t.getId()}}" class="delete" data-toggle="modal"><i class="fa fa-trash-o" data-toggle="tooltip"  title="Hapus" value='{{t.getId()}}'></i></a>
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
    <main>
</div>

{% endblock %}