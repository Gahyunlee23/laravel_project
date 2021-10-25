<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Curator
 *
 * @property int $id
 * @property string|null $user_id 큐레이터 id
 * @property string|null $user_page 큐레이터 전용 page 명
 * @property string $user_pass 큐레이터 password
 * @property string|null $name 큐레이터 이름
 * @property string $tel 큐레이터 연락처
 * @property string $email 큐레이터 이메일
 * @property string $explanation 큐레이터 설명
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $uploaded_time
 * @method static \Illuminate\Database\Eloquent\Builder|Curator newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Curator newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Curator query()
 * @method static \Illuminate\Database\Eloquent\Builder|Curator whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Curator whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Curator whereExplanation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Curator whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Curator whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Curator whereTel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Curator whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Curator whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Curator whereUserPage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Curator whereUserPass($value)
 * @mixin \Eloquent
 * @property string $visible 활성화
 * @method static \Illuminate\Database\Eloquent\Builder|Curator whereVisible($value)
 * @property string|null $logo_image 큐레이터 로고 이미지
 * @method static \Illuminate\Database\Eloquent\Builder|Curator whereLogoImage($value)
 * @property string|null $percent 총 할인%
 * @method static \Illuminate\Database\Eloquent\Builder|Curator wherePercent($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\CuratorBanner[] $curatorBanners
 * @property-read int|null $curator_banners_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\CuratorHotel[] $curatorHotels
 * @property-read int|null $curator_hotels_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Banner[] $banners
 * @property-read int|null $banners_count
 */
class Curator extends Model
{
    protected $table = 'curators';

    protected $fillable = [
        'id', 'logo_image',
        'user_id', 'user_page', 'user_pass',
        'name', 'tel', 'email',
        'explanation',
        'created_at', 'updated_at'
    ];
    /* @array $appends */
    public $appends = ['uploaded_time'];

    public function getUploadedTimeAttribute(): string
    {
        return $this->updated_at->diffForHumans();
    }

    public function curatorHotels(): HasMany
    {
        return $this->hasMany(CuratorHotel::class,'curator_id','id');
    }
    public function curatorBanners(): HasMany
    {
        return $this->hasMany(CuratorBanner::class,'curator_id','id');
    }
    public function banners(): HasMany
    {
        return $this->hasMany(Banner::class,'curator_id','id');
    }
}
