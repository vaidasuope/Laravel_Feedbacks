<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addCompany(){

        return view('pages/add-company');
    }

    public function addToDatabaseCompany(Request $request){

        $validateData = $request->validate([
            'spec' => 'required|unique:companies,company_name',
        ]);

        Company::create([
            'company_name'=>request('spec')
        ]);

        return redirect('/add-service')->with(['message' => 'Company has been created successfully!', 'alert' => 'alert-success']);

//        return redirect('/add-service');

    }
}
