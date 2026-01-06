<!-- resources/views/awards/voting.blade.php -->
@extends('layouts.apphome')
<link rel="stylesheet" href="{{('assets/css/awards.css') }}">

@section('title', 'TopGear Awards')

@section('content')

        <div class="tg-banner-wrap">
                <img src="https://www.topgearmag.in/uploads/awards26/awards26.jpg" width="100%">
        </div>
        <div class="kjbar-wrap">

                <div class="kjleft">
                        <div class="kjcar active"><a href="#">Vote For Cars <i class="fa fa-car" aria-hidden="true"></i></a>
                        </div>
                        <div class="kjbike"><a href="/voting-bikes">Vote For Bikes <i class="fa fa-motorcycle"
                                                aria-hidden="true"></i></a></div>
                </div>
        </div>
        <div class="tg-voting-wrap">
                <div class="container">
                        <div class="kjbar-wrap">
                        </div>
                        <form id="tga-25" method="get" action="https://www.topgearmag.in/voting-bikes">
                                <!-- cat1 -->
                                <div class="row">
                                        <div class="tgsection-title kjcat-question">
                                                <h2>Car of the year </h2>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                                <div class="kjchocie-wrap">
                                                        <input type="radio" id="kj01" name="cat1" value="Kia Syros" />
                                                        <label for="kj01"><img src="uploads/awards26/cars/Kia-Syros.jpg"
                                                                        alt="Kia Syros" />
                                                                <p>Kia Syros</p>
                                                        </label>
                                                </div>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                                <div class="kjchocie-wrap">
                                                        <input type="radio" id="kj02" name="cat1" value="Kia Carens Clavis" />
                                                        <label for="kj02"><img src="uploads/awards26/cars/Kia-Carens-Clavis.jpg"
                                                                        alt="Kia Carens Clavis" />
                                                                <p>Kia Carens Clavis</p>
                                                        </label>
                                                </div>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                                <div class="kjchocie-wrap">
                                                        <input type="radio" id="kj03" name="cat1" value="Skoda Kylaq" />
                                                        <label for="kj03"><img src="uploads/awards26/cars/Skoda-Kylaq.jpg"
                                                                        alt="Skoda Kylaq" />
                                                                <p>Skoda Kylaq</p>
                                                        </label>
                                                </div>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                                <div class="kjchocie-wrap">
                                                        <input type="radio" id="kj04" name="cat1"
                                                                value="Maruti Suzuki Victoris" />
                                                        <label for="kj04"><img
                                                                        src="uploads/awards26/cars/Maruti-Suzuki-Victoris.jpg"
                                                                        alt="Maruti Suzuki Victoris" />
                                                                <p>Maruti Suzuki Victoris</p>
                                                        </label>
                                                </div>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                                <div class="kjchocie-wrap">
                                                        <input type="radio" id="kj05" name="cat1" value="Hyundai Venue" />
                                                        <label for="kj05"><img src="uploads/awards26/cars/Hyundai-Venue.jpg"
                                                                        alt="Hyundai Venue" />
                                                                <p>Hyundai Venue</p>
                                                        </label>
                                                </div>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                                <div class="kjchocie-wrap">
                                                        <input type="radio" id="kj06" name="cat1" value="Mahindra XEV 9e" />
                                                        <label for="kj06"><img src="uploads/awards26/cars/Mahindra-XEV-9e.jpg"
                                                                        alt="Mahindra XEV 9e" />
                                                                <p>Mahindra XEV 9e</p>
                                                        </label>
                                                </div>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                                <div class="kjchocie-wrap">
                                                        <input type="radio" id="kj07" name="cat1" value="Mahindra XEV 9s" />
                                                        <label for="kj07"><img src="uploads/awards26/cars/Mahindra-XEV-9s.jpg"
                                                                        alt="Mahindra XEV 9s" />
                                                                <p>Mahindra XEV 9s</p>
                                                        </label>
                                                </div>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                                <div class="kjchocie-wrap">
                                                        <input type="radio" id="kj08" name="cat1" value="Mahindra BE 6" />
                                                        <label for="kj08"><img src="uploads/awards26/cars/Mahindra-BE-6.jpg"
                                                                        alt="Mahindra BE 6" />
                                                                <p>Mahindra BE 6</p>
                                                        </label>
                                                </div>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                                <div class="kjchocie-wrap">
                                                        <input type="radio" id="kj09" name="cat1" value="Vinfast VF 6" />
                                                        <label for="kj09"><img src="uploads/awards26/cars/Vinfast-VF-6.jpg"
                                                                        alt="Vinfast VF 6" />
                                                                <p>Vinfast VF 6</p>
                                                        </label>
                                                </div>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                                <div class="kjchocie-wrap">
                                                        <input type="radio" id="kj10" name="cat1" value="Vinfast VF 7" />
                                                        <label for="kj10"><img src="uploads/awards26/cars/Vinfast-VF-7.jpg"
                                                                        alt="Vinfast VF 7" />
                                                                <p>Vinfast VF 7</p>
                                                        </label>
                                                </div>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                                <div class="kjchocie-wrap">
                                                        <input type="radio" id="kj11" name="cat1" value="Tata Sierra" />
                                                        <label for="kj11"><img src="uploads/awards26/cars/Tata-Sierra.jpg"
                                                                        alt="Tata Sierra" />
                                                                <p>Tata Sierra</p>
                                                        </label>
                                                </div>
                                        </div>
                                </div>
                                <!-- cat2 -->
                                <div class="row">
                                        <div class="tgsection-title kjcat-question">
                                                <h2>Sedan of the year</h2>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                                <div class="kjchocie-wrap">
                                                        <input type="radio" id="kj12" name="cat2" value="Toyota Camry" />
                                                        <label for="kj12"><img src="uploads/awards26/cars/Toyota-Camry.jpg"
                                                                        alt="Toyota Camry" />
                                                                <p>Toyota Camry</p>
                                                        </label>
                                                </div>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                                <div class="kjchocie-wrap">
                                                        <input type="radio" id="kj13" name="cat2"
                                                                value="BMW 2 Series Gran Coupe" />
                                                        <label for="kj13"><img
                                                                        src="uploads/awards26/cars/BMW-2-Series-Gran-Coupe.jpg"
                                                                        alt="BMW 2 Series Gran Coupe" />
                                                                <p>BMW 2 Series Gran Coupe</p>
                                                        </label>
                                                </div>
                                        </div>
                                </div>
                                <!-- cat3 -->
                                <div class="row">
                                        <div class="tgsection-title kjcat-question">
                                                <h2>Compact SUV of the Year</h2>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                                <div class="kjchocie-wrap">
                                                        <input type="radio" id="kj14" name="cat3"
                                                                value="Maruti Suzuki Victoris" />
                                                        <label for="kj14"><img
                                                                        src="uploads/awards26/cars/Maruti-Suzuki-Victoris.jpg"
                                                                        alt="Maruti Suzuki Victoris" />
                                                                <p>Maruti Suzuki Victoris</p>
                                                        </label>
                                                </div>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                                <div class="kjchocie-wrap">
                                                        <input type="radio" id="kj15" name="cat3" value="Tata Sierra" />
                                                        <label for="kj15"><img src="uploads/awards26/cars/Tata-Sierra.jpg"
                                                                        alt="Tata Sierra" />
                                                                <p>Tata Sierra</p>
                                                        </label>
                                                </div>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                                <div class="kjchocie-wrap">
                                                        <input type="radio" id="kj16" name="cat3" value="Vinfast VF6" />
                                                        <label for="kj16"><img src="uploads/awards26/cars/Vinfast-VF6.jpg"
                                                                        alt="Vinfast VF6" />
                                                                <p>Vinfast VF6</p>
                                                        </label>
                                                </div>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                                <div class="kjchocie-wrap">
                                                        <input type="radio" id="kj17" name="cat3" value="Mahindra BE 6" />
                                                        <label for="kj17"><img src="uploads/awards26/cars/Mahindra-BE-6.jpg"
                                                                        alt="Mahindra BE 6" />
                                                                <p>Mahindra BE 6</p>
                                                        </label>
                                                </div>
                                        </div>
                                </div>
                                <!-- cat4 -->
                                <div class="row">
                                        <div class="tgsection-title kjcat-question">
                                                <h2>Sub-Compact SUV of the Year</h2>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                                <div class="kjchocie-wrap">
                                                        <input type="radio" id="kj18" name="cat4" value="Kia Syros" />
                                                        <label for="kj18"><img src="uploads/awards26/cars/Kia-Syros.jpg"
                                                                        alt="Kia Syros" />
                                                                <p>Kia Syros</p>
                                                        </label>
                                                </div>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                                <div class="kjchocie-wrap">
                                                        <input type="radio" id="kj19" name="cat4" value="Skoda Kylaq" />
                                                        <label for="kj19"><img src="uploads/awards26/cars/Skoda-Kylaq.jpg"
                                                                        alt="Skoda Kylaq" />
                                                                <p>Skoda Kylaq</p>
                                                        </label>
                                                </div>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                                <div class="kjchocie-wrap">
                                                        <input type="radio" id="kj20" name="cat4" value="Hyundai Venue" />
                                                        <label for="kj20"><img src="uploads/awards26/cars/Hyundai-Venue.jpg"
                                                                        alt="Hyundai Venue" />
                                                                <p>Hyundai Venue</p>
                                                        </label>
                                                </div>
                                        </div>
                                </div>
                                <!-- cat5 -->
                                <div class="row">
                                        <div class="tgsection-title kjcat-question">
                                                <h2>Mid-Size SUV of the Year</h2>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                                <div class="kjchocie-wrap">
                                                        <input type="radio" id="kj21" name="cat5"
                                                                value="Volkswagen Tiguan R Line" />
                                                        <label for="kj21"><img
                                                                        src="uploads/awards26/cars/Volkswagen-Tiguan-R-Line.jpg"
                                                                        alt="Volkswagen Tiguan R Line" />
                                                                <p>Volkswagen Tiguan R Line</p>
                                                        </label>
                                                </div>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                                <div class="kjchocie-wrap">
                                                        <input type="radio" id="kj22" name="cat5" value="Skoda Kodiaq" />
                                                        <label for="kj22"><img src="uploads/awards26/cars/Skoda-Kodiaq.jpg"
                                                                        alt="Skoda Kodiaq" />
                                                                <p>Skoda Kodiaq</p>
                                                        </label>
                                                </div>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                                <div class="kjchocie-wrap">
                                                        <input type="radio" id="kj23" name="cat5" value="Mahindra XEV 9e" />
                                                        <label for="kj23"><img src="uploads/awards26/cars/Mahindra-XEV-9e.jpg"
                                                                        alt="Mahindra XEV 9e" />
                                                                <p>Mahindra XEV 9e</p>
                                                        </label>
                                                </div>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                                <div class="kjchocie-wrap">
                                                        <input type="radio" id="kj24" name="cat5" value="Mahindra XEV 9s" />
                                                        <label for="kj24"><img src="uploads/awards26/cars/Mahindra-XEV-9s.jpg"
                                                                        alt="Mahindra XEV 9s" />
                                                                <p>Mahindra XEV 9s</p>
                                                        </label>
                                                </div>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                                <div class="kjchocie-wrap">
                                                        <input type="radio" id="kj25" name="cat5" value="BYD Sealion" />
                                                        <label for="kj25"><img src="uploads/awards26/cars/BYD-Sealion.jpg"
                                                                        alt="BYD Sealion" />
                                                                <p>BYD Sealion</p>
                                                        </label>
                                                </div>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                                <div class="kjchocie-wrap">
                                                        <input type="radio" id="kj26" name="cat5" value="Vinfast VF7" />
                                                        <label for="kj26"><img src="uploads/awards26/cars/Vinfast-VF7.jpg"
                                                                        alt="Vinfast VF7" />
                                                                <p>Vinfast VF7</p>
                                                        </label>
                                                </div>
                                        </div>
                                </div>
                                <!-- cat6 -->
                                <div class="row">
                                        <div class="tgsection-title kjcat-question">
                                                <h2>MPV of the Year</h2>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                                <div class="kjchocie-wrap">
                                                        <input type="radio" id="kj27" name="cat6" value="Kia Carens Clavis" />
                                                        <label for="kj27"><img src="uploads/awards26/cars/Kia-Carens-Clavis.jpg"
                                                                        alt="Kia Carens Clavis" />
                                                                <p>Kia Carens Clavis</p>
                                                        </label>
                                                </div>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                                <div class="kjchocie-wrap">
                                                        <input type="radio" id="kj28" name="cat6" value="MG M9" />
                                                        <label for="kj28"><img src="uploads/awards26/cars/MG-M9.jpg"
                                                                        alt="MG M9" />
                                                                <p>MG M9</p>
                                                        </label>
                                                </div>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                                <div class="kjchocie-wrap">
                                                        <input type="radio" id="kj29" name="cat6"
                                                                value="Kia Carens Clavis EV" />
                                                        <label for="kj29"><img
                                                                        src="uploads/awards26/cars/Kia-Carens-Clavis-EV.jpg"
                                                                        alt="Kia Carens Clavis EV" />
                                                                <p>Kia Carens Clavis EV</p>
                                                        </label>
                                                </div>
                                        </div>
                                </div>
                                <!-- cat7 -->
                                <div class="row">
                                        <div class="tgsection-title kjcat-question">
                                                <h2>Performance Car of the Year</h2>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                                <div class="kjchocie-wrap">
                                                        <input type="radio" id="kj30" name="cat7" value="Volkswagen Golf GTI" />
                                                        <label for="kj30"><img
                                                                        src="uploads/awards26/cars/Volkswagen-Golf-GTI.jpg"
                                                                        alt="Volkswagen Golf GTI" />
                                                                <p>Volkswagen Golf GTI</p>
                                                        </label>
                                                </div>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                                <div class="kjchocie-wrap">
                                                        <input type="radio" id="kj31" name="cat7"
                                                                value="Porsche Macan Electric" />
                                                        <label for="kj31"><img
                                                                        src="uploads/awards26/cars/Porsche-Macan-Electric.jpg"
                                                                        alt="Porsche Macan Electric" />
                                                                <p>Porsche Macan Electric</p>
                                                        </label>
                                                </div>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                                <div class="kjchocie-wrap">
                                                        <input type="radio" id="kj32" name="cat7" value="MINI Convertible" />
                                                        <label for="kj32"><img src="uploads/awards26/cars/MINI-Convertible.jpg"
                                                                        alt="MINI Convertible" />
                                                                <p>MINI Convertible</p>
                                                        </label>
                                                </div>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                                <div class="kjchocie-wrap">
                                                        <input type="radio" id="kj33" name="cat7" value="MINI Countryman JCW" />
                                                        <label for="kj33"><img
                                                                        src="uploads/awards26/cars/MINI-Countryman-JCW.jpg"
                                                                        alt="MINI Countryman JCW" />
                                                                <p>MINI Countryman JCW</p>
                                                        </label>
                                                </div>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                                <div class="kjchocie-wrap">
                                                        <input type="radio" id="kj34" name="cat7" value="Lotus Emeya R" />
                                                        <label for="kj34"><img src="uploads/awards26/cars/Lotus-Emeya-R.jpg"
                                                                        alt="Lotus Emeya R" />
                                                                <p>Lotus Emeya R</p>
                                                        </label>
                                                </div>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                                <div class="kjchocie-wrap">
                                                        <input type="radio" id="kj35" name="cat7" value="Skoda Octavia RS" />
                                                        <label for="kj35"><img src="uploads/awards26/cars/Skoda-Octavia-RS.jpg"
                                                                        alt="Skoda Octavia RS" />
                                                                <p>Skoda Octavia RS</p>
                                                        </label>
                                                </div>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                                <div class="kjchocie-wrap">
                                                        <input type="radio" id="kj36" name="cat7" value="BMW M5" />
                                                        <label for="kj36"><img src="uploads/awards26/cars/BMW-M5.jpg"
                                                                        alt="BMW M5" />
                                                                <p>BMW M5</p>
                                                        </label>
                                                </div>
                                        </div>
                                </div>
                                <!-- cat8 -->
                                <div class="row">
                                        <div class="tgsection-title kjcat-question">
                                                <h2>Sports Car of the Year</h2>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                                <div class="kjchocie-wrap">
                                                        <input type="radio" id="kj37" name="cat8" value="Mercedes-AMG CLE 53" />
                                                        <label for="kj37"><img
                                                                        src="uploads/awards26/cars/Mercedes-AMG-CLE-53.jpg"
                                                                        alt="Mercedes-AMG CLE 53" />
                                                                <p>Mercedes-AMG CLE 53</p>
                                                        </label>
                                                </div>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                                <div class="kjchocie-wrap">
                                                        <input type="radio" id="kj38" name="cat8" value="BMW M4 CS" />
                                                        <label for="kj38"><img src="uploads/awards26/cars/BMW-M4-CS.jpg"
                                                                        alt="BMW M4 CS" />
                                                                <p>BMW M4 CS</p>
                                                        </label>
                                                </div>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                                <div class="kjchocie-wrap">
                                                        <input type="radio" id="kj39" name="cat8" value="Lotus Emira" />
                                                        <label for="kj39"><img src="uploads/awards26/cars/Lotus-Emira.jpg"
                                                                        alt="Lotus Emira" />
                                                                <p>Lotus Emira</p>
                                                        </label>
                                                </div>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                                <div class="kjchocie-wrap">
                                                        <input type="radio" id="kj40" name="cat8" value="MG Cyberster" />
                                                        <label for="kj40"><img src="uploads/awards26/cars/MG-Cyberster.jpg"
                                                                        alt="MG Cyberster" />
                                                                <p>MG Cyberster</p>
                                                        </label>
                                                </div>
                                        </div>
                                </div>
                                <!-- cat9 -->
                                <div class="row">
                                        <div class="tgsection-title kjcat-question">
                                                <h2>Supercar of the Year</h2>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                                <div class="kjchocie-wrap">
                                                        <input type="radio" id="kj41" name="cat9"
                                                                value="Lamborghini Temarario" />
                                                        <label for="kj41"><img
                                                                        src="uploads/awards26/cars/Lamborghini-Temarario.jpg"
                                                                        alt="Lamborghini Temarario" />
                                                                <p>Lamborghini Temarario</p>
                                                        </label>
                                                </div>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                                <div class="kjchocie-wrap">
                                                        <input type="radio" id="kj42" name="cat9"
                                                                value="Aston Martin Vanquish" />
                                                        <label for="kj42"><img
                                                                        src="uploads/awards26/cars/Aston-Martin-Vanquish.jpg"
                                                                        alt="Aston Martin Vanquish" />
                                                                <p>Aston Martin Vanquish</p>
                                                        </label>
                                                </div>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                                <div class="kjchocie-wrap">
                                                        <input type="radio" id="kj43" name="cat9" value="Maserati McPura" />
                                                        <label for="kj43"><img src="uploads/awards26/cars/Maserati-McPura.jpg"
                                                                        alt="Maserati McPura" />
                                                                <p>Maserati McPura</p>
                                                        </label>
                                                </div>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                                <div class="kjchocie-wrap">
                                                        <input type="radio" id="kj44" name="cat9"
                                                                value="Ferrari 296 Speciale" />
                                                        <label for="kj44"><img
                                                                        src="uploads/awards26/cars/Ferrari-296-Speciale.jpg"
                                                                        alt="Ferrari 296 Speciale" />
                                                                <p>Ferrari 296 Speciale</p>
                                                        </label>
                                                </div>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                                <div class="kjchocie-wrap">
                                                        <input type="radio" id="kj45" name="cat9"
                                                                value="Porsche 911 Carrera 4 GTS" />
                                                        <label for="kj45"><img
                                                                        src="uploads/awards26/cars/Porsche-911-Carrera-4-GTS.jpg"
                                                                        alt="Porsche 911 Carrera 4 GTS" />
                                                                <p>Porsche 911 Carrera 4 GTS</p>
                                                        </label>
                                                </div>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                                <div class="kjchocie-wrap">
                                                        <input type="radio" id="kj46" name="cat9" value="Mercedes-AMG GT 63" />
                                                        <label for="kj46"><img
                                                                        src="uploads/awards26/cars/Mercedes-AMG-GT-63.jpg"
                                                                        alt="Mercedes-AMG GT 63" />
                                                                <p>Mercedes-AMG GT 63</p>
                                                        </label>
                                                </div>
                                        </div>
                                </div>
                                <!-- cat10 -->
                                <div class="row">
                                        <div class="tgsection-title kjcat-question">
                                                <h2>EV of the Year</h2>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                                <div class="kjchocie-wrap">
                                                        <input type="radio" id="kj47" name="cat10" value="Vinfast VF6" />
                                                        <label for="kj47"><img src="uploads/awards26/cars/Vinfast-VF6.jpg"
                                                                        alt="Vinfast VF6" />
                                                                <p>Vinfast VF6</p>
                                                        </label>
                                                </div>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                                <div class="kjchocie-wrap">
                                                        <input type="radio" id="kj48" name="cat10" value="Vinfast VF7" />
                                                        <label for="kj48"><img src="uploads/awards26/cars/Vinfast-VF7.jpg"
                                                                        alt="Vinfast VF7" />
                                                                <p>Vinfast VF7</p>
                                                        </label>
                                                </div>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                                <div class="kjchocie-wrap">
                                                        <input type="radio" id="kj49" name="cat10" value="Mahindra BE 6" />
                                                        <label for="kj49"><img src="uploads/awards26/cars/Mahindra-BE-6.jpg"
                                                                        alt="Mahindra BE 6" />
                                                                <p>Mahindra BE 6</p>
                                                        </label>
                                                </div>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                                <div class="kjchocie-wrap">
                                                        <input type="radio" id="kj50" name="cat10" value="Mahindra XEV 9e" />
                                                        <label for="kj50"><img src="uploads/awards26/cars/Mahindra-XEV-9e.jpg"
                                                                        alt="Mahindra XEV 9e" />
                                                                <p>Mahindra XEV 9e</p>
                                                        </label>
                                                </div>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                                <div class="kjchocie-wrap">
                                                        <input type="radio" id="kj51" name="cat10" value="Tata Harrier EV" />
                                                        <label for="kj51"><img src="uploads/awards26/cars/Tata-Harrier-EV.jpg"
                                                                        alt="Tata Harrier EV" />
                                                                <p>Tata Harrier EV</p>
                                                        </label>
                                                </div>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                                <div class="kjchocie-wrap">
                                                        <input type="radio" id="kj52" name="cat10" value="BYD Sealion" />
                                                        <label for="kj52"><img src="uploads/awards26/cars/BYD-Sealion.jpg"
                                                                        alt="BYD Sealion" />
                                                                <p>BYD Sealion</p>
                                                        </label>
                                                </div>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                                <div class="kjchocie-wrap">
                                                        <input type="radio" id="kj53" name="cat10" value="Mahindra XEV 9S" />
                                                        <label for="kj53"><img src="uploads/awards26/cars/Mahindra-XEV-9S.jpg"
                                                                        alt="Mahindra XEV 9S" />
                                                                <p>Mahindra XEV 9S</p>
                                                        </label>
                                                </div>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                                <div class="kjchocie-wrap">
                                                        <input type="radio" id="kj54" name="cat10" value="Kia Clavis EV" />
                                                        <label for="kj54"><img src="uploads/awards26/cars/Kia-Clavis-EV.jpg"
                                                                        alt="Kia Clavis EV" />
                                                                <p>Kia Clavis EV</p>
                                                        </label>
                                                </div>
                                        </div>
                                </div>

                                <!-- cat11 -->
                                <div class="row">
                                        <div class="tgsection-title kjcat-question">
                                                <h2>EV SUV of the Year</h2>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                                <div class="kjchocie-wrap">
                                                        <input type="radio" id="kj55" name="cat11" value="Vinfast VF6" />
                                                        <label for="kj55"><img
                                                                        src="uploads/awards26/cars/Vinfast-VF6.jpg"
                                                                        alt="Vinfast VF6" />
                                                                <p>Vinfast VF6</p>
                                                        </label>
                                                </div>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                                <div class="kjchocie-wrap">
                                                        <input type="radio" id="kj56" name="cat11" value="Vinfast VF7" />
                                                        <label for="kj56"><img
                                                                        src="uploads/awards26/cars/Vinfast-VF7.jpg"
                                                                        alt="Vinfast VF7" />
                                                                <p>Vinfast VF7</p>
                                                        </label>
                                                </div>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                                <div class="kjchocie-wrap">
                                                        <input type="radio" id="kj57" name="cat11" value="Mahindra BE 6" />
                                                        <label for="kj57"><img
                                                                        src="uploads/awards26/cars/Mahindra-BE-6.jpg"
                                                                        alt="Mahindra BE 6" />
                                                                <p>Mahindra BE 6</p>
                                                        </label>
                                                </div>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                                <div class="kjchocie-wrap">
                                                        <input type="radio" id="kj58" name="cat11" value="Mahindra XEV 9e" />
                                                        <label for="kj58"><img
                                                                        src="uploads/awards26/cars/Mahindra-XEV-9e.jpg"
                                                                        alt="Mahindra XEV 9e" />
                                                                <p>Mahindra XEV 9e</p>
                                                        </label>
                                                </div>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                                <div class="kjchocie-wrap">
                                                        <input type="radio" id="kj59" name="cat11" value="Tata Harrier EV" />
                                                        <label for="kj59"><img
                                                                        src="uploads/awards26/cars/Tata-Harrier-EV.jpg"
                                                                        alt="Tata Harrier EV" />
                                                                <p>Tata Harrier EV</p>
                                                        </label>
                                                </div>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                                <div class="kjchocie-wrap">
                                                        <input type="radio" id="kj60" name="cat11" value="BYD Sealion" />
                                                        <label for="kj60"><img
                                                                        src="uploads/awards26/cars/BYD-Sealion.jpg"
                                                                        alt="BYD Sealion" />
                                                                <p>BYD Sealion</p>
                                                        </label>
                                                </div>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                                <div class="kjchocie-wrap">
                                                        <input type="radio" id="kj61" name="cat11" value="Mahindra XEV 9S" />
                                                        <label for="kj61"><img
                                                                        src="uploads/awards26/cars/Mahindra-XEV-9S.jpg"
                                                                        alt="Mahindra XEV 9S" />
                                                                <p>Mahindra XEV 9S</p>
                                                        </label>
                                                </div>
                                        </div>
                                </div>
                                <!-- cat12 -->
                                <div class="row">
                                        <div class="tgsection-title kjcat-question">
                                                <h2>Luxury Mid-Size SUV of the Year</h2>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                                <div class="kjchocie-wrap">
                                                        <input type="radio" id="kj62" name="cat12" value="Volvo EX30" />
                                                        <label for="kj62"><img
                                                                        src="uploads/awards26/cars/Volvo-EX30.jpg"
                                                                        alt="Volvo EX30" />
                                                                <p>Volvo EX30</p>
                                                        </label>
                                                </div>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                                <div class="kjchocie-wrap">
                                                        <input type="radio" id="kj63" name="cat12" value="Porsche Macan Electric" />
                                                        <label for="kj63"><img
                                                                        src="uploads/awards26/cars/Porsche-Macan-Electric.jpg"
                                                                        alt="Porsche Macan Electric" />
                                                                <p>Porsche Macan Electric</p>
                                                        </label>
                                                </div>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                                <div class="kjchocie-wrap">
                                                        <input type="radio" id="kj64" name="cat12" value="BMW iX1 LWB" />
                                                        <label for="kj64"><img
                                                                        src="uploads/awards26/cars/BMW-iX1-LWB.jpg"
                                                                        alt="BMW iX1 LWB" />
                                                                <p>BMW iX1 LWB</p>
                                                        </label>
                                                </div>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                                <div class="kjchocie-wrap">
                                                        <input type="radio" id="kj65" name="cat12" value="MINI Countryman JCW" />
                                                        <label for="kj65"><img
                                                                        src="uploads/awards26/cars/MINI-Countryman-JCW.jpg"
                                                                        alt="MINI Countryman JCW" />
                                                                <p>MINI Countryman JCW</p>
                                                        </label>
                                                </div>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                                <div class="kjchocie-wrap">
                                                        <input type="radio" id="kj66" name="cat12" value="BMW X3" />
                                                        <label for="kj66"><img
                                                                        src="uploads/awards26/cars/BMW-X3.jpg"
                                                                        alt="BMW X3" />
                                                                <p>BMW X3</p>
                                                        </label>
                                                </div>
                                        </div>
                                </div>
                                <!-- cat13 -->
                                <div class="row">
                                        <div class="tgsection-title kjcat-question">
                                                <h2>Luxury/Performance SUV of the Year</h2>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                                <div class="kjchocie-wrap">
                                                        <input type="radio" id="kj67" name="cat13" value="Mercedes-Benz G580" />
                                                        <label for="kj67"><img
                                                                        src="uploads/awards26/cars/Mercedes-Benz-G580.jpg"
                                                                        alt="Mercedes-Benz G580" />
                                                                <p>Mercedes-Benz G580</p>
                                                        </label>
                                                </div>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                                <div class="kjchocie-wrap">
                                                        <input type="radio" id="kj68" name="cat13" value="Audi RS Q8" />
                                                        <label for="kj68"><img
                                                                        src="uploads/awards26/cars/Audi-RS-Q8.jpg"
                                                                        alt="Audi RS Q8" />
                                                                <p>Audi RS Q8</p>
                                                        </label>
                                                </div>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                                <div class="kjchocie-wrap">
                                                        <input type="radio" id="kj69" name="cat13" value="Tesla Model Y" />
                                                        <label for="kj69"><img
                                                                        src="uploads/awards26/cars/Tesla-Model-Y.jpg"
                                                                        alt="Tesla Model Y" />
                                                                <p>Tesla Model Y</p>
                                                        </label>
                                                </div>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                                <div class="kjchocie-wrap">
                                                        <input type="radio" id="kj70" name="cat13" value="Land Rover Defender Octa" />
                                                        <label for="kj70"><img
                                                                        src="uploads/awards26/cars/Land-Rover-Defender-Octa.jpg"
                                                                        alt="Land Rover Defender Octa" />
                                                                <p>Land Rover Defender Octa</p>
                                                        </label>
                                                </div>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                                <div class="kjchocie-wrap">
                                                        <input type="radio" id="kj71" name="cat13" value="Mercedes-Benz G450d" />
                                                        <label for="kj71"><img
                                                                        src="uploads/awards26/cars/Mercedes-Benz-G450d.jpg"
                                                                        alt="Mercedes-Benz G450d" />
                                                                <p>Mercedes-Benz G450d</p>
                                                        </label>
                                                </div>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                                <div class="kjchocie-wrap">
                                                        <input type="radio" id="kj72" name="cat13" value="Land Cruiser LC300" />
                                                        <label for="kj72"><img
                                                                        src="uploads/awards26/cars/Land-Cruiser-LC300.jpg"
                                                                        alt="Land Cruiser LC300" />
                                                                <p>Land Cruiser LC300</p>
                                                        </label>
                                                </div>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                                <div class="kjchocie-wrap">
                                                        <input type="radio" id="kj73" name="cat13" value="Range Rover Sport SV" />
                                                        <label for="kj73"><img
                                                                        src="uploads/awards26/cars/Range-Rover-Sport-SV.jpg"
                                                                        alt="Range Rover Sport SV" />
                                                                <p>Range Rover Sport SV</p>
                                                        </label>
                                                </div>
                                        </div>
                                </div>
                                <!-- cat14 -->
                                <div class="row">
                                        <div class="tgsection-title kjcat-question">
                                                <h2>Luxury Car of the Year</h2>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                                <div class="kjchocie-wrap">
                                                        <input type="radio" id="kj74" name="cat14" value="Mercedes-Benz G580" />
                                                        <label for="kj74"><img
                                                                        src="uploads/awards26/cars/Mercedes-Benz-G580.jpg"
                                                                        alt="Mercedes-Benz G580" />
                                                                <p>Mercedes-Benz G580</p>
                                                        </label>
                                                </div>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                                <div class="kjchocie-wrap">
                                                        <input type="radio" id="kj75" name="cat14" value="Mercedes-Benz G450d" />
                                                        <label for="kj75"><img
                                                                        src="uploads/awards26/cars/Mercedes-Benz-G450d.jpg"
                                                                        alt="Mercedes-Benz G450d" />
                                                                <p>Mercedes-Benz G450d</p>
                                                        </label>
                                                </div>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                                <div class="kjchocie-wrap">
                                                        <input type="radio" id="kj76" name="cat14" value="Land Cruiser LC300" />
                                                        <label for="kj76"><img
                                                                        src="uploads/awards26/cars/Land-Cruiser-LC300.jpg"
                                                                        alt="Land Cruiser LC300" />
                                                                <p>Land Cruiser LC300</p>
                                                        </label>
                                                </div>
                                        </div>
                                </div>

                                <div class="text-center mt-3 mb-5">
                                        <button class="tg-btn" type="submit">Vote</button>
                                </div>
                        </form>
                </div>
        </div>

@endsection