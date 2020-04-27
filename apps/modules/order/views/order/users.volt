{% extends "../layouts/base.volt" %}

{% block title %}Halaman Order{% endblock %}

{% block content %}
<div id="page-container" class="sidebar-inverse side-scroll page-header-fixed main-content-boxed">
    <main id="main-container" style="padding-top: 5vw">
        <div class="content" style="padding-top: 0">
        <div id="hides" class="notif-block" style="height:5vh;  overflow-y: auto;">{{flashSession.output()}}</div>
            <div class="table-wrapper" style="height:70vh">
            <form action="users" method="POST">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><h2>Tambah <b>Pesanan</b></h2></div>
                </div>
                <div class="row">
                    <div class="col-sm-6"></div>
                    <div class="col-sm-6">
                        <a id="multi-items" class="btn btn-success"><i class="fa fa-plus"></i><span>Tambah Item</span></a>						
                    </div>
                </div>
            </div>
            <input type="hidden" id="items_notes" name="items_notes" value="">
            <input type="hidden" id="items_types" name="items_types" value="">
            <div class="row">
                <div class="col-sm-8">
                    <label><b>Masukkan Nama Service</b></label>
                    <select class="selectpicker form-control" data-live-search="true" data-container="body" name="pilihan" id="pilihan">
                        {% for s in service %}
                            <option  title="{{s.getServiceName()}}" price="{{s.getServicePrice()}}" value='{{s.getId()}}'>{{s.getServiceName()}}</option>
                        {% endfor %}
                    </select>
                </div>
                <div class="col-sm">
                    <label><b>Total Pesanan</b></label>
                    <div class="form-group"><input type="text" class="form-control" name="order_total" id="order_total"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-8">
                    <label><b>Detail Item</b></label>
                    <div class="item-fields">
                        <div class='form-group'><input type='text' class='form-control' name='item_notes'></div>
                    </div>
                </div>
                <div class="col-sm">
                    <label><b>Tipe Item</b></label>
                    <div class="type-fields">
                        <div class='form-group'><input type='text' class='form-control' name='item_types'></div>
                    </div>
                </div>
            </div>
            <div class="row" style="float:right">
                <a id="changes" class="btn btn-info text-light" style="margin-right:15px"><span>Simpan Perubahan</span></a>		
                <input type="submit" class="btn btn-success" name="Simpan" id="Simpan" value="Kirim" disabled>		
                </div>
            </div>
            </form>
            <div>
        </div>
        </div>
    </main>
</div>
{% endblock %}