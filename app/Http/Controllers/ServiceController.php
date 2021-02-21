<?php

namespace App\Http\Controllers;

use App\Company;
use App\Service;
use App\Specialization;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use File;
use Gate;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    public function _construct()
    {
        $this->middleware('auth', ['except' => ['index', 'showFull']]);
    }

    public function index(Request $request)
    {

        $services = DB::table('services')
            ->join('specializations', 'services.specialization_id', '=', 'specializations.id')
            ->join('companies', 'services.company_id', '=', 'companies.id')
            ->leftJoin('reviews', 'services.id', '=', 'reviews.service_id')
            ->select('services.id', 'services.first_name', 'services.last_name', 'services.gender',
                'specializations.specialization_name', 'companies.company_name', 'services.city', 'services.img',
                DB::raw('ROUND(AVG(reviews.stars)) as stars'), DB::raw('COUNT(reviews.stars) as number'))
            ->groupBy('services.id',  'specializations.specialization_name', 'companies.company_name')
            ->orderBy('services.created_at', 'DESC')
            ->paginate(5);

        $genders = [
            'male',
            'female',
            'prefer not to say'
        ];

        $specializations = Specialization::all();
        $companies = Company::all();
//        $ratings = DB::table('services')
//            ->leftJoin('reviews', 'services.id', '=', 'reviews.service_id')
//            ->select('services.id', DB::raw('AVG(reviews.stars) as stars'))
//            ->groupBy('services.id')
//            ->get();
        $cities = DB::table('services')->select('services.city')
            ->distinct()->get();

        return view('pages/home', compact('services', 'specializations', 'companies', 'genders', 'cities'));
    }

    public function addService()
    {

        $users = User::all();
        $specializations = Specialization::all();
        $companies = Company::all();
        $genders = [
            'male',
            'female',
            'prefer not to say'
        ];

        return view('pages/add-service', compact('users', 'specializations', 'companies', 'genders'));
    }

    public function addToDatabase(Request $request)
    {

        $validateData = $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'gender' => 'required',
            'specialization' => 'required',
            'company' => 'required',
            'description' => 'required|max:255',
            'city' => 'required',
            'img' => 'mimes:jpeg, jpg, png, gif|max:10000'
        ]);

        if (request()->hasFile('img')) {
            //cia path pasiima nuotrauka is input field su name img ir nurodom kur ja saugosim
            $path = $request->file('img')->store('public/image');
            $filename = str_replace('public/', "", $path);

            Service::create([
                'user_id' => Auth::id(),
                'first_name' => request('name'),
                'last_name' => request('surname'),
                'gender' => request('gender'),
                'specialization_id' => request('specialization'),
                'company_id' => request('company'),
                'description' => request('description'),
                'city' => request('city'),
                'img' => $filename

            ]);

        } else {
            Service::create([
                'user_id' => Auth::id(),
                'first_name' => request('name'),
                'last_name' => request('surname'),
                'gender' => request('gender'),
                'specialization_id' => request('specialization'),
                'company_id' => request('company'),
                'description' => request('description'),
                'city' => request('city'),
            ]);

        }

        return redirect('/')->with(['message' => 'The add is added!', 'alert' => 'alert-success']);

    }

    public function delete(Service $service)
    {

        if (Gate::allows('delete', $service)) {

            $service->delete();

            return redirect('/');
        }
        return redirect()->back()->with(['message' => 'You can delete only your adds!', 'alert' => 'alert-danger']);


    }

    public function edit(Service $service)
    {

        if (Gate::allows('update', $service)) {

            $users = User::all();
            $specializations = Specialization::all();
            $companies = Company::all();
            $genders = [
                'male',
                'female',
                'prefer not to say'
            ];

            $services = DB::table('services')
                ->join('specializations', 'services.specialization_id', '=', 'specializations.id')
                ->join('companies', 'services.company_id', '=', 'companies.id')
                ->join('users', 'services.user_id', '=', 'users.id')
                ->select('services.id', 'services.first_name', 'services.last_name', 'services.description',
                    'services.gender', 'users.name', 'services.company_id',
                    'specializations.specialization_name', 'services.specialization_id',
                    'companies.company_name', 'services.city', 'services.img')
                ->where('services.id', $service->id)
                ->get();


            return view('pages/edit-service', compact('services', 'genders', 'companies', 'specializations', 'users'));
        }
        return redirect()->back()->with(['message' => 'You can update only your adds!', 'alert' => 'alert-danger']);
    }

    public function storeUpdate(Request $request, Service $service)
    {

        if ($request->file()) {
            File::delete(storage_path('app/public/' . $service->img));
            $path = $request->file('img')->store('public/image');
            $filename = str_replace('public/', '', $path);
            Service::where('services.id', $service->id)->update(['img' => $filename]);
        }

        Service::where('services.id', $service->id)->update($request->only(['first_name', 'last_name', 'gender', 'city',
            'specialization_id', 'company_id', 'description']));

        return redirect('/service/' . $service->id);
    }

    public function showFull(Service $service)
    {

        $services = DB::table('services')
            ->join('specializations', 'services.specialization_id', '=', 'specializations.id')
            ->join('companies', 'services.company_id', '=', 'companies.id')
            ->join('users', 'services.user_id', '=', 'users.id')
            ->select('services.id', 'services.first_name', 'services.last_name', 'services.description',
                'services.gender', 'users.name', 'services.company_id',
                'specializations.specialization_name', 'services.specialization_id',
                'companies.company_name', 'services.city', 'services.img')
            ->where('services.id', $service->id)
            ->get();

        $comments = DB::table('services')
            ->join('reviews', 'services.id', '=', 'reviews.service_id')
            ->select('reviews.comment', 'reviews.user_name')
            ->where('services.id', $service->id)
            ->get();

        $ratings = DB::table('services')
            ->join('reviews', 'services.id', '=', 'reviews.service_id')
            ->select('reviews.stars')
            ->where('services.id', $service->id)
            ->avg('reviews.stars');

        return view('pages/full-add', compact('services', 'comments', 'ratings'));
    }

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
            ->groupBy('services.id', 'specializations.specialization_name', 'companies.company_name', 'reviews.stars')
        ->count();

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
