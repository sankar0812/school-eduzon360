@extends('layouts.default')
@section('title', 'fees')
@section('sidebar')
    @include('include.sidebar')
@endsection
@section('contentdashboard')

    <h5 class="fw-bold  mb-3"><span class="text-muted fw-light"></span>Fees Details</h5>
    <div class="col-xl-12 ">
        <div class="nav-align-top mb-4">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-top-route" aria-controls="navs-top-route" aria-selected="true"
                        style="font-weight:bold;">
                        Fees Collection
                    </button>
                </li>
                <li class="nav-item">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-top-vehicle" aria-controls="navs-top-vehicle" aria-selected="false"
                        style="font-weight:bold;">
                        Assign Fees (For Class)
                    </button>
                </li>
                <li class="nav-item">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-top-class-assign" aria-controls="navs-top-class-assign" aria-selected="false"
                        style="font-weight:bold;">
                        Fee Structure (For Class)
                    </button>
                </li>
            </ul>

            <div class="tab-content">

                <div class="tab-pane fade show active" id="navs-top-route" role="tabpanel">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="container">


                                @if (isset($feesCollection))
                                    <h5>Edit Fees Collection</h5>
                                    <form method="post">
                                        @method('PATCH')
                                    @else
                                        <h5>Create Fees Collection</h5>

                                        @if (auth()->user()->type == 'admin')
                                            <form method="post" action="{{ route('adminfeescollection.store') }}">
                                            @elseif (auth()->user()->type == 'accountant')
                                                <form method="post" action="{{ route('accountantfeescollection.store') }}">
                                                @else
                                                    return redirect()->route('home');
                                        @endif

                                @endif
                                @csrf
                                @php
                                    $class = DB::table('class_sections')
                                        ->where(['c_status' => 1, 'c_delete' => 1])
                                        ->get();
                                @endphp

                                <div class="form-group row mb-3">
                                    <label class="col-sm-3 col-form-label" for="classSelectid">Select Class:</label>
                                    <div class="col-md-9">
                                        <select class="form-control" id="classSelectid" name="class_id" required>
                                            <option disabled selected>Select Class</option>
                                            @foreach ($class as $section)
                                                <option value="{{ $section->id }}"
                                                    {{ isset($record) && $record->class_id == $section->id ? 'selected' : '' }}>
                                                    {{ $section->c_class }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label class="col-sm-3 col-form-label" for="student_id">Student :</label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="student_id" id="student_id" required>
                                            <option disabled selected>Select Student</option>
                                            <!-- Options will be dynamically populated based on the selected class -->
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label class="col-sm-3 col-form-label" for="balance">Balance:</label>
                                    <div class="col-md-9">
                                        <input type="text" readonly name="balance" id="balance" class="form-control"
                                            value="{{ isset($feesCollection) ? $feesCollection->balance : '' }}">
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label class="col-sm-3 col-form-label" for="amount">Amount:</label>
                                    <div class="col-md-9">
                                        <input type="text" name="amount" id="amount" class="form-control"
                                            value="{{ isset($feesCollection) ? $feesCollection->amount : old('amount') }}">
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label class="col-sm-3 col-form-label" for="paid_date">Paid Date:</label>
                                    <div class="col-md-9">
                                        <input type="text" readonly name="paid_date" id="paid_date" class="form-control"
                                            value="{{ $currentDate = now()->format('d-m-Y') }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    @php
                                        $month = date('m');

                                        $currentDate = now();
                                        $nextYe = $currentDate->format('Y');
                                        $nextYear = $currentDate->addYear()->format('y');

                                        if ($month >= '06') {
                                            $fyear = $nextYe . '-' . $nextYear;
                                        } else {
                                            $fyear = $nextYe - 1 . '-' . ($nextYear - 1);
                                        }
                                    @endphp
                                    
                                    

                                    <label class="col-sm-3 col-form-label" for="academic_date">Academic Date:</label>
                                    <div class="col-md-9">
                                        <input type="text" name="academic_date" readonly id="academic_date"
                                            class="form-control" value="{{ $fyear }}">
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label class="col-sm-3 col-form-label" for="student_id">Payment Mode :</label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="payment" id="" required>
                                            <option disabled selected>Select Mode</option>
                                            <option value="Cash">Cash</option>
                                            <option value="online">Online</option>
                                        </select>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    @if (isset($feesCollection))
                                        Update Fees Collection
                                    @else
                                        Create Fees Collection
                                    @endif
                                </button>
                                </form>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    Student Fee History
                                </div>
                                <div class="card-body" id="feeHistoryCard">
                                    <p>Loading...</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="navs-top-vehicle" role="tabpanel">

                    <div class="row">
                        <div class="col-md-3">


                            <div>
                                <!-- Add your other HTML content here -->
                                @if (auth()->user()->type == 'admin')
                                    <form action="{{ route('adminfees.export') }}" method="POST">
                                    @elseif (auth()->user()->type == 'accountant')
                                        <form action="{{ route('accountantfees.export') }}" method="POST">
                                        @else
                                            return redirect()->route('home');
                                @endif


                                @csrf

                                @php
                                    $class = DB::table('class_sections')
                                        ->where(['c_status' => 1, 'c_delete' => 1])
                                        ->get();
                                @endphp


                                <div class="form-group row mb-3">
                                    <label class="col-sm-6 col-form-label" for="classSelect">Select Class:</label>

                                    <div class="col-md-6">
                                        <select name="class_id" id="classSelect" class="form-control" required>
                                            <option disabled selected>Select Class</option>
                                            @foreach ($class as $section)
                                                <option value="{{ $section->id }}">{{ $section->c_class }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>





                                <button type="submit" class="btn btn-primary">Download</button>
                                </form>
                                <!-- <table id="studentsTable" class="table table-striped table-hover"> -->
                                <!-- Table headers will be dynamically added using JavaScript -->
                                <!-- </table> -->


                            </div>

                        </div>
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <div>
                                <!-- Display success or error messages, if any -->
                                @if (session('success'))
                                    <div style="color: green;">{{ session('success') }}</div>
                                @endif

                                @if (session('error'))
                                    <div style="color: red;">{{ session('error') }}</div>
                                @endif

                                <!-- Add your other HTML content here -->
                                @if (auth()->user()->type == 'admin')
                                    <form action="{{ route('adminfees.import') }}" method="post"
                                        enctype="multipart/form-data">
                                    @elseif (auth()->user()->type == 'accountant')
                                        <form action="{{ route('accountantfees.import') }}" method="post"
                                            enctype="multipart/form-data">
                                        @else
                                            return redirect()->route('home');
                                @endif
                                @csrf

                                <div class="form-group row mb-3">
                                    <label class="col-sm-6 col-form-label" for="file">Select Excel File To
                                        Upload:<b>(Fees Upload)</b></label>

                                    <div class="col-md-6">
                                        <input type="file" name="file" accept=".xlsx" class="form-control"
                                            autocomplete="off" data-bs-backdrop="static">
                                    </div>
                                </div>
                                <!-- <input type="file" name="file" accept=".xlsx"> -->
                                <button type="submit" class="btn btn-primary">Upload</button>
                                </form>

                            </div>

                        </div>
                    </div>




                </div>

                <div class="tab-pane fade" id="navs-top-class-assign" role="tabpanel">
                    <div class="card-body row g-3">
                        <div class="col-md-6">

                            @if (auth()->user()->type == 'admin')
                                <form method="post"
                                    action="{{ isset($record) ? route('adminfee-structure.update', ['id' => $record->id]) : route('adminfee-structure.store') }}">
                                @elseif (auth()->user()->type == 'accountant')
                                    <form method="post"
                                        action="{{ isset($record) ? route('accountantfee-structure.update', ['id' => $record->id]) : route('accountantfee-structure.store') }}">
                                    @else
                                        return redirect()->route('home');
                            @endif

                            @csrf
                            @if (isset($record))
                                @method('PUT')
                            @endif

                            @php
                                $class = DB::table('class_sections')
                                    ->where(['c_status' => 1, 'c_delete' => 1])
                                    ->get();
                            @endphp

                            <div class="form-group row mb-3">
                                <label class="col-sm-3 col-form-label" for="class_id">Select Class:</label>
                                <div class="col-md-9">
                                    <select class="form-control" id="class_id" name="class_id" required>
                                        <option disabled selected>Select Class</option>
                                        @foreach ($class as $section)
                                            <option value="{{ $section->id }}"
                                                {{ isset($record) && $record->class_id == $section->id ? 'selected' : '' }}>
                                                {{ $section->c_class }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label class="col-sm-3 col-form-label" for="annual_fee">Enter Annual Fee:</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="annual_fee"
                                        value="{{ isset($record) ? $record->annual_fee : '' }}" required>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label class="col-sm-3 col-form-label" for="exam_fees">Enter Exam Fees:</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="exam_fees"
                                        value="{{ isset($record) ? $record->exam_fees : '' }}" required>
                                </div>
                            </div>

                            <button class="btn btn-primary"
                                type="submit">{{ isset($record) ? 'Update' : 'Submit' }}</button>
                            </form>


                        </div>

                        <div class="col-md-6">


                            <div class="table-responsive text-nowrap">
                                @if ($feeStructures->count() > 0)
                                    <table class="table" id="example3">
                                        <thead>
                                            <tr>
                                                <!-- <th>ID</th> -->
                                                <th>Class</th>
                                                <th>Annual Fee</th>
                                                <th>Exam Fees</th>
                                                <th>Academic Year</th>
                                                <!-- <th>Status</th> -->
                                                <th class="exclude-export">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($feeStructures as $feeStructure)
                                                <tr>
                                                    <!-- <td>{{ $feeStructure->id }}</td> -->
                                                    <td>{{ $feeStructure->c_class }}</td>
                                                    <!-- Assuming you have a relationship to get the class details -->
                                                    <td>{{ $feeStructure->annual_fee }}</td>
                                                    <td>{{ $feeStructure->exam_fees }}</td>
                                                    <td>{{ $feeStructure->academic_year }}</td>
                                                    <!-- <td>{{ $feeStructure->status }}</td> -->
                                                    <td>
                                                        <div class="dropdown">
                                                            <button type="button"
                                                                class="btn p-0 dropdown-toggle hide-arrow"
                                                                data-bs-toggle="dropdown">
                                                                <i class="bx bx-dots-vertical-rounded"></i>
                                                            </button>
                                                            <ul class="dropdown-menu"
                                                                aria-labelledby="dropdownMenuButton3">

                                                                <li><a class="dropdown-item" data-bs-toggle="modal"
                                                                        data-bs-target="#exampleModal13{{ $feeStructure->id }}"><i
                                                                            class="fa-solid fa-pen"></i> Edit</a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <p>No Fee Structure records found.</p>
                                @endif
                            </div>
                            </table>
                        </div>

                    </div>
                </div>

            </div>
        </div>



        @foreach ($feeStructures as $feeStructure)
            <div class="modal fade" id="exampleModal13{{ $feeStructure->id }}" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Fees Structure For Class</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            @if (auth()->user()->type == 'admin')
                                <form method="post"
                                    action="{{ route('adminfee-structure.update', ['id' => $feeStructure->id]) }}">
                                @elseif (auth()->user()->type == 'accountant')
                                    <form method="post"
                                        action="{{ route('accountantfee-structure.update', ['id' => $feeStructure->id]) }}">
                                    @else
                                        return redirect()->route('home');
                            @endif


                            @csrf


                            @php
                                $class = DB::table('class_sections')
                                    ->where(['c_status' => 1, 'c_delete' => 1])
                                    ->get();
                            @endphp

                            <div class="form-group row mb-3">
                                <label class="col-sm-3 col-form-label" for="class_id">Select Class :</label>
                                <div class="col-md-9">
                                    <select class="form-control" id="class_id" name="class_id" readonly required>
                                        <option disabled selected>Select Class</option>
                                        @foreach ($class as $section)
                                            <option  disabled  value="{{ $section->id }}"
                                                {{ optional($feeStructure)->class_id == $section->id ? 'selected' : '' }}>
                                                {{ $section->c_class }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label class="col-sm-3 col-form-label" for="annual_fee">Enter Annual Fee:</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="annual_fee"
                                        value="{{ isset($feeStructure) ? $feeStructure->annual_fee : '' }}" required>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label class="col-sm-3 col-form-label" for="exam_fees">Enter Exam Fees:</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="exam_fees"
                                        value="{{ isset($feeStructure) ? $feeStructure->exam_fees : '' }}" required>
                                </div>
                            </div>
                            <!--<button class="btn btn-primary" type="submit">Update</button>-->
                             <button class="btn btn-primary" type="submit" onclick="return confirm('Only Update Before Assign For a class')">Update</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

@endsection
@push('other-scripts')
    <script>
        $(document).ready(function() {
            $('#classSelectid').change(function() {
                var class_id = $(this).val();

                // Make an AJAX request to fetch students based on the selected class
                $.ajax({
                    url: "{{ url('get-student-by-class-for-fees') }}",
                    type: "POST",
                    data: {
                        class_id: class_id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        // Clear previous options
                        $('#student_id').empty();
                        console.log(response, 'hiii');
                        // Populate students based on the response
                        $('#student_id').append(
                            '<option disabled selected>Select Student</option>');
                        $.each(response.students, function(index, student) {
                            $('#student_id').append('<option value="' + student.id +
                                '">' + student.s_name + '</option>');
                        });
                    },
                    error: function(error) {
                        console.log('Error:', error);
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#student_id').change(function() {
                var class_id = $(classSelectid).val();
                var student_id = $(this).val();

                $.ajax({
                    url: "{{ url('getstudentfeebalance') }}",
                    type: "POST",
                    data: {
                        class_id: class_id,
                        student_id: student_id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        var feeRecords = response.StudentFeeBalance;

                        var feeHistoryCard = document.getElementById('feeHistoryCard');
                        feeHistoryCard.innerHTML = ''; // Clear previous content

                        if (feeRecords.length > 0) {
                            feeRecords.forEach(function(record) {
                                var card = document.createElement('div');
                                card.className = 'card';

                                var cardBody = document.createElement('div');
                                cardBody.className = 'card-body';

                                // Build the card content dynamically
                                cardBody.innerHTML = `
                            <p class="card-text">Total Fees: ${record.total_fees}</p>
                            <p class="card-text">Academic Year: ${record.academic_year}</p>
                            <p class="card-text">Total Balance: ${record.balance}</p>
                            <p class="card-text">Total Fees Paid: ${record.total_fees_paid}</p>
                            <p class="card-text">Fees Paid Details:</p>
                        `;
                                balance.value = record.balance;
                                // Check if paid date is available
                                if (record.fees_collections && record.fees_collections
                                    .length > 0) {
                                    cardBody.innerHTML += '<ul>';
                                    record.fees_collections.forEach(function(
                                    collection) {
                                        cardBody.innerHTML +=
                                            `<li>Date: ${collection.paid_date}, Amount: ${collection.amount}</li>`;
                                    });
                                    cardBody.innerHTML += '</ul>';
                                } else {
                                    cardBody.innerHTML +=
                                        '<p>No fees paid details available.</p>';
                                }

                                card.appendChild(cardBody);
                                feeHistoryCard.appendChild(card);
                            });
                        } else {
                            feeHistoryCard.innerHTML =
                                '<p>No fee records found for this student.</p>';
                        }
                    },
                    error: function(error) {
                        console.log('Error:', error);
                    }
                });
            });
        });
    </script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        var amountInput = document.getElementById('amount');
        var balanceInput = document.getElementById('balance');

        // Assuming record.balance is a JavaScript variable containing the balance value
        var recordBalance = parseFloat('${record.balance}') || 0; // Parse the record.balance as a float

        // Set the initial value of the balance input field
        // Assuming you want to display it as a currency with two decimal places
        balanceInput.value = recordBalance.toFixed(2);

        amountInput.addEventListener('input', function() {
            var amount = parseFloat(amountInput.value) || 0;
            var balance = parseFloat(balanceInput.value);

            if (amount > balance) {
                amountInput.setCustomValidity('Amount (' + amount.toFixed(2) + ') cannot be greater than the balance (' +
                    balance.toFixed(2) + ')');
            } else {
                amountInput.setCustomValidity('');
            }
        });
    });
</script>



@endpush
