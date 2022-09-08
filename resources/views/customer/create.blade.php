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
            <!-- FORM SECTION customer/store-->
            <!-- <form method="POST" action="{{ $data->id ? url('customer/'.$data->id) : url('customer/store') }}"> -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

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
                <form method="POST" action="{{ $data->id ? url('customer/'.$data->id) : url('customer/store') }}">
                    @if ($data->id) @method('PUT') @endif
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Customer Full Name : </label>
                                    <input type="text" class="form-control" value="{{ old('fullname', $data->fullname) }}" name="fullname" id="fullname" placeholder="Enter full name" required autofocus>
                                </div>
                                <!-- /.form-group -->
                                <div class="form-group">
                                    <label>Whatsapp number (optional) : </label>
                                    <input type="number" class="form-control" value="{{ old('whatsapp_number', $data->whatsapp_number) }}" id="whatsapp_number" name="whatsapp_number" placeholder="Enter customer phone">
                                </div>
                                <!-- /.form-group -->
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Phone Number : </label>
                                    <input type="number" class="form-control" value="{{ old('phone_number', $data->phone_number) }}" id="phone_number" name="phone_number" placeholder="Enter customer phone" required>
                                    <!-- <input type="text" id="fullname" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus /> -->
                                </div>
                                <!-- /.form-group -->
                                <div class="form-group">
                                    <label>Select State</label>
                                    <select class="form-control select2bs4" style="width: 100%;" name="customer_state" id="customer_state">
                                        @foreach($states as $state)
                                        <option value="{{ $state->state_id }}" @selected(old('customer_state')==$state->state_name)>
                                            {{ $state->state_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- /.form-group -->
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Customer Email : </label>
                                    <input type="email" class="form-control" value="{{ old('customer_email', $data->customer_email) }}" id="customer_email" name="customer_email" placeholder="Enter customer email..." required>
                                </div>

                                <div class="form-group">
                                    <label>Date of Delivery : </label>
                                    <input type="date" class="form-control" value="{{ old('date_of_delivery', $data->date_of_delivery) }}" id="date_of_delivery" name="date_of_delivery" required>
                                    <!-- <input type="text" id="fullname" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus /> -->
                                </div>
                            </div>

                            <div class="col-md-6">
                                <!-- /.form-group -->
                                <div class="form-group">
                                    <label>Select Product (Multiple Selection Allowed)</label>
                                    <select class="select2" multiple="multiple" name="products[]" id="products" style="width: 100%;">

                                        @foreach($products as $product)
                                        <option  @selected(old('name')==$product->name)>
                                            {{ $product->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- /.form-group -->

                                <div class="form-group">
                                    <label>Total Cost of Product(s) : </label>
                                    <input type="number" class="form-control" value="{{ old('total_cost_of_products', $data->total_cost_of_products) }}" id="total_cost_of_products" name="total_cost_of_products" placeholder="Enter cost of product" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <!-- /.form-group -->
                                <div class="form-group">
                                    <label>Address : </label>
                                    <textarea name="customer_address" id="customer_address" class="form-control" rows="3" placeholder="Enter customer address..." required>{{ old('customer_address', $data->customer_address) }}
                                    </textarea>
                                </div>
                            </div>

                            <div class="col-md-6">


                                <div class="form-group">
                                    <label>Note : </label>
                                    <textarea name="dispatcher_note" id="dispatcher_note" class="form-control" rows="3" placeholder="Enter Dispatcher note...">{{ old('dispatcher_note', $data->dispatcher_note) }}
                                    </textarea>
                                </div>

                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <button class="btn btn-primary btn-sm" type="submit">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@include('customer.partials.footer')