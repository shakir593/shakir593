<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Company;
class Employee extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['first_name','last_name','email','company','phone'];

    public function company()
    {
        return $this->belongsTo(Company::class,'company');
    }
}
