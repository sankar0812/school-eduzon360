@extends('layouts.default')
@push('other-scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            var maxField = 10; //Input fields increment limitation
            // var addButton = $('.add_button'); //Add button selector
            var wrapper = $('.field_wrapper'); //Input field wrapper
            // var fieldHTML =
            //     '<div><input type="text" placeholder="name" name="field_name[]" value=""/><button href="javascript:void(0);" style="margin:12px;" class="btn btn-info remove_button" title="Add field">close</button></div>'; //New input field html
            // var fieldHTML2 =
            //     '<div><input type="text" placeholder="staff" name="staff[]" value=""/><button href="javascript:void(0);" style="margin:12px;" class="btn btn-info remove_button" title="Add field">close</button></div>'; //New input field html

            // var x = 1; //Initial field counter is 1

            //Once add button is clicked
            // $(addButton).click(function() {
            //     //Check maximum number of input fields
            //     if (x < maxField) {
            //         // x++; //Increment field counter
            //         $(wrapper).append(fieldHTML); //Add field html
            //         $(wrapper).append(fieldHTML2);
            //     }
            // });

            //Once remove button is clicked
            $(wrapper).on('click', '.remove_button', function(e) {
                e.preventDefault();
                // $(this).parent('div').remove(); //Remove field html
                // x--; //Decrement field counter
            });
        });
    </script>
@endpush
@section('title', 'Mark Add')
@section('sidebar')
    @include('include.sidebar')
@endsection
@section('contentdashboard')

    <div class="row">
        <div class="card mb-4">

        <div class="card-body">
            <form action="{{ url('/markinsert') }}" class="" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group row mb-1">
                    <label for="" class="col-sm-2 col-form-label">Class/Section</label>
                    <div class="col-md-5">
                        <select class="form-select" id="country-dropdown" name="sf_nationality">
                            <option active>Select Country</option>
                            @foreach ($classdatas as $classdata)
                                <option value="{{ $classdata->c_class}}">
                                    {{ $classdata->c_class}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="" class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-3">
                        <button type="submit" class="btn btn-primary mb-4 btn-sm">Submit Form <i
                                class="fa-solid fa-location-arrow"></i></button>
                    </div>
                </div>
            </form>
        </div>

        </div>

        <div class="col-xl">
            <form class="row g-3" action="{{url('/markinsert') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">Mark Entry</h6>
                        <!-- <small class="text-muted float-end">Profile Details</small> -->
                    </div>
                    <div class="card-body field_wrapper row g-3">
                        {{-- <div class="field_wrapper"> --}}
                        {{-- <div> --}}
                        @foreach ($students as $student)
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="" class="form-label">Staff id</label>
                                    <input type="text" class="form-control" value="{{ $student->s_name }}" id=""
                                        autocomplete="off" required>
                                    <input type="hidden" class="form-control" value="{{ $student->id }}"
                                        name="first_name[]" id="" autocomplete="off">
                                </div>
                                <div class="col-md-3">
                                    <label for="" class="form-label">Name</label>
                                    <input type="text" class="form-control" name="sf_name" name="staff[]" id=""
                                        placeholder="Enter Mark" autocomplete="off" required>
                                </div>
                            </div>
                        @endforeach
                        {{-- </div> --}}
                        <input type="submit" style="width:50%;" name="submit" class="btn btn-outline-primary mb-3" value="submit">

                        {{-- </div> --}}
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
