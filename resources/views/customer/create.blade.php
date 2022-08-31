@include('customer.partials.header')

@include('sidebar')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Create Customers Form</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('/customers/list') }}">Customers List</a></li>
                        <li class="breadcrumb-item active">Customers Create</li>
                    </ol>

                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>


    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- FORM SECTION -->
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Add Customer Form</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>

                <!-- /.card-body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Customer Full Name : </label>
                                <input type="text" class="form-control" :value="old('fullname')" name="fullname" id="fullname" placeholder="Enter full name" required autofocus>
                            </div>
                            <!-- /.form-group -->
                            <div class="form-group">
                                <label>Whatsapp number (optional) : </label>
                                <input type="number" class="form-control" :value="old('whatsappphone')" id="whatsappphone" name="whatsappphone" placeholder="Whatsapp Number" required>
                            </div>
                            <!-- /.form-group -->
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Phone Number : </label>
                                <input type="number" class="form-control" :value="old('phone')" id="phone" name="phone" placeholder="Enter customer phone" required>
                                <!-- <input type="text" id="fullname" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus /> -->
                            </div>
                            <!-- /.form-group -->
                            <div class="form-group">
                                <label>Select State</label>
                                <select class="form-control select2bs4" style="width: 100%;">
                                    <option selected="selected">Alabama</option>
                                    <option>Alaska</option>
                                    <option disabled="disabled">California (disabled)</option>
                                    <option>Delaware</option>
                                    <option>Tennessee</option>
                                    <option>Texas</option>
                                    <option>Washington</option>
                                </select>
                            </div>
                            <!-- /.form-group -->
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Dispatcher : </label>
                                <input type="text" class="form-control" :value="old('phone')" id="phone" name="phone" placeholder="Enter customer phone" required>
                                <!-- <input type="text" id="fullname" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus /> -->
                            </div>

                            <div class="form-group">
                                <label>Date of Delivery : </label>
                                <input type="date" class="form-control" :value="old('phone')" id="phone" name="phone" placeholder="Enter customer phone" required>
                                <!-- <input type="text" id="fullname" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus /> -->
                            </div>
                        </div>

                        <div class="col-md-6">
                            <!-- /.form-group -->
                            <div class="form-group">
                                <label>Select Product (Multiple Selection Allowed)</label>
                                <select class="select2" multiple="multiple" data-placeholder="Select product(s)" style="width: 100%;">
                                    <option>Alabama</option>
                                    <option>Alaska</option>
                                    <option>California</option>
                                    <option>Delaware</option>
                                    <option>Tennessee</option>
                                    <option>Texas</option>
                                    <option>Washington</option>
                                </select>
                            </div>
                            <!-- /.form-group -->

                            <div class="form-group">
                                <label>Total Cost of Product(s) : </label>
                                <input type="number" class="form-control" :value="old('phone')" id="phone" name="phone" placeholder="Enter cost of product" required>
                            </div>
                        </div>

                        <div class="col-md-6">

                            <div class="form-group">
                                <label>Address : </label>
                                <textarea name="address" id="address" class="form-control" rows="3" placeholder="Enter ..." required></textarea>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@include('customer.partials.footer')