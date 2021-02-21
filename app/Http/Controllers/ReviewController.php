<?php

namespace App\Http\Controllers;

use App\Review;
use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use function GuzzleHttp\default_user_agent;

class ReviewController extends Controller
{
    public function addCommentToDatabase(Request $request){

//        $validateData = $request->validate([
//            'user_name' => 'required',
//        ]);

            Review::create([
                'service_id' => request('service_id'),
                'user_name'=>request('user_name'),
                'stars' => request('stars'),
                'comment' => request('comment')
            ]);

        return redirect()->back()->with(['message' => 'Your comment is added!', 'alert' => 'alert-success']);
    }
}
