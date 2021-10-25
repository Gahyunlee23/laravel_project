<?php

namespace App;

use App\Http\Livewire\Hotels\Collect;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\HotelRoomType
 *
 * @property int $id
 * @property int|null $hotel_id 호텔 id
 * @property int|null $user_id user(관리자) id
 * @property string|null $name 룸 배드 명칭
 * @property string|null $main_explanation 룸 배드 개수
 * @property string|null $sub_explanation 룸 타입 하단 추가 설명
 * @property string|null $order 룸 타입 정렬순
 * @property string|null $visible 룸 타입 보일지
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|HotelRoomType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HotelRoomType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HotelRoomType query()
 * @method static \Illuminate\Database\Eloquent\Builder|HotelRoomType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelRoomType whereHotelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelRoomType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelRoomType whereMainExplanation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelRoomType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelRoomType whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelRoomType whereSubExplanation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelRoomType whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelRoomType whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelRoomType whereVisible($value)
 * @mixin \Eloquent
 * @property string|null $image 룸 이미지
 * @property string|null $sold_out 판매 완료=1, 판매중=0
 * @method static \Illuminate\Database\Eloquent\Builder|HotelRoomType whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelRoomType whereSoldOut($value)
 * @property string|null $upgrade 업그레이드 용 N Y
 * @method static \Illuminate\Database\Eloquent\Builder|HotelRoomType whereUpgrade($value)
 * @property int $sale_possibility_count 판매 가능 총 개수
 * @method static \Illuminate\Database\Eloquent\Builder|HotelRoomType whereSalePossibilityCount($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\HotelReservation[] $reservations
 * @property-read int|null $reservations_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\RoomTypeImage[] $images
 * @property-read int|null $images_count
 * @property-read \Illuminate\Database\Eloquent\Collection $getImagesSlideAttribute
 * @property-read int|null $ImagesSlide_count
 * @property-read mixed $images_slide
 */
class HotelRoomType extends Model
{
    protected $table = 'room_types';

    public $fillable = [
        'id', 'hotel_id', 'user_id',
        'sale_possibility_count',
        'name', 'main_explanation', 'sub_explanation',
        'image',
        'order', 'visible','upgrade', 'sold_out',
        'created_at', 'updated_at'
    ];
    public function reservations()
    {
        return $this->hasMany(HotelReservation::class, 'room_type_id','id');
    }

    public function images() {
        return $this->hasMany(RoomTypeImage::class, 'room_type_id','id');
    }

    public function getImagesSlideAttribute() {
        if($this->images->count() >= 1){
            return collect($this->image)->merge($this->images->pluck('path'));
        }
        return collect($this->image);
    }


}
