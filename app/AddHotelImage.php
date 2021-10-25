<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\AddHotelImage
 *
 * @property int $id
 * @property int|null $add_hotel_id 입점 신청 호텔 ID
 * @property int|null $hotel_manager_id 호텔 매니저 User ID
 * @property string|null $type 종류
 * @property string|null $title 사진 [제목, 타이틀]
 * @property string|null $image 이미지
 * @property string|null $explanation 설명 180자 이하
 * @property string|null $sub_explanation 서브 설명 180자 이하
 * @property string|null $order 출력 순서
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelImage query()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelImage whereAddHotelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelImage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelImage whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelImage whereExplanation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelImage whereHotelManagerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelImage whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelImage whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelImage whereSubExplanation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelImage whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelImage whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelImage whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Query\Builder|AddHotelImage onlyTrashed()
 * @method static \Illuminate\Database\Query\Builder|AddHotelImage withTrashed()
 * @method static \Illuminate\Database\Query\Builder|AddHotelImage withoutTrashed()
 */
class AddHotelImage extends Model
{
    use SoftDeletes;

    protected $table = 'add_hotel_images';

    protected $guarded = [];

}
