@extends('layouts.app')

@section('content')

    <section class="bg2" data-aos="zoom-in">

        <div class="container-fluid">
            <form id="myForm-search">
                <div class="row">
                    <div class="col-sm-6">
                        <input class="input-form" id="lead_service_type" type="text" placeholder="What Services are You Looking For?" required />
                        <div id="service-suggestions" class="dropdown-menu show" style="position: absolute; display: none; z-index: 1000;"></div>
                    </div>
                    <div class="col-sm-6">
                        <input class="input-form" id="postcode" type="text" placeholder="Postcode" required />
                    </div>
                    <div class="col-sm-12">
                        <button type="submit" class="search-btn">Search</button>
                    </div>
                    <div class="col-sm-12">
                        <p class="form-p">Popular: House Cleaning, Web Design, Personal Trainers</p>
                    </div>
                </div>
            </form>
        </div>
    </section>

@endsection
   