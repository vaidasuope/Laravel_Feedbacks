@extends('main')

@section('content')

    <div class="container">

        <form action='/search' method="get" enctype="multipart/form-data"
              class="searchBox mb-2 row pt-3 pl-2 d-flex justify-content-center align-items-center">
            {{--        {{csrf_field()}}--}}
            <div class="form-group col-lg-2 col-4">
                <input type="text" class="form-control" name="search" id="search" placeholder="Search...">
            </div>
            <div class="form-group col-lg col-4">
                <select class="form-control" id="spec" name="specialization_name">
                    <option value="" selected disabled>Specialization</option>
                    @foreach($specializations as $specialization)
                        <option
                            value="{{$specialization->specialization_name}}">{{ucfirst($specialization->specialization_name)}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-lg col-4">
                <select class="form-control" id="comp" name="comp">
                    <option value="" selected disabled>Company</option>
                    @foreach($companies as $company)
                        <option value="{{$company->company_name}}">{{$company->company_name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-lg col-4">
                <select class="form-control" id="city" name="city">
                    <option value="" selected disabled>City</option>
                    @foreach($cities as $city)
                        <option value="{{$city->city}}">{{$city->city}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-lg col-4">
                <select class="form-control" id="gender" name="gender">
                    <option value="" selected disabled>Gender</option>
                    @foreach($genders as $gender)
                        <option value="{{$gender}}">{{$gender}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-lg col-4">
                <select class="form-control" id="raiting" name="raiting">
                    <option value="" selected disabled>Raiting</option>
                    <option value="1" class="text-dark">&bigstar;</option>
                    <option value="2" class="text-dark">&bigstar;&bigstar;</option>
                    <option value="3" class="text-dark">&bigstar;&bigstar;&bigstar;</option>
                    <option value="4" class="text-dark">&bigstar;&bigstar;&bigstar;&bigstar;</option>
                    <option value="5" class="text-dark">&bigstar;&bigstar;&bigstar;&bigstar;&bigstar;</option>
                </select>
            </div>
            <div class="form-group col-lg col ml-3">
                <button type="submit" class="btn btn-dark">Submit</button>
            </div>
        </form>

        @forelse($services as $service)
            <div class="row justify-content-center">
                <div class="col-md-10 m-2 background">
                    <div class="row d-flex align-items-center">
                        <div class="col-md-3 col-6 d-flex justify-content-center">
                            @if($service->img)
                                <img src="{{$service->img}}" class="p-3 img">
                            @else
                                <img src="https://banffventureforum.com/wp-content/uploads/2019/08/no-photo-icon-22.png" class="p-3 img">
                            @endif
                        </div>
                        <div class="col-md-4 col-5 ml-2 p-3">
                            <p class="row font-weight-bold">{{ucfirst($service->first_name)}} {{ucfirst($service->last_name)}}</p>
                            <p class="row">{{ucfirst($service->specialization_name)}}</p>
                            <p class="row">{{ucfirst($service->company_name)}}</p>
                            <p class="row">{{ucfirst($service->city)}}</p>
                        </div>
                        <div class="col-md col-12">
                            <div class="average-star-rating d-flex align-items-center pl-3"
                                 style="--rating:{{round($service->stars,1)}};">
                                <span class="textSize">({{$service->number}})</span></div>
                            <a href="/service/{{$service->id}}" class="btn-light float-right p-1 rounded">Read
                                reviews</a>
                        </div>
                    </div>
                </div>
            </div>

        @empty
            <div class="row justify-content-center">
                <div class="col-md-10 m-2 background">
                    <h3 class="text-center p-5">No results found</h3>
                </div>
            </div>

        @endforelse
        <div class="float-right">
            {{$services->appends(request()->input())->links()}}
        </div>
    </div>
@endsection
