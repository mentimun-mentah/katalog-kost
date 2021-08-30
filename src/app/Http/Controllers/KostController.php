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
          'images' => 'required',
          'images.*' => 'mimes:jpg,jpeg,png|max:2000',
          'name' => 'required|string|min:3|max:255',
          'category' => 'required|string|in:laki-laki,perempuan,umum',
          'total_rooms' => 'required|integer|min:1',
          'price_day' => 'nullable|integer|min:1',
          'price_month' => 'nullable|integer|min:1',
          'price_year' => 'nullable|integer|min:1',
          'facilities' => 'required|string|min:1',
          'lat' => ['required','regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
          'lng' => ['required','regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
          'address' => 'required|string|min:6',
          'desc' => 'required|string|min:5',
      ]);

      $imgData = array();

      # save image to storage
      if($request->hasfile('images')) {
        foreach($request->file('images') as $file){
          $name = Str::random(20).'.'.$file->getClientOriginalExtension();
          $file->move(public_path('storage/kosts/'),$name);
          $imgData[] = $name;  
        }
      }

      Kost::create([
        'image' => implode(",",$imgData),
        'name' => $request->name,
        'slug' => Str::slug($request->name,'-'),
        'category' => $request->category,
        'total_rooms' => $request->total_rooms,
        'price_day' => $request->price_day,
        'price_month' => $request->price_month,
        'price_year' => $request->price_year,
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
        'images' => 'nullable',
        'images.*' => 'mimes:jpg,jpeg,png|max:2000',
        'delete_image' => 'nullable',
        'name' => 'required|string|min:3|max:255',
        'category' => 'required|string|in:laki-laki,perempuan,umum',
        'total_rooms' => 'required|integer|min:1',
        'price_day' => 'nullable|integer|min:1',
        'price_month' => 'nullable|integer|min:1',
        'price_year' => 'nullable|integer|min:1',
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
      $kost->price_day = $request->price_day;
      $kost->price_month = $request->price_month;
      $kost->price_year = $request->price_year;
      $kost->facilities = $request->facilities;
      $kost->lat = $request->lat;
      $kost->lng = $request->lng;
      $kost->address = $request->address;
      $kost->desc = $request->desc;
      $kost->save();

      # update image
      if($request->has('delete_image')){
        foreach($request->delete_image as $file){
          $imagePath = public_path('storage/kosts/'.$file);
          if(file_exists($imagePath)){
            unlink($imagePath);
          }
        }
      }

      # save image to storage
      if($request->hasfile('images')) {

        $imgData = array();

        foreach($request->file('images') as $file){
          $name = Str::random(20).'.'.$file->getClientOriginalExtension();
          $file->move(public_path('storage/kosts/'),$name);
          $imgData[] = $name;  
        }

        foreach(explode(",",$kost->image) as $img){
          if($request->has('delete_image')){
            if(in_array($img,$request->delete_image) == false){
              $imgData[] = $img;
              continue;
            }
          }else{
            $imgData[] = $img;
          }
        }

        $kost->image = implode(",",$imgData);
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
