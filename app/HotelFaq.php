<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\HotelFaq
 *
 * @property int $id
 * @property int $hotel_id
 * @property int $user_id 작성자 user id
 * @property string $faq
 * @property string $faq_answer
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $uploaded_time
 * @property-read \App\Hotel $hotel
 * @method static \Illuminate\Database\Eloquent\Builder|HotelFaq newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HotelFaq newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HotelFaq query()
 * @method static \Illuminate\Database\Eloquent\Builder|HotelFaq whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelFaq whereFaq($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelFaq whereFaqAnswer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelFaq whereHotelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelFaq whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelFaq whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelFaq whereUserId($value)
 * @mixin \Eloquent
 * @property string $question
 * @property string $answer
 * @method static \Illuminate\Database\Eloquent\Builder|HotelFaq whereAnswer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelFaq whereQuestion($value)
 * @property string|null $answer_name 작성자 user_name
 * @property string|null $answer_job
 * @method static \Illuminate\Database\Eloquent\Builder|HotelFaq whereAnswerJob($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelFaq whereAnswerName($value)
 */
class HotelFaq extends Model
{
    protected $table = 'faqs';

    public $fillable = [
        'hotel_id','user_id',
        'answer_name','answer_job',
        'question', 'answer'
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
