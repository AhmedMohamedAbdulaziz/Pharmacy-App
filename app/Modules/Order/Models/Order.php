<?php
namespace App\Modules\Order\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use App\Modules\Auth\Models\User;
use App\Modules\Medicine\Models\Medicine;

class Order extends Model
{
    use HasFactory, HasUuids;

    protected $table    = 'orders';
    protected $fillable = ['user_id', 'medicine_id', 'quantity', 'total_price', 'status'];
    protected $guarded  = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function medicine()
    {
        return $this->belongsTo(Medicine::class);
    }
}
