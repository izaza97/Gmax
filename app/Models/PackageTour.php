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

    protected $appends = [
        'image_path',
    ];

    public function getImagePathAttribute()
    {
        return $this->images->first()->path;
    }

    public function packagelist()
    {
        return $this->belongsTo(PackageList::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
