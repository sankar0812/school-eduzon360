@extends('layouts.default')
@section('title', 'Vechicle_Edit')
@section('sidebar')
    @include('include.sidebar')
@endsection
@section('contentdashboard')
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="mb-0">Vechicle_Edit</h6>
                    <small class="text-muted float-end"></small>
                </div>
                <div class="card-body">
                    <form class="row g-3">
                        <div class="col-md-6">
                            <label for="" class="form-label">Registration No</label>
                            <input type="text" class="form-control" name="Regno" id=""
                                placeholder="Registration No" autocomplete="off" required>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Registration Date</label>
                            <input type="text" class="form-control" name="regdate" id=""
                                placeholder="Registration Date" autocomplete="off" required>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">chassis No</label>
                            <input type="text" class="form-control" name="chassisno" id=""
                                placeholder="chassis No" autocomplete="off" required>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Engine No</label>
                            <input type="text" class="form-control" name="engineno" id=""
                                placeholder="Engine No" autocomplete="off" required>
                        </div>
                        <div class="col-md-12">
                            <label for="" class="form-label">Owner Name</label>
                            <input type="text" class="form-control" name="ownername" id=""
                                placeholder="Owner Name" autocomplete="off" required>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">vechicle Class</label>
                            <input type="text" class="form-control" name="vechicleclass" id=""
                                placeholder="vechicle Class" autocomplete="off" required>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">chassis No</label>
                            <input type="text" class="form-control" name="chassisno" id=""
                                placeholder="chassis No" autocomplete="off" required>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Engine No</label>
                            <input type="text" class="form-control" name="engineno" id=""
                                placeholder="Engine No" autocomplete="off" required>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Fuel</label>
                            <input type="text" class="form-control" name="fuel" id="" placeholder="Fuel"
                                autocomplete="off" required>
                        </div>
                        <div class="col-md-12">
                            <label for="" class="form-label">Maker/Model</label>
                            <input type="text" class="form-control" name="maker_model" id=""
                                placeholder="Maker/Model" autocomplete="off" required>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Fitness/REGN upto</label>
                            <input type="text" class="form-control" name="fitness" id=""
                                placeholder="Fitness/REGN upto" autocomplete="off" required>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">FC upto</label>
                            <input type="text" class="form-control" name="fc" id=""
                                placeholder="FC upto" autocomplete="off" required>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Mv TaX upto</label>
                            <input type="text" class="form-control" name="mvtax" id=""
                                placeholder="Mv TaX upto" autocomplete="off" required>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Insurance Upto</label>
                            <input type="text" class="form-control" name="insurance" id=""
                                placeholder="Insurance Upto" autocomplete="off" required>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">PUCC upto</label>
                            <input type="text" class="form-control" name="pucc" id=""
                                placeholder="PUCC upto" autocomplete="off" required>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Emission Norms</label>
                            <input type="text" class="form-control" name="insurance" id=""
                                placeholder="Insurance Upto" autocomplete="off" required>
                        </div>

                        <div class="col-12">

                            <button type="submit" class="btn btn-primary">Update Form <i
                                    class="fa-solid fa-location-arrow"></i></button>
                            <a href="{{ url('vehicledetails') }}" class="btn btn-dark">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>


@endsection
