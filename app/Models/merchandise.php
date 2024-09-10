<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Merchandise extends Model
{
    use HasFactory;
    use HasUuids;
    use SoftDeletes;

    protected $table = 'merchandises';
    protected $primaryKey = 'id';
    public $incrementing = false;
    public $timestamps = true;
    protected $keyType = 'string';
    protected $fillable = ['code', 'count'];
}
