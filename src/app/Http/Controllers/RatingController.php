<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RatingController extends Controller
{
    public function createRating(Request $request)
    {

        $rating = Rating::where('user_id',Auth::user()->id)->where('kost_id',$request->kost_id)->first();
        if($rating) return response()->json(['errors' => ['review' => ['Tidak bisa menambahkan rating lagi :)']]],422);

        $request->validate([
          'rating' => 'required|integer|min:1|max:5',
          'review' => 'required|string|min:5',
          'kost_id' => 'required|exists:kosts,id'
        ]);

        Rating::create([
          'rating' => $request->rating,
          'review' => $request->review,
          'user_id' => Auth::user()->id,
          'kost_id' => $request->kost_id
        ]);

        return ['status' => 'Success add rating'];
    }

    public function getRating(Request $request, $kost_id)
    {
        $results = DB::table('ratings')
          ->join('users','users.id','=','ratings.user_id')
          ->where('ratings.kost_id','=',$kost_id)
          ->orderBy('ratings.id','desc')
          ->select(
            'ratings.id as ratings_id', 'ratings.rating as ratings_rating', 'ratings.review as ratings_review',
            'ratings.kost_id as ratings_kost_id', 'ratings.created_at as ratings_created_at', 'ratings.updated_at as ratings_updated_at',
            'users.name as users_name', 'users.avatar as users_avatar'
          )
          ->paginate(5);

        return $results;
    }

    public function getTotalRating($kost_id)
    {

      $total = DB::table('ratings')
        ->where('ratings.kost_id','=',$kost_id)
        ->select(
          DB::raw('(SUM(ratings.rating) * 5) / (COUNT(ratings.id) * 5) as score_value'),
          DB::raw('COUNT(ratings.id) as score_count')
        )
        ->get();

      $five = DB::table('ratings')
        ->where('ratings.kost_id','=',$kost_id)
        ->where('ratings.rating','=',5)
        ->select(
          DB::raw('COUNT(ratings.id) as score_five_count')
        )
        ->get();

      $four = DB::table('ratings')
        ->where('ratings.kost_id','=',$kost_id)
        ->where('ratings.rating','=',4)
        ->select(
          DB::raw('COUNT(ratings.id) as score_four_count')
        )
        ->get();

      $three = DB::table('ratings')
        ->where('ratings.kost_id','=',$kost_id)
        ->where('ratings.rating','=',3)
        ->select(
          DB::raw('COUNT(ratings.id) as score_three_count')
        )
        ->get();

      $two = DB::table('ratings')
        ->where('ratings.kost_id','=',$kost_id)
        ->where('ratings.rating','=',2)
        ->select(
          DB::raw('COUNT(ratings.id) as score_two_count')
        )
        ->get();

      $one = DB::table('ratings')
        ->where('ratings.kost_id','=',$kost_id)
        ->where('ratings.rating','=',1)
        ->select(
          DB::raw('COUNT(ratings.id) as score_one_count')
        )
        ->get();

      $total[0]->score_five_count = $five[0]->score_five_count;
      $total[0]->score_four_count = $four[0]->score_four_count;
      $total[0]->score_three_count = $three[0]->score_three_count;
      $total[0]->score_two_count = $two[0]->score_two_count;
      $total[0]->score_one_count = $one[0]->score_one_count;

      return $total;
      
    }
}
