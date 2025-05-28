<!-- resources/views/awards/bikes.blade.php -->
@extends('layouts.apphome')
<link rel="stylesheet" href="{{ asset('assets/css/awards.css') }}">
<meta name="robots" content="noindex">
@section('title', 'TopGear Awards 2025')

@section('content')
<div class="tg-banner-wrap">
    <img src="https://www.topgearmag.in/uploads/awards25/awards25.jpg" width="100%">
</div>
<div class="container">
    <!-- Cars Section -->
    <div class="row">
        <div class="text-center mb-3" style="font-size: 30px;">Poll Result - Cars</div>
    </div>
    <div class="row">
        @foreach ($carCategories as $key => $name)
        <div class="tgsection-title kjcat-question">
            <h2>{{ ucfirst($name) }}</h2>
        </div>
        <table border="1">
            <thead>
                <tr>
                    <th>Option</th>
                    <th>Vote Count</th>
                </tr>
            </thead>
            <tbody>
		
                @foreach ($carVoteCounts[$key] as $option)
		
                <tr>
                    <td>{{ $option->$key }}</td>
                    <td>{{ $option->vote_count }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endforeach
    </div>

    <!-- Bikes Section -->
    <div class="row">
        <div class="text-center mb-3" style="font-size: 30px;">Poll Result - Bikes</div>
    </div>
    <div class="row">
        @foreach ($bikeCategories as $key => $name)
        <div class="tgsection-title kjcat-question">
            <h2>{{ ucfirst($name) }}</h2>
        </div>
        <table border="1">
            <thead>
                <tr>
                    <th>Option</th>
                    <th>Vote Count</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bikeVoteCounts[$key] as $option)
                <tr>
                    <td>{{ $option->$key }}</td>
                    <td>{{ $option->vote_count }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endforeach
    </div>
</div>
@endsection
