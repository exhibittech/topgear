<!-- resources/views/awards/options.blade.php -->
@extends('layouts.apphome')
<link rel="stylesheet" href="{{('assets/css/awards.css') }}">

@section('title', 'TopGear Awards 2026 - Choose Category')

@section('content')

<div class="tg-banner-wrap">
<img src="https://www.topgearmag.in/uploads/awards25/awards25.webp" width="100%">
</div>

<div class="tg-voting-wrap">
<div class="container">
    

    @if($carVote && $bikeVote)
        <div class="kj-thankyou-wrap">
            <div class="kj-thankyou-message">
                <i class="fa fa-check-circle" aria-hidden="true"></i>
                <h2>Thank You for Voting!</h2>
                <p>You have successfully submitted your votes for both Cars and Bikes.</p>
                <p>We appreciate your participation in TopGear Awards 2026!</p>
            </div>
        </div>
    @endif

    <div class="kj-options-wrap">
        <div class="tgsection-title kjcat-question">
            <h2>Choose Your Category</h2>
            <p>Select a category to cast your vote</p>
        </div>
        
        <div class="row justify-content-center">
            <!-- Car Option -->
            <div class="col-lg-4 col-md-5 col-6">
                <a href="{{ route('awards.voting26') }}" class="kj-option-card {{ $carVote ? 'voted' : '' }}">
                    <div class="kj-option-icon">
                        <i class="fa fa-car" aria-hidden="true"></i>
                    </div>
                    <h3>Vote for Cars</h3>
                    @if($carVote)
                        <div class="kj-voted-badge">
                            <i class="fa fa-check" aria-hidden="true"></i> Voted
                        </div>
                    @else
                        <div class="kj-pending-badge">
                            <i class="fa fa-arrow-right" aria-hidden="true"></i> Cast Vote
                        </div>
                    @endif
                </a>
            </div>
            
            <!-- Bike Option -->
            <div class="col-lg-4 col-md-5 col-6">
                <a href="{{ route('awards.bikes') }}" class="kj-option-card {{ $bikeVote ? 'voted' : '' }}">
                    <div class="kj-option-icon">
                        <i class="fa fa-motorcycle" aria-hidden="true"></i>
                    </div>
                    <h3>Vote for Bikes</h3>
                    @if($bikeVote)
                        <div class="kj-voted-badge">
                            <i class="fa fa-check" aria-hidden="true"></i> Voted
                        </div>
                    @else
                        <div class="kj-pending-badge">
                            <i class="fa fa-arrow-right" aria-hidden="true"></i> Cast Vote
                        </div>
                    @endif
                </a>
            </div>
        </div>
    </div>

</div>
</div>

@endsection
