@extends('admin.layouts.master')

@section('content')
    <!-- Main Content -->

    <section class="section">
        <div class="section-header">
            <h1>Coupon</h1>

        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12 col-md-6 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Create Coupon</h4>

                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.coupons.store') }}" method="POST">
                                @csrf

                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="name">
                                </div>

                                <div class="form-group">
                                    <label>Coupon Code</label>
                                    <input type="text" class="form-control" name="code">
                                </div>

                                <div class="form-group">
                                    <label>Quantity</label>
                                    <input type="text" class="form-control" name="quantity">
                                </div>

                                <div class="form-group">
                                    <label>Max Use Per Person</label>
                                    <input type="text" class="form-control" name="max_use">
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Start Date</label>
                                            <input type="text" class="form-control datepicker" name="start_date">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>End Date</label>
                                            <input type="text" class="form-control datepicker" name="end_date">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="inputState">Category</label>
                                            <select id="inputState" class="form-control main-category" name="discount_type">
                                                <option value="percent">Percentage (%)</option>
                                                <option value="amount">Amount ({{$settings->currency_icon}})</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>Discount Value</label>
                                            <input type="text" class="form-control" name="discount">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputState">Status</label>
                                    <select id="inputState" class="form-control" name="status">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary">Create</button>
                            </form>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </section>
@endsection
