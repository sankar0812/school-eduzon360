@extends('layouts.loginapp')
@section('logintitle', 'Student Login')
@section('contentlogin')
    <div class="limiter">
        <div class="container-login100">

            <div class="wrap-login100">
                <div class="login100-pic js-tilt" data-tilt>
                    <img src="loginasset/images/logo.png" alt="IMG">
                </div>

                <form class="login100-form validate-form" action="{{ route('student.studenthome') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <span class="login100-form-title">
                        Student Login
                    </span>
                    <div class="wrap-input100 validate-input" data-validate="">
                        <!-- <input class="input100" type="text" name="class" placeholder="Class & section" autocomplete="off"> -->
                        {{-- <select class="input100" style="border: none; box-shadow: none; appearance: none;" name="class" >
                            @php
                                $class = DB::table('class_sections')
                                    ->where(['c_status' => 1, 'c_delete' => 1])
                                    ->get();
                            @endphp
                            <option value="" selected disabled hidden>select Class & section</option>
                            @foreach ($class as $section)
                                <option value="{{ $section->id }}">{{ $section->c_class }}</option>
                            @endforeach
                        </select> --}}
                        <input class="input100" type="name" name="name" placeholder="Studend Name" autocomplete="off" required>
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="">
                        <input class="input100" type="number" name="phone" placeholder="Phone Number" autocomplete="off">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">

                            <i class="fa fa-address-book" aria-hidden="true"></i>
                        </span>
                    </div>
                    <div class="wrap-input100 validate-input" data-validate="">
                        <input class="input100" type="date" name="dob" placeholder="Date of Brith"
                            autocomplete="off">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                    </div>
                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn">
                            Login
                        </button>
                        {{-- <a href="{{ url('parent/studenthome') }}" class="login100-form-btn">Login</a> --}}
                    </div>

                    <div class="text-center p-t-136">
                        <a class="txt2" href="">
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
