@extends('layout')

@section('content')
    <div class="page_content bg_gray">
        <div class="uo_header">
            <div class="wrapper cf">
                <div class="wbox ava">
                    <figure><img src="/storage/avatars/{{ $user->avatar }}" alt="avatar" /></figure>
                </div>
                <div class="main_info">
                    <h1>{{$user->name}}</h1>
                    <div class="midbox">
                        <h4>560 points</h4>
                        <div class="info_nav">
                            <a href="#">Get Free Points</a>
                            <span class="sepor"></span>
                            <a href="#">Win iPad</a>
                        </div>
                    </div>
                    <div class="stat">
                        <div class="item">
                            <div class="num">30</div>
                            <div class="title">total orders</div>
                        </div>
                        <div class="item">
                            <div class="num">14</div>
                            <div class="title">total reviews</div>
                        </div>
                        <div class="item">
                            <div class="num">0</div>
                            <div class="title">total gifts</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="uo_body">
            <div class="wrapper">
                <div class="uofb cf">
                    <div class="l_col adrs">
                        <h2>Add New Address</h2>

                        <form action="/addresses" method="post">
                            @csrf
                            <div class="field">
                                <input type="hidden" name="user_id" value="{{auth()->id()}}">

                                <label>Name *</label>
                                <input type="text" name="name" value="{{old('name')}}" palceholder=""
                                       class="vl_empty" required/>
                            </div>
                            <div class="field">
                                <label>Your country *</label>
                                <select class="vl_empty" name="country_id" id="country">
                                    <option class="plh"></option>
                                    @foreach ($countries as $country)
                                        <option value="{{$country->id}}">
                                            {{$country->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="field">
                                <label>Your state *</label>
                                <select id="state" name="state_id" class="vl_empty">
                                </select>
                            </div>
                            <div class="field">
                                <label>Your city</label>
                                <select id="city" name="city_id" class="vl_empty">
                                </select>
                            </div>

                            <div class="field">
                                <label>Street</label>
                                <input type="text" name="street" value="{{old('street')}}" palceholder="" class="vl_empty" />
                            </div>
                            <div class="field">
                                <label>House # </label>
                                <input type="text" name="house" value="{{old('house')}}" palceholder="House Name / Number" />
                            </div>

                            <div class="field">
                                <label class="pos_top">Additional information</label>
                                <textarea name="information">{{old('information')}}</textarea>
                            </div>

                            <div class="field">
                                <input type="submit" value="add address" class="green_btn" />
                            </div>
                        </form>
                    </div>

                    <div class="r_col">
                        <h2>My Addresses</h2>
                        <div class="uo_adr_list">
                            @foreach($addresses as $address)
                            <div class="item">
                                <h3>{{$address->name}}</h3>
                                <p>{{$address->getCountryName()}}, {{$address->getStateName()}},
                                    {{$address->getCityName()}}
                                    @if($address->street != null)
                                        , {{$address->street}}
                                    @endif
                                    @if($address->house != null)
                                        , {{$address->house}}
                                    @endif
                                    @if($address->information != null)
                                        , {{$address->information}}
                                    @endif
                                    </p>
                                <form method="post" action="/addresses/{{$address->id}}">
                                    @method('delete')
                                    @csrf
                                    <div class="actbox">
                                        <button type="submit" class="bcross">
                                        </button>
                                    </div>
                                </form>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            $('#country').change(function(){
                var cid = $(this).val();
                if(cid){
                    $.ajax({
                        type:"get",
                        url:"{{url('/getStates')}}/"+cid,
                        success:function(res)
                        {
                            $("#state").append('<option>Select</option>');
                            if(res)
                            {
                                $("#state").empty();
                                $("#city").empty();
                                $.each(res,function(key,value){
                                    $("#state").append('<option value="'+key+'">'+value+'</option>');
                                });
                            }
                        }

                    });
                }
            });
            $('#state').change(function(){
                var sid = $(this).val();
                if(sid){
                    $.ajax({
                        type:"get",
                        url:"{{url('/getCities')}}/"+sid,
                        success:function(res)
                        {
                            if(res)
                            {
                                $("#city").empty();
                                $.each(res,function(key,value){
                                    $("#city").append('<option value="'+key+'">'+value+'</option>');
                                });
                            }
                        }

                    });
                }
            });
        </script>
    </div>

    @include('errors')

@endsection
