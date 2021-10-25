<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\HotelCheckPoint
 *
 * @property int $id
 * @property int $hotel_id
 * @property string $title1 체크포인트 1 title
 * @property string $explanation1 체크포인트 1 설명
 * @property string $title2 체크포인트 2 title
 * @property string $explanation2 체크포인트 2 설명
 * @property string $title3 체크포인트 3 title
 * @property string $explanation3 체크포인트 3 설명
 * @property string $disable 비활성화
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|HotelCheckPoint newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HotelCheckPoint newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HotelCheckPoint query()
 * @method static \Illuminate\Database\Eloquent\Builder|HotelCheckPoint whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelCheckPoint whereDisable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelCheckPoint whereExplanation1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelCheckPoint whereExplanation2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelCheckPoint whereExplanation3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelCheckPoint whereHotelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelCheckPoint whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelCheckPoint whereTitle1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelCheckPoint whereTitle2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelCheckPoint whereTitle3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelCheckPoint whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string|null $image1 체크포인트 1 이미지
 * @property string|null $image2 체크포인트 2 이미지
 * @property string|null $image3 체크포인트 3 이미지
 * @property-read string $uploaded_time
 * @property-read \App\Hotel $hotel
 * @method static \Illuminate\Database\Eloquent\Builder|HotelCheckPoint whereImage1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelCheckPoint whereImage2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelCheckPoint whereImage3($value)
 */
class HotelCheckPoint extends Model
{

    protected $table = 'check_points';

    public $fillable = [
        'hotel_id',
        'title1', 'explanation1', 'image1',
        'title2', 'explanation2', 'image2',
        'title3', 'explanation3', 'image3',
        'disable'
    ];

    /* @array $appends */
    public $appends = ['uploaded_time'];

    public function getUploadedTimeAttribute(): string
    {
        return $this->updated_at->diffForHumans();
    }
    public function hotel(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Hotel::class,'id','hotel_id');
    }
}
