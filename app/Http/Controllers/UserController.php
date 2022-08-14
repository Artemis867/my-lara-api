<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserInfoModel;
use App\Models\User;
use Illuminate\Support\Str;

class UserController extends Controller
{
  //
  public function __construct() {
  }


  public function generateToken(Request $request) {
    $reqData = $request->all();
    $user = User::where('uuid', $request->uuid)->first();

    $token = $user->createToken($user->uuid)->plainTextToken;
    $response = (object) [
      "status" => "success",
      "message" => "token generated",
      "token" => $token,
    ];

    return response(json_encode($response), 200)
    ->header('Content-type', 'application/json');
  }

  public function fetchUserList() {
    $arrUserList = [];
    foreach(User::all() as $userInfo) {
      array_push($arrUserList, [
        "uuid" => $userInfo->uuid,
        "first_name" => $userInfo->first_name,
        "last_name" => $userInfo->last_name
      ]);
    }

    $response = (object) [
      "status" => "success",
      "message" => "user personal info",
      "data" => $arrUserList
    ];
    
    return response(json_encode($response), 200)
    ->header('Content-type', 'application/json');
  }

  public function addUser(Request $request) {

    $reqData = (object) $request->all();
    $user = new User;
    $user->uuid = Str::uuid();
    $user->first_name = $reqData->first_name;

    if (isset($reqData->middle_name)) {
      $user->middle_name = $reqData->middle_name;
    }

    $user->last_name = $reqData->last_name;
    $user->email = $reqData->email;
    $user->password = $reqData->password;

    $user->save();

    $response = (object) [
      "status" => "success",
      "message" => "User added successfully",
      "email" => $reqData->email,
    ];
  
    return response(json_encode($response), 200)
    ->header('Content-type', 'application/json');
  }

  public function modifyUser(Request $request, $uuid) {
    $reqData = (object) $request->all();
    $user = User::where('uuid', $uuid)->first();

    if(isset($reqData->first_name)) {
      $user->first_name = $reqData->first_name;
    }
    if(isset($reqData->middle_name)) {
      $user->middle_name = $reqData->middle_name;
    }
    if(isset($reqData->last_name)) {
      $user->last_name = $reqData->last_name;
    }
    if(isset($reqData->email)) {
      $user->email = $reqData->email;
    }
  
    $user->save();

    $response = (object) [
      "status" => "Success",
      "message" => "User updated.",
      "uuid" => $uuid,
      "req" => $reqData
    ];
  
    return response(json_encode($response), 200)
    ->header('Content-type', 'application/json');
  }

  public function deleteUser(Request $request) {
    $reqData = (object) $request->all();
    $user = User::where('uuid', $reqData->uuid)->first();

    $user->delete();

    $response = (object) [
      "status" => "Success",
      "message" => "User Deleted.",
    ];
  
    return response(json_encode($response), 200)
    ->header('Content-type', 'application/json');
  }
}