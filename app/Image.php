<?php

namespace App;

use Illuminate\Contracts\Session\Session;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * App\Image
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $email
 * @property string|null $tel
 * @property string|null $sns
 * @property string $path
 * @property float $size
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $size_in_kb
 * @property-read mixed $uploaded_time
 * @property-read string $url
 * @method static \Illuminate\Database\Eloquent\Builder|Image newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Image newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Image query()
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereSns($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereTel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Image extends Model
{
    /* Fillable *//* 'auth_by',*/
    protected $fillable = [
        'name', 'sns', 'tel', 'path', 'size'
    ];/* 'sns',*/
    /* @array $appends */
    public $appends = ['url', 'uploaded_time', 'size_in_kb'];

    public function getUrlAttribute(): string
    {
        $url = Str::replaceFirst('//', '/', $this->path);
        $url = Str::replaceFirst(' ', '%20', $url);
        $url = Str::replaceFirst(' ', '%20', $url);
        $url = Str::replaceFirst(' ', '%20', $url);
        $url = Str::replaceFirst(' ', '%20', $url);
        $url = Str::replaceFirst(' ', '%20', $url);
        $url = Str::replaceFirst('?', '%3F', $url);
        $url = Str::replaceFirst('?', '%3F', $url);
        $url = Str::replaceFirst('?', '%3F', $url);
        $url = Str::replaceFirst('@', '%40', $url);
        $url = Str::replaceFirst('@', '%40', $url);
        $url = Str::replaceFirst('@', '%40', $url);
        $url = Str::replaceFirst(',', '%2C', $url);
        $url = Str::replaceFirst(',', '%2C', $url);
        $url = Str::replaceFirst(',', '%2C', $url);
        $url = Str::replaceFirst(':', '%3A', $url);
        $url = Str::replaceFirst(':', '%3A', $url);
        $url = Str::replaceFirst(':', '%3A', $url);
        $url = Str::replaceFirst(';', '%3B', $url);
        $url = Str::replaceFirst(';', '%3B', $url);
        $url = Str::replaceFirst(';', '%3B', $url);
        $url = Str::replaceFirst('&', '%26', $url);
        $url = Str::replaceFirst('&', '%26', $url);
        $url = Str::replaceFirst('&', '%26', $url);
        $url = Str::replaceFirst('=', '%3D', $url);
        $url = Str::replaceFirst('=', '%3D', $url);
        $url = Str::replaceFirst('=', '%3D', $url);

        return Storage::disk('s3')->url($url);
    }

    public function getUploadedTimeAttribute()
    {
        return $this->created_at->diffForHumans();
    }
    public function getSizeInKbAttribute()
    {
        return round($this->size / 1024, 2);
    }

    /*public function user()
    {
        return $this->belongsTo(User::class, 'auth_by');
    }*/

    public static function boot()
    {
        parent::boot();
    }
}
