<?php 
    include '../model/statistical.php';
    $product = select_top5_product_by_count();
    $type = select_top5_type_by_count();
    $view = top5_product_view();
    $revenue = monthly_revenue();

?>
<div class="d-flex flex-wrap justify-content-between align-items-start mb-5">
    <div class="d-flex flex-wrap justify-content-center align-items-start" style="position: relative; height:70vh; width:40vw;">
        <h1 class="text-center text-light mb-4">Top sản phẩm bán chạy</h1>
      <canvas id="product"></canvas>
    </div>
    <div class="d-flex flex-column align-items-center" style="position: relative; height:50vh; width:40vw;">
        <h1 class="text-center text-light mb-4">Top loại sản phẩm bán chạy</h1>
      <canvas id="type"></canvas>
    </div>
    <div style="position: relative; height:50vh; width:40vw;">
        <h1 class="text-center text-light mb-4">Top sản phẩm có lượt xem nhiều </h1>
      <canvas id="view"></canvas>
    </div>
    <div class="d-flex flex-column align-items-center" style="position: relative; height:50vh; width:40vw;">
        <h1 class="text-center text-light mb-4">Doanh thu theo tháng</h1>
      <canvas id="revenue"></canvas>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

 <!-- Thieu san pham duoc xem nhieu nhat, -->
<script>
    let product = <?php echo json_encode($product);?>;
    let type = <?php echo json_encode($type);?>;
    let view = <?php echo json_encode($view);?>;
    let revenue = <?php echo json_encode($revenue);?>;
    const productView = document.getElementById('product');
    const typeView = document.getElementById('type');
    const views = document.getElementById('view');
    const revenues = document.getElementById('revenue');
    Chart.defaults.color = '#fff';

    new Chart(productView, {
        type: 'bar',
        data: {
        labels: product.map(e => 'Mã sản phẩm: '+e.idProduct),
        datasets: [{
            label: '# Số lượng bán',
            data: product.map(e => e.count),
            backgroundColor:[
                'rgb(88, 101, 130)','rgb(79, 113, 187)','rgb(223, 227, 229)','rgba(75,192,192,0.6)','rgba(255,99,132,0.6)'
            ],
            borderWidth: 4,
            borderColor:'#777'
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
    new Chart(typeView, {
        type: 'polarArea',
        data: {
        labels: type.map(e => 'Mã loại: '+e.idType),
        datasets: [{
            label: '',
            data: type.map(e => e.count),
            backgroundColor:[
                'rgb(88, 101, 130)','rgb(79, 113, 187)','rgb(223, 227, 229)','rgba(75,192,192,0.6)','rgba(255,99,132,0.6)'
            ],
            borderWidth: 4,
            borderColor:'#777'
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
    
    new Chart(views, {
        type: 'bar',
        data: {
        labels: view.map(e => e.nameProduct.length > 20 ? e.nameProduct.slice(0,20) + '...':e.nameProduct),
        datasets: [{
            label: '# Số lượng xem',
            data: view.map(e => e.view),
            backgroundColor:[
                'rgb(88, 101, 130)','rgb(79, 113, 187)','rgb(223, 227, 229)','rgba(75,192,192,0.6)','rgba(255,99,132,0.6)'
            ],
            borderWidth: 4,
            borderColor:'#777'
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
    new Chart(revenues, {
        type: 'line',
        data: {
        labels: revenue.map(e => e.month),
        datasets: [{
            label: '# Doanh thu theo tháng',
            data: revenue.map(e => e.doanh_thu),
            backgroundColor:[
                'rgb(88, 101, 130)','rgb(79, 113, 187)','rgb(223, 227, 229)','rgba(75,192,192,0.6)','rgba(255,99,132,0.6)'
            ],
            borderWidth: 4,
            borderColor:'#777'
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