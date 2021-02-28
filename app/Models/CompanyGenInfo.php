<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyGenInfo extends Model
{
    use HasFactory;
    protected $table = 'azhrms_company_gen_info';
    protected $fillable = [
        'c_name', 'tax_id','registration_number','note','res_company_name',
    
    ];
}
