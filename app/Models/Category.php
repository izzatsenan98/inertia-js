<?php

namespace App\Models;

use App\Observers\CategoryObserver;
use App\Scopes\UserScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * Search query function
     *
     * @param mixed $query
     * @param mixed $term
     * @return void
     */
    public function scopeSearch($query, $term)
    {
        $term = "%$term%";

        $query->where(function ($query) use ($term) {
            $query->where('name', 'like', $term);
        });
    }

    /**
     * Query filter for categories
     *
     * @param mixed $query
     * @return void
     */
    public function scopeCategoriesQuery($query)
    {
        $search = request('search', '');

        $direction = request('direction', 'desc');

        if (!in_array($direction, ['asc', 'desc'])) {
            $direction = 'desc';
        }

        $field = request('field', 'created_at');
        if (!in_array($field, ['name', 'created_at'])) {
            $field = 'created_at';
        }

        $query->orderBy($field, $direction)
            ->search(trim($search));
    }

    protected static function boot()
    {
        parent::boot();
        static::observe(new CategoryObserver());
    }

    public static function booted()
    {
        static::addGlobalScope(new UserScope());
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

}
