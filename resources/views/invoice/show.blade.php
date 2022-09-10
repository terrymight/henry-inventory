<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('app.name') }} | Search For Invoice</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Customer`s Invoice</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/">Go back</a></li>
           
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">

          <!-- Main content -->
          <div class="invoice p-3 mb-3">
            <!-- title row -->
            <div class="row">
              <div class="col-12">
                <h4>
                  <i class="fas fa-globe"></i> {{ $application->company_name }}.
                  <small class="float-right">Date: {{ $data->created_at->format('d-m-Y') }}</small>
                </h4>
              </div>
              <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
              <div class="col-sm-4 invoice-col">
                From
                <address>
                  <strong>{{ $application->company_name }}, Admin</strong><br>
                  {{ $application->address }}<br>

                  Phone: {{ $application->phone }} @isset($application->phone_sec) ,{{ $application->phone_sec }} @endisset<br>
                  Email: {{ $application->email }}
                </address>
              </div>
              <!-- /.col -->
              <div class="col-sm-4 invoice-col">
                To
                <address>
                  <strong>{{ $data->fullname }}</strong><br>
                  {{ $data->customer_address }}<br>
                  Phone: {{ $data->phone_number }}<br>
                  Email: {{ $data->customer_email }}
                </address>
              </div>
              <!-- /.col -->
              <div class="col-sm-4 invoice-col">
                <b>Invoice #{{ $data->invoice_number }}</b><br>
                <br>
                <b>Order ID:</b> #{{ $data->invoice_number }}<br>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row">
              <div class="col-12 table-responsive">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Product</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($data->products as $product)
                    <tr>
                      <td>{{ $product }}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">
              <!-- accepted payments column -->
              <div class="col-6">
                <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                  Note {{ $data->dispatcher_note }}
                </p>
                <p class="lead">Product Current Status:</p>
                <p class="lead">
                  @if( $data->products_status == 'not processed' )
                    <span class="badge bg-primary">{{ $data->products_status }}</span>
                  @elseif ( $data->products_status == 'delivered' )
                    <span class="badge bg-success">{{ $data->products_status }}</span>
                  @elseif ( $data->products_status == 'processed' )                 
                    <span class="badge bg-primary">{{ $data->products_status }}</span>
                  @elseif ( $data->products_status == 'rescheduled' )
                    <span class="badge bg-danger">{{ $data->products_status }}</span>
                  @elseif ( $data->products_status == 'canceled' )
                    <span class="badge bg-danger">{{ $data->products_status }}</span>
                  @endif
                </p>
              </div>
              <!-- /.col -->
              <div class="col-6">
                <p class="lead">Amount Due {{ $data->created_at->format('d-m-Y') }}</p>

                <div class="table-responsive">
                  <table class="table">
                    <th>Total Amount:</th>
                    <td>{{ $data->total_cost_of_products }}</td>
                    </tr>
                  </table>
                </div>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- this row will not appear when printing -->
           
          </div>
          <!-- /.invoice -->
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
</body>
</html>
