<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\EnterRoom
 *
 * @property int $id
 * @property int $enter_id
 * @property string $type 룸 타입
 * @property int $supply_price_month 한달살기 가격
 * @property int $supply_price_3_weeks 3주 살기 가격
 * @property int $supply_price_2_weeks 2주 살기 가격
 * @property int $supply_price_1_weeks 1주 살기 가격
 * @property int $supply_price_short_day 단기 살기 가격
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|EnterRoom newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EnterRoom newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EnterRoom query()
 * @method static \Illuminate\Database\Eloquent\Builder|EnterRoom whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnterRoom whereEnterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnterRoom whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnterRoom whereSupplyPrice1Weeks($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnterRoom whereSupplyPrice2Weeks($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnterRoom whereSupplyPrice3Weeks($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnterRoom whereSupplyPriceMonth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnterRoom whereSupplyPriceShortDay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnterRoom whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnterRoom whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class EnterRoom extends Model
{

    protected $table = 'enter_rooms';

    protected $fillable = [
        'id', 'enter_id',
        'type', 'supply_price_month', 'supply_price_3_weeks', 'supply_price_2_weeks', 'supply_price_1_weeks', 'supply_price_short_day',
    ];
}
