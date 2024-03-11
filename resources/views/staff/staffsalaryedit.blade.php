@extends('layouts.default')
@section('title', 'Staff Salary Edit')
@section('sidebar')
    @include('include.sidebar')
@endsection
@section('contentdashboard')
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Staff Salary Edit</h5>
                    <small class="text-muted float-end"></small>
                </div>
                <div class="card-body">
 
                    @if (auth()->user()->type == 'admin')
                        <form class="row g-3" method="POST" action={{ route('salary.update', $salarys->staff_id) }}
                            enctype="multipart/form-data">
                        @elseif (auth()->user()->type == 'clerk')
                            <form class="row g-3" method="POST"
                                action={{ route('clerksalary.update', $salarys->staff_id) }} enctype="multipart/form-data">
                            @else
                                return redirect()->route('home');
                    @endif



                    @csrf

                    {{-- @foreach ($salarys as $salary) --}}
                    <div class="col-md-3">

                        <label for="" class="form-label">Staff Name</label>
                        <select class="form-select" id="country-dropdown" required name="staff_name">
                            <option active>Select Staff Name</option>
                            @foreach ($staffs as $staff)
                                <option value="{{ $staff->id }}"{{ $salarys->staff_id == $staff->id ? 'Selected' : '' }}>
                                    {{ $staff->sf_name }}</option>
                            @endforeach
                        </select>

                    </div>
                    <div class="col-md-3">
                        <label for="" class="form-label">Basic Salary</label>
                          <input type="hidden" value="{{ $salarys->date }}"  name="date">
                        <input type="text" class="form-control" value="{{ $salarys->basic_salary }}" id="basic"
                            required name="basic_salary" placeholder="Basic Salary" autocomplete="off">
                    </div>
                    <div class="col-md-3">
                        <label for="" class="form-label">Overtime</label>
                        <input type="text" class="form-control" value="{{ $salarys->overtime }}" id="overtime" required
                            name="overtime" placeholder="Overtime" autocomplete="off">
                    </div>

                    <div class="col-md-3">
                        <label for="" class="form-label">Allowance</label>
                        <input type="text" class="form-control" value="{{ $salarys->allowance }}" id="allowance" required
                            name="allowance" placeholder="Allowance" autocomplete="off">
                    </div>
                    <div class="col-md-3">
                        <label for="" class="form-label">Bonus</label>
                        <input type="text" class="form-control" value="{{ $salarys->bonus }}" id="bonus" required
                            name="bonus" placeholder="Bonus" autocomplete="off">
                    </div>
                    <div class="col-md-3">
                        <label for="" class="form-label">Reduction</label>
                        <input type="text" class="form-control" value="{{ $salarys->reduction }}" id="reduction" required
                            name="reduction" placeholder="Reduction Amount" autocomplete="off">
                    </div>
                    <div class="col-md-3">
                        <label for="" class="form-label">Net salary</label>
                        <input type="text" class="form-control" onclick="add()" name="net_salary" required
                            id="net_salary" placeholder="Net salary" autocomplete="off">
                    </div>
                    <div class="col-md-3">
                        <label for="" class="form-label">Reduction Reason</label>
                        <textarea type="text" class="form-control" id="" name="reduction_reason" placeholder="Reduction Reason"
                            autocomplete="off">{{ $salarys->reduction_reason }}</textarea>
                    </div>
                    <div class="col-md-3">
                        <label for="" class="form-label">Payment Type</label>
                        <select id="salary" name="payment_type" class="form-select" autocomplete="off">
                            <option>Select Payment Type </option>
                            <option value="account"{{ $salarys->payment_method === 'account' ? 'Selected' : '' }}>Account
                                Transfer</option>
                            <option value="cheque"{{ $salarys->payment_method === 'cheque' ? 'Selected' : '' }}>Cheque
                            </option>
                            <option value="cash"{{ $salarys->payment_method === 'cash' ? 'Selected' : '' }}>Cash</option>

                        </select>
                    </div>

                    <div class="col-12">
                        <button type="submit"  class="btn btn-primary ">Submit Form <i class="fa-solid fa-location-arrow"></i></button>
                        @if (auth()->user()->type == 'admin')
                            <a href="{{ url('staffsalary') }}" class="btn btn-dark">Back</a>
                        @elseif (auth()->user()->type == 'clerk')
                            <a href="{{ url('clerk/staffsalary') }}" class="btn btn-dark">Back</a>
                        @else
                            return redirect()->route('home');
                        @endif


                    </div>
                    {{-- @endforeach --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('other-scripts')
    // <script>
    //     function add() {
    //         $(document).ready(function() {


    //             let basic = parseInt($('#basic').val());
    //             // alert("basic");
    //             let overtime = parseInt($('#overtime').val());
    //             let allowance = parseInt($('#allowance').val());
    //             let bonus = parseInt($('#bonus').val());
    //             let reduction = parseInt($('#reduction').val());


    //             $('#net_salary').on('click', function() {
    //                 let net_salary = basic + overtime + allowance + bonus - reduction;
    //                 document.getElementById("net_salary").value = net_salary;
    //             });
    //         })
    //     }
    // </script>
                <script>
    $(document).ready(function() {
        function calculateNetSalary() {
            let basic = parseInt($('#basic').val()) || 0;
            let overtime = parseInt($('#overtime').val()) || 0;
            let allowance = parseInt($('#allowance').val()) || 0;
            let bonus = parseInt($('#bonus').val()) || 0;
            let reduction = parseInt($('#reduction').val()) || 0;

            let net_salary = basic + overtime + allowance + bonus - reduction;
            $('#net_salary').val(net_salary);
        }

        // Calculate net salary on page load
        calculateNetSalary();

        // Bind the calculateNetSalary function to the change event of specified input fields
        $('#basic, #overtime, #allowance, #bonus, #reduction').on('change', function() {
            calculateNetSalary();
        });
    });
</script>
@endpush
