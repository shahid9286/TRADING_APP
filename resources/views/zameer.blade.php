@extends('admin.layouts.master')
@section('title', 'Dashboard')

@section('content')
<section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Net Ballance</span>
                <span class="info-box-number">
                  10
                  <small>%</small>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Locked Amount</span>
                <span class="info-box-number">41,410</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">investment</span>
                <span class="info-box-number">760</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Withdraws Pending </span>
                <span class="info-box-number">2,000</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>


<div class="row g-3 my-3">
  {{-- Parent Tree --}}
  <div class="col-md-4">
    <div class="card">
      <div class="card-header border-transparent">
        <h3 class="card-title">Parent Tree</h3>
        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
          </button>
          <button type="button" class="btn btn-tool" data-card-widget="remove">
            <i class="fas fa-times"></i>
          </button>
        </div>
      </div>
      <div class="card-body">
        <ul class="list-unstyled mb-0">
          <li><span class="text-danger">●</span> Chrome</li>
          <li><span class="text-success">●</span> IE</li>
          <li><span class="text-warning">●</span> Firefox</li>
          <li><span class="text-primary">●</span> Safari</li>
          <li><span class="text-info">●</span> Opera</li>
        </ul>
      </div>
    </div>
  </div>

  {{-- Referral Tree --}}
  <div class="col-md-4">
    <div class="card">
      <div class="card-header border-transparent">
        <h3 class="card-title">Referral Tree</h3>
        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
          </button>
          <button type="button" class="btn btn-tool" data-card-widget="remove">
            <i class="fas fa-times"></i>
          </button>
        </div>
      </div>
      <div class="card-body">
        <ul class="list-unstyled mb-0">
          <li><span class="text-danger">●</span> Chrome</li>
          <li><span class="text-success">●</span> IE</li>
          <li><span class="text-warning">●</span> Firefox</li>
          <li><span class="text-primary">●</span> Safari</li>
          <li><span class="text-info">●</span> Opera</li>
        </ul>
      </div>
    </div>
  </div>

  {{-- Account Info --}}
  <div class="col-md-4">
    <div class="card">
      <div class="card-header border-transparent">
        <h3 class="card-title">Account Info</h3>
        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
          </button>
          <button type="button" class="btn btn-tool" data-card-widget="remove">
            <i class="fas fa-times"></i>
          </button>
        </div>
      </div>
      <div class="card-body">
        <div class="d-flex justify-content-between py-2 border-bottom">
          <span>United States</span><span class="text-danger">↓ 12%</span>
        </div>
        <div class="d-flex justify-content-between py-2 border-bottom">
          <span>India</span><span class="text-success">↑ 4%</span>
        </div>
        <div class="d-flex justify-content-between py-2">
          <span>China</span><span class="text-warning">→ 0%</span>
        </div>
      </div>
    </div>
  </div>
</div>
        
<div class="row">
  <!-- Left col -->
  <div class="col-md-8">
    <!-- TABLE: LATEST ORDERS -->
    <div class="card">
      <div class="card-header border-transparent">
        <h3 class="card-title">Latest Orders</h3>
        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
          </button>
          <button type="button" class="btn btn-tool" data-card-widget="remove">
            <i class="fas fa-times"></i>
          </button>
        </div>
      </div>
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table m-0">
            <thead>
              <tr>
                <th>Order ID</th>
                <th>Item</th>
                <th>Status</th>
                <th>Popularity</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><a href="#">OR9842</a></td>
                <td>Call of Duty IV</td>
                <td><span class="badge badge-success">Shipped</span></td>
                <td><div class="sparkbar" data-color="#00a65a" data-height="20">90,80,90,-70</div></td>
              </tr>
              <tr>
                <td><a href="#">OR1848</a></td>
                <td>Samsung Smart TV</td>
                <td><span class="badge badge-warning">Pending</span></td>
                <td><div class="sparkbar" data-color="#f39c12" data-height="20">90,80,-90,70</div></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="card-footer clearfix">
        <a href="javascript:void(0)" class="btn btn-sm btn-info float-left">Place New Order</a>
        <a href="javascript:void(0)" class="btn btn-sm btn-secondary float-right">View All Orders</a>
      </div>
    </div>
  </div>
  <!-- /.col -->

  <!-- Right col -->
  <div class="col-md-4">
    <div class="card">
      <div class="card-header border-transparent">
        <h3 class="card-title">Recently Added Products</h3>
        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
          </button>
          <button type="button" class="btn btn-tool" data-card-widget="remove">
            <i class="fas fa-times"></i>
          </button>
        </div>
      </div>
      <div class="card-body p-0">
        <ul class="products-list product-list-in-card pl-2 pr-2">
          <li class="item">
            <div class="product-info">
              <a href="#" class="product-title">
                Samsung TV
                <span class="badge badge-warning float-right">$1800</span>
              </a>
              <span class="product-description">Samsung 32" 1080p 60Hz LED Smart HDTV.</span>
            </div>
          </li>
          <li class="item">
            <div class="product-info">
              <a href="#" class="product-title">
                Xbox One
                <span class="badge badge-danger float-right">$350</span>
              </a>
              <span class="product-description">Xbox One Console Bundle with Halo.</span>
            </div>
          </li>
        </ul>
      </div>
      <div class="card-footer text-center">
        <a href="javascript:void(0)" class="uppercase">View All Products</a>
      </div>
    </div>
  </div>
  <!-- /.col -->
</div>
        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>
@endsection
