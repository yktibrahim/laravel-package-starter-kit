<?php

namespace LaravelPackageStarterKit\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LaravelPackageStarterKitModel extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     * Toplu atanabilir özellikler.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
    ];
} 