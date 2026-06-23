<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Medicine;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Supplier extends Model
{
    use HasFactory;
    
     use HasUuids;

     protected $primaryKey = 'id';

    protected $keyType = 'string';
    public $incrementing = false;
    protected $table = 'suppliers';

    
    protected $fillable = [
        'name',
        'phone',
        'address'
        ];
        
        protected $guarded=['id'];
    public function medicines()
    {
        return $this->hasMany(Medicine::class);
    }
}
