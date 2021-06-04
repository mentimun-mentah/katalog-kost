<?php

namespace App\Http\Controllers;

use App\Models\Kost;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class KostController extends Controller
{
    public function add_kost()
    {
        return view('kosts.add_kost');
    }

    public function my_kost()
    {
      return view('kosts.my_kost');
    }

    public function changeMyKost($id)
    {
      $kost = Kost::where('id',$id)->where('user_id',Auth::user()->id)->firstOrFail();
      return view('kosts.change_kost', ['kost' => $kost]);
    }

    public function createKost(Request $request)
    {
     $request->validate([
        'image' => 'required|mimes:jpg,jpeg,png|max:2000',
        'name' => 'required|string|min:3|max:255',
        'category' => 'required|string|in:mahasiswa,umum',
        'total_rooms' => 'required|integer|min:1',
        'price' => 'required|integer|min:1',
        'facilities' => 'required|string|min:1',
        'lat' => ['required','regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
        'lng' => ['required','regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
        'address' => 'required|string|min:6',
        'desc' => 'required|string|min:5',
     ]);

      # save image to storage
      $photoName = Str::random(20).'.'.$request->image->getClientOriginalExtension();
      $request->image->move(public_path('storage/kosts/'),$photoName);

      Kost::create([
        'image' => $photoName,
        'name' => $request->name,
        'slug' => Str::slug($request->name,'-'),
        'category' => $request->category,
        'total_rooms' => $request->total_rooms,
        'price' => $request->price,
        'facilities' => $request->facilities,
        'lat' => $request->lat,
        'lng' => $request->lng,
        'address' => $request->address,
        'desc' => $request->desc,
        'user_id' => Auth::user()->id
      ]);

      return ['status' => 'Success create kost'];
    }

    public function getMyKost(Request $request)
    {
      $query = Kost::query();
      $query->where('user_id',Auth::user()->id);

      if($request->q) $query->where('name','like','%'.$request->q.'%');
      if($request->category) $query->where('category',$request->category);

      $results = $query->paginate(6);

      foreach($results as $data){
        $score = DB::table('ratings')
          ->where('ratings.kost_id','=',$data->id)
          ->selectRaw('(SUM(ratings.rating) * 5) / (COUNT(ratings.id) * 5) as score_value')
          ->get();

        $data->score = $score[0]->score_value;
      }

      return $results;
    }

    public function getTotalKost()
    {
      return Kost::count(); 
    }

    public function updateKost(Request $request)
    {
      $kost = Kost::findOrFail($request->id);

      $request->validate([
        'image' => 'nullable|mimes:jpg,jpeg,png|max:2000',
        'name' => 'required|string|min:3|max:255',
        'category' => 'required|string|in:mahasiswa,umum',
        'total_rooms' => 'required|integer|min:1',
        'price' => 'required|integer|min:1',
        'facilities' => 'required|string|min:1',
        'lat' => ['required','regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
        'lng' => ['required','regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
        'address' => 'required|string|min:6',
        'desc' => 'required|string|min:5',
      ]);

      $kost->name = $request->name;
      $kost->slug = Str::slug($request->name,'-');
      $kost->category = $request->category;
      $kost->total_rooms = $request->total_rooms;
      $kost->price = $request->price;
      $kost->facilities = $request->facilities;
      $kost->lat = $request->lat;
      $kost->lng = $request->lng;
      $kost->address = $request->address;
      $kost->desc = $request->desc;
      $kost->save();

      # update image
      $imagePath = public_path('storage/kosts/'.$kost->image);
      if($request->image && file_exists($imagePath)){
          unlink($imagePath);
          # save image to storage
          $photoName = Str::random(20).'.'.$request->image->getClientOriginalExtension();
          $request->image->move(public_path('storage/kosts/'),$photoName);
          $kost->image = $photoName;
          $kost->save();
      }

      toast('Success update kost','success');
      return ['status' => 'Success update kost'];
    }

    public function deleteKost($id)
    {
      $kost = Kost::where('id',$id)->where('user_id',Auth::user()->id)->firstOrFail();

      # delete image
      $imagePath = public_path('storage/kosts/'.$kost->image);
      if(file_exists($imagePath)) unlink($imagePath); 

      $kost->delete();

      return ['status' => 'Success delete kost'];
    }

}
