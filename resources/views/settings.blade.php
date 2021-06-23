@extends('layouts.app')

@section('title', __('Settings'))

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <div class="card setting-card mb-3 p-2">
                <a href="{{ route('settings.general') }}">
                    <div class="d-flex setting-item align-items-center">
                        <div class="setting-icon p-2 mr-3 d-flex align-items-center">
                            <i class="fas fa-cog"></i>
                        </div>
                        <div class="setting-content">
                            <div class="setting-title font-weight-bold">General</div>
                            <div class="setting-description">View and update general application settings</div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="card setting-card mb-3 p-2">
                <a href="{{ route('users') }}">
                    <div class="d-flex setting-item align-items-center">
                        <div class="setting-icon p-2 mr-3 d-flex align-items-center">
                            <i class="fas fa-cog"></i>
                        </div>
                        <div class="setting-content">
                            <div class="setting-title font-weight-bold">Users</div>
                            <div class="setting-description">Manage Users</div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="card setting-card mb-3 p-2">
                <a href="{{ route('settings.printnode') }}">
                    <div class="d-flex setting-item align-items-center">
                        <div class="setting-icon p-2 mr-3 d-flex align-items-center">
                            <i class="fas fa-cog"></i>
                        </div>
                        <div class="setting-content">
                            <div class="setting-title font-weight-bold">PrintNode</div>
                            <div class="setting-description">View and update PrintNode integration  settings</div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="card setting-card mb-3 p-2">
                <a href="{{ route('settings.rmsapi') }}">
                    <div class="d-flex setting-item align-items-center">
                        <div class="setting-icon p-2 mr-3 d-flex align-items-center">
                            <i class="fas fa-cog"></i>
                        </div>
                        <div class="setting-content">
                            <div class="setting-title font-weight-bold">Microsoft Dynamic RMS 2.0 API</div>
                            <div class="setting-description">View and update RMS API integration settings</div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="card setting-card mb-3 p-2">
                <a href="{{ route('settings.dpd-ireland') }}">
                    <div class="d-flex setting-item align-items-center">
                        <div class="setting-icon p-2 mr-3 d-flex align-items-center">
                            <i class="fas fa-cog"></i>
                        </div>
                        <div class="setting-content">
                            <div class="setting-title font-weight-bold">DPD Ireland API</div>
                            <div class="setting-description">View and update DPD Ireland integration settings</div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="card setting-card mb-3 p-2">
                <a href="{{ route('settings.api2cart') }}">
                    <div class="d-flex setting-item align-items-center">
                        <div class="setting-icon p-2 mr-3 d-flex align-items-center">
                            <i class="fas fa-cog"></i>
                        </div>
                        <div class="setting-content">
                            <div class="setting-title font-weight-bold">Api2cart</div>
                            <div class="setting-description">View and update Api2cart integration settings</div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="card setting-card mb-3 p-2">
                <a href="{{ route('settings.api') }}">
                    <div class="d-flex setting-item align-items-center">
                        <div class="setting-icon p-2 mr-3 d-flex align-items-center">
                            <i class="fas fa-cog"></i>
                        </div>
                        <div class="setting-content">
                            <div class="setting-title font-weight-bold">API</div>
                            <div class="setting-description">View and update application API settings and tokens</div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="card setting-card mb-3 p-2">
                <a href="{{ url('admin/tools/queue-monitor') }}" target="_blank">
                    <div class="d-flex setting-item align-items-center">
                        <div class="setting-icon p-2 mr-3 d-flex align-items-center">
                            <i class="fas fa-cog"></i>
                        </div>
                        <div class="setting-content">
                            <div class="setting-title font-weight-bold">Queue Monitor</div>
                            <div class="setting-description">Open jobs monitor</div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="card setting-card p-2">
                <a href="{{ url('admin/tools/log-viewer') }}" target="_blank">
                    <div class="d-flex setting-item align-items-center">
                        <div class="setting-icon p-2 mr-3 d-flex align-items-center">
                            <i class="fas fa-cog"></i>
                        </div>
                        <div class="setting-content">
                            <div class="setting-title font-weight-bold">Log Viewer</div>
                            <div class="setting-description">View application logs</div>
                        </div>
                    </div>
                </a>
            </div>

        </div>
</div>
@endsection