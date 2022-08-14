<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class UserInfoModel extends Authenticatable
{
  use HasApiTokens, HasFactory;

  protected $connection = 'pgsql';
  protected $table = 'users.user_infos';
    
  protected $primaryKey = 'user_id';
  protected $keyType = 'string';
  public $incrementing = 'false';

  public $timestamps = false;
}
