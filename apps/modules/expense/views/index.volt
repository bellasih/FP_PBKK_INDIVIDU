{% extends "../layouts/base.volt" %}

{% block title %}Pengeluaran{% endblock %}

{% block content %}
<div id="page-container" class="sidebar-inverse side-scroll page-header-fixed main-content-boxed">
    <main id="main-container" style="padding-top: 5vw">
        <div class="content" style="padding-top: 0">
        <div class="table-wrapper">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-8"><h2>Kelola <b>Pengeluaran Laundry</b></h2></div>
            </div>
            <div class="row">
                <div class="col-sm-6"></div>
                <div class="col-sm-6">
                    <a href="#tambahPengeluaranModal"  class="btn btn-success" data-toggle="modal"><i class="fa fa-plus"></i><span>Tambah Pengeluaran</span></a>
                    <a href="#hapusPengeluaranModal" id="coba2" class="btn btn-danger" data-toggle="modal"><i class="fa fa-trash-o"></i><span>Hapus</span></a>						
                </div>
            </div>
        </div>
            {% if datas != null %}
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th></th>
                        <th>No.</th>
                        <th>Nama Admin</th>
                        <th>Catatan Pengeluaran</th>
                        <th>Total Pengeluaran</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                {% set i = 1 %}
                    {% for t in datas %}
                        <tr>
                            <td>
                                <span class="custom-checkbox">
                                    <input type="checkbox" id="checkbox1" name="options" value="{{t.getId()}}">
                                    <label for="checkbox1"></label>
                                </span>
                            </td>
                            <td>{{i}}</td>
                            <td>{{t.getAdminId()}}</td>
                            <td>{{t.getExpenseNote()}}</td>
                            <td>{{t.getExpenseTotal()}}</td>
                            <td>
                                <!--change to button-->
                                <a href="#lihatInvoiceModal{{t.getId()}}" class="view" data-toggle="modal"><i class="fa fa-eye" data-toggle="tooltip" title="Lihat"></i></a>
                                <a href="#editExpenseModal{{t.getId()}}" class="edit" data-toggle="modal" data-remote="{{url('edit/pickup_Expense?')}}"><i class="fa fa-pencil" data-toggle="tooltip" title="Ubah" value="{{t.getId()}}"></i></a>
                                <a href="#deleteExpenseModal{{t.getId()}}" class="delete" data-toggle="modal"><i class="fa fa-trash-o" data-toggle="tooltip"  title="Hapus" value='{{t.getId()}}'></i></a>
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
    <main>
</div>

<div id="tambahPengeluaranModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form>
                <div class="modal-header">						
                    <h4 class="modal-title">Tambah Pengeluaran</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">									
                    <div class="form-group">
                        <label><b>{{form.getLabel('expense_note')}}</b></label>
                        {{form.render('expense_note')}}
                    </div>
                    <div class="form-group">
                        <label><b>{{form.getLabel('expense_total')}}</b></label>
                        {{form.render('expense_total')}}
                    </div>
                    <div class="form-group">
                        <label><b>{{form.getLabel('invoice')}}</b></label>
                        {{form.render('invoice')}}
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

<div id="hapusPengeluaranModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form>
                <div class="modal-header">						
                    <h4 class="modal-title">Hapus Pengeluaran</h4>
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