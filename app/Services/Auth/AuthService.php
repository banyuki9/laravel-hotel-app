<?php

namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthService 
{

  /**
   * Judge a user role 
   *
   * @return boolean
   */
  public static function judgeAdmin(string $email)
  {
    $user = User::where('email', '=', $email)->first();
    return ($user['role'] === 0) ? true : false;
  }

  public function updateCustomerUserData($request)
  {
    $customer_data = $request->session()->get('customerData');
    $user = User::where('id', '=', Auth::id())->first();
    $user->name_kanji = $customer_data['name_kanji'];
    $user->name_kana = $customer_data['name_kana'];
    $user->number = $customer_data['number'];
    $user->save();
  }

  
}