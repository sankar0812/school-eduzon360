@extends('layouts.default')
@section('title', 'Route Details')
@section('sidebar')
    @include('include.sidebar')
@endsection
@section('contentdashboard')
    <h5 class="fw-bold mb-3"><span class="text-muted fw-light"></span>Route List</h5>
    <!-- Student List -->
    <div class="card p-2">
        <div class="table-responsive text-nowrap">
            <table class="table" id="example">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Route Title</th>
                        <th>Starting Point</th>
                        <th>Ending Point</th>
                        <th>Sub Main Locations</th>
                        <th>Action</th>
                    </tr>
                </thead>
                @extends('layouts.default')
@section('title', 'Route Details')
@section('sidebar')
    @include('include.sidebar')
@endsection
@section('contentdashboard')
    <h5 class="fw-bold mb-3"><span class="text-muted fw-light"></span>Route List</h5>
    <!-- Student List -->
    <div class="card p-2">
        <div class="table-responsive text-nowrap">
            <table class="table" id="example">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Route Title</th>
                        <th>Starting Point</th>
                        <th>Ending Point</th>
                       
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($routes as $route)
                        <tr>
                            <td>{{ $route->id }}</td>
                            <td>
                                <div class="editable-field" data-type="text" data-route-id="{{ $route->id }}" data-field="routetitle">{{ $route->routetitle }}</div>
                            </td>
                            <td>
                                <div class="editable-field" data-type="text" data-route-id="{{ $route->id }}" data-field="starting_point">{{ $route->starting_point }}</div>
                            </td>
                            <td>
                                <div class="editable-field" data-type="text" data-route-id="{{ $route->id }}" data-field="ending_point">{{ $route->ending_point }}</div>
                            </td>
                        
                            <td>
                                <button class="btn btn-primary edit-route" data-bs-toggle="modal" data-bs-target="#editRouteModal{{ $route->id }}">Edit</button>
                                <!-- Add other action buttons as needed -->
                            </td>
                        </tr>

                        <!-- Edit Route Modal -->
                        <div class="modal fade" id="editRouteModal{{ $route->id }}" tabindex="-1" aria-labelledby="editRouteModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editRouteModalLabel">Edit Route</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('route.update', $route->id) }}" method="post">
                                            @csrf
                                          

                                            <div class="mb-3">
                                                <label for="edit-routetitle" class="form-label">Route Title</label>
                                                <input type="text" class="form-control" id="edit-routetitle" name="routetitle" value="{{ $route->routetitle }}">
                                            </div>

                                            <div class="mb-3">
                                                <label for="edit-starting_point" class="form-label">Starting Point</label>
                                                <input type="text" class="form-control" id="edit-starting_point" name="starting_point" value="{{ $route->starting_point }}">
                                            </div>

                                            <div class="mb-3">
                                                <label for="edit-ending_point" class="form-label">Ending Point</label>
                                                <input type="text" class="form-control" id="edit-ending_point" name="ending_point" value="{{ $route->ending_point }}">
                                            </div>

                                            <div class="mb-3">
                                                <label for="edit-sub-main-locations" class="form-label">Sub Main Locations</label>
                                                <div id="edit-sub-main-locations-container-{{ $route->id }}">
                                                    @foreach($route->subRouteLocations as $subMainLocation)
                                                        <div class="sub-main-location-row row mb-2">
                                                            <div class="col-8">
                                                                <div class="editable-field" data-type="text" data-route-id="{{ $route->id }}" data-field="sub_main_locations">{{ $subMainLocation->name }}</div>
                                                            </div>
                                                            <div class="col-4">
                                                                <button type="button" class="btn btn-danger w-100" onclick="removeSubMainLocation(this)">Remove</button>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <button type="button" class="btn btn-success" onclick="addSubMainLocation({{ $route->id }})">Add Sub Main Location</button>
                                            </div>

                                      

                                            <button type="button" class="btn btn-primary" onclick="submitEditForm({{ $route->id }})">Save Changes</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const editableFields = document.querySelectorAll('.editable-field');

            editableFields.forEach(field => {
                field.addEventListener('click', function() {
                    const fieldType = this.getAttribute('data-type');
                    const fieldId = this.getAttribute('data-route-id');
                    const fieldName = this.getAttribute('data-field');
                    const fieldValue = this.textContent;

                    const inputElement = document.createElement('input');
                    inputElement.type = fieldType;
                    inputElement.value = fieldValue;

                    inputElement.addEventListener('blur', function() {
                        const updatedValue = this.value;
                        updateFieldOnServer(fieldId, fieldName, updatedValue);
                    });

                    this.textContent = '';
                    this.appendChild(inputElement);
                    inputElement.focus();
                });
            });
        });

        // Function to add new sub-main locations dynamically
        function addSubMainLocation(routeId) {
            const container = document.getElementById(`edit-sub-main-locations-container-${routeId}`);
            const row = document.createElement('div');
            row.classList.add('sub-main-location-row', 'row', 'mb-2');

            const inputColumn = document.createElement('div');
            inputColumn.classList.add('col-8');

            const input = document.createElement('input');
            input.type = 'text';
            input.name = `sub_main_locations[${routeId}][]`;
            input.classList.add('form-control');

            inputColumn.appendChild(input);

            const deleteButtonColumn = document.createElement('div');
            deleteButtonColumn.classList.add('col-4');

            const deleteButton = document.createElement('button');
            deleteButton.type = 'button';
            deleteButton.classList.add('btn', 'btn-danger', 'w-100');
            deleteButton.textContent = 'Remove';
            deleteButton.addEventListener('click', function () {
                container.removeChild(row);
            });

            deleteButtonColumn.appendChild(deleteButton);

            row.appendChild(inputColumn);
            row.appendChild(deleteButtonColumn);

            container.appendChild(row);
        }

        // Function to remove sub-main locations dynamically
        function removeSubMainLocation(element) {
            const row = element.closest('.sub-main-location-row');
            row.parentNode.removeChild(row);
        }

        // Function to submit the edited form
        function submitEditForm(routeId) {
            // Get the form element
            const form = document.getElementById(`editRouteForm${routeId}`);
            const formData = new FormData(form);

            // Perform AJAX request to update the data on the server
            fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                console.log(data); // You can handle the response as needed
                // Optionally, you can close the modal or update the UI based on the response
            })
            .catch(error => {
                console.error('Error:', error);
                // Handle errors if any
            });
        }

        // Function to update the field on the server
        function updateFieldOnServer(routeId, fieldName, updatedValue) {
            // Perform AJAX request to update the data on the server
            fetch('{{ route("route.update", ['id' => $route->id]) }}', {

                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: JSON.stringify({
                    route_id: routeId,
                    field_name: fieldName,
                    updated_value: updatedValue,
                }),
            })
            .then(response => response.json())
            .then(data => {
                console.log(data); // You can handle the response as needed
                // Optionally, you can close the modal or update the UI based on the response
            })
            .catch(error => {
                console.error('Error:', error);
                // Handle errors if any
            });
        }
    </script>
@endsection

            </table>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const editableFields = document.querySelectorAll('.editable-field');

            editableFields.forEach(field => {
                field.addEventListener('click', function() {
                    const fieldType = this.getAttribute('data-type');
                    const fieldId = this.getAttribute('data-route-id');
                    const fieldName = this.getAttribute('data-field');
                    const fieldValue = this.textContent;

                    const inputElement = document.createElement('input');
                    inputElement.type = fieldType;
                    inputElement.value = fieldValue;

                    inputElement.addEventListener('blur', function() {
                        const updatedValue = this.value;
                        // Perform AJAX request to update the data on the server
                        // You can use fetch or other AJAX methods for this purpose

                        // For simplicity, we're just updating the content on the page
                        this.parentNode.textContent = updatedValue;
                    });

                    this.textContent = '';
                    this.appendChild(inputElement);
                    inputElement.focus();
                });
            });
        });

        // Function to add new sub-main locations dynamically
        function addSubMainLocation(routeId) {
            const container = document.getElementById(`sub-main-locations-container-${routeId}`);
            const row = document.createElement('div');
            row.classList.add('sub-main-location-row', 'row', 'mb-2');

            const inputColumn = document.createElement('div');
            inputColumn.classList.add('col-8');

            const input = document.createElement('input');
            input.type = 'text';
            input.name = `sub_main_locations[${routeId}][]`;
            input.classList.add('form-control');

            inputColumn.appendChild(input);

            const deleteButtonColumn = document.createElement('div');
            deleteButtonColumn.classList.add('col-4');

            const deleteButton = document.createElement('button');
            deleteButton.type = 'button';
            deleteButton.classList.add('btn', 'btn-danger', 'w-100');
            deleteButton.textContent = 'Remove';
            deleteButton.addEventListener('click', function () {
                container.removeChild(row);
            });

            deleteButtonColumn.appendChild(deleteButton);

            row.appendChild(inputColumn);
            row.appendChild(deleteButtonColumn);

            container.appendChild(row);
        }

        // Function to remove sub-main locations dynamically
        function removeSubMainLocation(element) {
            const row = element.closest('.sub-main-location-row');
            row.parentNode.removeChild(row);
        }

        // Function to submit the edited form
        function submitEditForm(routeId) {
            const form = document.getElementById(`editRouteForm${routeId}`);
            // Perform any additional validation or processing if needed
            form.submit();
        }
    </script>
@endsection
