<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\EnterOption
 *
 * @property int $id
 * @property int $enter_id
 * @property string $amenities 도구
 * @property string $facilities 시설
 * @property string $benefit 혜택
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|EnterOption newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EnterOption newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EnterOption query()
 * @method static \Illuminate\Database\Eloquent\Builder|EnterOption whereAmenities($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnterOption whereBenefit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnterOption whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnterOption whereEnterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnterOption whereFacilities($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnterOption whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnterOption whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class EnterOption extends Model
{
    protected $table = 'enter_options';

    protected $fillable = [
        'id',
        'enter_id', 'amenities','facilities','benefit',
    ];
}
