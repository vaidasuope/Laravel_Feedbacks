@extends('main')

@section('content')

    <div class="contentBox">

        <div class="pt-5">
            <div class="row justify-content-center text-dark font-weight-bold mb-2">
                <h2 class="font-weight-bold">Edit provided data</h2>
            </div>

            @include('_partials/errors')

            <div class="row justify-content-center">
                @foreach($services as $service)
                <form action="/storeUpdate/{{$service->id}}" method="post" enctype="multipart/form-data"
                      class="text-dark font-weight-bold col-md-10">
                    {{csrf_field()}}
                    <div class="form-group row">
                        <div class="form-group col-md">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" name="first_name" id="name" value="{{$service->first_name}}" placeholder="First name">
                        </div>
                        <div class="form-group col-md">
                            <label for="surname">Surname:</label>
                            <input type="text" class="form-control" name="last_name" id="surname" value="{{$service->last_name}}"  placeholder="Last name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="form-group col-md">
                            <label for="user">Gender:</label>

                            <select class="form-control" id="gender" name="gender">
                                <option value="{{$service->gender}}" selected>{{$service->gender}}</option>
                                @foreach($genders as $gender)
                                    @if($gender!==$service->gender)
                                    <option value={{$gender}}>{{$gender}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md">
                            <label for="city">City:</label>
                            <input type="text" class="form-control" name="city" id="city" value="{{$service->city}}"  placeholder="City">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="form-group col-md">
                            <label for="user">Specialization:</label>
                            <p class="smallText">Couldn't find needed specialization? <a href="/add-spec">Click here</a></p>
                            <select class="form-control" id="specialization" name="specialization_id">
                                <option value="{{$service->specialization_id}}"  selected>{{$service->specialization_name}}</option>
                                @foreach($specializations as $specialization)
                                    @if($specialization->specialization_name!==$service->specialization_name)
                                    <option
                                        value={{$specialization->id}}>{{$specialization->specialization_name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md">
                            <label for="company">Company:</label>
                            <p class="smallText">Couldn't find needed company name? <a href="/add-company">Click here</a></p>
                            <select class="form-control" id="company" name="company_id">
                                <option value="{{$service->company_id}}" selected>{{$service->company_name}}</option>
                                @foreach($companies as $company)
                                    @if($company->company_name!==$service->company_name)
                                    <option value={{$company->id}}>{{$company->company_name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea type="text" class="form-control" id="description" name="description">{{$service->description}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="upload">Add an image:</label>
                        <input type="file" class="form-control" id="img" name="img">
                    </div>
                    <div class="form-group">
                        <label for="user">Created by:</label>
                        <select class="form-control" id="user" name="user">
                            <option value="{{$service->name}}"selected disabled>{{$service->name}}</option>
                            @foreach($users as $user)
                                <option value={{$user->id}}>{{$user->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group d-flex justify-content-center m-5">
                        <button type="submit" name="submit" class="btn btn-dark rounded">Publish</button>
                        <a href="/" class="btn btn-dark rounded ml-3">Cancel</a>
                    </div>
                </form>
                @endforeach
            </div>
        </div>
    </div>

@endsection
