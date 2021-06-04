<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Jobs\SendEmailAcceptOwner;
use App\Jobs\SendEmailRejectOwner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function ownerConfirmation()
    {
      return view('admin.kost.owner_confirmation');
    }

    public function manageOwner()
    {
      return view('admin.kost.manage_owner');
    }

    public function allUsers(Request $request)
    {

      $query = User::query();

      $query->where('role','owner');

      if($request->status == 'true') $query->where('status',1);
      if($request->status == 'false') $query->where('status',0);

      $results = $query->paginate(12);

      return $results;
    }

    public function acceptUser(Request $request, $id)
    {
      $user = User::findOrFail($id);
      # make user active
      $user->status = 1;
      $user->save();

      SendEmailAcceptOwner::dispatch($user);
      return ['status' => 'Success accept user'];
    }

    public function rejectUser($id)
    {
      $user = User::findOrFail($id);

      SendEmailRejectOwner::dispatch($user);
      sleep(2);

      $user->delete();
      return ['status' => 'Success reject user'];
    }

    public function deleteUser($id)
    {
      $user = User::findOrFail($id);
      $user->delete();

      return ['status' => 'Success delete user'];
    }

}
