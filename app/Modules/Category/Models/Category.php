<?php
namespace App\Modules\Category\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Category extends Model
{
    use HasFactory, HasUuids;

    protected $primaryKey  = 'id';
    protected $keyType     = 'string';
    public    $incrementing = false;
    protected $table       = 'categories';
    protected $fillable    = ['name'];
    protected $guarded     = ['id'];

    public function medicines()
    {
        // Late-bind to avoid circular import at class-load time
        return $this->hasMany(\App\Modules\Medicine\Models\Medicine::class);
    }
}
