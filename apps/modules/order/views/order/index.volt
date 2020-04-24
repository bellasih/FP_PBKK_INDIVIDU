{% extends "../layouts/base.volt" %}

{% block title %}Halaman Order{% endblock %}

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
                        <a id="multi-uwus" href="#deleteOrderModal" class="btn btn-danger" data-toggle="modal"><i class="fa fa-trash-o"></i><span>Hapus</span></a>						
                    </div>
                </div>
            </div>
           {% if page != null %}
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
                    {% set i = 1 %}
                    {% for t in page %}
                        <tr>
                            <td>
                                <span class="custom-checkbox">
                                    <input type="checkbox" id="checkbox1" name="options" value="{{t.getId()}}">
                                    <label for="checkbox1"></label>
                                </span>
                            </td>
                            <td>{{i}}</td>
                            <td>{{t.getUserId()}}</td>
                            <td>{{t.getServiceId()}}</td>
                            <td>{{t.getOrderTotal()}}</td>
                            <td>{{t.getOrderDate()}}</td>
                            <td>{{t.getFinishDate()}}</td>
                            <td>{{t.getOrderStatus()}}</td>
                            <td>
                                <a href="#lihatItemModal{{t.getId()}}" class="view" data-toggle="modal" ><i class="fa fa-eye" data-toggle="tooltip" title="Lihat" value="{{t.getId()}}"></i></a>
                                <a href="#editOrderModal{{t.getId()}}" class="edit" data-toggle="modal" ><i class="fa fa-pencil" data-toggle="tooltip" title="Ubah" value="{{t.getId()}}"></i></a>
                            </td>
                        </tr>
                    {% set i = i + 1 %}
                    {% endfor %}
                </tbody>
            </table>
            <div class="text-center text-lg">
                <a href='/order'>First</a>
                {% if page_number - 1 >= 1 %}
                <a href='/order?page={{page_number - 1}}'>Previous</a>
                {% endif %}
                {% if page_number + 1 <= page_last %}
                <a href='/order?page={{page_number + 1 }}'>Next</a>
                {% endif %}
                <a href='/order?page={{page_last}}'>Last</a>
                <p class="text-success">Anda berada di halaman {{page_number}} dari {{page_last}}</p>
            </div>
            {% else %}
                <h2 class="text-danger text-center">Tidak ada data yang dapat ditampilkan</h2>
            {% endif %}
        </div>
    <main>
</div>

<div id="hapusPengeluaranModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="order" action="delete/order" method="POST">
                <div class="modal-header">						
                    <h4 class="modal-title">Hapus Pengeluaran</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">				
                    <input type='hidden' value='' name='order_id' id='order_id'>
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

{% set j = 0 %}
{% for t in page %}
<div id="editOrderModal{{t.getId()}}" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="update/order" method="POST">
                <div class="modal-header">						
                    <h4 class="modal-title">Edit Pengeluaran</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="order_id" name="order_id" value="{{t.getId()}}">
                    <div class="form-group">
                        <label><b>Status Pesanan</b></label>
                        <p><input type="text" class="form-control" name="order_total" id="order_total" value="{{t.getOrderStatus()}}"></p>
                    </div>					
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Batal">
                    <input type="submit" class="btn btn-success" id="Simpan" nama="Simpan" value="Simpan">
                </div>
            </form>
        </div>
    </div>
</div>

<div id="lihatItemModal{{t.getId()}}" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
                <div class="modal-header">						
                    <h4 class="modal-title">Detail Item Member</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                {% if detail_item[j] != null %}
                <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Tipe Item</th>
                        <th>Detail Item</th>
                    </tr>
                </thead>
                <tbody>
                    {% set k = 1 %}
                    {% for l in detail_item[j] %}
                        <tr>
                            <td>{{k}}</td>
                            <td>{{l['item_type']}}</td>
                            <td>{{l['item_details']}}</td>
                        </tr>
                    {% set k = k + 1 %}
                    {% endfor %}
                </tbody>
                </table>
                {% endif %}
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Batal">
                </div>
            </form>
        </div>
    </div>
</div>
{% set j = j + 1 %}
{% endfor %}

{% endblock %}