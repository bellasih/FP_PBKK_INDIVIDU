$(document).ready(function(){

    //multiple delete
    $("#multi-uwus").click(function() {
        let values = [];
        var params = $(this).attr('href');
        $.each($("input[name='options']:checked"), function() {
            values.push($(this).val());
        });
        if(params == '#deleteBarangModal'){
            $('#goods_id').val(values.toString());
        }
        else if(params == '#deleteDeliveryModal'){
            $('#pd_id').val(values.toString());
        }
        else if(params == '#hapusPengeluaranModal'){
            $('#expense_id').val(values.toString());
        }
        else if(params == '#deleteOrderModal'){
            $('#order_id').val(values.toString());
        }
    });

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
