<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Models\Plan;
use App\Models\Room;

class Book extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'plan_id', 'note', 'adult_number', 'child_number', 'total_amount', 'stripe_id', 'checkin_status', 'has_credit_card', 'book_code', 'checkin_at', 'checkout_at', 'booked_at'];

    public static function getTermDays($from, $to)
    {
        $start = $from ? Carbon::parse($from) : today();
        $end = $to ? Carbon::parse($to) : Carbon::tomorrow();

        return collect(CarbonPeriod::create($start, $end));
    }

    public static function getHolidaysCount($days)
    {
        $holidays = $days->filter(function ($day) {
            return $day->dayOfWeek % 6 == 0;
        });
        return $holidays->count();
    }

    public static function getGuestNumbers($adult, $child)
    {
        $guests = 
        [
            'adult' => $adult ? $adult : 2,
            'child' => $child ? $child : 0,
        ];
        return $guests;
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
