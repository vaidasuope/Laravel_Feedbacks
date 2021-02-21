<?php

namespace App\Http\Controllers;

use App\Company;
use App\Specialization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        //Formos option laukams uzpildyti

        $specializations = Specialization::all();
        $companies = Company::all();
//        $ratings = DB::table('services')
//            ->leftJoin('reviews', 'services.id', '=', 'reviews.service_id')
//            ->select('services.id', DB::raw('ROUND(AVG(reviews.stars)) as stars'))
//            ->groupBy('services.id')
//            ->get();
        $cities = DB::table('services')->select('services.city')
            ->distinct()->get();
        $genders = [
            'male',
            'female',
            'prefer not to say'
        ];

        $services = DB::table('services')
            ->join('specializations', 'services.specialization_id', '=', 'specializations.id')
            ->join('companies', 'services.company_id', '=', 'companies.id')
            ->leftJoin('reviews', 'services.id', '=', 'reviews.service_id')
            ->select('services.id', 'services.gender', 'services.first_name', 'services.last_name',
                'specializations.specialization_name', 'companies.company_name', 'services.city', 'services.img',
                DB::raw('ROUND(AVG(reviews.stars)) as stars'), DB::raw('COUNT(reviews.stars) as number'))
            ->groupBy('services.id','specializations.specialization_name','companies.company_name','reviews.stars' );


        if ($request->filled('specialization_name')) {
            $services->where('specialization_name', $request->specialization_name);
        }
        if ($request->filled('city')) {
            $services->where('city', $request->city);
        }
        if ($request->filled('comp')) {
            $services->where('company_name', $request->comp);
        }
        if ($request->filled('raiting')) {
            $services->having('stars', $request->raiting);
        }
        if ($request->filled('gender')) {
            $services->where('gender', $request->gender);
        }
        if ($request->filled('search')) {
            $services->where('first_name', 'LIKE', '%' . $request->search . '%')
                ->orWhere('last_name','LIKE', '%' . $request->search . '%')
                ->orWhere('specialization_name','LIKE', '%' . $request->search . '%')
                ->orWhere('city','LIKE', '%' . $request->search . '%')
                ->orWhere('company_name','LIKE', '%' . $request->search . '%');
        }

        return view('pages/search', ['services' => $services->paginate(3)], compact('specializations', 'companies',
            'genders', 'cities'));
    }
}
