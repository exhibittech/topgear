<!-- resources/views/awards/bikes.blade.php -->
@extends('layouts.apphome')
<link rel="stylesheet" href="{{('assets/css/awards.css') }}">

@section('title', 'TopGear Awards 2025')

@section('content')

<div class="tg-banner-wrap">
<img src="https://www.topgearmag.in/uploads/awards25/awards25.webp" width="100%">
</div>
<div class="kjbar-wrap">
	  
	<div class="kjleft">
                <div class="kjcar "><a href="{{ route('awards.voting26') }}">Vote For Cars <i class="fa fa-car" aria-hidden="true"></i></a></div>
                <div class="kjbike active"><a href={{ route('awards.bikes') }}>Vote For Bikes <i class="fa fa-motorcycle" aria-hidden="true"></i></a></div>
	</div>
</div>

<div class="tg-voting-wrap">
<div class="container">
        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
        <div class="kjbar-wrap">
        </div>

        @if($bikeVote)
        <div class="alert alert-info">
            <h3>You have already voted for bikes!</h3>
            <p>Thank you for your participation! <a href="{{ route('signup') }}">Go back to Signup Page</a></p>
        </div>
    @else

        <form id="tga-bike25" method="POST" action="{{ route('awards.bikes.store') }}" novalidate>
                @csrf
<!-- bcat1 -->
<div class="row">
        <div class="tgsection-title kjcat-question">
        <h2>Motorcycle of the year </h2>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj01" name="bcat1" value="Hero Xtreme 125R" />      
                <label for="bkj01"><img src="uploads/awards25/bikes/Hero-Xtreme-125R.jpg" alt="Hero Xtreme 125R"/>
                <p>Hero Xtreme 125R</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj02" name="bcat1" value="Bajaj Freedom 125" />      
                <label for="bkj02"><img src="uploads/awards25/bikes/Bajaj-Freedom-125.jpg" alt="Bajaj Freedom 125"/>
                <p>Bajaj Freedom 125</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj03" name="bcat1" value="Royal Enfield Guerrilla 450" />      
                <label for="bkj03"><img src="uploads/awards25/bikes/Royal-Enfield-Guerrilla-450.jpg" alt="Royal Enfield Guerrilla 450"/>
                <p>Royal Enfield Guerrilla 450</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj04" name="bcat1" value="Bajaj Pulsar N125" />      
                <label for="bkj04"><img src="uploads/awards25/bikes/Bajaj-Pulsar-N125.jpg" alt="Bajaj Pulsar N125"/>
                <p>Bajaj Pulsar N125</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj05" name="bcat1" value="Hero Mavrick 440" />      
                <label for="bkj05"><img src="uploads/awards25/bikes/Hero-Mavrick-440.jpg" alt="Hero Mavrick 440"/>
                <p>Hero Mavrick 440</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj06" name="bcat1" value="Triumph Speed T4" />      
                <label for="bkj06"><img src="uploads/awards25/bikes/Triumph-Speed-T4.jpg" alt="Triumph Speed T4"/>
                <p>Triumph Speed T4</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj07" name="bcat1" value="Bajaj Pulsar NS400Z" />      
                <label for="bkj07"><img src="uploads/awards25/bikes/Bajaj-Pulsar-NS400Z.jpg" alt="Bajaj Pulsar NS400Z"/>
                <p>Bajaj Pulsar NS400Z</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj08" name="bcat1" value="Jawa 350" />      
                <label for="bkj08"><img src="uploads/awards25/bikes/Jawa-350.jpg" alt="Jawa 350"/>
                <p>Jawa 350</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj09" name="bcat1" value="BSA Goldstar" />      
                <label for="bkj09"><img src="uploads/awards25/bikes/BSA-Goldstar.jpg" alt="BSA Goldstar"/>
                <p>BSA Goldstar</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj10" name="bcat1" value="TVS Apache RR 310" />      
                <label for="bkj10"><img src="uploads/awards25/bikes/Apache-RR-310.jpg" alt="TVS Apache RR 310"/>
                <p>TVS Apache RR 310</p>
                </label>
        </div>
        </div>
</div>
<!-- bcat2 -->
<div class="row">
        <div class="tgsection-title kjcat-question">
        <h2>Performance Motorcycle of the year </h2>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj11" name="bcat2" value="Ducati Streetfighter V4" />      
                <label for="bkj11"><img src="uploads/awards25/bikes/Ducati-Streetfighter-V4.jpg" alt="Ducati Streetfighter V4"/>
                <p>Ducati Streetfighter V4</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj12" name="bcat2" value="Kawasaki Z900" />      
                <label for="bkj12"><img src="uploads/awards25/bikes/Kawasaki-Z900.jpg" alt="Kawasaki Z900"/>
                <p>Kawasaki Z900</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj13" name="bcat2" value="BMW M1000 XR" />      
                <label for="bkj13"><img src="uploads/awards25/bikes/BMW-M1000-XR.jpg" alt="BMW M1000 XR"/>
                <p>BMW M1000 XR</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj14" name="bcat2" value="BMW S1000 XR" />      
                <label for="bkj14"><img src="uploads/awards25/bikes/BMW-S1000-XR.jpg" alt="BMW S1000 XR"/>
                <p>BMW S1000 XR</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj15" name="bcat2" value="Ducati Hypermotard 950 SP" />      
                <label for="bkj15"><img src="uploads/awards25/bikes/Ducati-Hypermotard-950-SP.jpg" alt="Ducati Hypermotard 950 SP"/>
                <p>Ducati Hypermotard 950 SP</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj16" name="bcat2" value="Suzuki GSX-8R" />      
                <label for="bkj16"><img src="uploads/awards25/bikes/Suzuki-GSX-8R.jpg" alt="Suzuki GSX-8R"/>
                <p>Suzuki GSX-8R</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj17" name="bcat2" value="KTM 1390 Super Duke R" />      
                <label for="bkj17"><img src="uploads/awards25/bikes/KTM-1390-Super-Duke-R.jpg" alt="KTM 1390 Super Duke R"/>
                <p>KTM 1390 Super Duke R</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj18" name="bcat2" value="KTM 890 Duke R" />      
                <label for="bkj18"><img src="uploads/awards25/bikes/KTM-890-Duke-R.jpg" alt="KTM 890 Duke R"/>
                <p>KTM 890 Duke R</p>
                </label>
        </div>
        </div>
</div>
<!-- bcat3 -->
<div class="row">
        <div class="tgsection-title kjcat-question">
        <h2>Electric Motorcycle of the Year</h2>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj19" name="bcat3" value="Revolt RV400 BRZ" />      
                <label for="bkj19"><img src="uploads/awards25/bikes/Revolt-RV400-BRZ.jpg" alt="Revolt RV400 BRZ"/>
                <p>Revolt RV400 BRZ</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj20" name="bcat3" value="Ultraviolette F77 Mach 2" />      
                <label for="bkj20"><img src="uploads/awards25/bikes/Ultraviolette-F77-Mach-2.jpg" alt="Ultraviolette F77 Mach 2"/>
                <p>Ultraviolette F77 Mach 2</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj21" name="bcat3" value="Revolt RV1+" />      
                <label for="bkj21"><img src="uploads/awards25/bikes/Revolt-RV1-plus.jpg" alt="Revolt RV1+"/>
                <p>Revolt RV1+</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj22" name="bcat3" value="Oben Rorr EZ" />      
                <label for="bkj22"><img src="uploads/awards25/bikes/Oben-Rorr-EZ.jpg" alt="Oben Rorr EZ"/>
                <p>Oben Rorr EZ</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj23" name="bcat3" value="Srivaru Prana 2.0" />      
                <label for="bkj23"><img src="uploads/awards25/bikes/Srivaru-Prana-2.0.jpg" alt="Srivaru Prana 2.0"/>
                <p>Srivaru Prana 2.0</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj24" name="bcat3" value="Matter Aera" />      
                <label for="bkj24"><img src="uploads/awards25/bikes/Matter-Aera.jpg" alt="Matter Aera"/>
                <p>Matter Aera</p>
                </label>
        </div>
        </div>
</div>
<!-- bcat4 -->
<div class="row">
    <div class="tgsection-title kjcat-question">
    <h2>Scooter of the year </h2>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input required type="radio" id="bkj25" name="bcat4" value="Ather 450 Apex" />      
            <label for="bkj25"><img src="uploads/awards25/bikes/Ather-450-Apex.jpg" alt="Ather 450 Apex"/>
            <p>Ather 450 Apex</p>
            </label>
    </div>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input required type="radio" id="bkj26" name="bcat4" value="Kinetic E Luna" />      
            <label for="bkj26"><img src="uploads/awards25/bikes/Kinetic-e-Luna.jpg" alt="Kinetic E Luna"/>
            <p>Kinetic E Luna</p>
            </label>
    </div>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input required type="radio" id="bkj27" name="bcat4" value="Ather Rizta" />      
            <label for="bkj27"><img src="uploads/awards25/bikes/Ather-Rizta.jpg" alt="Ather Rizta"/>
            <p>Ather Rizta</p>
            </label>
    </div>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input required type="radio" id="bkj28" name="bcat4" value="Ampere Nexus" />      
            <label for="bkj28"><img src="uploads/awards25/bikes/Ampere-Nexus.jpg" alt="Ampere Nexus"/>
            <p>Ampere Nexus</p>
            </label>
    </div>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input required type="radio" id="bkj29" name="bcat4" value="BGauss RUV 350" />      
            <label for="bkj29"><img src="uploads/awards25/bikes/BGauss-RUV-350.jpg" alt="BGauss RUV 350"/>
            <p>BGauss RUV 350</p>
            </label>
    </div>
    </div>
    <!--<div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input required type="radio" id="bkj30" name="bcat4" value="Bajaj Chetak 3201" />      
            <label for="bkj30"><img src="uploads/awards25/bikes/Bajaj-Chetak-3201.jpg" alt="Bajaj Chetak 3201"/>
            <p>Bajaj Chetak 3201</p>
            </label>
    </div>
    </div>-->
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input required type="radio" id="bkj31" name="bcat4" value="BMW CE 02" />      
            <label for="bkj31"><img src="uploads/awards25/bikes/BMW-CE-02.jpg" alt="BMW CE 02"/>
            <p>BMW CE 02</p>
            </label>
    </div>
    </div>    
    <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj32" name="bcat4" value="BMW CE 04" />      
                <label for="bkj32"><img src="uploads/awards25/bikes/BMW-CE-04.jpg" alt="BMW CE 04"/>
                <p>BMW CE 04</p>
                </label>
        </div>
        </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input required type="radio" id="bkj33" name="bcat4" value="VLF Tennis" />      
            <label for="bkj33"><img src="uploads/awards25/bikes/VLF-Tennis.jpg" alt="VLF Tennis"/>
            <p>VLF Tennis</p>
            </label>
    </div>
    </div>
    <!--<div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input required type="radio" id="bkj34" name="bcat4" value="Honda Activa e" />      
            <label for="bkj34"><img src="uploads/awards25/bikes/Honda-Activa-e.jpg" alt="Honda Activa e"/>
            <p>Honda Activa e</p>
            </label>
    </div>
    </div>-->
    <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj35" name="bcat4" value="TVS iQube ST" />      
                <label for="bkj35"><img src="uploads/awards25/bikes/TVS-iQube-ST.jpg" alt="TVS iQube ST"/>
                <p>TVS iQube ST</p>
                </label>
        </div>
        </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input required type="radio" id="bkj36" name="bcat4" value="TVS Jupiter" />      
            <label for="bkj36"><img src="uploads/awards25/bikes/TVS-Jupiter.jpg" alt="TVS Jupiter"/>
            <p>TVS Jupiter</p>
            </label>
    </div>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input required type="radio" id="bkj37" name="bcat4" value="Hero Destini 125" />      
            <label for="bkj37"><img src="uploads/awards25/bikes/Hero-Destini-125.jpg" alt="Hero Destini 125"/>
            <p>Hero Destini 125</p>
            </label>
    </div>
    </div>
</div>
<!-- bcat5 -->
<div class="row">
    <div class="tgsection-title kjcat-question">
    <h2>Commuter of the year </h2>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input required type="radio" id="bkj38" name="bcat5" value="Hero Xtreme 125R" />      
            <label for="bkj38"><img src="uploads/awards25/bikes/Hero-Xtreme-125R.jpg" alt="Hero Xtreme 125R"/>
            <p>Hero Xtreme 125R</p>
            </label>
    </div>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input required type="radio" id="bkj39" name="bcat5" value="Hero Splendor+ XTEC 2.0" />      
            <label for="bkj39"><img src="uploads/awards25/bikes/Hero-Splendor-plus-Xtec-2.0.jpg" alt="Hero Splendor+ XTEC 2.0"/>
            <p>Hero Splendor+ XTEC 2.0</p>
            </label>
    </div>
    </div>    
    <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj40" name="bcat5" value="Bajaj Freedom 125" />      
                <label for="bkj40"><img src="uploads/awards25/bikes/Bajaj-Freedom-125.jpg" alt="Bajaj Freedom 125"/>
                <p>Bajaj Freedom 125</p>
                </label>
        </div>
        </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input required type="radio" id="bkj41" name="bcat5" value="Bajaj Pulsar N125" />      
            <label for="bkj41"><img src="uploads/awards25/bikes/Bajaj-Pulsar-N125.jpg" alt="Bajaj Pulsar N125"/>
            <p>Bajaj Pulsar N125</p>
            </label>
    </div>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input required type="radio" id="bkj42" name="bcat5" value="Bajaj Pulsar NS160" />      
            <label for="bkj42"><img src="uploads/awards25/bikes/Bajaj-Pulsar-NS160.jpg" alt="Bajaj Pulsar NS160"/>
            <p>Bajaj Pulsar NS160</p>
            </label>
    </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj43" name="bcat5" value="Bajaj Pulsar N150" />      
                <label for="bkj43"><img src="uploads/awards25/bikes/Bajaj-Pulsar-N150.jpg" alt="Bajaj Pulsar N150"/>
                <p>Bajaj Pulsar N150</p>
                </label>
        </div>
        </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input required type="radio" id="bkj44" name="bcat5" value="Bajaj Pulsar N160" />      
            <label for="bkj44"><img src="uploads/awards25/bikes/Bajaj-Pulsar-N160.jpg" alt="Bajaj Pulsar N160"/>
            <p>Bajaj Pulsar N160</p>
            </label>
    </div>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input required type="radio" id="bkj45" name="bcat5" value="Hero Xtreme 160R" />      
            <label for="bkj45"><img src="uploads/awards25/bikes/Hero-Xtreme-160R.jpg" alt="Hero Xtreme 160R"/>
            <p>Hero Xtreme 160R</p>
            </label>
    </div>
    </div>
</div>
<!-- bcat6 -->
<div class="row">
    <div class="tgsection-title kjcat-question">
    <h2>Two-wheeler of the year up to 250cc</h2>
    </div> 
    <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj46" name="bcat6" value="Husqvarna Vitpilen 250" />      
                <label for="bkj46"><img src="uploads/awards25/bikes/Husqvarna-Vitpilen-250.jpg" alt="Husqvarna Vitpilen 250"/>
                <p>Husqvarna Vitpilen 250</p>
                </label>
        </div>
        </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input required type="radio" id="bkj47" name="bcat6" value="Bajaj Pulsar NS200" />      
            <label for="bkj47"><img src="uploads/awards25/bikes/Bajaj-Pulsar-NS200.jpg" alt="Bajaj Pulsar NS200"/>
            <p>Bajaj Pulsar NS200</p>
            </label>
    </div>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input required type="radio" id="bkj48" name="bcat6" value="Bajaj Pulsar N250" />      
            <label for="bkj48"><img src="uploads/awards25/bikes/Bajaj-Pulsar-N250.jpg" alt="Bajaj Pulsar N250"/>
            <p>Bajaj Pulsar N250</p>
            </label>
    </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj49" name="bcat6" value="KTM 200 Duke" />      
                <label for="bkj49"><img src="uploads/awards25/bikes/KTM-200-Duke.jpg" alt="KTM 200 Duke"/>
                <p>KTM 200 Duke</p>
                </label>
        </div>
        </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input required type="radio" id="bkj50" name="bcat6" value="KTM 250 Duke" />      
            <label for="bkj50"><img src="uploads/awards25/bikes/KTM-250-Duke.jpg" alt="KTM 250 Duke"/>
            <p>KTM 250 Duke</p>
            </label>
    </div>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input required type="radio" id="bkj51" name="bcat6" value="Kawasaki KLX 230" />      
            <label for="bkj51"><img src="uploads/awards25/bikes/Kawasaki-KLX-230.jpg" alt="Kawasaki KLX 230"/>
            <p>Kawasaki KLX 230</p>
            </label>
    </div>
    </div>
</div>
<!-- bcat7 -->
<div class="row">
    <div class="tgsection-title kjcat-question">
    <h2>Roadster of the Year Up To 500cc</h2>
    </div> 
    <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj52" name="bcat7" value="Jawa 350" />      
                <label for="bkj52"><img src="uploads/awards25/bikes/Jawa-350.jpg" alt="Jawa 350"/>
                <p>Jawa 350</p>
                </label>
        </div>
        </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input required type="radio" id="bkj53" name="bcat7" value="Jawa 42" />      
            <label for="bkj53"><img src="uploads/awards25/bikes/Jawa-42.jpg" alt="Jawa 42"/>
            <p>Jawa 42</p>
            </label>
    </div>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input required type="radio" id="bkj54" name="bcat7" value="Royal Enfield Classic 350" />      
            <label for="bkj54"><img src="uploads/awards25/bikes/RE-Classic-350.jpg" alt="Royal Enfield Classic 350"/>
            <p>Royal Enfield Classic 350</p>
            </label>
    </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj55" name="bcat7" value="Jawa 42 FJ" />      
                <label for="bkj55"><img src="uploads/awards25/bikes/Jawa-42-FJ.jpg" alt="Jawa 42 FJ"/>
                <p>Jawa 42 FJ</p>
                </label>
        </div>
        </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input required type="radio" id="bkj56" name="bcat7" value="Triumph Speed T4" />      
            <label for="bkj56"><img src="uploads/awards25/bikes/Triumph-Speed-T4.jpg" alt="Triumph Speed T4"/>
            <p>Triumph Speed T4</p>
            </label>
    </div>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input required type="radio" id="bkj57" name="bcat7" value="Royal Enfield Goan Classic 350" />      
            <label for="bkj57"><img src="uploads/awards25/bikes/Royal-Enfield-Goan-Classic-350.jpg" alt="Royal Enfield Goan Classic 350"/>
            <p>Royal Enfield Goan Classic 350</p>
            </label>
    </div>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input required type="radio" id="bkj58" name="bcat7" value="Hero Mavrick 440" />      
            <label for="bkj58"><img src="uploads/awards25/bikes/Hero-Mavrick-440.jpg" alt="Hero Mavrick 440"/>
            <p>Hero Mavrick 440</p>
            </label>
    </div>
    </div>
</div>
<!-- bcat8 -->
<div class="row">
    <div class="tgsection-title kjcat-question">
    <h2>Two-wheeler of the year up to 400cc</h2>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input required type="radio" id="bkj59" name="bcat8" value="TVS Apache RR 310" />      
            <label for="bkj59"><img src="uploads/awards25/bikes/TVS-Apache-RR-310.jpg" alt="TVS Apache RR 310"/>
            <p>TVS Apache RR 310</p>
            </label>
    </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj60" name="bcat8" value="Yezdi Adventure" />      
                <label for="bkj60"><img src="uploads/awards25/bikes/Yezdi-Adventure.jpg" alt="Yezdi Adventure"/>
                <p>Yezdi Adventure</p>
                </label>
        </div>
        </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input required type="radio" id="bkj61" name="bcat8" value="Bajaj Pulsar NS400Z" />      
            <label for="bkj61"><img src="uploads/awards25/bikes/Bajaj-Pulsar-NS400Z.jpg" alt="Bajaj Pulsar NS400Z"/>
            <p>Bajaj Pulsar NS400Z</p>
            </label>
    </div>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input required type="radio" id="bkj62" name="bcat8" value="Husqvarna Svartpilen 401" />      
            <label for="bkj62"><img src="uploads/awards25/bikes/Husqvarna-Svartpilen-401.jpg" alt="Husqvarna Svartpilen 401"/>
            <p>Husqvarna Svartpilen 401</p>
            </label>
    </div>
    </div>
</div>
<!-- bcat9 -->
<div class="row">
    <div class="tgsection-title kjcat-question">
    <h2>Two-wheeler of the year up to 700cc</h2>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input required type="radio" id="bkj63" name="bcat9" value="Royal Enfield Guerrilla 450" />      
            <label for="bkj63"><img src="uploads/awards25/bikes/Royal-Enfield-Guerrilla-450.jpg" alt="Royal Enfield Guerrilla 450"/>
            <p>Royal Enfield Guerrilla 450</p>
            </label>
    </div>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input required type="radio" id="bkj64" name="bcat9" value="Kawasaki ZX-6R" />      
            <label for="bkj64"><img src="uploads/awards25/bikes/Kawasaki-ZX-6R.jpg" alt="Kawasaki ZX-6R"/>
            <p>Kawasaki ZX-6R</p>
            </label>
    </div>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input required type="radio" id="bkj65" name="bcat9" value="Kawasaki Z650 RS" />      
            <label for="bkj65"><img src="uploads/awards25/bikes/Kawasaki-Z650-RS.jpg" alt="Kawasaki Z650 RS"/>
            <p>Kawasaki Z650 RS</p>
            </label>
    </div>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input required type="radio" id="bkj66" name="bcat9" value="Aprilia Tuareg 660" />      
            <label for="bkj66"><img src="uploads/awards25/bikes/Aprilia-Tuareg-660.jpg" alt="Aprilia Tuareg 660"/>
            <p>Aprilia Tuareg 660</p>
            </label>
    </div>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input required type="radio" id="bkj67" name="bcat9" value="Kawasaki Ninja ZX-4RR" />      
            <label for="bkj67"><img src="uploads/awards25/bikes/Kawasaki-Ninja-ZX-4RR.jpg" alt="Kawasaki Ninja ZX-4RR"/>
            <p>Kawasaki Ninja ZX-4RR</p>
            </label>
    </div>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input required type="radio" id="bkj68" name="bcat9" value="BSA Goldstar" />      
            <label for="bkj68"><img src="uploads/awards25/bikes/BSA-Goldstar.jpg" alt="BSA Goldstar"/>
            <p>BSA Goldstar</p>
            </label>
    </div>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input required type="radio" id="bkj69" name="bcat9" value="Triumph Daytona 660" />      
            <label for="bkj69"><img src="uploads/awards25/bikes/Triumph-Daytona-660.jpg" alt="Triumph Daytona 660"/>
            <p>Triumph Daytona 660</p>
            </label>
    </div>
    </div>    
    <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj70" name="bcat9" value="Royal Enfield Bear 650" />      
                <label for="bkj70"><img src="uploads/awards25/bikes/Royal-Enfield-Bear-650.jpg" alt="Royal Enfield Bear 650"/>
                <p>Royal Enfield Bear 650</p>
                </label>
        </div>
        </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input required type="radio" id="bkj71" name="bcat9" value="Brixton Crossfire 500X" />      
            <label for="bkj71"><img src="uploads/awards25/bikes/Brixton-Crossfire-500X.jpg" alt="Brixton Crossfire 500X"/>
            <p>Brixton Crossfire 500X</p>
            </label>
    </div>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input required type="radio" id="bkj72" name="bcat9" value="Brixton Crossfire 500XC" />      
            <label for="bkj72"><img src="uploads/awards25/bikes/Brixton-Crossfire-500XC.jpg" alt="Brixton Crossfire 500XC"/>
            <p>Brixton Crossfire 500XC</p>
            </label>
    </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj73" name="bcat9" value="Honda NX500" />      
                <label for="bkj73"><img src="uploads/awards25/bikes/Honda-NX500.jpg" alt="Honda NX500"/>
                <p>Honda NX500</p>
                </label>
        </div>
        </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input required type="radio" id="bkj74" name="bcat9" value="Kawasaki Ninja 500" />      
            <label for="bkj74"><img src="uploads/awards25/bikes/Kawasaki-Ninja-500.jpg" alt="Kawasaki Ninja 500"/>
            <p>Kawasaki Ninja 500</p>
            </label>
    </div>
    </div>
</div>
<!-- bcat10 -->
<div class="row">
    <div class="tgsection-title kjcat-question">
    <h2>Premium Motorcycle of the Year</h2>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input required type="radio" id="bkj75" name="bcat10" value="Suzuki V-Strom 800DE" />      
            <label for="bkj75"><img src="uploads/awards25/bikes/Suzuki-V-Strom-800DE.jpg" alt="Suzuki V-Strom 800DE"/>
            <p>Suzuki V-Strom 800DE</p>
            </label>
    </div>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input required type="radio" id="bkj76" name="bcat10" value="Ducati DesertX Rally" />      
            <label for="bkj76"><img src="uploads/awards25/bikes/Ducati-DesertX-Rally.jpg" alt="Ducati DesertX Rally"/>
            <p>Ducati DesertX Rally</p>
            </label>
    </div>
    </div>
    <!--<div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input required type="radio" id="bkj77" name="bcat10" value="Harley Davidson Pan America 1250 Special" />      
            <label for="bkj77"><img src="uploads/awards25/bikes/Harley-Davidson-Pan-America-1250-Special.jpg" alt="Harley Davidson Pan America 1250 Special"/>
            <p>Harley Davidson Pan America 1250 Special</p>
            </label>
    </div>
    </div>-->
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input required type="radio" id="bkj78" name="bcat10" value="Ducati Multistrada V4 RS" />      
            <label for="bkj78"><img src="uploads/awards25/bikes/Ducati-Multistrada-V4-RS.jpg" alt="Ducati Multistrada V4 RS"/>
            <p>Ducati Multistrada V4 RS</p>
            </label>
    </div>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input required type="radio" id="bkj79" name="bcat10" value="BMW F 900 GS" />      
            <label for="bkj79"><img src="uploads/awards25/bikes/BMW-F-900-GS.jpg" alt="BMW F 900 GS"/>
            <p>BMW F 900 GS</p>
            </label>
    </div>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input required type="radio" id="bkj80" name="bcat10" value="Triumph Tiger 1200" />      
            <label for="bkj80"><img src="uploads/awards25/bikes/Triumph-Tiger-1200.jpg" alt="Triumph Tiger 1200"/>
            <p>Triumph Tiger 1200</p>
            </label>
    </div>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input required type="radio" id="bkj81" name="bcat10" value="KTM 1290 Super Adventure S" />      
            <label for="bkj81"><img src="uploads/awards25/bikes/KTM-1290-Super-Adventure-S.jpg" alt="KTM 1290 Super Adventure S"/>
            <p>KTM 1290 Super Adventure S</p>
            </label>
    </div>
    </div>    
    <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj82" name="bcat10" value="KTM 890 Adventure R" />      
                <label for="bkj82"><img src="uploads/awards25/bikes/KTM-890-Adventure-R.jpg" alt="KTM 890 Adventure R"/>
                <p>KTM 890 Adventure R</p>
                </label>
        </div>
        </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input required type="radio" id="bkj83" name="bcat10" value="Triumph Tiger 900" />      
            <label for="bkj83"><img src="uploads/awards25/bikes/Triumph-Tiger-900.jpg" alt="Triumph Tiger 900"/>
            <p>Triumph Tiger 900</p>
            </label>
    </div>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input required type="radio" id="bkj84" name="bcat10" value="Triumph Scrambler 1200 X" />      
            <label for="bkj84"><img src="uploads/awards25/bikes/Triumph-Scrambler-1200X.jpg" alt="Triumph Scrambler 1200 X"/>
            <p>Triumph Scrambler 1200 X</p>
            </label>
    </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj84a" name="bcat10" value="Indian Roadmaster Elite" />      
                <label for="bkj84a"><img src="uploads/awards25/bikes/Indian-Roadmaster-Elite.jpg" alt="Indian Roadmaster Elite"/>
                <p>Indian Roadmaster Elite</p>
                </label>
        </div>
        </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input required type="radio" id="bkj85" name="bcat10" value="BMW R 12" />      
            <label for="bkj85"><img src="uploads/awards25/bikes/BMW-R12.jpg" alt="BMW R 12"/>
            <p>BMW R 12</p>
            </label>
    </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj86" name="bcat10" value="Brixton Cromwell 1200" />      
                <label for="bkj86"><img src="uploads/awards25/bikes/Brixton-Cromwell-1200.jpg" alt="Brixton Cromwell 1200"/>
                <p>Brixton Cromwell 1200</p>
                </label>
        </div>
        </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input required type="radio" id="bkj87" name="bcat10" value="Brixton Cromwell 1200 X" />      
            <label for="bkj87"><img src="uploads/awards25/bikes/Brixton-Cromwell-1200-X.jpg" alt="Brixton Cromwell 1200 X"/>
            <p>Brixton Cromwell 1200 X</p>
            </label>
    </div>
    </div>
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input required type="radio" id="bkj88" name="bcat10" value="Ducati Hypermotard 698 Mono" />      
            <label for="bkj88"><img src="uploads/awards25/bikes/Ducati-Hypermotard-698-Mono.jpg" alt="Ducati Hypermotard 698 Mono"/>
            <p>Ducati Hypermotard 698 Mono</p>
            </label>
    </div>
    </div>    
    <div class="col-lg-3 col-6">
    <div class="kjchocie-wrap">
            <input required type="radio" id="bkj89" name="bcat10" value="BMW R1300 GS" />      
            <label for="bkj89"><img src="uploads/awards25/bikes/BMW-R1300-GS.jpg" alt="BMW R1300 GS"/>
            <p>BMW R1300 GS</p>
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
        document.getElementById('tga-bike25').addEventListener('submit', function (event) {
            event.preventDefault();  // Prevent form submission for validation
    
            let allCategoriesValid = true;
            const errorMessageElement = document.getElementById('error-message');
            errorMessageElement.style.display = 'none';  // Hide error message by default
    
            // Categories array for bike nominations
            const categories = [
                'bcat1', 'bcat2', 'bcat3', 'bcat4', 'bcat5', 
                'bcat6', 'bcat7', 'bcat8', 'bcat9', 'bcat10'
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
