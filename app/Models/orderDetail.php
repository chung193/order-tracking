<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class OrderDetail extends Model
{
    use HasFactory;
    use HasUuids;
    use SoftDeletes;

    protected $table = 'order_details';
    protected $primaryKey = 'id';
    public $incrementing = false;
    public $timestamps = true;
    protected $keyType = 'string';
    protected $fillable = ['order_id', 'merchandise_id', 'count'];
}
