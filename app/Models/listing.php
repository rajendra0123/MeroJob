<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class listing extends Model
{

    // Necessary for using model factories in Laravel.
    use HasFactory;
    protected $table = 'listing';
    protected $fillable = ['title', 'company', 'location', 'website', 'tags', 'email', 'description', 'logo', 'user_id'];



    //filter by clicking on tags
    public function scopeFilter($query, array $filters)
    {
        if ($filters['tag'] ?? false) {
            $query->where('tags', 'like', '%' . request('tag') . '%');

        }

        //search in hero section
        if ($filters['search'] ?? false) {
            $query->where('title', 'like', '%' . request('search') . '%')
                ->orWhere('description', 'like', '%' . request('search') . '%')
                ->orWhere('tags', 'like', '%' . request('search') . '%')
                ->orWhere('location', 'like', '%' . request('search') . '%');
        }
    }

    //Relationship to User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
