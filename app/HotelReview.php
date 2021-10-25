<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\HotelReview
 *
 * @property int $id
 * @property int $hotel_id
 * @property int $hotel_room_type_id
 * @property string $name 리뷰어 성명
 * @property string $job 리뷰어 직업
 * @property string $star 리뷰어 별점
 * @property string $content 내용
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $created_time
 * @property-read string $uploaded_time
 * @property-read \App\Hotel $hotel
 * @property-read \App\HotelRoomType $hotel_room_type
 * @method static Builder|HotelReview newModelQuery()
 * @method static Builder|HotelReview newQuery()
 * @method static Builder|HotelReview query()
 * @method static Builder|HotelReview whereContent($value)
 * @method static Builder|HotelReview whereCreatedAt($value)
 * @method static Builder|HotelReview whereHotelId($value)
 * @method static Builder|HotelReview whereHotelRoomTypeId($value)
 * @method static Builder|HotelReview whereId($value)
 * @method static Builder|HotelReview whereJob($value)
 * @method static Builder|HotelReview whereName($value)
 * @method static Builder|HotelReview whereStar($value)
 * @method static Builder|HotelReview whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string|null $option
 * @property string|null $visible 활성화
 * @property string|null $input_completed_at 작성일
 * @method static Builder|HotelReview whereInputCompletedAt($value)
 * @method static Builder|HotelReview whereOption($value)
 * @method static Builder|HotelReview whereVisible($value)
 * @property string|null $images 리뷰 이미지
 * @property string|null $link 링크
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Support\Collection $image_explode
 * @method static \Illuminate\Database\Query\Builder|HotelReview onlyTrashed()
 * @method static Builder|HotelReview whereDeletedAt($value)
 * @method static Builder|HotelReview whereImages($value)
 * @method static Builder|HotelReview whereLink($value)
 * @method static \Illuminate\Database\Query\Builder|HotelReview withTrashed()
 * @method static \Illuminate\Database\Query\Builder|HotelReview withoutTrashed()
 * @property string|null $order 순서
 * @method static Builder|HotelReview whereOrder($value)
 */
class HotelReview extends Model
{
    use SoftDeletes;

    protected $table = 'reviews';

    public $fillable = [
        'id','hotel_id','hotel_room_type_id','input_completed_at',
        'name', 'job', 'star', 'content', 'option',
        'images','link','order'
    ];

    /* @array $appends */
    public $appends = [
        'uploaded_time', 'created_time'
    ];

    public function getUploadedTimeAttribute(): string
    {
        Carbon::setLocale('ko');
        return $this->updated_at->diffForHumans();
    }

    public function getCreatedTimeAttribute(): string
    {
        Carbon::setLocale('ko');
        return $this->created_at->diffForHumans();
    }
    public function getImageExplodeAttribute(): \Illuminate\Support\Collection
    {
        if($this->images){
            return \Str::of($this->images)->explode('||');
        }

        return collect();
    }

    public function hotel(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Hotel::class,'id','hotel_id');
    }
    public function hotel_room_type(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(HotelRoomType::class,'id','hotel_room_type_id');
    }
}
