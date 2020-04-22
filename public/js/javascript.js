$(document).ready(function(){

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
    });

    $("#uwus").click(function() {
        var values = $(this).val();
        var params = $(this).attr('at');

        if(params == '#deleteBarangModal'){
            $('#goods_id').val(values);
        }
        else if(params == '#deleteDeliveryModal'){
            alert(values);
            $('#pd_id').val(values);
        }
        else if(params == '#deleteExpenseModal'){
            $('#expense_id').val(values);
        }
    });


    // function alerts()
    // {
    //     alert('Halooo');
    // }
    // window.onload=alerts;

    //function buat chart
    // function BuildChart(lab, val, chartTitle, types){
    //     var ctx = document.getElementById('myChart').getContext('2d');
    //     var myChart = new Chart(ctx, {
    //         type: types,
    //         data: {
    //             labels: lab,
    //             datasets: [{
    //                 label: '# Jumlah Pengisi Survei',
    //                 data: val,
    //                 backgroundColor: [
    //                     'rgba(255, 99, 132, 0.2)',
    //                     'rgba(54, 162, 235, 0.2)',
    //                     'rgba(255, 159, 64, 0.2)',
    //                     'rgba(255, 159, 64, 0.2)'
    //                 ],
    //                 borderColor: [
    //                     'rgba(255, 99, 132, 1)',
    //                     'rgba(54, 162, 235, 1)',
    //                     'rgba(255, 159, 64, 1)',
    //                     'rgba(255, 159, 64, 1)'
    //                 ],
    //                 borderWidth: 1
    //             }]
    //         },
    //         options: {
    //             scales: {
    //                 yAxes: [{
    //                     ticks: {
    //                         beginAtZero: true
    //                     }
    //                 }]
    //             },
    //             title: {
    //                 display: true,
    //                 text: chartTitle,
    //                 fontSize: 20
    //             }
    //         }
    //     });
    //     return myChart;
    // }
    
    // //data chart kuesioner - rekap
    // var table1 = document.getElementById('dataTable1');
    // var json1 = [];
    // var headers1 = [];
    // console.log(table1);

    // if(table1 != null){
    //     for(var i = 1; i<table1.rows[0].cells.length; i++){
    //         headers1[i] = table1.rows[0].cells[i].innerHTML.toLowerCase().replace(/ /gi, '');
    //     }
    
    //     for(var i =1; i<table1.rows.length; i++){
    //         var tableRows = table1.rows[i];
    //         var rowDatas = {};
    //         for(var j = 1;j < tableRows.cells.length; j++){
    //             rowDatas[headers1[j]] = tableRows.cells[j].innerHTML;
    //         }
    //         json1.push(rowDatas);
    //     }
    //     console.log(json1);
    
    //     var label = json1.map(function(e){
    //         return e.nilaikepuasan;
    //     })
        
    //     var value = json1.map(function(e){
    //         return e.jumlahresponden;
    //     })
    
    //     var chart1 = BuildChart(label,value,"Grafik Jumlah Responden Berdasarkan Hasil Kepuasan","bar");
    // }
    // else{
    //     //data chart responden
    //     var table = document.getElementById('dataTable');
    //     var json = [];
    //     var headers = [];

    //     for(var i = 1; i<table.rows[0].cells.length; i++){
    //         headers[i] = table.rows[0].cells[i].innerHTML.toLowerCase().replace(/ /gi, '');
    //     }

    //     for(var i =1; i<table.rows.length; i++){
    //         var tableRow = table.rows[i];
    //         var rowData = {};
    //         for(var j = 1;j < tableRow.cells.length; j++){
    //             rowData[headers[j]] = tableRow.cells[j].innerHTML;
    //         }
    //         json.push(rowData)
    //     }
    //     console.log(json);

    //     var labels = json.map(function(e){
    //         return e.tanggal;
    //     })

    //     var values = json.map(function(e){
    //         return e.jumlahresponden;
    //     })

    //     var chart = BuildChart(labels,values,"Grafik Jumlah Responden Survei Terbaru dalam Kurun Waktu 1 Minggu","bar");
    // } 


    // $("#coba").click(function() {
    //     let values = [];
    //     $.each($("input[name='options']:checked"), function() {
    //         values.push($(this).val());
    //     });    
    //     $('#hiddens').val(values.toString());  
    // });

    // $("#coba1").click(function() {
    //     let values = [];
    //     $.each($("input[name='options']:checked"), function() {
    //         values.push($(this).val());
    //     });    
    //     $('#hiddens').val(values.toString());  
    // });

    // $("#coba2").click(function() {
    //     let values = [];
    //     $.each($("input[name='options']:checked"), function() {
    //         values.push($(this).val());
    //     });    
    //     $('#hiddens').val(values.toString());  
    // });

    // var maxLength = 40;
    // $('#pilihan > option').text(function(i, text) {
    //     if (text.length > maxLength) {
    //         return text.substr(0, maxLength) + '...';  
    //     }
    // });

    // $(document).on("scroll", function () {
    //     var pageTop = $(document).scrollTop()
    //     var pageBottom = pageTop + $(window).height()
    //     var tags = $(".scroll-animate")
      
    //     for (var i = 0; i < tags.length; i++) {
    //       var tag = tags[i]
      
    //       if ($(tag).position().top < pageBottom) {
    //         $(tag).addClass("visible")
    //       } else {
    //         $(tag).removeClass("visible")
    //       }
    //     }
    // });    
});
