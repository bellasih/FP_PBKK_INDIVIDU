$(document).ready(function(){

    //multiple delete
    $("#multi-uwus").click(function() {
        let values = [];
        var params = $(this).attr('href');
        $.each($("input[name='options']:checked"), function() {
            values.push($(this).val());
        });
        if(params == '#hapusBarangModal'){
            $('#goods_id').val(values.toString());
        }
        if(params == '#deleteServiceModal'){
            $('#service_id').val(values.toString());
        }
        if(params == '#deleteDeliveryModal'){
            $('#pd_id').val(values.toString());
        }
        if(params == '#hapusPengeluaranModal'){
            $('#expense_id').val(values.toString());
        }
        if(params == '#deleteOrderModal'){
            $('#order_id').val(values.toString());
        }
    });

    //multi-items
    $("#multi-items").click(function() {
        var wrapper = $('.item-fields');
        var wrapper1 = $('.type-fields');
        $(wrapper).append("<div class='form-group'><input type='text' class='form-control' name='item_notes'></div>");
        $(wrapper1).append("<div class='form-group'><input type='text' class='form-control' name='item_types'></div>");
    });

    //get val multi-tems
    $("#changes").click(function() {
        let values = [];
        let value = [];
        $.each($("input[name='item_notes']"), function() {
            values.push($(this).val());
        });
        $.each($("input[name='item_types']"), function() {
            value.push($(this).val());
        });

        console.log(values.toString());
        console.log(value.toString());

        $('#items_notes').val(values.toString());
        $('#items_types').val(value.toString());

        $('#Simpan').prop('disabled',false);
    });

    //hide
    setTimeout(function(){
        $(document).on('click','#hides',function(){
            $('#hides').hide();
        });
     },1000);

    //chart
    var dates   = document.getElementsByClassName('dates')[0].value;
    var value   = parseFloat(document.getElementsByClassName('totals')[0].value/1000);
    var ctx     = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [dates.toString()],
            datasets: [{
                label: '# Jumlah Order',
                data: [value.toString()],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            },
            title: {
                display: true,
                text: 'Jumlah Order 7 Tanggal/Waktu Terakhir (dalam Ribu)',
                fontSize: 20
            }
        }
    });


    // $("#uwus").click(function() {
    //     var values = $(this).val();
    //     var params = $(this).attr('at');

    //     if(params == '#deleteBarangModal'){
    //         $('#goods_id').val(values);
    //     }
    //     else if(params == '#deleteDeliveryModal'){
    //         alert(values);
    //         $('#pd_id').val(values);
    //     }
    //     else if(params == '#deleteExpenseModal'){
    //         $('#expense_id').val(values);
    //     }
    // });
});
