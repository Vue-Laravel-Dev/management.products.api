<?php

$cards = [
    [
        'link' => 'settings.general',
        'title' => 'General',
        'description' => 'View and update general application settings',
        'external' => false
    ],
    [
        'link' => 'users',
        'title' => 'Users',
        'description' => 'Manage Users',
        'external' => false
    ],
    [
        'link' => 'settings.printnode',
        'title' => 'PrintNode',
        'description' => 'View and update PrintNode integration  settings',
        'external' => false
    ],
    [
        'link' => 'settings.rmsapi',
        'title' => 'Microsoft Dynamic RMS 2.0 API',
        'description' => 'View and update RMS API integration settings',
        'external' => false
    ],
    [
        'link' => 'settings.dpd-ireland',
        'title' => 'DPD Ireland API',
        'description' => 'View and update DPD Ireland integration settings',
        'external' => false
    ],
    [
        'link' => 'settings.api2cart',
        'title' => 'Api2cart',
        'description' => 'View and update Api2cart integration settings',
        'external' => false
    ],
    [
        'link' => 'settings.api',
        'title' => 'API',
        'description' => 'View and update application API settings and tokens',
        'external' => false
    ],
    [
        'link' => 'admin/tools/queue-monitor',
        'title' => 'Queue Monitor',
        'description' => 'Open jobs monitor',
        'external' => true
    ],
    [
        'link' => 'admin/tools/log-viewer',
        'title' => 'Log Viewer',
        'description' => 'View application logs',
        'external' => true
    ]
];

?>
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
            
            @foreach ($cards as $card)
                <div class="card setting-card p-2 {{ $loop->first ?  '' : 'mt-3' }}">
                    <a href="{{ $card['external'] ?  url($card['link']) : route($card['link'])}}"{!! $card['external'] ? 'target="blank"' : '' !!}>
                        <div class="d-flex setting-item align-items-center">
                            <div class="setting-content">
                                <div class="setting-title font-weight-bold">{{ $card['title'] }}</div>
                                <div class="setting-description">{{ $card['description'] }}</div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach

        </div>
</div>
@endsection