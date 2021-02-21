@extends('main')

@section('content')

    <div class="contentBox">

        <div class="pt-5">
            <div class="row justify-content-center text-dark font-weight-bold mb-2">
                <h2 class="font-weight-bold">What service do you provide?</h2>
            </div>

            @include('_partials/errors')

            <div class="row d-flex justify-content-center">
                <div class="col-md-12">
                    @if(session()->has('message'))
                        <div class="alert {{session('alert') ?? 'alert-info'}}">
                            {{ session('message') }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="row justify-content-center">
                <form action="/store" method="post" enctype="multipart/form-data"
                      class="text-dark font-weight-bold col-md-10">
                    {{csrf_field()}}
                    <div class="form-group row">
                        <div class="form-group col-md">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="First name">
                        </div>
                        <div class="form-group col-md">
                            <label for="surname">Surname:</label>
                            <input type="text" class="form-control" name="surname" id="surname" placeholder="Last name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="form-group col-md">
                            <label for="user">Gender:</label>

                            <select class="form-control" id="gender" name="gender">
                                <option value="" selected disabled>--Chose gender--</option>
                                @foreach($genders as $gender)
                                    <option value={{$gender}}>{{$gender}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md">
                            <label for="city">City:</label>
                            <input type="text" class="form-control" name="city" id="city" placeholder="City">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="form-group col-md">
                            <label for="user">Specialization:</label>
                            <p class="smallText">Couldn't find needed specialization? <a href="/add-spec">Click here</a>
                            </p>
                            <select class="form-control" id="specialization" name="specialization">
                                <option value="" selected disabled>--Chose your work field--</option>
                                @foreach($specializations as $specialization)
                                    <option
                                        value={{$specialization->id}}>{{ucfirst($specialization->specialization_name)}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md">
                            <label for="company">Company:</label>
                            <p class="smallText">Couldn't find needed company name? <a href="/add-company">Click
                                    here</a></p>
                            <select class="form-control" id="company" name="company">
                                <option value="" selected disabled>--Chose your company--</option>
                                @foreach($companies as $company)
                                    <option value={{$company->id}}>{{$company->company_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea type="text" class="form-control" id="description" name="description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="upload">Add an image:</label>
                        <input type="file" class="form-control" id="img" name="img">
                    </div>
                    {{--                    <div class="form-group">--}}
                    {{--                        <label for="user">Created by:</label>--}}
                    {{--                        <select class="form-control" id="user" name="user">--}}
                    {{--                            <option value="" selected disabled>--Chose your user name--</option>--}}
                    {{--                            @foreach($users as $user)--}}
                    {{--                                <option value={{$user->id}}>{{$user->name}}</option>--}}
                    {{--                            @endforeach--}}
                    {{--                        </select>--}}
                    {{--                    </div>--}}
                    <div class="form-group d-flex justify-content-center m-5">
                        <button type="submit" name="submit" class="btn btn-dark rounded">Publish</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
