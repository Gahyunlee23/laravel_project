<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\HotelImage
 *
 * @property int $id
 * @property int $hotel_id
 * @property int $user_id 작성자 user id
 * @property string|null $type 옵션 타입 / main=0, review=1, sub[2~], 등
 * @property string|null $images 이미지[]
 * @property string|null $position_y 이미지 포지션 Y축 예 100%,100%|20%,100%  , 는 메인과 서브 분류 | 는 다음 이미지 순
 * @property string|null $title 사진 [제목, 타이틀]
 * @property string|null $explanation 설명
 * @property string|null $sub_explanation 서브 설명
 * @property string|null $disable 비활성화
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $uploaded_time
 * @property-read \App\Hotel $hotel
 * @method static \Illuminate\Database\Eloquent\Builder|HotelImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HotelImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HotelImage query()
 * @method static \Illuminate\Database\Eloquent\Builder|HotelImage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelImage whereDisable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelImage whereExplanation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelImage whereHotelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelImage whereImages($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelImage wherePositionY($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelImage whereSubExplanation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelImage whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelImage whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelImage whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelImage whereUserId($value)
 * @mixin \Eloquent
 */
class HotelImage extends Model
{
    protected $table = 'hotel_images';

    public $fillable = [
        'hotel_id','user_id',
        'type', 'images','position_y',
        'title', 'explanation', 'sub_explanation',
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
        return $this->belongsTo(Hotel::class,'hotel_id','id');
    }
}
