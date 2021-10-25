<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * App\Recommendation
 *
 * @property int $id
 * @property string $tel 연락처
 * @property string $recommendation
 * @property string $privacy 개인정보동의
 * @property string|null $marketing 마케팅
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Support\Collection $recommendations
 * @method static \Illuminate\Database\Eloquent\Builder|Recommendation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Recommendation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Recommendation query()
 * @method static \Illuminate\Database\Eloquent\Builder|Recommendation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recommendation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recommendation whereMarketing($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recommendation wherePrivacy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recommendation whereRecommendation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recommendation whereTel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recommendation whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Recommendation extends Model
{
    protected $table = 'recommendation';

    public $fillable = [
        'id', 'tel', 'recommendation', 'privacy', 'marketing',
        'created_at', 'updated_at'
    ];
    public function getRecommendationsAttribute(): \Illuminate\Support\Collection
    {
        return Str::of($this->recommendation)->explode('ㆍ');
    }
}
