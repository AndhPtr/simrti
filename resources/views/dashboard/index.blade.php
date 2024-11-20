@extends('layouts.app', [
'class' => '',
'elementActive' => 'dashboard',
'pageTitle' => 'Dashboard'
])

@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5 col-md-4">
                            <div class="icon-big text-center icon-warning">
                                <i class="nc-icon nc-globe text-warning"></i>
                            </div>
                        </div>
                        <div class="col-7 col-md-8">
                            <div class="numbers">
                                <p class="card-category">Aset Kritis Organisasi</p>
                                <p class="card-title">{{ $asetCount }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <hr>
                    <div class="stats">
                        <i class="nc-icon nc-simple-add"></i> Tambah Aset
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5 col-md-4">
                            <div class="icon-big text-center icon-success">
                                <i class="nc-icon nc-money-coins text-success"></i>
                            </div>
                        </div>
                        <div class="col-7 col-md-8">
                            <div class="numbers">
                                <p class="card-category">Risiko Aset Organisasi</p>
                                <p class="card-title">{{ $riskCount }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <hr>
                    <div class="stats">
                        <i class="nc-icon nc-simple-add"></i> Tambah Risiko
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5 col-md-4">
                            <div class="icon-big text-center icon-danger">
                                <i class="nc-icon nc-vector text-danger"></i>
                            </div>
                        </div>
                        <div class="col-7 col-md-8">
                            <div class="numbers">
                                <p class="card-category">Mitigasi Risiko Aset Kritis</p>
                                <p class="card-title">{{ $mitigationCount }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <hr>
                    <div class="stats">
                        <i class="nc-icon nc-simple-add"></i> Tambah Mitigasi
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5 col-md-4">
                            <div class="icon-big text-center icon-primary">
                                <i class="nc-icon nc-favourite-28 text-primary"></i>
                            </div>
                        </div>
                        <div class="col-7 col-md-8">
                            <div class="numbers">
                                <p class="card-category">Pengguna Terdaftar</p>
                                <p class="card-title">{{ $userCount }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <hr>
                    <div class="stats">
                        <i class="nc-icon nc-simple-add"></i> Tambah User
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Risk Levels</h5>
                    <p class="card-category">Distribution of Risks by Level</p>
                </div>
                <div class="card-body">
                    <canvas id="riskLevelChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card card-chart">
                <div class="card-header">
                    <h5 class="card-title">Monthly Risk Trends</h5>
                    <p class="card-category">Number of New Risks Created</p>
                </div>
                <div class="card-body">
                    <canvas id="riskTrendChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Risk Levels Chart
        const riskLevels = @json($riskLevels); // Assume this is an associative array { "5": count, "4": count, ... }
        const levelLabels = ['Very Low', 'Low', 'Medium', 'High', 'Very High'];
        const levelColors = ['#99FF85', '#2BFF00', 'yellow', '#FF5C5C', 'red']; // Corresponding colors
        const levelData = [
            riskLevels[5] || 0, // Very Low
            riskLevels[4] || 0, // Low
            riskLevels[3] || 0, // Medium
            riskLevels[2] || 0, // High
            riskLevels[1] || 0 // Very High
        ];

        new Chart(document.getElementById('riskLevelChart'), {
            type: 'pie',
            data: {
                labels: levelLabels,
                datasets: [{
                    data: levelData,
                    backgroundColor: levelColors,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                    },
                },
            },
        });
        // Risk Trends Chart
        const riskTrends = @json($riskTrends);
        const trendLabels = Object.keys(riskTrends);
        const trendData = Object.values(riskTrends);

        new Chart(document.getElementById('riskTrendChart'), {
            type: 'line',
            data: {
                labels: trendLabels,
                datasets: [{
                    label: 'New Risks',
                    data: trendData,
                    borderColor: '#3498db',
                    backgroundColor: 'rgba(52, 152, 219, 0.2)',
                    fill: true,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false,
                    },
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Month',
                        },
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Risks Created',
                        },
                    },
                },
            },
        });
    });
</script>
@endpush