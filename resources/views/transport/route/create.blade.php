@extends('layouts.default')
@section('title', 'Add Routes')
@section('sidebar')
    @include('include.sidebar')
@endsection
@section('contentdashboard')

<hr class="my-3" />
<h4 class="fw-bold py-2"><span class="text-muted fw-light"></span>Add Routes</h4>
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
             
                <div class="card-body">

                <form action="{{ route('route.add') }}" method="post" enctype="multipart/form-data">
                            @elseif (auth()->user()->type == 'clerk')
                            <form action="{{ route('clerk.route.add') }}" method="post" enctype="multipart/form-data">
                                @else
                                return redirect()->route('home');
                                @endif


                                <div class="modal-body ">

                                    @csrf

                                    <div class="form-group">
                                        <label for="name">Route Name:</label>
                                        <input type="text" name="routetitle" id="name" class="form-control" value="{{ old('name') }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="starting_point">Starting Point:</label>
                                        <input type="text" name="starting_point" id="starting_point" class="form-control" value="{{ old('starting_point') }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="ending_point">Ending Point:</label>
                                        <input type="text" name="ending_point" id="ending_point" class="form-control" value="{{ old('ending_point') }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="sub_main_locations">Sub Main Locations:</label>
                                        <div id="sub-main-locations-container">
                                            <!-- Sub Main Locations will be added dynamically here -->
                                        </div>
                                        <button type="button" class="btn btn-success" id="add-sub-main-location">Add Sub Main Location</button>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="" class="col-sm-3 col-form-label"></label>
                                    <div class="col-sm-6">
                                        <button type="submit" class="btn btn-primary mb-2 ">Submit Form <i class="fa-solid fa-location-arrow"></i></button>
                                    </div>
                                </div>
                            </form>
            </div>
        </div>

    </div>



@endsection
@push('other-scripts')
<script>
        // JavaScript for dynamic addition and deletion of sub-main locations
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('sub-main-locations-container');
            const addButton = document.getElementById('add-sub-main-location');

            addButton.addEventListener('click', function() {
                const row = document.createElement('div');
                row.classList.add('sub-main-location-row', 'row', 'mb-2');

                const inputColumn = document.createElement('div');
                inputColumn.classList.add('col-8');

                const input = document.createElement('input');
                input.type = 'text';
                input.name = 'sub_main_locations[]';
                input.classList.add('form-control');

                inputColumn.appendChild(input);

                const deleteButtonColumn = document.createElement('div');
                deleteButtonColumn.classList.add('col-4');

                const deleteButton = document.createElement('button');
                deleteButton.type = 'button';
                deleteButton.classList.add('btn', 'btn-danger', 'w-100');
                deleteButton.textContent = 'Remove';
                deleteButton.addEventListener('click', function() {
                    container.removeChild(row);
                });

                deleteButtonColumn.appendChild(deleteButton);

                row.appendChild(inputColumn);
                row.appendChild(deleteButtonColumn);

                container.appendChild(row);
            });
        });
    </script>
@endpush
