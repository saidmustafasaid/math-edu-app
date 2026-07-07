<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }

    public function tests()
    {
        return $this->hasMany(Test::class);
    }
}
