<script type="text/javascript">

    var datas = <?php echo json_encode($bar_chart_amount); ?>;
    var labelss = <?php echo json_encode($bar_chart_date); ?>;

    var ctx = document.getElementById('salesChart').getContext('2d');
    var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        // labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        labels: labelss,
        datasets: [{
            label: 'Sales Of : BDT ',
            // data: [12, 19, 3, 5, 2, 3],
            data: datas,
            backgroundColor: "rgba(255, 159, 64, 1)",
            // backgroundColor: [
            //     // 'rgba(255, 99, 132, 0.2)',
            //     // 'rgba(54, 162, 235, 0.2)',
            //     // 'rgba(255, 206, 86, 0.2)',
            //     // 'rgba(75, 192, 192, 0.2)',
            //     // 'rgba(153, 102, 255, 0.2)',
            //     // 'rgba(255, 159, 64, 0.2)'
            //     // 'rgba(255, 99, 132, 1)',
            //     // 'rgba(54, 162, 235, 1)',
            //     // 'rgba(255, 206, 86, 1)',
            //     // 'rgba(75, 192, 192, 1)',
            //     // 'rgba(153, 102, 255, 1)',
            //     'rgba(255, 159, 64, 1)'
            // ],
            // borderColor: [
            //     'rgba(255, 99, 132, 1)',
            //     'rgba(54, 162, 235, 1)',
            //     'rgba(255, 206, 86, 1)',
            //     'rgba(75, 192, 192, 1)',
            //     'rgba(153, 102, 255, 1)',
            //     'rgba(255, 159, 64, 1)'
            // ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

</script>


<script type="text/javascript">

    var names = <?php echo json_encode($top_products_name); ?>;
    var qtys = <?php echo json_encode($top_products_qty); ?>;

    var ctx = document.getElementById('topProducts').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            // labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
            labels: names,
            datasets: [{
                label: 'Sales Of : TK ',
                // data: [12, 19, 3, 5, 2, 3],
                data: qtys,
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 206, 86,)',
                    'rgb(75, 192, 192)',
                    'rgb(153, 102, 255)'
                ],
                // borderColor: [
                //     'rgba(255, 99, 132, 1)',
                //     'rgba(54, 162, 235, 1)',
                //     'rgba(255, 206, 86, 1)',
                //     'rgba(75, 192, 192, 1)',
                //     'rgba(153, 102, 255, 1)'
                // ],
                hoverOffset: 4
            }]
        },
        options: {
            responsive:true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>



<script type="text/javascript">

    var names = <?php echo json_encode($low_products_name); ?>;
    var qtys = <?php echo json_encode($low_products_qty); ?>;

    var ctx = document.getElementById('lowProducts').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'polarArea',
        data: {
            
            labels: names,
            datasets: [{
                data: qtys,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.3)',
                    'rgba(54, 162, 235, 0.3)',
                    'rgba(255, 206, 86, 0.3)',
                    'rgba(75, 192, 192, 0.3)',
                    'rgba(153, 102, 255, 0.3)'
                ],
                hoverOffset: 4
            }]
        },
        options: {
            responsive:true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>