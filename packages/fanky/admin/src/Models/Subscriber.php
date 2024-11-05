<?php
namespace Fanky\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    protected $table = 'subscribers';

        protected $guarded = ['id'];

    public function scopePublic($query)
    {
        return $query->where('published', 1);
    }
}
