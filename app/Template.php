<?php

namespace App;

use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Template
 *
 * @property int $id
 * @property string $company 발신프로필
 * @property string|null $code 템플릿 코드
 * @property string|null $catalog 종류
 * @property string|null $name 템플릿 명
 * @property string $template 템플릿
 * @property string|null $button 템플릿 버튼
 * @property string|null $web_url 템플릿 웹 링크
 * @property string|null $mobile_url 템플릿 모바일 링크
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Template newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Template newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Template query()
 * @method static \Illuminate\Database\Eloquent\Builder|Template whereButton($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Template whereCatalog($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Template whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Template whereCompany($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Template whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Template whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Template whereMobileUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Template whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Template whereTemplate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Template whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Template whereWebUrl($value)
 * @mixin \Eloquent
 * @property string|null $use 0 = 미사용, 1 = 사용
 * @method static \Illuminate\Database\Eloquent\Builder|Template whereUse($value)
 * @property string|null $variable 변수 설정
 * @method static \Illuminate\Database\Eloquent\Builder|Template whereVariable($value)
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Query\Builder|Template onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Template whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Template withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Template withoutTrashed()
 */
class Template extends Model
{
    use SoftDeletes;
    protected $table = 'templates';

    protected $guarded = [];
}
