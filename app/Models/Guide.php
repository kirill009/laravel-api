<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Guide extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'full_name', 'email', 'phone'
    ];
}
