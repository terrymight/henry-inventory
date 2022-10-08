@include('customer.partials.header')

@include('sidebar')

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
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('customers/list') }}">Customer List</a></li>
            <li class="breadcrumb-item active">Customer Invoice</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  @if(!is_null($err))
  <div class="alert alert-danger alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>
      
      {{ $err }}
      
    </strong>
  </div>
  @endif
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
                      <th>Qty</th>
                      <th>Product</th>
                      <th>Subtotal</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($data->products as $product)
                    <tr>
                      <td>{{ $product['qty'] }}</td>
                      <td>{{ $product['pro'] }}</td>
                      <td>{{ $product['px'] }}</td>
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
                @foreach ($data->comments as $item)
                <form method="post" action="{{ url('customer/comment/destroy/'.$item->id.'/'.$data->id) }}">
                  @method('delete')
                  @csrf
                  <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                    <ul>
                      <li><a href="{{ url('customer/comment/destroy/'.$item->id.'/'.$data->id) }}">Delete</a> {{ $item->comments_name }} (Posted by {{ $item->created_at }})</li>
                      
                    </ul>
                  @endforeach
                </form>
                  <a href="{{ url('/comment/create/'.$data->id) }}">Add Comments</a>
                </p>
                </form>
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
                <form method="POST" action=" {{ url('/comment/update/status') }}">
                  @csrf
                <p class="lead">Change status:</p>
                <br>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <select name="products_status" id="">
                        <option value="delivered">Delivered</option>
                        <option value="processed">Processed</option>
                        <option value="rescheduled">Rescheduled</option>
                        <option value="not processed">Not Processed</option>
                        <option value="canceled">Canceled</option>                  
                      </select>
                      <input type="hidden" name="customer_id" value="{{ $data->id }}">
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary float-left"> Save
                      </button>
                    </div>
                  </div>

                </div>
                </form>
              </div>
              <!-- /.col -->
              <div class="col-6">
                <p class="lead">Amount Due {{ $data->created_at->format('d-m-Y') }}</p>

                <div class="table-responsive">
                  <table class="table">
                    <th>Total:</th>
                    <td>{{ $data->total_cost_of_products }}</td>
                    </tr>
                  </table>
                </div>
              </div>

              
              <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- this row will not appear when printing -->
            <form method="POST" action="{{ url('customer/notification/'.$data->id) }}">
              @csrf
              <div class="row no-print">


                <div class="col-12">
                  <div class="custom-control custom-checkbox">
                    <input type="hidden" value="{{ $data->customer_email }}" name="customer_email">
                    <input value="email_notification" name="email_notification" class="custom-control-input custom-control-input-danger" type="checkbox" id="email_notification" checked>
                    <label for="email_notification" class="custom-control-label">Send Email?</label>
                  </div>
                  <div class="custom-control custom-checkbox">
                  <input type="hidden" value="{{ $data->invoice_number }}" name="invoice_number">
                  <input type="hidden" value="{{ $data->fullname }}" name="fullname">
                    <input type="hidden" value="{{ $data->phone_number }}" name="phone_number">
                    <input value="sms_notification" name="sms_notification" class="custom-control-input custom-control-input-danger" type="checkbox" id="sms_notification">
                    <label for="sms_notification" class="custom-control-label">Send SMS?</label>
                  </div>

                  @if(Auth::user()->role_permission == 1 || Auth::user()->role_permission == 3 )
                  <button type="submit" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Send Invoice
                  </button>
                  @endif
                </div>
              </div>
            </form>
          </div>
          <!-- /.invoice -->
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->



@include('customer.partials.footer')