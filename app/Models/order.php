<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    use HasFactory;
    use HasUuids;
    use SoftDeletes;

    protected $table = 'orders';
    protected $primaryKey = 'id';
    public $incrementing = false;
    public $timestamps = true;
    protected $keyType = 'string';
    protected $fillable = ['class_code', 'result', 'address', 'shipment_id'];

    public function merchandise(): BelongsToMany
    {
        return $this->belongsToMany(merchandise::class, 'order_details', 'merchandise_id', 'order_id')->withPivot('deleted_at')->wherePivot('deleted_at', "=", null);
    }

    public function shipment()
    {
        return $this->belongsTo(shipment::class, 'shipment_details', 'shipment_id', 'order_id')->withPivot('deleted_at')->wherePivot('deleted_at', "=", null);
    }
}
