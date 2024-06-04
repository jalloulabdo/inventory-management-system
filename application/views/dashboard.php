<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/variable-pie.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script src="https://code.highcharts.com/modules/no-data-to-display.js"></script>
<link rel="stylesheet" href="<?php echo base_url('assets/bower_components/dashboard/dashbordNew.css') ?>">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <div id="overlay">
    <div class="cv-spinner">
      <div class="spinnerD"></div>
    </div>
  </div>
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Dashboard

    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Small boxes (Stat box) -->
    <?php if ($is_admin == true): ?>
      <div class="row justify-content-center">
        <div class="col-xxl-3 col-xl-6 col-md-6 col-sm-6">
          <div class="card border-0 rounded-1 mb-20 box-shadow">
            <div class="stat-card d-flex flex-wrap align-items-center justify-content-between">
              <div class="stat-icon d-flex flex-coulmn justify-content-center">
                <img src="<?php echo base_url() . 'assets/images/dashboard/wallet-money-2.ebacd2ec.svg' ?>" alt=""
                  class="blur-icon">
                <img src="<?php echo base_url() . 'assets/images/dashboard/wallet-money.0e90e8be.svg' ?>" alt="">
              </div>
              <div class="stat-info text-end">
                <span data-v-2b8703c6="" class="d-block fs-14 fw-medium">SALES</span>
                <h4 data-v-2b8703c6="" class="fw-black mb-0 lh-1" id="totalPaid"></h4>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xxl-3 col-xl-6 col-md-6 col-sm-6">
          <div class="card border-0 rounded-1 mb-20 box-shadow">
            <div class="stat-card d-flex flex-wrap align-items-center justify-content-between">
              <div class="stat-icon d-flex flex-coulmn justify-content-center">
                <img src="<?php echo base_url() . 'assets/images/dashboard/wallet-add-2.5b609765.svg' ?>" alt=""
                  class="blur-icon">
                <img src="<?php echo base_url() . 'assets/images/dashboard/wallet-add.e317072d.svg' ?>" alt="">
              </div>
              <div class="stat-info text-end">
                <span data-v-2b8703c6="" class="d-block fs-14 fw-medium">Brands</span>
                <h4 data-v-2b8703c6="" class="fw-black mb-0 lh-1" id="totalBrands"></h4>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-xxl-3 col-xl-6 col-md-6 col-sm-6">
          <div class="card border-0 rounded-1 mb-20 box-shadow">
            <div class="stat-card d-flex flex-wrap align-items-center justify-content-between">
              <div class="stat-icon d-flex flex-coulmn justify-content-center">
                <img src="<?php echo base_url() . 'assets/images/dashboard/wallet-money-2.ebacd2ec.svg' ?>" alt=""
                  class="blur-icon">
                <img src="<?php echo base_url() . 'assets/images/dashboard/wallet-money.0e90e8be.svg' ?>" alt="">
              </div>
              <div class="stat-info text-end">
                <div class="d-flex justify-content-between flex-direction">
                  <div>
                    <span data-v-2b8703c6="" class="d-block fs-14 fw-medium">Total UnPaid</span>
                    <h4 data-v-2b8703c6="" class="fw-black mb-0 lh-1" id="totalUnPaid"></h4>
                  </div>
                  <div>
                    <span data-v-2b8703c6="" class="d-block fs-14 fw-medium">Orders UnPaid</span>
                    <h4 data-v-2b8703c6="" class="fw-black mb-0 lh-1" id="orderUnPaid"></h4>
                  </div>
                </div>
              </div>

            </div>
          </div> 
        </div>
        <div class="col-xxl-3 col-xl-6 col-md-6 col-sm-6">
          <div class="card border-0 rounded-1 mb-20 box-shadow">
            <div class="stat-card d-flex flex-wrap align-items-center justify-content-between">
              <div class="stat-icon d-flex flex-coulmn justify-content-center">
                <img src="<?php echo base_url() . 'assets/images/dashboard/wallet-add-2.5b609765.svg' ?>" alt=""
                  class="blur-icon">
                <img src="<?php echo base_url() . 'assets/images/dashboard/wallet-add.e317072d.svg' ?>" alt="">
              </div>
              <div class="stat-info text-end">
                <span data-v-2b8703c6="" class="d-block fs-14 fw-medium">SALES</span>
                <h4 data-v-2b8703c6="" class="fw-black mb-0 lh-1">$5312.00</h4>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="chart-wrapper style-one d-flex">
        <div class="card border-0 rounded-1 mb-20 box-shadow">
          <div class="card-body p-xl-40">
            <h6 class="card-title fw-semiBold fs-18 mb-30"> Top Selling Products (2024) </h6>
            <div class="chart-body">
              <figure class="highcharts-figure">
                <div id="containerPie"></div>
              </figure>
            </div>
          </div>
        </div>
        <div class="card border-0 rounded-1 mb-20 box-shadow">
          <div class="card-body p-xl-40">
            <h6 class="card-title fw-semiBold fs-18 mb-30"> Sales by Month </h6>
            <div class="chart-body">

              <figure class="highcharts-figure">
                <div id="containerCol"></div>
              </figure>
            </div>
          </div>
        </div>
      </div>
      <div class="chart-wrapper style-two d-flex">
        <div class="card border-0 rounded-1 mb-20">
          <div class="card-body p-xl-40">
            <h6 class="card-title fw-semiBold fs-18 mb-30">Stock Alert</h6>
            <div class="table-responsive style-five">
              <table class="table text-nowrap align-middle mb-0" id="alertProduct">
                <thead>
                  <tr>
                    <td class="text-title fw-normal fs-14 pt-0 ps-0">Serial</td>
                    <td class="text-title fw-normal fs-14 pt-0">Product</td>
                    <td class="text-title fw-normal fs-14 pt-0">WAREHOUSE </td>
                    <td class="text-title fw-normal fs-14 pt-0">QUANTITY </td>
                  </tr>
                </thead>
                <tbody >
                  
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="card border-0 rounded-1 mb-20">
          <div class="card-body p-xl-40">
            <h6 class="card-title fw-semiBold fs-18 mb-30">Top 05 Customer (<span id="monthActual"></span>)</h6>
            <div class="chart-body">
            <div id="containerCustomer"></div>
            </div>
          </div>
        </div>
      </div>
      <!-- <div class="row">
        <div class="col-lg-3 col-xs-6">
         
          <div class="small-box bg-purple">
            <div class="inner">
              <h3><?php echo $total_brands ?></h3>

              <h4><b>Total Items</b></h4>
            </div>
            <div class="icon">
              <i class="fa fa-cubes"></i>
            </div>
            <a href="<?php echo base_url('Controller_Items/') ?>" class="small-box-footer">More Info <i
                class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        
        <div class="col-lg-3 col-xs-6">
          
          <div class="small-box bg-teal">
            <div class="inner">
              <h3><?php echo $total_category ?></h3>

              <h4><b>Total Category</b></h4>
            </div>
            <div class="icon">
              <i class="fa fa-th"></i>
            </div>
            <a href="<?php echo base_url('Controller_Category/') ?>" class="small-box-footer">More Info <i
                class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        
        <div class="col-lg-3 col-xs-6">
          
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo $total_attribures; ?></h3>

              <h4><b>Total Elements</h4></b>
            </div>
            <div class="icon">
              <i class="fa fa-files-o"></i>
            </div>
            <a href="<?php echo base_url('Controller_Element/') ?>" class="small-box-footer">More Info <i
                class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        
        <div class="col-lg-3 col-xs-6">
          
          <div class="small-box bg-green">
            <div class="inner">
              <h3>
                <?php $query = $this->db->query('SELECT SUM( net_amount)as total FROM orders WHERE paid_status = 1')->row();
                echo floatval($query->total); ?>
              </h3>

              <h4><b>Total Sales</b></h4>
            </div>
            <div class="icon">
              <i class="fa fa-dollar"></i>
            </div>
            <a href="<?php echo base_url('Controller_Orders/') ?>" class="small-box-footer">More Info <i
                class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        
      </div>


      <div class="row">
        <div class="col-lg-3 col-xs-6">
          
          <div class="small-box bg-primary">
            <div class="inner">
              <h3><?php echo $total_products ?></h3>

              <h4><b>Total Products</b></h4>
            </div>
            <div class="icon">
              <i class="fa fa-cube"></i>
            </div>
            <a href="<?php echo base_url('Controller_Products/') ?>" class="small-box-footer">More Info <i
                class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        
        <div class="col-lg-3 col-xs-6">
          
          <div class="small-box bg-olive">
            <div class="inner">
              <h3><?php echo $total_paid_orders ?></h3>

              <h4><b>Paid Orders</b></h4>
            </div>
            <div class="icon">
              <i class="fa fa-check"></i>
            </div>
            <a href="<?php echo base_url('Controller_Orders/') ?>" class="small-box-footer">More Info <i
                class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        
        <div class="col-lg-3 col-xs-6">
          
          <div class="small-box bg-maroon">
            <div class="inner">
              <h3>
                <?php $query = $this->db->query('SELECT * FROM orders WHERE paid_status = 2');
                echo $query->num_rows(); ?>
              </h3>

              <h4><b>UnPaid Orders</b></h4>
            </div>
            <div class="icon">
              <i class="fa fa-spinner"></i>
            </div>
            <a href="<?php echo base_url('Controller_Orders/') ?>" class="small-box-footer">More Info <i
                class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        
        <div class="col-lg-3 col-xs-6">
          
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo $total_users; ?></h3>

              <h4><b>Total Members</b></h4>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="<?php echo base_url('Controller_Members/') ?>" class="small-box-footer">More Info <i
                class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        

        <div class="col-lg-3 col-xs-6">
          
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo $total_stores ?></h3>

              <h4><b>Total Warehouse</b></h4>
            </div>
            <div class="icon">
              <i class="fa fa-institution"></i>
            </div>
            <a href="<?php echo base_url('Controller_Warehouse/') ?>" class="small-box-footer">More Info <i
                class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>
      

      <div class="row">
        <div class="col-lg-6 col-xs-6">
          <div class="col-lg-6 col-xs-3">
            <div class="small-box bg-purple">
              <div class="inner">
                <h3><?php echo $total_brands ?></h3>

                <h4><b>Total Items</b></h4>
              </div>
              <div class="icon">
                <i class="fa fa-cubes"></i>
              </div>
              <a href="<?php echo base_url('Controller_Items/') ?>" class="small-box-footer">More Info <i
                  class="fa fa-arrow-circle-right"></i></a>
            </div>
            
            <div class="small-box bg-teal">
              <div class="inner">
                <h3><?php echo $total_category ?></h3>

                <h4><b>Total Category</b></h4>
              </div>
              <div class="icon">
                <i class="fa fa-th"></i>
              </div>
              <a href="<?php echo base_url('Controller_Category/') ?>" class="small-box-footer">More Info <i
                  class="fa fa-arrow-circle-right"></i></a>
            </div>
            
            <div class="small-box bg-yellow">
              <div class="inner">
                <h3><?php echo $total_attribures; ?></h3>

                <h4><b>Total Elements</h4></b>
              </div>
              <div class="icon">
                <i class="fa fa-files-o"></i>
              </div>
              <a href="<?php echo base_url('Controller_Element/') ?>" class="small-box-footer">More Info <i
                  class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-6 col-xs-3">
            <div class="small-box bg-purple">
              <div class="inner">
                <h3><?php echo $total_brands ?></h3>

                <h4><b>Total Items</b></h4>
              </div>
              <div class="icon">
                <i class="fa fa-cubes"></i>
              </div>
              <a href="<?php echo base_url('Controller_Items/') ?>" class="small-box-footer">More Info <i
                  class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-xs-6">
          <figure class="highcharts-figure">
            <div id="container"></div>
            <p class="highcharts-description">
            </p>
          </figure>
        </div>
      </div> -->


    <?php endif; ?>


  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script src="<?php echo base_url('assets/bower_components/dashboard/charts.js') ?>"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>