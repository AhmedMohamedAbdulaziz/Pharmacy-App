<?php
namespace App\Modules\Supplier\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Supplier extends Model
{
    use HasFactory, HasUuids;

    protected $primaryKey  = 'id';
    protected $keyType     = 'string';
    public    $incrementing = false;
    protected $table       = 'suppliers';
    protected $fillable    = ['name', 'phone', 'address'];
    protected $guarded     = ['id'];

    public function medicines()
    {
        return $this->hasMany(\App\Modules\Medicine\Models\Medicine::class);
    }
}
