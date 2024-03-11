@extends('layouts.default')
@section('title', 'Fees Form')
@section('sidebar')
    @include('include.sidebar')
@endsection
@section('contentdashboard')


    <div class="card">
        <h5 class="card-header">
            {{-- <a href="{{ url('/addstaff') }}" class="btn btn-outline-primary btn-sm">Add</a> --}}
        </h5>
        <div class="table-responsive text-nowrap feesforms">
            <table class="table table-primary table-bordered table-striped ">

                <thead class="table-dark">
                    <tr>
                        <th colspan="3">
                            <h2 class="text-center">ideaux IT school</h2>
                            <form>
                                <div class="row">
                                    <div class="col-12">
                                        @php
                                            $class = DB::table('class_sections')
                                                ->where(['c_status' => 1, 'c_delete' => 1])
                                                ->get();
                                        @endphp
                                        <label>class & section</label>
                                        <select class="form-control" id="classdropdown" name="class">
                                            <option></option>
                                            @foreach ($class as $section)
                                                <option value="{{ $section->id }}">{{ $section->c_class }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <label>Name</label>
                                        {{-- <input type="text" class="form-control" id="state-dropdown" placeholder="name"> --}}
                                        <select class="form-select" id="student_name-dropdown" name="student_name">
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </th>

                    </tr>
                    <tr>

                        <th>particular</th>
                        <th> Due Amount (Rs)</th>
                        <th> Amount(Rs) to Pay </th>
                    </tr>
                </thead>
                <tbody class="text-dark">
                    @if (auth()->user()->type == 'admin')
                        <form action="{{ route('fees.add') }}" class="" method="post" enctype="multipart/form-data">
                        @elseif (auth()->user()->type == 'accountant')
                            <form action="{{ route('accountant.feesadd') }}" class="" method="post"
                                enctype="multipart/form-data">
                            @else
                                return redirect()->route('home');
                    @endif

                    @csrf
                    <tr>

                        <td>Admission Fee</td>
                        <td> <input type="text" name="admission" id="admission" class="bgtable form-control"
                                style="background-color: transparent;color:black; font-weight:bolder;" readonly>
                            <input type="hidden" name="student" id="studentid" class="bgtable form-control"
                                style="background-color: transparent;color:black; font-weight:bolder;" readonly>
                            <input type="hidden" name="class" id="class" class="bgtable form-control"
                                style="background-color: transparent;color:black; font-weight:bolder;" readonly>
                            <input type="hidden" name="totaldue" id="totaldue" class="bgtable form-control"
                                style="background-color: transparent;color:black; font-weight:bolder;" readonly>
                        </td>
                        {{-- @php
                                $fees = DB::table('fees')
                                    ->join('paidfees', 'paidfees.student_id', '=', 'fees.student_id')
                                    ->select('paidfees.*','fees.*')
                                    ->where(['fees.status' => 1])
                                    ->get();
                            @endphp --}}
                        <td> <input type="text" name="admissionfees" id="admissionfees" class="bgtable form-control">
                            {{-- @foreach ($fees as $fee)
                                <option value="{{ $fee->id }}">{{ $fee->admission }}</option>
                            @endforeach --}}
                            {{-- <form> --}}
                            {{-- <label for="appt-time">Choose an appointment time: </label> --}}
                            {{-- <input id="appt-time" type="time" name="appt-time" step="2" />
                              </form> --}}
                        </td>
                    </tr>
                    <tr>

                        <td>Term1 Fee</td>
                        <td><input type="text" name="" id="term1" class="bgtable form-control"
                                style="background-color: transparent;color:black; font-weight:bolder;" readonly>
                        </td>
                        <td><input type="text" name="term1fees" id="term1fees" class="bgtable form-control">
                        </td>
                    </tr>
                    <tr>

                        <td>Term2 Fee</td>
                        <td><input type="text" name="" id="term2" class="bgtable form-control"
                                style="background-color: transparent;color:black; font-weight:bolder;" readonly>
                        </td>
                        <td><input type="text" name="term2fees" id="term2fees" class="bgtable form-control">
                        </td>
                    </tr>
                    <tr>

                        <td>Term3 Fee</td>
                        <td><input type="text" name="" id="term3" class="bgtable form-control"
                                style="background-color: transparent;color:black; font-weight:bolder;" readonly>
                        </td>
                        <td><input type="text" name="term3fees" id="term3fees" class="bgtable form-control">
                            {{-- <input type="text" name="admisso" id="admission" class="bgtable form-control"> --}}
                        </td>
                    </tr>
                    {{-- <tr>

                            <td>Special Fee</td>
                            <td><input type="text" name="" id="special" class="bgtable form-control" style="background-color: transparent;color:black; font-weight:bolder;" readonly>
                            </td>
                            <td><input type="text" name="specialfees" id="specialfees" class="bgtable form-control" >
                            </td>
                        </tr> --}}
                    <tr>

                        <td>Book Fee</td>
                        <td><input type="text" name="" id="book" class="bgtable form-control"
                                style="background-color: transparent;color:black; font-weight:bolder;" readonly>
                        </td>
                        <td><input type="text" name="bookfees" id="bookfees" class="bgtable form-control">
                        </td>
                    </tr>
                    <tr>

                        <td>Uniform Fee</td>
                        <td><input type="text" name="" id="uniform" class="bgtable form-control"
                                style="background-color: transparent;color:black; font-weight:bolder;" readonly>
                        </td>
                        <td><input type="text" name="uniformfees" id="uniformfees" class="bgtable form-control">
                            {{-- <input type="hidden" name="studentid" id="studentid" class="bgtable form-control"> --}}
                        </td>
                    </tr>
                    <tr>

                        <td>Fine</td>
                        <td><input type="text" name="" id="fine" class="bgtable form-control"
                                style="background-color: transparent;color:black; font-weight:bolder;" readonly>
                        </td>
                        <td><input type="text" name="finefees" id="finefees" class="bgtable form-control">
                        </td>
                    </tr>

                    <tr>

                        <td>Other Fee</td>
                        <td><input type="text" name="" id="other" class="bgtable form-control"
                                style="background-color: transparent;color:black; font-weight:bolder;" readonly>
                        </td>
                        <td><input type="text" name="otherfees" id="otherfees" class="bgtable form-control">
                        </td>
                    </tr>
                    <tr>
                        <td>Total</td>
                        <td><input type="text" name="" id="total" class="bgtable form-control"
                                style="background-color: transparent;color:black; font-weight:bolder;" readonly></td>
                        <td><input type="text" name="totalfees" onclick="add()" id="totalfees"
                                class="bgtable form-control"></td>
                    </tr>
                    <tr>
                        <td colspan="3">
                             {{-- <button type="submit" class="btn btn-outline-primary"><i
                                    class="fa-solid fa-arrow-up-from-bracket fa-xl"></i></button> --}}
                                    <button type="submit" class="btn btn-primary ">Submit Form <i
                                        class="fa-solid fa-location-arrow"></i></button>
                                </td>
                    </tr>

                    </form>
                </tbody>
            </table>
        </div>
    </div>

@endsection
@push('other-scripts')
    <script>
        function add() {
            $(document).ready(function() {

                let admission = parseInt($('#admissionfees').val());
                let term1 = parseInt($('#term1fees').val());
                let term2 = parseInt($('#term2fees').val());
                let term3 = parseInt($('#term3fees').val());
                let bookfees = parseInt($('#bookfees').val());
                let uniformfees = parseInt($('#uniformfees').val());
                let finefees = parseInt($('#finefees').val());
                let otherfees = parseInt($('#otherfees').val());
                $('#totalfees').on('click', function() {
                    let total = admission + term1 + term2 + term3 + otherfees + bookfees + uniformfees +
                        finefees;
                    // $("#state-dropdown").htmlg('');
                    // console.log(total);
                    document.getElementById("totalfees").value = total;

                    // $("#total").append(total);




                });
            })
        }

        //  alert("0");
        $(document).ready(function() {
            $('#classdropdown').on('change', function() {
                // alert("0");
                var class_id = this.value;
// alert(class_id);
                $("#student_name-dropdown").html('');
                $.ajax({
                    url: "{{ url('get-student-by-class') }}",
                    type: "POST",
                    data: {
                        class_id: class_id,
                        _token: '{{ csrf_token() }}'

                    },
                    dataType: 'json',
                    success: function(response) {
                        // alert(0);
                        console.log(response,'jdfjsd');
                        $('#student_name-dropdown').html(
                            '<option value="">Select Student</option>');
                        $.each(response.students, function(key, value) {
                            $("#student_name-dropdown").append('<option value="' + value
                                .id +
                                '">' + value.s_name + '</option>');

                        });
                    },
                    error: function(err) {
                        console.log(err, 'err');


                    }
                });
            });

        });


        $(document).ready(function() {
            $('#student_name-dropdown').on('change', function() {
                // alert("0");
                var student_id = this.value;
                // alert(student_id);
                // $("#student_name-dropdown").html('');
                $.ajax({
                    url: "{{ url('get-fees-by-student') }}",
                    type: "POST",
                    data: {
                        student_id: student_id,
                        _token: '{{ csrf_token() }}'

                    },
                    dataType: 'json',
                    success: function(response) {
                        console.log(response, 'jdfjsd');

                        document.getElementById("admission").value = response.fees.admission;
                        document.getElementById("term1").value = response.fees.term1;
                        document.getElementById("term2").value = response.fees.term2;
                        document.getElementById("term3").value = response.fees.term3;
                        document.getElementById("book").value = response.fees.books;
                        document.getElementById("uniform").value = response.fees.uniform;
                        document.getElementById("fine").value = response.fees.fine;
                        document.getElementById("other").value = response.fees.extra;
                        document.getElementById("total").value = response.fees.total;
                        document.getElementById("studentid").value = response.fees.student_id;
                        document.getElementById("totaldue").value = response.fees.total;
                        document.getElementById("class").value = response.fees.s_classid;


                        // document.getElementById("admissionfees").value = response.paidfees.admissionfees;
                        // });
                        // $("#edit-form [name=\"admissionfees\"]").val(response.admission);
                    },
                    error: function(err) {
                        console.log(err, 'err');
                        // $('#student_name-dropdown').html('<option value="">Select Student</option>');
                        // $.each(result.students, function(key, value) {
                        //     $("#student_name-dropdown").append('<option value="' + value.s_name +
                        //         '">' + value.s_name + '</option>');
                        // });

                    }
                });





            });

        });
    </script>
@endpush
