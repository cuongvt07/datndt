<?php

namespace App\Mail;

use App\Models\User;
use App\Models\DiscountCode;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DiscountCodeMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;
    protected $discountCode;

    public function __construct(User $user, DiscountCode $discountCode)
    {
        $this->user = $user;
        $this->discountCode = $discountCode; // Đảm bảo đã lưu discountCode
    }

    public function build()
    {
        return $this->view('emails.discount_code')
            ->with([
                'user' => $this->user,
                'discountCode' => $this->discountCode, // Truyền discountCode vào view
                'usageLimit' => $this->discountCode->usage_limit, // Truyền lượt sử dụng vào view
            ]);
    }
}
