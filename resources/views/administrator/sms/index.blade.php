@include('header')

@include('sidebar')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">User Sms</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
            <li class="breadcrumb-item active">User Sms</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
    @if(!is_null($leads))
      <div class="alert alert-danger alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>
          
          {{ $leads }}
          
        </strong>
      </div>
      @endif


      <form method="POST" action="{{ url('sms-settings') }}">
        @csrf
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Select Customers Types : </label>
                <select class="form-control select2bs4" style="width: 100%;" name="product_status" id="product_status">
                  <option value="not processed">Not Processed</option>
                  <option value="processed">Processed</option>
                  <option value="rescheduled">Rescheduled</option>
                  <option value="canceled">Canceled</option>
                  <option value="delivered">Delivered</option>
                </select>
              </div>

              <div class="form-group">
                <label>Sms Body (can not be more than 160 characters): </label>
                <textarea maxlength="160" name="sms_body" id="sms_body" class="form-control" rows="3" placeholder="Enter SMS Body..." required>{{ old('customer_address') }}
                </textarea>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <input type="submit" class="btn btn-primary" value="Send Massage">
            </div>
          </div>
        </div>
      </form>
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->



@include('footer')