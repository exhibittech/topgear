<!-- resources/views/awards/voting.blade.php -->
@extends('layouts.apphome')
<link rel="stylesheet" href="{{('assets/css/awards.css') }}">

@section('title', 'TopGear Awards  2025')

@section('content')

<div class="tg-banner-wrap">
<img src="https://www.topgearmag.in/uploads/awards25/awards25.webp" width="100%">
</div>
<div class="kjbar-wrap">
    <div class="kjleft">
      <div class="kjcar active"><a href="{{ route('awards.voting26') }}">Vote For Cars <i class="fa fa-car" aria-hidden="true"></i></a></div>
    </div>
</div>
<div class="tg-voting-wrap">
<div class="container">
        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

        <div class="kjbar-wrap">
        </div>

        @if($carVote)
        <div class="alert alert-info">
            <h3>You have already voted for cars!</h3>
            <p>Want to review your bike votes? <a href="{{ route('awards.bikes') }}">Go to Bike Voting</a></p>
        </div>
    @else
        <form id="tga-25" method="POST" action="{{ route('awards.voting.store') }}" novalidate>
                @csrf
<!-- cat1 -->

        <div class="row">
                <div class="tgsection-title kjcat-question">
                <h2>Hatchback of the year </h2>
                </div>
                <div class="col-lg-3 col-6">
                <div class="kjchocie-wrap">
                        <input type="radio" id="kj01" name="cat1" value="Maruti Suzuki Swift" />      
                        <label for="kj01"><img src="uploads/awards25/cars/Maruti-Suzuki-Swift.jpg" alt="Maruti Suzuki Swift"/>
                        <p>Maruti Suzuki Swift</p>
                        </label>
                </div>
                </div>
                <div class="col-lg-3 col-6">
                <div class="kjchocie-wrap">
                        <input type="radio" id="kj02" name="cat1" value="Toyota Urban Cruiser Taisor" />      
                        <label for="kj02"><img src="uploads/awards25/cars/Toyota-Kirloskar-Taisor.jpg" alt="Toyota Urban Cruiser Taisor"/>
                        <p>Toyota Urban Cruiser Taisor</p>
                        </label>
                </div>
                </div>
                <div class="col-lg-3 col-6">
                <div class="kjchocie-wrap">
                        <input type="radio" id="kj03" name="cat1" value="Tata Altroz Racer" />      
                        <label for="kj03"><img src="uploads/awards25/cars/Tata-Motors-Altroz-Racer.jpg" alt="Tata Altroz Racer"/>
                        <p>Tata Altroz Racer</p>
                        </label>
                </div>
                </div>
        </div>
<!-- cat2 -->
        <div class="row">
                <div class="tgsection-title kjcat-question">
                <h2>Sedan of the year </h2>
                </div>
                <div class="col-lg-3 col-6">
                <div class="kjchocie-wrap">
                        <input type="radio" id="kj04" name="cat2" value="Honda Amaze" />      
                        <label for="kj04"><img src="uploads/awards25/cars/Honda-Amaze.jpg" alt="Honda Amaze"/>
                        <p>Honda Amaze</p>
                        </label>
                </div>
                </div>
                <div class="col-lg-3 col-6">
                <div class="kjchocie-wrap">
                        <input type="radio" id="kj07" name="cat2" value="Maruti Suzuki Dzire" />      
                        <label for="kj07"><img src="uploads/awards25/cars/Maruti-Suzuki-Dzire.jpg" alt="Maruti Suzuki Dzire"/>
                        <p>Maruti Suzuki Dzire</p>
                        </label>
                </div>
                </div>
                <div class="col-lg-3 col-6">
                <div class="kjchocie-wrap">
                        <input type="radio" id="kj05" name="cat2" value="Škoda Slavia Monte Carlo" />      
                        <label for="kj05"><img src="uploads/awards25/cars/Skoda-Slavia-Monte-Carlo.jpg" alt="Škoda Slavia Monte Carlo"/>
                        <p>Škoda Slavia Monte Carlo</p>
                        </label>
                </div>
                </div>
                <!--<div class="col-lg-3 col-6">
                <div class="kjchocie-wrap">
                        <input type="radio" id="kj06" name="cat2" value="BYD Seal" />      
                        <label for="kj06"><img src="uploads/awards25/cars/BYD-Seal.jpg" alt="BYD Seal"/>
                        <p>BYD Seal</p>
                        </label>
                </div>
                </div>-->
                <div class="col-lg-3 col-6">
                <div class="kjchocie-wrap">
                        <input type="radio" id="kj08" name="cat2" value="Volkswagen Virtus GT Line" />      
                        <label for="kj08"><img src="uploads/awards25/cars/Volkswagen-Virtus-GT-Line.jpg" alt="Volkswagen Virtus GT Line"/>
                        <p>Volkswagen Virtus GT Line</p>
                        </label>
                </div>
                </div>
        </div>
<!-- cat3 -->
        <div class="row">
                <div class="tgsection-title kjcat-question">
                <h2>Luxury Sedan of the year </h2>
                </div>
                <div class="col-lg-3 col-6">
                <div class="kjchocie-wrap">
                        <input type="radio" id="kj09" name="cat3" value="Toyota Camry" />      
                        <label for="kj09"><img src="uploads/awards25/cars/Toyota-Kirloskar-Camry.jpg" alt="Toyota Camry"/>
                        <p>Toyota Camry</p>
                        </label>
                </div>
                </div>
                <div class="col-lg-3 col-6">
                <div class="kjchocie-wrap">
                        <input type="radio" id="kj10" name="cat3" value="BYD Seal" />      
                        <label for="kj10"><img src="uploads/awards25/cars/BYD-Seal.jpg" alt="BYD Seal"/>
                        <p>BYD Seal</p>
                        </label>
                </div>
                </div>
                <div class="col-lg-3 col-6">
                <div class="kjchocie-wrap">
                        <input type="radio" id="kj11" name="cat3" value="BMW 5 Series LWB" />      
                        <label for="kj11"><img src="uploads/awards25/cars/BMW-5-Series-LWB.jpg" alt="BMW 5 Series LWB"/>
                        <p>BMW 5 Series LWB</p>
                        </label>
                </div>
                </div>
                <div class="col-lg-3 col-6">
                <div class="kjchocie-wrap">
                        <input type="radio" id="kj12" name="cat3" value="Mercedes-Benz E-Class LWB" />      
                        <label for="kj12"><img src="uploads/awards25/cars/Mercedes-Benz-E-Class-LWB.jpg" alt="Mercedes-Benz E-Class LWB"/>
                        <p>Mercedes-Benz E-Class LWB</p>
                        </label>
                </div>
                </div>
                <div class="col-lg-3 col-6">
                <div class="kjchocie-wrap">
                        <input type="radio" id="kj13" name="cat3" value="Porsche Panamera GTS" />      
                        <label for="kj13"><img src="uploads/awards25/cars/Porsche-Panamera-GTS.jpg" alt="Porsche Panamera GTS"/>
                        <p>Porsche Panamera GTS</p>
                        </label>
                </div>
                </div>
        </div>
<!-- cat4 -->
<div class="row">
    <div class="tgsection-title kjcat-question">
    <h2>Compact SUV of the year</h2>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input type="radio" id="kj14" name="cat4" value="Mahindra XUV 3XO" />      
            <label for="kj14"><img src="uploads/awards25/cars/Mahindra-XUV-3XO.jpg" alt="Mahindra XUV 3XO"/>
            <p>Mahindra XUV 3XO</p>
            </label>
    </div>
    </div>
    <!--<div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input type="radio" id="kj15" name="cat4" value="Škoda Kylaq" />      
            <label for="kj15"><img src="uploads/awards25/cars/Skoda-Kylaq.jpg" alt="Škoda Kylaq"/>
            <p>Škoda Kylaq</p>
            </label>
    </div>
    </div>-->    
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input type="radio" id="kj15a" name="cat4" value="Kia Sonet" />      
            <label for="kj15a"><img src="uploads/awards25/cars/Kia-Sonet.jpg" alt="Kia Sonet"/>
            <p>Kia Sonet</p>
            </label>
    </div>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input type="radio" id="kj15b" name="cat4" value="Nissan Magnite" />      
            <label for="kj15b"><img src="uploads/awards25/cars/Nissan-New-Magnite.jpg" alt="Nissan Magnite"/>
            <p>Nissan Magnite</p>
            </label>
    </div>
    </div>
    <!--<div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input type="radio" id="kj16" name="cat4" value="Tata Punch.ev" />      
            <label for="kj16"><img src="uploads/awards25/cars/Tata-Punch-EV.jpg" alt="Tata Punch.ev"/>
            <p>Tata Punch.ev</p>
            </label>
    </div>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input type="radio" id="kj17" name="cat4" value="Toyota Urban Cruiser Taisor" />      
            <label for="kj17"><img src="uploads/awards25/cars/Toyota-Urban-Cruiser-Taisor.png" alt="Toyota Urban Cruiser Taisor"/>
            <p>Toyota Urban Cruiser Taisor</p>
            </label>
    </div>
    </div>-->
</div>
<!-- cat5 -->
<div class="row">
    <div class="tgsection-title kjcat-question">
    <h2>SUV under 30 lakhs</h2>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input type="radio" id="kj18" name="cat5" value="Citroën Basalt" />      
            <label for="kj18"><img src="uploads/awards25/cars/Citroen-Basalt.jpg" alt="Citroën Basalt"/>
            <p>Citroën Basalt</p>
            </label>
    </div>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input type="radio" id="kj19" name="cat5" value="Mahindra Thar ROXX" />      
            <label for="kj19"><img src="uploads/awards25/cars/Mahindra-Thar-ROXX.jpg" alt="Mahindra Thar ROXX"/>
            <p>Mahindra Thar ROXX</p>
            </label>
    </div>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input type="radio" id="kj20" name="cat5" value="Jeep Meridian" />      
            <label for="kj20"><img src="uploads/awards25/cars/Jeep-Meridian.jpg" alt="Jeep Meridian"/>
            <p>Jeep Meridian</p>
            </label>
    </div>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input type="radio" id="kj21" name="cat5" value="Tata Curvv" />      
            <label for="kj21"><img src="uploads/awards25/cars/Tata-Curvv.jpg" alt="Tata Curvv"/>
            <p>Tata Curvv</p>
            </label>
    </div>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input type="radio" id="kj22" name="cat5" value="Hyundai Creta" />      
            <label for="kj22"><img src="uploads/awards25/cars/Hyundai-Creta.jpg" alt="Hyundai Creta"/>
            <p>Hyundai Creta</p>
            </label>
    </div>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input type="radio" id="kj23" name="cat5" value="Škoda Kushaq Onyx" />      
            <label for="kj23"><img src="uploads/awards25/cars/Skoda-Kushaq-Onyx.jpg" alt="Škoda Kushaq Onyx"/>
            <p>Škoda Kushaq Onyx</p>
            </label>
    </div>
    </div>
    <!--<div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input type="radio" id="kj24" name="cat5" value="Tata Curvv.ev" />      
            <label for="kj24"><img src="uploads/awards25/cars/Tata-Curvv-EV.jpg" alt="Tata Curvv.ev"/>
            <p>Tata Curvv.ev</p>
            </label>
    </div>
    </div>-->
</div>
<!-- cat6 -->
<div class="row">
    <div class="tgsection-title kjcat-question">
    <h2>Premium Mid-Size SUV of the year</h2>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input type="radio" id="kj25" name="cat6" value="Volvo EX40" />      
            <label for="kj25"><img src="uploads/awards25/cars/Volvo-XC40-Recharge.jpg" alt="Volvo EX40"/>
            <p>Volvo EX40</p>
            </label>
    </div>
    </div>
    <!--<div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input type="radio" id="kj26" name="cat6" value="Tata Curvv" />      
            <label for="kj26"><img src="uploads/awards25/cars/Tata-Curvv.jpg" alt="Tata Curvv"/>
            <p>Tata Curvv</p>
            </label>
    </div>
    </div>-->
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input type="radio" id="kj27" name="cat6" value="Mini Countryman Electric" />      
            <label for="kj27"><img src="uploads/awards25/cars/BMW-MINI-Countryman-Electric.jpg" alt="Mini Countryman Electric"/>
            <p>Mini Countryman Electric</p>
            </label>
    </div>
    </div>
    
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input type="radio" id="kj30" name="cat6" value="Nissan X-Trail" />      
            <label for="kj30"><img src="uploads/awards25/cars/Nissan-X-Trail.jpg" alt="Nissan X-Trail"/>
            <p>Nissan X-Trail</p>
            </label>
    </div>
    </div>
</div>
<!-- cat7 -->
<div class="row">
    <div class="tgsection-title kjcat-question">
    <h2>Performance SUV of the year</h2>
    </div>
    <!--<div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input type="radio" id="kj28" name="cat7" value="Hyundai Creta N Line" />      
            <label for="kj28"><img src="uploads/awards25/cars/Hyundai-Creta-N-Line.jpg" alt="Hyundai Creta N Line"/>
            <p>Hyundai Creta N Line</p>
            </label>
    </div>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input type="radio" id="kj29" name="cat7" value="Volkswagen Taigun GT Plus Sport" />      
            <label for="kj29"><img src="uploads/awards25/cars/Volkswagen-Taigun-GT-Plus-Sport.jpg" alt="Volkswagen Taigun GT Plus Sport"/>
            <p>Volkswagen Taigun GT Plus Sport</p>
            </label>
    </div>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input type="radio" id="kj30" name="cat7" value="Nissan All-New 4th Generation X-TRAIL" />      
            <label for="kj30"><img src="uploads/awards25/cars/Nissan-All-New-4th-Generation-X-Trail.jpg" alt="Nissan All-New 4th Generation X-TRAIL"/>
            <p>Nissan All-New 4th Generation X-TRAIL</p>
            </label>
    </div>
    </div>-->
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input type="radio" id="kj31" name="cat7" value="Mercedes-AMG GLC 43 4MATIC Coupé" />      
            <label for="kj31"><img src="uploads/awards25/cars/Mercedes-AMG-GLC-43-4MATIC-Coupe.jpg" alt="Mercedes-AMG GLC 43 4MATIC Coupé"/>
            <p>Mercedes-AMG GLC 43 4MATIC Coupé</p>
            </label>
    </div>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input type="radio" id="kj32" name="cat7" value="Porsche Cayenne GTS" />      
            <label for="kj32"><img src="uploads/awards25/cars/Porsche-Cayenne-GTS.jpg" alt="Porsche Cayenne GTS"/>
            <p>Porsche Cayenne GTS</p>
            </label>
    </div>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input type="radio" id="kj33" name="cat7" value="Mercedes-AMG G 63" />      
            <label for="kj33"><img src="uploads/awards25/cars/Mercedes-AMG-G-63.png" alt="Mercedes-AMG G 63"/>
            <p>Mercedes-AMG G 63</p>
            </label>
    </div>
    </div>
</div>
<!-- cat8 -->
<div class="row">
    <div class="tgsection-title kjcat-question">
    <h2>Luxury SUV of the year</h2>
    </div>
    <!--<div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input type="radio" id="kj34" name="cat8" value="BMW Mini Countryman Electric" />      
            <label for="kj34"><img src="uploads/awards25/cars/BMW-MINI-Countryman-Electric.jpg" alt="BMW Mini Countryman Electric"/>
            <p>BMW Mini Countryman Electric</p>
            </label>
    </div>
    </div>-->
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input type="radio" id="kj35" name="cat8" value="Audi Q7" />      
            <label for="kj35"><img src="uploads/awards25/cars/Audi-Q7.jpg" alt="Audi Q7"/>
            <p>Audi Q7</p>
            </label>
    </div>
    </div>
    
    <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input type="radio" id="kj36" name="cat8" value="Audi Q8" />      
                <label for="kj36"><img src="uploads/awards25/cars/Audi-Q8.jpg" alt="Audi Q8"/>
                <p>Audi Q8</p>
                </label>
        </div>
        </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input type="radio" id="kj37" name="cat8" value="Mercedes-Benz GLS 450" />      
            <label for="kj37"><img src="uploads/awards25/cars/Mercedes-Benz-GLS-450.jpg" alt="Mercedes-Benz GLS 450"/>
            <p>Mercedes-Benz GLS 450</p>
            </label>
    </div>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input type="radio" id="kj38" name="cat8" value="Maserati Grecale" />      
            <label for="kj38"><img src="uploads/awards25/cars/Maserati-Grecale-Modena.jpg" alt="Maserati Grecale"/>
            <p>Maserati Grecale</p>
            </label>
    </div>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input type="radio" id="kj39" name="cat8" value="Porsche Cayenne GTS" />      
            <label for="kj39"><img src="uploads/awards25/cars/Porsche-Cayenne-GTS.jpg" alt="Porsche Cayenne GTS"/>
            <p>Porsche Cayenne GTS</p>
            </label>
    </div>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input type="radio" id="kj40" name="cat8" value="Mercedes-Maybach GLS 600" />      
            <label for="kj40"><img src="uploads/awards25/cars/Mercedes-Maybach-GLS-600.jpg" alt="Mercedes-Maybach GLS 600"/>
            <p>Mercedes-Maybach GLS 600</p>
            </label>
    </div>
    </div>
</div>
<!-- cat9 -->
<div class="row">
    <div class="tgsection-title kjcat-question">
    <h2>MPV of the year</h2>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input type="radio" id="kj41" name="cat9" value="Hyundai Alcazar" />      
            <label for="kj41"><img src="uploads/awards25/cars/Hyundai-Alcazar.jpg" alt="Hyundai Alcazar"/>
            <p>Hyundai Alcazar</p>
            </label>
    </div>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input type="radio" id="kj42" name="cat9" value="BYD eMAX 7" />      
            <label for="kj42"><img src="uploads/awards25/cars/BYD-eMAX-7.jpg" alt="BYD eMAX 7"/>
            <p>BYD eMAX 7</p>
            </label>
    </div>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input type="radio" id="kj43" name="cat9" value="Kia Carnival" />      
            <label for="kj43"><img src="uploads/awards25/cars/Kia-Carnival.jpg" alt="Kia Carnival"/>
            <p>Kia Carnival</p>
            </label>
    </div>
    </div>
</div>
<!-- cat10 -->
<div class="row">
    <div class="tgsection-title kjcat-question">
    <h2>CNG Car Of The Year</h2>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input type="radio" id="kj44" name="cat10" value="Hyundai Exter Hy-CNG Duo" />      
            <label for="kj44"><img src="uploads/awards25/cars/Hyundai-Exter-Hy-CNG-Duo.jpg" alt="Hyundai Exter Hy-CNG Duo"/>
            <p>Hyundai Exter Hy-CNG Duo</p>
            </label>
    </div>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input type="radio" id="kj45" name="cat10" value="Maruti Suzuki Swift S-CNG" />      
            <label for="kj45"><img src="uploads/awards25/cars/Maruti-Suzuki-Swift-S-CNG.jpg" alt="Maruti Suzuki Swift S-CNG"/>
            <p>Maruti Suzuki Swift S-CNG</p>
            </label>
    </div>
    </div>
    
    <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input type="radio" id="kj46" name="cat10" value="Maruti Suzuki Dzire S-CNG" />      
                <label for="kj46"><img src="uploads/awards25/cars/Maruti-Suzuki-Dzire-S-CNG.jpg" alt="Maruti Suzuki Dzire S-CNG"/>
                <p>Maruti Suzuki Dzire S-CNG</p>
                </label>
        </div>
        </div>
    <!--<div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input type="radio" id="kj47" name="cat10" value="Hyundai Aura E CNG" />      
            <label for="kj47"><img src="uploads/awards25/cars/Hyundai-Aura-E-CNG.jpg" alt="Hyundai Aura E CNG"/>
            <p>Hyundai Aura E CNG</p>
            </label>
    </div>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input type="radio" id="kj48" name="cat10" value="Tata Tigor iCNG" />      
            <label for="kj48"><img src="uploads/awards25/cars/Tata-Tigor-iCNG.jpg" alt="Tata Tigor iCNG"/>
            <p>Tata Tigor iCNG</p>
            </label>
    </div>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input type="radio" id="kj49" name="cat10" value="Tata Tiago iCNG" />      
            <label for="kj49"><img src="uploads/awards25/cars/Tata-Tiago-iCNG.jpg" alt="Tata Tiago iCNG"/>
            <p>Tata Tiago iCNG</p>
            </label>
    </div>
    </div>-->
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input type="radio" id="kj50" name="cat10" value="Tata Nexon iCNG" />      
            <label for="kj50"><img src="uploads/awards25/cars/Tata-Nexon-iCNG.jpg" alt="Tata Nexon iCNG"/>
            <p>Tata Nexon iCNG</p>
            </label>
    </div>
    </div>
</div>
<!-- cat11 -->
<div class="row">
    <div class="tgsection-title kjcat-question">
    <h2>Enthusiasts' Choice of the year</h2>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input type="radio" id="kj51" name="cat11" value="Volkswagen Virtus GT Line" />      
            <label for="kj51"><img src="uploads/awards25/cars/Volkswagen-Virtus-GT-Line.jpg" alt="Volkswagen Virtus GT Line"/>
            <p>Volkswagen Virtus GT Line</p>
            </label>
    </div>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input type="radio" id="kj52" name="cat11" value="Škoda Slavia Monte Carlo" />      
            <label for="kj52"><img src="uploads/awards25/cars/Skoda-Slavia-Monte-Carlo.jpg" alt="Škoda Slavia Monte Carlo"/>
            <p>Škoda Slavia Monte Carlo</p>
            </label>
    </div>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input type="radio" id="kj53" name="cat11" value="Hyundai Creta N Line" />      
            <label for="kj53"><img src="uploads/awards25/cars/Hyundai-Creta-N-Line.jpg" alt="Hyundai Creta N Line"/>
            <p>Hyundai Creta N Line</p>
            </label>
    </div>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input type="radio" id="kj54" name="cat11" value="Škoda Kushaq Onyx" />      
            <label for="kj54"><img src="uploads/awards25/cars/Skoda-Kushaq-Onyx.jpg" alt="Škoda Kushaq Onyx"/>
            <p>Škoda Kushaq Onyx</p>
            </label>
    </div>
    </div>
</div>
<!-- cat12 -->
<div class="row">
    <div class="tgsection-title kjcat-question">
    <h2>Facelift Of The Year</h2>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input type="radio" id="kj55" name="cat12" value="Nissan Magnite" />      
            <label for="kj55"><img src="uploads/awards25/cars/Nissan-New-Magnite.jpg" alt="Nissan Magnite"/>
            <p>Nissan Magnite</p>
            </label>
    </div>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input type="radio" id="kj56" name="cat12" value="Kia Sonet" />      
            <label for="kj56"><img src="uploads/awards25/cars/Kia-Sonet.jpg" alt="Kia Sonet"/>
            <p>Kia Sonet</p>
            </label>
    </div>
    </div>    
    <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input type="radio" id="kj57" name="cat12" value="Hyundai Creta" />      
                <label for="kj57"><img src="uploads/awards25/cars/Hyundai-Creta.jpg" alt="Hyundai Creta"/>
                <p>Hyundai Creta</p>
                </label>
        </div>
        </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input type="radio" id="kj58" name="cat12" value="Tata Nexon.ev 45" />      
            <label for="kj58"><img src="uploads/awards25/cars/Tata-Nexon-EV-45.jpg" alt="Tata Nexon.ev 45"/>
            <p>Tata Nexon.ev 45</p>
            </label>
    </div>
    </div>
</div>
<!-- cat13 -->
<div class="row">
    <div class="tgsection-title kjcat-question">
    <h2>Lifestyle vehicle of the year</h2>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input type="radio" id="kj59" name="cat13" value="Mahindra Thar ROXX" />      
            <label for="kj59"><img src="uploads/awards25/cars/Mahindra-Thar-ROXX.jpg" alt="Mahindra Thar ROXX"/>
            <p>Mahindra Thar ROXX</p>
            </label>
    </div>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input type="radio" id="kj60" name="cat13" value="Tata Curvv" />      
            <label for="kj60"><img src="uploads/awards25/cars/Tata-Curvv.jpg" alt="Tata Curvv"/>
            <p>Tata Curvv</p>
            </label>
    </div>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input type="radio" id="kj61" name="cat13" value="Kia Carnival" />      
            <label for="kj61"><img src="uploads/awards25/cars/Kia-Carnival.jpg" alt="Kia Carnival"/>
            <p>Kia Carnival</p>
            </label>
    </div>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input type="radio" id="kj62" name="cat13" value="Mercedes-Benz CLE 300 Cabriolet" />      
            <label for="kj62"><img src="uploads/awards25/cars/Mercedes-Benz-CLE-300-Cabriolet.jpg" alt="Mercedes-Benz CLE 300 Cabriolet"/>
            <p>Mercedes-Benz CLE 300 Cabriolet</p>
            </label>
    </div>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input type="radio" id="kj63" name="cat13" value="Mercedes-AMG G 63" />      
            <label for="kj63"><img src="uploads/awards25/cars/Mercedes-AMG-G-63.png" alt="Mercedes-AMG G 63"/>
            <p>Mercedes-AMG G 63</p>
            </label>
    </div>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input type="radio" id="kj63a" name="cat13" value="Mini Cooper S" />      
            <label for="kj63a"><img src="uploads/awards25/cars/Mini-Cooper-S.jpg" alt="Mini Cooper S"/>
            <p>Mini Cooper S</p>
            </label>
    </div>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input type="radio" id="kj64" name="cat13" value="Aston Martin Vantage" />      
            <label for="kj64"><img src="uploads/awards25/cars/Aston-Martin-Vantage.jpg" alt="Aston Martin Vantage"/>
            <p>Aston Martin Vantage</p>
            </label>
    </div>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input type="radio" id="kj65" name="cat13" value="Ferrari Roma Spider" />      
            <label for="kj65"><img src="uploads/awards25/cars/Ferrari-Roma-Spider.jpg" alt="Ferrari Roma Spider"/>
            <p>Ferrari Roma Spider</p>
            </label>
    </div>
    </div>
</div>
<!-- cat14 -->
<div class="row">
    <div class="tgsection-title kjcat-question">
    <h2>Design Of The Year</h2>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input type="radio" id="kj66" name="cat14" value="Citroën Basalt" />      
            <label for="kj66"><img src="uploads/awards25/cars/Citroen-Basalt.jpg" alt="Citroën Basalt"/>
            <p>Citroën Basalt</p>
            </label>
    </div>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input type="radio" id="kj67" name="cat14" value="Tata Curvv.ev" />      
            <label for="kj67"><img src="uploads/awards25/cars/Tata-Curvv-EV.jpg" alt="Tata Curvv.ev"/>
            <p>Tata Curvv.ev</p>
            </label>
    </div>
    </div>    
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
             <input type="radio" id="kj68" name="cat14" value="Tata Curvv" />      
             <label for="kj68"><img src="uploads/awards25/cars/Tata-Curvv.jpg" alt="Tata Curvv"/>
             <p>Tata Curvv</p>
            </label>
    </div>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input type="radio" id="kj69" name="cat14" value="MG Windsor" />      
            <label for="kj69"><img src="uploads/awards25/cars/MG-Windsor.jpg" alt="MG Windsor"/>
            <p>MG Windsor</p>
            </label>
    </div>
    </div>   
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
             <input type="radio" id="kj70" name="cat14" value="BYD Seal" />      
             <label for="kj70"><img src="uploads/awards25/cars/BYD-Seal.jpg" alt="BYD Seal"/>
             <p>BYD Seal</p>
            </label>
    </div>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input type="radio" id="kj71" name="cat14" value="Kia EV9" />      
            <label for="kj71"><img src="uploads/awards25/cars/Kia-EV9.jpg" alt="Kia EV9"/>
            <p>Kia EV9</p>
            </label>
    </div>
    </div>
</div>
<!-- cat15 -->
<div class="row">
    <div class="tgsection-title kjcat-question">
    <h2>Electric Car of the year</h2>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input type="radio" id="kj72" name="cat15" value="Tata Punch.ev" />      
            <label for="kj72"><img src="uploads/awards25/cars/Tata-Punch-EV.jpg" alt="Tata Punch.ev"/>
            <p>Tata Punch.ev</p>
            </label>
    </div>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input type="radio" id="kj73" name="cat15" value="MG Windsor" />      
            <label for="kj73"><img src="uploads/awards25/cars/MG-Windsor.jpg" alt="MG Windsor"/>
            <p>MG Windsor</p>
            </label>
    </div>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input type="radio" id="kj74" name="cat15" value="Tata Nexon.ev 45" />      
            <label for="kj74"><img src="uploads/awards25/cars/Tata-Nexon-EV-45.jpg" alt="Tata Nexon.ev 45"/>
            <p>Tata Nexon.ev 45</p>
            </label>
    </div>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input type="radio" id="kj75" name="cat15" value="Tata Curvv.ev" />      
            <label for="kj75"><img src="uploads/awards25/cars/Tata-Curvv-EV.jpg" alt="Tata Curvv.ev"/>
            <p>Tata Curvv.ev</p>
            </label>
    </div>
    </div>
    <!--<div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input type="radio" id="kj76" name="cat15" value="BYD Seal" />      
            <label for="kj76"><img src="uploads/awards25/cars/BYD-Seal.jpg" alt="BYD Seal"/>
            <p>BYD Seal</p>
            </label>
    </div>
    </div>-->
</div>
<!-- cat16 -->
<div class="row">
    <div class="tgsection-title kjcat-question">
    <h2>Premium EV Of The Year</h2>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input type="radio" id="kj77" name="cat16" value="Mercedes-Benz EQA" />      
            <label for="kj77"><img src="uploads/awards25/cars/Mercedes-Benz-EQA.jpg" alt="Mercedes-Benz India EQA"/>
            <p>Mercedes-Benz EQA</p>
            </label>
    </div>
    </div>   
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
             <input type="radio" id="kj78" name="cat16" value="BYD Seal" />      
             <label for="kj78"><img src="uploads/awards25/cars/BYD-Seal.jpg" alt="BYD Seal"/>
             <p>BYD Seal</p>
            </label>
    </div>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input type="radio" id="kj79" name="cat16" value="Volvo EX40" />      
            <label for="kj79"><img src="uploads/awards25/cars/Volvo-XC40-Recharge.jpg" alt="Volvo EX40"/>
            <p>Volvo EX40</p>
            </label>
    </div>
    </div>    
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
             <input type="radio" id="kj80" name="cat16" value="Mini Countryman Electric" />      
             <label for="kj80"><img src="uploads/awards25/cars/BMW-MINI-Countryman-Electric.jpg" alt="Mini Countryman Electric"/>
             <p>Mini Countryman Electric</p>
            </label>
    </div>
    </div>
    <!--<div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input type="radio" id="kj81" name="cat16" value="BYD ATTO 3 (New Variants)" />      
            <label for="kj81"><img src="uploads/awards25/cars/BYD-ATTO-3.jpg" alt="BYD ATTO 3 (New Variants)"/>
            <p>BYD ATTO 3 (New Variants)</p>
            </label>
    </div>
    </div>-->
</div>
<!-- cat17 -->
<div class="row">
    <div class="tgsection-title kjcat-question">
    <h2>Luxury EV of the year</h2>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input type="radio" id="kj82" name="cat17" value="Kia EV9" />      
            <label for="kj82"><img src="uploads/awards25/cars/Kia-EV9.jpg" alt="Kia EV9"/>
            <p>Kia EV9</p>
            </label>
    </div>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input type="radio" id="kj83" name="cat17" value="Mercedes-Benz EQS SUV 580" />      
            <label for="kj83"><img src="uploads/awards25/cars/Mercedes-Benz-EQS-SUV-580.jpg" alt="Mercedes-Benz EQS SUV 580"/>
            <p>Mercedes-Benz EQS SUV 580</p>
            </label>
    </div>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input type="radio" id="kj84" name="cat17" value="Lotus Eletre" />      
            <label for="kj84"><img src="uploads/awards25/cars/Lotus-Eletre.jpg" alt="Lotus Eletre"/>
            <p>Lotus Eletre</p>
            </label>
    </div>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input type="radio" id="kj85" name="cat17" value="BMW i5 M60" />      
            <label for="kj85"><img src="uploads/awards25/cars/BMW-i5-M60.jpg" alt="BMW i5 M60"/>
            <p>BMW i5 M60</p>
            </label>
    </div>
    </div>
</div>
<!-- cat18 -->
<div class="row">
    <div class="tgsection-title kjcat-question">
    <h2>Performance Car Of The Year</h2>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input type="radio" id="kj86" name="cat18" value="BMW M2" />      
            <label for="kj86"><img src="uploads/awards25/cars/BMW-M2.jpg" alt="BMW M2"/>
            <p>BMW M2</p>
            </label>
    </div>
    </div>   
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
             <input type="radio" id="kj87" name="cat18" value="BMW M4CS" />      
             <label for="kj87"><img src="uploads/awards25/cars/BMW-M4CS.jpg" alt="BMW M4CS"/>
             <p>BMW M4CS</p>
            </label>
    </div>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input type="radio" id="kj88" name="cat18" value="Mercedes-AMG C 63 S E Performance" />      
            <label for="kj88"><img src="uploads/awards25/cars/Mercedes-AMG-C63-S-E-Performance.jpg" alt="Mercedes-AMG C 63 S E Performance"/>
            <p>Mercedes-AMG C 63 S E Performance</p>
            </label>
    </div>
    </div>    
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
             <input type="radio" id="kj89" name="cat18" value="Porsche 911 Carrera" />      
             <label for="kj89"><img src="uploads/awards25/cars/Porsche-911-Carrera.jpg" alt="Porsche 911 Carrera"/>
             <p>Porsche 911 Carrera</p>
            </label>
    </div>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input type="radio" id="kj90" name="cat18" value="BMW M5" />      
            <label for="kj90"><img src="uploads/awards25/cars/BMW-M5.jpg" alt="BMW M5"/>
            <p>BMW M5</p>
            </label>
    </div>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input type="radio" id="kj91" name="cat18" value="Porsche 911 Carrera 4 GTS" />      
            <label for="kj91"><img src="uploads/awards25/cars/Porsche-911-Carrera-4-GTS.jpg" alt="Porsche 911 Carrera 4 GTS"/>
            <p>Porsche 911 Carrera 4 GTS</p>
            </label>
    </div>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input type="radio" id="kj92" name="cat18" value="Mercedes-AMG S 63 E Performance" />      
            <label for="kj92"><img src="uploads/awards25/cars/Mercedes-AMG-S-63-E-Performance.jpg" alt="Mercedes-AMG S 63 E Performance"/>
            <p>Mercedes-AMG S 63 E Performance</p>
            </label>
    </div>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input type="radio" id="kj93" name="cat18" value="Aston Martin Vantage" />      
            <label for="kj93"><img src="uploads/awards25/cars/Aston-Martin-Vantage.jpg" alt="Aston Martin Vantage"/>
            <p>Aston Martin Vantage</p>
            </label>
    </div>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input type="radio" id="kj94" name="cat18" value="Lamborghini Revuelto" />      
            <label for="kj94"><img src="uploads/awards25/cars/Lamborghini-Revuelto.jpg" alt="Lamborghini Revuelto"/>
            <p>Lamborghini Revuelto</p>
            </label>
    </div>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input type="radio" id="kj95" name="cat18" value="Ferrari Purosangue" />      
            <label for="kj95"><img src="uploads/awards25/cars/Ferrari-Purosangue.jpg" alt="Ferrari Purosangue"/>
            <p>Ferrari Purosangue</p>
            </label>
    </div>
    </div>
</div>
<!-- cat19 -->
<div class="row">
    <div class="tgsection-title kjcat-question">
    <h2>Car of the year</h2>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input type="radio" id="kj96" name="cat19" value="Maruti Suzuki Swift" />      
            <label for="kj96"><img src="uploads/awards25/cars/Maruti-Suzuki-Swift.jpg" alt="Maruti Suzuki Swift"/>
            <p>Maruti Suzuki Swift</p>
            </label>
    </div>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input type="radio" id="kj97" name="cat19" value="Maruti Suzuki Dzire" />      
            <label for="kj97"><img src="uploads/awards25/cars/Maruti-Suzuki-Dzire.jpg" alt="Maruti Suzuki Dzire"/>
            <p>Maruti Suzuki Dzire</p>
            </label>
    </div>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input type="radio" id="kj98" name="cat19" value="Mahindra Thar ROXX" />      
            <label for="kj98"><img src="uploads/awards25/cars/Mahindra-Thar-ROXX.jpg" alt="Mahindra Thar ROXX"/>
            <p>Mahindra Thar ROXX</p>
            </label>
    </div>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input type="radio" id="kj99" name="cat19" value="Honda Amaze" />      
            <label for="kj99"><img src="uploads/awards25/cars/Honda-Amaze.jpg" alt="Honda Amaze"/>
            <p>Honda Amaze</p>
            </label>
    </div>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input type="radio" id="kj100" name="cat19" value="Tata Curvv" />      
            <label for="kj100"><img src="uploads/awards25/cars/Tata-Curvv.jpg" alt="Tata Curvv"/>
            <p>Tata Curvv</p>
            </label>
    </div>
    </div>
    <!--<div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input type="radio" id="kj101" name="cat19" value="Hyundai Creta" />      
            <label for="kj101"><img src="uploads/awards25/cars/Hyundai-Creta.jpg" alt="Hyundai Creta"/>
            <p>Hyundai Creta</p>
            </label>
    </div>
    </div>-->
    <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input type="radio" id="kj101" name="cat19" value="Tata Punch.ev" />      
                <label for="kj101"><img src="uploads/awards25/cars/Tata-Punch-EV.jpg" alt="Tata Punch.ev"/>
                <p>Tata Punch.ev</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input type="radio" id="kj102" name="cat19" value="MG Windsor" />      
                <label for="kj102"><img src="uploads/awards25/cars/MG-Windsor.jpg" alt="MG Windsor"/>
                <p>MG Windsor</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input type="radio" id="kj103" name="cat19" value="Citroën Basalt" />      
                <label for="kj103"><img src="uploads/awards25/cars/Citroen-Basalt.jpg" alt="Citroën Basalt"/>
                <p>Citroën Basalt</p>
                </label>
        </div>
        </div>
        
    <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input type="radio" id="kj104" name="cat19" value="BYD eMAX 7" />      
                <label for="kj104"><img src="uploads/awards25/cars/BYD-eMAX-7.jpg" alt="BYD eMAX 7"/>
                <p>BYD eMAX 7</p>
                </label>
        </div>
        </div>
</div>

        <div class="text-center mt-3 mb-5">
        <button class="tg-btn" type="submit">Vote</button>
        <div id="error-message"  style="display:none;"></div>
        </div>
        


        </form>
        @endif
</div>
</div>
<script>
        document.getElementById('tga-25').addEventListener('submit', function (event) {
            event.preventDefault();  // Prevent form submission for validation
    
            let allCategoriesValid = true;
            const errorMessageElement = document.getElementById('error-message');
            errorMessageElement.style.display = 'none';  // Hide error message by default
    
            // Categories array
            const categories = [
                'cat1', 'cat2', 'cat3', 'cat4', 'cat5', 
                'cat6', 'cat7', 'cat8', 'cat9', 'cat10', 
                'cat11', 'cat12', 'cat13', 'cat14', 'cat15', 
                'cat16', 'cat17', 'cat18', 'cat19'
            ];
    
            categories.forEach(function (category) {
                const radios = document.getElementsByName(category);
                let isSelected = false;
    
                // Check if at least one radio button in the category is selected
                for (const radio of radios) {
                    if (radio.checked) {
                        isSelected = true;
                        break;
                    }
                }
    
                if (!isSelected) {
                    allCategoriesValid = false;
                }
            });
    
            if (!allCategoriesValid) {
                errorMessageElement.innerText = "Please select an option in every category.";
                errorMessageElement.style.display = 'block';  // Show error message
            } else {
                this.submit();  // Submit the form if all categories are valid
            }
        });
    </script>
@endsection
