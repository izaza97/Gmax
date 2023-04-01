<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageTour extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    public function packagelist()
    {
        return $this->belongsTo(PackageList::class);
    }
}
