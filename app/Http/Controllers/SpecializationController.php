<?php

namespace App\Http\Controllers;

use App\Specialization;
use Illuminate\Http\Request;


class SpecializationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addSpec(){

        return view('pages/add-spec');
    }

    public function addToDatabaseSpecialization(Request $request){

        $validateData = $request->validate([
            'title' => 'required|unique:specializations,specialization_name',
        ]);

        Specialization::create([
            'specialization_name'=>request('title')
        ]);

        return redirect('/add-service')->with(['message' => 'Specialization has been created successfully!', 'alert' => 'alert-success']);

//        return redirect('/add-service');

    }
}
