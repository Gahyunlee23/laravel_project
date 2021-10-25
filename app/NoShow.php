<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\NoShow
 *
 * @property int $id
 * @property int|null $reservation_id
 * @property int|null $confirmation_id
 * @property int|null $hotel_id
 * @property int|null $user_id
 * @property int|null $hotel_manager_id
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\HotelReservation|null $reservation
 * @method static \Illuminate\Database\Eloquent\Builder|NoShow newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NoShow newQuery()
 * @method static \Illuminate\Database\Query\Builder|NoShow onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|NoShow query()
 * @method static \Illuminate\Database\Eloquent\Builder|NoShow whereConfirmationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NoShow whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NoShow whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NoShow whereHotelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NoShow whereHotelManagerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NoShow whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NoShow whereReservationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NoShow whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NoShow whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|NoShow withTrashed()
 * @method static \Illuminate\Database\Query\Builder|NoShow withoutTrashed()
 * @mixin \Eloquent
 */
class NoShow extends Model
{
    use SoftDeletes;

    protected $table = 'no_shows';

    protected $guarded = [];


    public function reservation(): BelongsTo
    {
        return $this->belongsTo(HotelReservation::class, 'reservation_id', 'id');
    }
}
