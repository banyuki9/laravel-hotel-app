<?php

namespace App\Services\Auth;

use App\Models\User;


class AuthService 
{

  /**
   * Get the user role 
   *
   * @return boolean
   */
  public static function judgeAdmin(string $email)
  {
    $user = User::where('email', '=', $email)->first();
    return ($user['role'] === 0) ? true : false;
  }

  
}