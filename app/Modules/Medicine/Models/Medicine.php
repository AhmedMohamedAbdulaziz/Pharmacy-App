<?php
namespace App\Modules\Medicine\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Modules\Category\Models\Category;
use App\Modules\Supplier\Models\Supplier;

class Medicine extends Model implements HasMedia
{
    use HasFactory, HasUuids, InteractsWithMedia;

    protected $primaryKey  = 'id';
    protected $keyType     = 'string';
    public    $incrementing = false;
    protected $table       = 'medicines';
    protected $fillable    = ['name', 'price', 'quantity', 'expire_date', 'category_id', 'supplier_id'];
    protected $casts       = ['expire_date' => 'date'];
    protected $guarded     = ['id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
