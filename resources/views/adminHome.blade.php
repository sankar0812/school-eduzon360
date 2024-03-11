@extends('layouts.default')
@section('sidebar')
    @include('include.sidebar')
@endsection
@section('contentdashboard')
    @if ($schoolinfo == '')
    @else
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span>Welcome - {{ $schoolinfo->name }} | super admin
        </h4>
    @endif
    {{--
        <div class="col-lg-12 mb-4 order-0">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-7">
                        <div class="card-body">
                            @if ($schoolinfo == '')
                            @else
                                <h5 class="card-title text-primary">{{ $schoolinfo->name }}</h5>
                                <p class="mb-4">
                                    {{ strip_tags($schoolinfo->about) }}
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                            <img src="../assets/img/illustrations/man.png" height="140" alt="View Badge User"
                                data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                data-app-light-img="illustrations/man-with-laptop-light.png" />
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    <!--/ Total Revenue -->
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card">
                <a href="" class="d-block">
                    <div class="card-body">
                        <div class="white-box single-summery">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h5>Student</h5>
                                    <p class="mb-0">Total Students</p>
                                </div>
                                <h5 class="gradient-color2">
                                    {{ $students }}
                                </h5>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card">
                <a href="" class="d-block">
                    <div class="card-body">
                        <div class="white-box single-summery">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h5>Staff</h5>
                                    <p class="mb-0">Total staff</p>
                                </div>
                                <h5 class="gradient-color2">
                                    {{ $staffcount }}
                                </h5>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card">
                <a href="" class="d-block">
                    <div class="card-body">
                        <div class="white-box single-summery">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h5>Today Payment</h5>
                                    <p class="mb-0">Total payment</p>
                                </div>
                                <h5 class="gradient-color2">
                                    ₹ {{ $todaypayment }}
                                </h5>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card">
                <a href="" class="d-block">
                    <div class="card-body">
                        <div class="white-box single-summery">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h5>Monthly Expense</h5>
                                    <p class="mb-0">Total Expense</p>
                                </div>
                                <h5 class="gradient-color2">
                                    ₹ {{ $monthlyexpencecount }}
                                </h5>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <hr class="my-3" />
    <h4 class="fw-bold py-3 mb-1"><span class="text-muted fw-light"></span>Total Boys and Girls</h4>
    <div class="row">
        <div class="col-12 col-lg-12 order-3 order-md-3 order-lg-2 mb-4">
            <div class="card">
                <!-- <h3 style="padding: 12px;font-style:italic;font-family:algerian;">Boys And Girls per Class</h3> -->
                <!-- <div id="chart"></div> -->
                <div id="container" >
                    <canvas id="canvas" style="max-height: 450px;"></canvas>
                </div>
                <!-- <div style="height: 350px;">
                                                                <canvas id="chart" width="450" height="200" style="padding:12px; "></canvas>
                                                            </div> -->
            </div>
        </div>
    </div>
    <hr class="my-3" />
    <h4 class="fw-bold py-3 mb-1"><span class="text-muted fw-light"></span>Yearly Admission</h4>
    <!-- Total Revenue -->
    <div class="col-12 col-lg-12 order-3 order-md-3 order-lg-12 mb-4">
        <div class="card h-100">
            <div style="height: 350px;">
                <canvas id="chartContainer" width="450" height="200" style="padding:12px; "></canvas>
            </div>
        </div>
    </div>
@endsection
@push('other-scripts')
<!-- Include Simplebar CSS -->
<link rel="stylesheet" href="https://unpkg.com/simplebar@5.4.0/dist/simplebar.min.css" integrity="sha384-nrDR4a2vAe8bLqL6gruiJq6HcXAK1r/MfKa2Fg2mJZMCouRFwt9i/NdWwnET9gRW" crossorigin="anonymous">

<!-- Include Simplebar JS -->
<script src="https://unpkg.com/simplebar@5.4.0/dist/simplebar.min.js" integrity="sha384-3A4rzU2V/BG2bQEc5Yu8lWfHxJFqOVCXAAYARU3ZI3kT+GTCj6aSjV1vtJ5Gz9F2" crossorigin="anonymous"></script>


    <script>
        var studentCountsByClass = <?php echo json_encode($studentCountsByClass); ?>;
        var ctx = document.getElementById('chartContainer').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: studentCountsByClass.map(entry => entry.academic_year),
                datasets: [{
                    label: 'New Admission Students',
                    data: studentCountsByClass.map(entry => entry.count),
                    backgroundColor: 'rgba(44, 175, 254, 0.6)',
                    borderColor: 'transparent',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true, // Enable responsiveness
                maintainAspectRatio: false, // Allow aspect ratio to change
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Academic Year'
                        },
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: {
                                size: 14,
                                weight: 'bold'
                            },
                            stepSize: 2 // Set the step size for the x-axis ticks
                        }
                    },
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Number of Students'
                        },
                        ticks: {
                            font: {
                                size: 14,
                                weight: 'bold'
                            },
                            stepSize: 1
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        labels: {
                            font: {
                                size: 16,
                                weight: 'bold'
                            }
                        }
                    }
                }
            }
        });
    </script>
    <script>
        var studentCountsByClass = <?php echo json_encode($studentCountsByClassboysandgirls); ?>;
        console.log(studentCountsByClass); // Use console.log for debugging, instead of alert

        var labels = <?php echo json_encode($studentCountsByClassboysandgirls->pluck('c_class')->toArray()); ?>;
        var boysData = <?php echo json_encode($studentCountsByClassboysandgirls->pluck('boys_count')->toArray()); ?>;
        var girlsData = <?php echo json_encode($studentCountsByClassboysandgirls->pluck('girls_count')->toArray()); ?>;

        var barChartData = {
            labels: labels,
            datasets: [{
                    label: 'Boys',
                    backgroundColor: 'rgb(0, 227, 150)',
                    borderColor: 'rgb(88, 255, 197)',
                    borderWidth: 1,
                    data: boysData,
                },
                {
                    label: 'Girls',
                    backgroundColor: 'rgb(0, 143, 251)',
                    borderColor: 'rgb(89, 188, 253)',
                    borderWidth: 1,
                    data: girlsData,
                },
            ],
        };

        var chartOptions = {

            responsive: true,
            legend: {
                position: 'top',
            },
            title: {
                display: true,
                text: 'Boys And Girls per Class', // Add your chart label here
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                    },
                }, ],
            },
        };

        window.onload = function() {
            var ctx = document.getElementById('canvas').getContext('2d');
            window.myBar = new Chart(ctx, {
                type: 'bar',
                horizontal: true,
                data: barChartData,
                options: chartOptions,
            });
        };
    </script>
@endpush
