<?php

namespace App\Http\Controllers;

use App\Models\Kost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
  
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function detailKost($slug,$user_id)
    {
      $kost = Kost::with('user')->where('slug',$slug)->where('user_id',$user_id)->firstOrFail();

      return view('detailkost',['kost' => $kost]);
    }

    public function listKos(Request $request)
    {
      return view('listkos', ['query' => json_encode(array("q" => $request->q))]);
    }

    public function listKosMap(Request $request)
    {
      $query = DB::table('kosts');

      if($request->q) $query->where('kosts.address','like','%'.$request->q.'%');
      if($request->category) $query->where('kosts.category','=',$request->category);

      $results = $query->select('kosts.*')
        ->selectRaw('( 6371 * acos( cos( radians(?) ) *
                   cos( radians( lat ) )
                   * cos( radians( lng ) - radians(?)
                   ) + sin( radians(?) ) *
                   sin( radians( lat ) ) )
                 ) AS distance', [$request->lat, $request->lng, $request->lat])
        ->havingRaw("distance < ?", [$request->radius])
        ->orderBy('distance','asc')
        ->get();

      foreach($results as $data){
        $score = DB::table('ratings')
          ->where('ratings.kost_id','=',$data->id)
          ->selectRaw('(SUM(ratings.rating) * 5) / (COUNT(ratings.id) * 5) as score_value')
          ->get();

        $data->score = $score[0]->score_value;
      }
              
      return $results;
    }

    public function allKosts(Request $request)
    {
      $query = DB::table('kosts');

      if($request->order_by) {
        $order_by = $request->order_by;
        if($order_by == 'newest') $query->orderBy('id','desc');
        if($order_by == 'oldest') $query->orderBy('id','asc');
        if($order_by == 'random') $query->inRandomOrder();
      }  

      $results = $query->take($request->limit ? $request->limit : 3)->get();

      foreach($results as $data){
        $score = DB::table('ratings')
          ->where('ratings.kost_id','=',$data->id)
          ->selectRaw('(SUM(ratings.rating) * 5) / (COUNT(ratings.id) * 5) as score_value')
          ->get();

        $data->score = $score[0]->score_value;
      }

      return $results;
    }
}
