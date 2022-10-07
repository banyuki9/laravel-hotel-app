<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use \Carbon\Carbon;
use App\Services\Plan\PlanService;

class BookConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = '【Laravel-Hotel】宿泊予約が確定しました。';
    public $bookData;
    public User $userData;
    public $plan;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($bookData, $userData)
    {
        $this->bookData = $bookData;
        $this->userData = $userData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->plan = PlanService::getPlan($this->bookData->plan_id);
        $this->bookData->checkin_at = $this->changeDateFormat($this->bookData->checkin_at);
        $this->bookData->checkout_at = $this->changeDateFormat($this->bookData->checkout_at);
        return $this->markdown('email.book_confirmation');
    }

    public function changeDateFormat($date)
    {
        return Carbon::parse($date)->format('Y年m月d日');
    }
}
