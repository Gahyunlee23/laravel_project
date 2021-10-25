<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ConfirmationSchedule
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ConfirmationSchedule newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ConfirmationSchedule newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ConfirmationSchedule query()
 * @mixin \Eloquent
 */
class ConfirmationSchedule extends Model
{
    protected $table = 'confirmation_schedules';

    public $fillable = [
        'id','reservation_id',
        'start_dt', 'end_dt', 'add_days',
        'memo', 'status',
        'created_at', 'updated_at'
    ];
}
