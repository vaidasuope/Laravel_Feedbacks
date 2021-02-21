@extends('main')

@section('content')

    <div class="contentBox">

    <div class="pt-5">
        <div class="row justify-content-center text-dark font-weight-bold mb-2">
            <h2 class="font-weight-bold">What company do you want to add?</h2>
        </div>

        @include('_partials/errors')

        <div class="row justify-content-center">
            <form action="/saveComp" method="post" enctype="multipart/form-data"
                  class="text-dark font-weight-bold col-md-10">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="title">Name:</label>
                    <input type="text" class="form-control" name="spec" id="spec" placeholder="Name of the company">
                </div>
                <div class="form-group d-flex justify-content-center m-5">
                    <button type="submit" name="submit" class="btn btn-dark rounded">Submit</button>
                    <a href="/add-service" class="btn btn-dark rounded ml-3">Cancel</a>
                </div>
            </form>
        </div>
    </div>
    </div>

@endsection
