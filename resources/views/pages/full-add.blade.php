@extends('main')

@section('content')
    @foreach($services as $service)
        <div class="row justify-content-center">

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


            <div class="col-md-10 m-2 background">

                @if(Auth::check())
                    <div class="row float-right mt-1">
                        <a onclick="return confirm('Are you really want to delete it?')"
                           class="mr-2" href="/delete/{{$service->id}}">Delete</a>
                        <a class="mr-2" href="/edit/{{$service->id}}">Edit</a>
                    </div>
                @endif

                <div class="row mt-5 ml-2">
                    <div class="average-star-rating" style="--rating:{{round($ratings,1)}};">
                        <span class="textSize">{{round($ratings,1)}}</span></div>
                </div>

                <div class="row">
                    <div class="col-md-3 d-flex justify-content-center">
                        @if($service->img)
                        <img src="/{{$service->img}}" style="height: 160px" class="p-3">
                        @else
                            <img src="https://banffventureforum.com/wp-content/uploads/2019/08/no-photo-icon-22.png" style="height: 160px" class="p-3">
                        @endif
                    </div>
                    <div class="col-md ml-2 p-3 mt-3 ml-4">
                        <p class="font-weight-bold">{{ucfirst($service->first_name)}} {{ucfirst($service->last_name)}}</p>
                        {{--                        <p class="font-weight-bold">{{ucfirst($service->last_name)}}</p>--}}
                        <div class="row">
                            <p class="mt-2 col-md-12">{{ucfirst($service->specialization_name)}}</p>
                            <p class="mt-2 col-md-12">{{$service->company_name}}</p>
                            <p class="mt-2 col-md-12">{{$service->city}}</p>
                        </div>
                    </div>
                    <div class="col-md-7 p-3 mt-3">
                        <h6 class="font-weight-bold">About me:</h6>
                        <p class="textAbout">{{$service->description}}</p>
                    </div>
                </div>
                <hr/>
                <div class="col-md-12">
                    <h3 class="text-center mb-3 font-weight-bold">Customer reviews:</h3>
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            @foreach($comments as $comment)
                                @if($comment->comment!==null && $comment->user_name!==null)
                                    <p class="font-weight-bold">{{$comment->user_name}}:</p>
                                    <p>{{$comment->comment}}</p>
                                @elseif($comment->comment!==null)
                                    <p class="font-weight-bold">Anonymous:</p>
                                    <p>{{$comment->comment}}</p>
                                    <hr/>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <hr/>

                <form action="/addComment" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}

                    <h3 class="font-weight-bold text-center">Leave your review:</h3>

                    <div class="d-flex justify-content-center">
                        <div class="form-group wrapper">
                            <input class="input" type="text" name="service_id" value="{{$service->id}}" hidden>
                            <input class="input" type="radio" id="r1" name="stars" value="5">
                            <label for="r1">&#10038;</label>
                            <input class="input" type="radio" id="r2" name="stars" value="4">
                            <label for="r2">&#10038;</label>
                            <input class="input" type="radio" id="r3" name="stars" value="3">
                            <label for="r3">&#10038;</label>
                            <input class="input" type="radio" id="r4" name="stars" value="2">
                            <label for="r4">&#10038;</label>
                            <input class="input" type="radio" id="r5" name="stars" value="1">
                            <label for="r5">&#10038;</label>
                        </div>
                    </div>
                    <div class="row">
                        <input type="text justify-content-center" name="service_id" value="{{$service->id}}" hidden>
                        <div class="form-group col-md-12 d-flex justify-content-center ">
                            <input type="text" name="user_name" id="user_name" placeholder="Enter your name"
                                   style="border: none">
                        </div>
                        <div class="form-group col-md-12 d-flex justify-content-center">
                            <textarea type="text" class="form-control col-md-5" id="comment" name="comment"
                                      placeholder="Leave your comment here..."></textarea>

                        </div>
                        <div class="form-group d-flex justify-content-center col-md-12">
                            <button type="submit" name="submit" class="btn btn-dark rounded col-md-3">Add</button>
                        </div>
                    </div>
                </form>
            </div>
    @endforeach
@endsection
