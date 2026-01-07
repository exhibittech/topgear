<!-- resources/views/awards/bikes.blade.php -->
@extends('layouts.apphome')
<link rel="stylesheet" href="{{('assets/css/awards.css') }}">

@section('title', 'TopGear Awards 2025')

@section('content')

<div class="tg-banner-wrap">
<img src="https://www.topgearmag.in/uploads/awards26/awards26.jpg" width="100%">
</div>
<!-- <div class="kjbar-wrap">
	  
	<div class="kjleft">
                <div class="kjcar "><a href="{{ route('awards.voting26') }}">Vote For Cars <i class="fa fa-car" aria-hidden="true"></i></a></div>
                <div class="kjbike active"><a href={{ route('awards.bikes') }}>Vote For Bikes <i class="fa fa-motorcycle" aria-hidden="true"></i></a></div>
	</div>
</div> -->

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
        <h2>Motorcycle of the Year</h2>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj01" name="bcat1" value="TVS Apache RTX" />      
                <label for="bkj01"><img src="uploads/awards26/bikes/TVS-Apache-RTX.jpg" alt="TVS Apache RTX"/>
                <p>TVS Apache RTX</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj02" name="bcat1" value="KTM 390 Adventure S" />      
                <label for="bkj02"><img src="uploads/awards26/bikes/KTM-390-Adventure-S.jpg" alt="KTM 390 Adventure S"/>
                <p>KTM 390 Adventure S</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj03" name="bcat1" value="KTM 390 Enduro" />      
                <label for="bkj03"><img src="uploads/awards26/bikes/KTM-390-Enduro.jpg" alt="KTM 390 Enduro"/>
                <p>KTM 390 Enduro</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj04" name="bcat1" value="Royal Enfield Classic 650" />      
                <label for="bkj04"><img src="uploads/awards26/bikes/Royal-Enfield-Classic-650.jpg" alt="Royal Enfield Classic 650"/>
                <p>Royal Enfield Classic 650</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj05" name="bcat1" value="Honda CB125" />      
                <label for="bkj05"><img src="uploads/awards26/bikes/Honda-CB125.jpg" alt="Honda CB125"/>
                <p>Honda CB125</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj06" name="bcat1" value="Kawasaki KLX230" />      
                <label for="bkj06"><img src="uploads/awards26/bikes/Kawasaki-KLX230.jpg" alt="Kawasaki KLX230"/>
                <p>Kawasaki KLX230</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj07" name="bcat1" value="Ultraviolette X47 Crossover" />      
                <label for="bkj07"><img src="uploads/awards26/bikes/Ultraviolette-X47-Crossover.jpg" alt="Ultraviolette X47 Crossover"/>
                <p>Ultraviolette X47 Crossover</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj08" name="bcat1" value="Yamaha XSR 155" />      
                <label for="bkj08"><img src="uploads/awards26/bikes/Yamaha-XSR-155.jpg" alt="Yamaha XSR 155"/>
                <p>Yamaha XSR 155</p>
                </label>
        </div>
        </div>
    </div>
<!-- bcat2 -->
<div class="row">
        <div class="tgsection-title kjcat-question">
        <h2>Scooter of the Year</h2>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj09" name="bcat2" value="TVS NTorq 150" />      
                <label for="bkj09"><img src="uploads/awards26/bikes/TVS-NTorq-150.jpg" alt="TVS NTorq 150"/>
                <p>TVS NTorq 150</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj10" name="bcat2" value="Hero Xoom 160" />      
                <label for="bkj10"><img src="uploads/awards26/bikes/Hero-Xoom-160.jpg" alt="Hero Xoom 160"/>
                <p>Hero Xoom 160</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj11" name="bcat2" value="Aprilia SR175" />      
                <label for="bkj11"><img src="uploads/awards26/bikes/Aprilia-SR175.jpg" alt="Aprilia SR175"/>
                <p>Aprilia SR175</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj12" name="bcat2" value="Vida VX2" />      
                <label for="bkj12"><img src="uploads/awards26/bikes/Vida-VX2.jpg" alt="Vida VX2"/>
                <p>Vida VX2</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj13" name="bcat2" value="Ather 450X" />      
                <label for="bkj13"><img src="uploads/awards26/bikes/Ather-450X.jpg" alt="Ather 450X"/>
                <p>Ather 450X</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj14" name="bcat2" value="Hero Destini 125" />      
                <label for="bkj14"><img src="uploads/awards26/bikes/Hero-Destini-125.jpg" alt="Hero Destini 125"/>
                <p>Hero Destini 125</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj15" name="bcat2" value="TVS Orbiter" />      
                <label for="bkj15"><img src="uploads/awards26/bikes/TVS-Orbiter.jpg" alt="TVS Orbiter"/>
                <p>TVS Orbiter</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj16" name="bcat2" value="Hero Xoom 125" />      
                <label for="bkj16"><img src="uploads/awards26/bikes/Hero-Xoom-125.jpg" alt="Hero Xoom 125"/>
                <p>Hero Xoom 125</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj17" name="bcat2" value="Honda Activa e" />      
                <label for="bkj17"><img src="uploads/awards26/bikes/Honda-Activa-e.jpg" alt="Honda Activa e"/>
                <p>Honda Activa e</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj18" name="bcat2" value="Suzuki Access 125" />      
                <label for="bkj18"><img src="uploads/awards26/bikes/Suzuki-Access-125.jpg" alt="Suzuki Access 125"/>
                <p>Suzuki Access 125</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj19" name="bcat2" value="Honda QC1" />      
                <label for="bkj19"><img src="uploads/awards26/bikes/Honda-QC1.jpg" alt="Honda QC1"/>
                <p>Honda QC1</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj20" name="bcat2" value="VLF Mobster 135" />      
                <label for="bkj20"><img src="uploads/awards26/bikes/VLF-Mobster-135.jpg" alt="VLF Mobster 135"/>
                <p>VLF Mobster 135</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj21" name="bcat2" value="Hero Destini 110" />      
                <label for="bkj21"><img src="uploads/awards26/bikes/Hero-Destini-110.jpg" alt="Hero Destini 110"/>
                <p>Hero Destini 110</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj22" name="bcat2" value="Simple One Gen 1.5" />      
                <label for="bkj22"><img src="uploads/awards26/bikes/Simple-One-Gen-1.5.jpg" alt="Simple One Gen 1.5"/>
                <p>Simple One Gen 1.5</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj23" name="bcat2" value="BMW C400 GT" />      
                <label for="bkj23"><img src="uploads/awards26/bikes/BMW-C400-GT.jpg" alt="BMW C400 GT"/>
                <p>BMW C400 GT</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj24" name="bcat2" value="Honda X-ADV" />      
                <label for="bkj24"><img src="uploads/awards26/bikes/Honda-X-ADV.jpg" alt="Honda X-ADV"/>
                <p>Honda X-ADV</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj25" name="bcat2" value="Vespa 125" />      
                <label for="bkj25"><img src="uploads/awards26/bikes/Vespa-125.jpg" alt="Vespa 125"/>
                <p>Vespa 125</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj26" name="bcat2" value="Vespa 150" />      
                <label for="bkj26"><img src="uploads/awards26/bikes/Vespa-150.jpg" alt="Vespa 150"/>
                <p>Vespa 150</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj27" name="bcat2" value="Bajaj Chetak 35 Series" />      
                <label for="bkj27"><img src="uploads/awards26/bikes/Bajaj-Chetak-35-Series.jpg" alt="Bajaj Chetak 35 Series"/>
                <p>Bajaj Chetak 35 Series</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj28" name="bcat2" value="Kinetic DX" />      
                <label for="bkj28"><img src="uploads/awards26/bikes/Kinetic-DX.jpg" alt="Kinetic DX"/>
                <p>Kinetic DX</p>
                </label>
        </div>
        </div>
         <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj29" name="bcat2" value="VLF Tennis" />      
                <label for="bkj29"><img src="uploads/awards26/bikes/VLF-Tennis.jpg" alt="VLF Tennis"/>
                <p>VLF Tennis</p>
                </label>
        </div>
        </div>
</div>
<!-- bcat3 -->
<div class="row">
        <div class="tgsection-title kjcat-question">
        <h2>EV two-wheeler of the Year</h2>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj30" name="bcat3" value="Ultraviolette F77 Superstreet" />      
                <label for="bkj30"><img src="uploads/awards26/bikes/Ultraviolette-F77-Superstreet.jpg" alt="Ultraviolette F77 Superstreet"/>
                <p>Ultraviolette F77 Superstreet</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj31" name="bcat3" value="Ultraviolette X47 Crossover" />      
                <label for="bkj31"><img src="uploads/awards26/bikes/Ultraviolette-X47-Crossover.jpg" alt="Ultraviolette X47 Crossover"/>
                <p>Ultraviolette X47 Crossover</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj32" name="bcat3" value="VIDA VX2" />      
                <label for="bkj32"><img src="uploads/awards26/bikes/VIDA-VX2.jpg" alt="VIDA VX2"/>
                <p>VIDA VX2</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj33" name="bcat3" value="Ather 450X" />      
                <label for="bkj33"><img src="uploads/awards26/bikes/Ather-450X.jpg" alt="Ather 450X"/>
                <p>Ather 450X</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj34" name="bcat3" value="TVS Orbiter" />      
                <label for="bkj34"><img src="uploads/awards26/bikes/TVS-Orbiter.jpg" alt="TVS Orbiter"/>
                <p>TVS Orbiter</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj35" name="bcat3" value="Honda Activa e" />      
                <label for="bkj35"><img src="uploads/awards26/bikes/Honda-Activa-e.jpg" alt="Honda Activa e"/>
                <p>Honda Activa e</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj36" name="bcat3" value="Honda QC1" />      
                <label for="bkj36"><img src="uploads/awards26/bikes/Honda-QC1.jpg" alt="Honda QC1"/>
                <p>Honda QC1</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj37" name="bcat3" value="Raptee T30" />      
                <label for="bkj37"><img src="uploads/awards26/bikes/Raptee-T30.jpg" alt="Raptee T30"/>
                <p>Raptee T30</p>
                </label>
        </div>
        </div>
</div>
<!-- bcat4 -->
<div class="row">
        <div class="tgsection-title kjcat-question">
        <h2>Entry-level Motorcycle of the year (under 150cc)</h2>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj38" name="bcat4" value="Hero Glamour X" />      
                <label for="bkj38"><img src="uploads/awards26/bikes/Hero-Glamour-X.jpg" alt="Hero Glamour X"/>
                <p>Hero Glamour X</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj39" name="bcat4" value="Honda Shine 100" />      
                <label for="bkj39"><img src="uploads/awards26/bikes/Honda-Shine-100.jpg" alt="Honda Shine 100"/>
                <p>Honda Shine 100</p>
                </label>
        </div>
        </div>
</div>
<!-- bcat5 -->
<div class="row">
        <div class="tgsection-title kjcat-question">
        <h2>Motorcycle of the year (under 200cc or equivalent EV)</h2>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj40" name="bcat5" value="Yamaha XSR 155" />      
                <label for="bkj40"><img src="uploads/awards26/bikes/Yamaha-XSR-155.jpg" alt="Yamaha XSR 155"/>
                <p>Yamaha XSR 155</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj41" name="bcat5" value="KTM 160 Duke" />      
                <label for="bkj41"><img src="uploads/awards26/bikes/KTM-160-Duke.jpg" alt="KTM 160 Duke"/>
                <p>KTM 160 Duke</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj42" name="bcat5" value="Honda CB125 Hornet" />      
                <label for="bkj42"><img src="uploads/awards26/bikes/Honda-CB125-Hornet.jpg" alt="Honda CB125 Hornet"/>
                <p>Honda CB125 Hornet</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj43" name="bcat5" value="Yamaha FZ-S Hybrid" />      
                <label for="bkj43"><img src="uploads/awards26/bikes/Yamaha-FZ-S-Hybrid.jpg" alt="Yamaha FZ-S Hybrid"/>
                <p>Yamaha FZ-S Hybrid</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj44" name="bcat5" value="Ola Roadster" />      
                <label for="bkj44"><img src="uploads/awards26/bikes/Ola-Roadster.jpg" alt="Ola Roadster"/>
                <p>Ola Roadster</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj45" name="bcat5" value="Honda NX200" />      
                <label for="bkj45"><img src="uploads/awards26/bikes/Honda-NX200.jpg" alt="Honda NX200"/>
                <p>Honda NX200</p>
                </label>
        </div>
        </div>
</div>
<!-- bcat6 -->
<div class="row">
        <div class="tgsection-title kjcat-question">
        <h2>Entry-level performance motorcycle of the year</h2>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj46" name="bcat6" value="KTM 160 Duke" />      
                <label for="bkj46"><img src="uploads/awards26/bikes/KTM-160-Duke.jpg" alt="KTM 160 Duke"/>
                <p>KTM 160 Duke</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj47" name="bcat6" value="Hero Xtreme 250R" />      
                <label for="bkj47"><img src="uploads/awards26/bikes/Hero-Xtreme-250R.jpg" alt="Hero Xtreme 250R"/>
                <p>Hero Xtreme 250R</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj48" name="bcat6" value="Bajaj Pulsar NS400Z" />      
                <label for="bkj48"><img src="uploads/awards26/bikes/Bajaj-Pulsar-NS400Z.jpg" alt="Bajaj Pulsar NS400Z"/>
                <p>Bajaj Pulsar NS400Z</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj49" name="bcat6" value="Yamaha XSR 155" />      
                <label for="bkj49"><img src="uploads/awards26/bikes/Yamaha-XSR-155.jpg" alt="Yamaha XSR 155"/>
                <p>Yamaha XSR 155</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj50" name="bcat6" value="Harley-Davidson X440T" />      
                <label for="bkj50"><img src="uploads/awards26/bikes/Harley-Davidson-X440T.jpg" alt="Harley-Davidson X440T"/>
                <p>Harley-Davidson X440T</p>
                </label>
        </div>
        </div>
</div>
<!-- bcat7 -->
<div class="row">
        <div class="tgsection-title kjcat-question">
        <h2>Adventure Motorcycle of the Year</h2>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj51" name="bcat7" value="KTM 390 Adventure S" />      
                <label for="bkj51"><img src="uploads/awards26/bikes/KTM-390-Adventure-S.jpg" alt="KTM 390 Adventure S"/>
                <p>KTM 390 Adventure S</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj52" name="bcat7" value="KTM 390 Enduro" />      
                <label for="bkj52"><img src="uploads/awards26/bikes/KTM-390-Enduro.jpg" alt="KTM 390 Enduro"/>
                <p>KTM 390 Enduro</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj53" name="bcat7" value="TVS Apache RTX" />      
                <label for="bkj53"><img src="uploads/awards26/bikes/TVS-Apache-RTX.jpg" alt="TVS Apache RTX"/>
                <p>TVS Apache RTX</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj54" name="bcat7" value="Royal Enfield Scram 440" />      
                <label for="bkj54"><img src="uploads/awards26/bikes/Royal-Enfield-Scram-440.jpg" alt="Royal Enfield Scram 440"/>
                <p>Royal Enfield Scram 440</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj55" name="bcat7" value="Hero Xpulse 210" />      
                <label for="bkj55"><img src="uploads/awards26/bikes/Hero-Xpulse-210.jpg" alt="Hero Xpulse 210"/>
                <p>Hero Xpulse 210</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj56" name="bcat7" value="Kawasaki KLX230" />      
                <label for="bkj56"><img src="uploads/awards26/bikes/Kawasaki-KLX230.jpg" alt="Kawasaki KLX230"/>
                <p>Kawasaki KLX230</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj57" name="bcat7" value="KTM 250 Adventure" />      
                <label for="bkj57"><img src="uploads/awards26/bikes/KTM-250-Adventure.jpg" alt="KTM 250 Adventure"/>
                <p>KTM 250 Adventure</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj58" name="bcat7" value="KTM 390 Adventure X" />      
                <label for="bkj58"><img src="uploads/awards26/bikes/KTM-390-Adventure-X.jpg" alt="KTM 390 Adventure X"/>
                <p>KTM 390 Adventure X</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj59" name="bcat7" value="Triumph Scrambler 400 XC" />      
                <label for="bkj59"><img src="uploads/awards26/bikes/Triumph-Scrambler-400-XC.jpg" alt="Triumph Scrambler 400 XC"/>
                <p>Triumph Scrambler 400 XC</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj60" name="bcat7" value="Ultraviolette X47 Crossover" />      
                <label for="bkj60"><img src="uploads/awards26/bikes/Ultraviolette-X47-Crossover.jpg" alt="Ultraviolette X47 Crossover"/>
                <p>Ultraviolette X47 Crossover</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj61" name="bcat7" value="Yezdi Adventure" />      
                <label for="bkj61"><img src="uploads/awards26/bikes/Yezdi-Adventure.jpg" alt="Yezdi Adventure"/>
                <p>Yezdi Adventure</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj62" name="bcat7" value="Royal Enfield Himalayan Mana Black Edition" />      
                <label for="bkj62"><img src="uploads/awards26/bikes/Royal-Enfield-Himalayan-Mana-Black-Edition.jpg" alt="Royal Enfield Himalayan Mana Black Edition"/>
                <p>Royal Enfield Himalayan Mana Black Edition</p>
                </label>
        </div>
        </div>
</div>
<!-- bcat8 -->
<div class="row">
        <div class="tgsection-title kjcat-question">
        <h2>Performance Motorcycle of the Year under 1000cc</h2>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj63" name="bcat8" value="Ducati Scrambler" />      
                <label for="bkj63"><img src="uploads/awards26/bikes/Ducati-Scrambler.jpg" alt="Ducati Scrambler"/>
                <p>Ducati Scrambler</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj64" name="bcat8" value="Kawasaki Ninja ZX-6R" />      
                <label for="bkj64"><img src="uploads/awards26/bikes/Kawasaki-Ninja-ZX-6R.jpg" alt="Kawasaki Ninja ZX-6R"/>
                <p>Kawasaki Ninja ZX-6R</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj65" name="bcat8" value="Honda CBR650R" />      
                <label for="bkj65"><img src="uploads/awards26/bikes/Honda-CBR650R.jpg" alt="Honda CBR650R"/>
                <p>Honda CBR650R</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj66" name="bcat8" value="Kawasaki Ninja 650" />      
                <label for="bkj66"><img src="uploads/awards26/bikes/Kawasaki-Ninja-650.jpg" alt="Kawasaki Ninja 650"/>
                <p>Kawasaki Ninja 650</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj67" name="bcat8" value="Triumph Trident 660" />      
                <label for="bkj67"><img src="uploads/awards26/bikes/Triumph-Trident-660.jpg" alt="Triumph Trident 660"/>
                <p>Triumph Trident 660</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj68" name="bcat8" value="Honda CB750 Hornet" />      
                <label for="bkj68"><img src="uploads/awards26/bikes/Honda-CB750-Hornet.jpg" alt="Honda CB750 Hornet"/>
                <p>Honda CB750 Hornet</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj69" name="bcat8" value="Aprilia Tuono 457" />      
                <label for="bkj69"><img src="uploads/awards26/bikes/Aprilia-Tuono-457.jpg" alt="Aprilia Tuono 457"/>
                <p>Aprilia Tuono 457</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj70" name="bcat8" value="Kawasaki Ninja 500" />      
                <label for="bkj70"><img src="uploads/awards26/bikes/Kawasaki-Ninja-500.jpg" alt="Kawasaki Ninja 500"/>
                <p>Kawasaki Ninja 500</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj71" name="bcat8" value="Honda CB650R" />      
                <label for="bkj71"><img src="uploads/awards26/bikes/Honda-CB650R.jpg" alt="Honda CB650R"/>
                <p>Honda CB650R</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj72" name="bcat8" value="Ducati Multistrada V2" />      
                <label for="bkj72"><img src="uploads/awards26/bikes/Ducati-Multistrada-V2.jpg" alt="Ducati Multistrada V2"/>
                <p>Ducati Multistrada V2</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj73" name="bcat8" value="Ducati Panigale V2" />      
                <label for="bkj73"><img src="uploads/awards26/bikes/Ducati-Panigale-V2.jpg" alt="Ducati Panigale V2"/>
                <p>Ducati Panigale V2</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj74" name="bcat8" value="Ducati Streetfighter V2" />      
                <label for="bkj74"><img src="uploads/awards26/bikes/Ducati-Streetfighter-V2.jpg" alt="Ducati Streetfighter V2"/>
                <p>Ducati Streetfighter V2</p>
                </label>
        </div>
        </div>
</div>
<!-- bcat9 -->
<div class="row">
        <div class="tgsection-title kjcat-question">
        <h2>Performance Motorcycle of the Year over 1000cc</h2>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj75" name="bcat9" value="BMW S 1000 R" />      
                <label for="bkj75"><img src="uploads/awards26/bikes/BMW-S-1000-R.jpg" alt="BMW S 1000 R"/>
                <p>BMW S 1000 R</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj76" name="bcat9" value="BMW S 1000 RR" />      
                <label for="bkj76"><img src="uploads/awards26/bikes/BMW-S-1000-RR.jpg" alt="BMW S 1000 RR"/>
                <p>BMW S 1000 RR</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj77" name="bcat9" value="Ducati Panigale V4" />      
                <label for="bkj77"><img src="uploads/awards26/bikes/Ducati-Panigale-V4.jpg" alt="Ducati Panigale V4"/>
                <p>Ducati Panigale V4</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj78" name="bcat9" value="Ducati Streetfighter V4" />      
                <label for="bkj78"><img src="uploads/awards26/bikes/Ducati-Streetfighter-V4.jpg" alt="Ducati Streetfighter V4"/>
                <p>Ducati Streetfighter V4</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj79" name="bcat9" value="Honda CB1000 Hornet" />      
                <label for="bkj79"><img src="uploads/awards26/bikes/Honda-CB1000-Hornet.jpg" alt="Honda CB1000 Hornet"/>
                <p>Honda CB1000 Hornet</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj80" name="bcat9" value="Honda CBR1000RR-R Fireblade" />      
                <label for="bkj80"><img src="uploads/awards26/bikes/Honda-CBR1000RR-R-Fireblade.jpg" alt="Honda CBR1000RR-R Fireblade"/>
                <p>Honda CBR1000RR-R Fireblade</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj81" name="bcat9" value="Kawasaki Ninja ZX-10R" />      
                <label for="bkj81"><img src="uploads/awards26/bikes/Kawasaki-Ninja-ZX-10R.jpg" alt="Kawasaki Ninja ZX-10R"/>
                <p>Kawasaki Ninja ZX-10R</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj82" name="bcat9" value="Triumph Speed Triple 1200 RS" />      
                <label for="bkj82"><img src="uploads/awards26/bikes/Triumph-Speed-Triple-1200-RS.jpg" alt="Triumph Speed Triple 1200 RS"/>
                <p>Triumph Speed Triple 1200 RS</p>
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
                <input required type="radio" id="bkj83" name="bcat10" value="Ducati Multistrada V4" />      
                <label for="bkj83"><img src="uploads/awards26/bikes/Ducati-Multistrada-V4.jpg" alt="Ducati Multistrada V4"/>
                <p>Ducati Multistrada V4</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj84" name="bcat10" value="BMW R 1300 GSA" />      
                <label for="bkj84"><img src="uploads/awards26/bikes/BMW-R-1300-GSA.jpg" alt="BMW R 1300 GSA"/>
                <p>BMW R 1300 GSA</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj85" name="bcat10" value="Harley-Davidson Pan America 1250" />      
                <label for="bkj85"><img src="uploads/awards26/bikes/Harley-Davidson-Pan-America-1250.jpg" alt="Harley-Davidson Pan America 1250"/>
                <p>Harley-Davidson Pan America 1250</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj86" name="bcat10" value="Kawasaki Versys 1100" />      
                <label for="bkj86"><img src="uploads/awards26/bikes/Kawasaki-Versys-1100.jpg" alt="Kawasaki Versys 1100"/>
                <p>Kawasaki Versys 1100</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj87" name="bcat10" value="Indian Scout" />      
                <label for="bkj87"><img src="uploads/awards26/bikes/Indian-Scout.jpg" alt="Indian Scout"/>
                <p>Indian Scout</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj88" name="bcat10" value="Harley-Davidson Street Bob" />      
                <label for="bkj88"><img src="uploads/awards26/bikes/Harley-Davidson-Street-Bob.jpg" alt="Harley-Davidson Street Bob"/>
                <p>Harley-Davidson Street Bob</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj89" name="bcat10" value="Harley-Davidson Street Glide" />      
                <label for="bkj89"><img src="uploads/awards26/bikes/Harley-Davidson-Street-Glide.jpg" alt="Harley-Davidson Street Glide"/>
                <p>Harley-Davidson Street Glide</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj90" name="bcat10" value="Harley-Davidson Road Glide" />      
                <label for="bkj90"><img src="uploads/awards26/bikes/Harley-Davidson-Road-Glide.jpg" alt="Harley-Davidson Road Glide"/>
                <p>Harley-Davidson Road Glide</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj91" name="bcat10" value="Harley-Davidson Breakout" />      
                <label for="bkj91"><img src="uploads/awards26/bikes/Harley-Davidson-Breakout.jpg" alt="Harley-Davidson Breakout"/>
                <p>Harley-Davidson Breakout</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj92" name="bcat10" value="Harley-Davidson Fat Boy" />      
                <label for="bkj92"><img src="uploads/awards26/bikes/Harley-Davidson-Fat-Boy.jpg" alt="Harley-Davidson Fat Boy"/>
                <p>Harley-Davidson Fat Boy</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj93" name="bcat10" value="Harley-Davidson Sportster" />      
                <label for="bkj93"><img src="uploads/awards26/bikes/Harley-Davidson-Sportster.jpg" alt="Harley-Davidson Sportster"/>
                <p>Harley-Davidson Sportster</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj94" name="bcat10" value="Harley-Davidson Nightster" />      
                <label for="bkj94"><img src="uploads/awards26/bikes/Harley-Davidson-Nightster.jpg" alt="Harley-Davidson Nightster"/>
                <p>Harley-Davidson Nightster</p>
                </label>
        </div>
        </div>
</div>
<!-- bcat11 -->
<div class="row">
        <div class="tgsection-title kjcat-question">
        <h2>Design of the Year</h2>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj95" name="bcat11" value="Triumph Thruxton 400" />      
                <label for="bkj95"><img src="uploads/awards26/bikes/Triumph-Thruxton-400.jpg" alt="Triumph Thruxton 400"/>
                <p>Triumph Thruxton 400</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj96" name="bcat11" value="BMW R 1300 GSA" />      
                <label for="bkj96"><img src="uploads/awards26/bikes/BMW-R-1300-GSA.jpg" alt="BMW R 1300 GSA"/>
                <p>BMW R 1300 GSA</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj97" name="bcat11" value="BMW S 1000 RR" />      
                <label for="bkj97"><img src="uploads/awards26/bikes/BMW-S-1000-RR.jpg" alt="BMW S 1000 RR"/>
                <p>BMW S 1000 RR</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj98" name="bcat11" value="Honda CBR1000RR-R Fireblade" />      
                <label for="bkj98"><img src="uploads/awards26/bikes/Honda-CBR1000RR-R-Fireblade.jpg" alt="Honda CBR1000RR-R Fireblade"/>
                <p>Honda CBR1000RR-R Fireblade</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj99" name="bcat11" value="Royal Enfield Meteor 350 Sundowner Orange Special Edition" />      
                <label for="bkj99"><img src="uploads/awards26/bikes/Royal-Enfield-Meteor-350-Sundowner-Orange-Special-Edition.jpg" alt="Royal Enfield Meteor 350 Sundowner Orange Special Edition"/>
                <p>Royal Enfield Meteor 350 Sundowner Orange Special Edition</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj100" name="bcat11" value="Yezdi Roadster" />      
                <label for="bkj100"><img src="uploads/awards26/bikes/Yezdi-Roadster.jpg" alt="Yezdi Roadster"/>
                <p>Yezdi Roadster</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj101" name="bcat11" value="Yezdi Adventure" />      
                <label for="bkj101"><img src="uploads/awards26/bikes/Yezdi-Adventure.jpg" alt="Yezdi Adventure"/>
                <p>Yezdi Adventure</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj102" name="bcat11" value="Yamaha XSR 155" />      
                <label for="bkj102"><img src="uploads/awards26/bikes/Yamaha-XSR-155.jpg" alt="Yamaha XSR 155"/>
                <p>Yamaha XSR 155</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj103" name="bcat11" value="VLF Mobster 135" />      
                <label for="bkj103"><img src="uploads/awards26/bikes/VLF-Mobster-135.jpg" alt="VLF Mobster 135"/>
                <p>VLF Mobster 135</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj104" name="bcat11" value="TVS Orbiter" />      
                <label for="bkj104"><img src="uploads/awards26/bikes/TVS-Orbiter.jpg" alt="TVS Orbiter"/>
                <p>TVS Orbiter</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj105" name="bcat11" value="TVS NTorq 150" />      
                <label for="bkj105"><img src="uploads/awards26/bikes/TVS-NTorq-150.jpg" alt="TVS NTorq 150"/>
                <p>TVS NTorq 150</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj106" name="bcat11" value="Hero Xoom 160" />      
                <label for="bkj106"><img src="uploads/awards26/bikes/Hero-Xoom-160.jpg" alt="Hero Xoom 160"/>
                <p>Hero Xoom 160</p>
                </label>
        </div>
        </div>
        <div class="col-lg-3 col-6">
        <div class="kjchocie-wrap">
                <input required type="radio" id="bkj107" name="bcat11" value="Hero Xtreme 250R" />      
                <label for="bkj107"><img src="uploads/awards26/bikes/Hero-Xtreme-250R.jpg" alt="Hero Xtreme 250R"/>
                <p>Hero Xtreme 250R</p>
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
