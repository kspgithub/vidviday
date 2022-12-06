<?php

namespace App\Mail;

use App\Models\Testimonial;
use App\Models\UserQuestion;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;

class TestimonialAdminEmail extends BaseTemplateEmail
{
    public Testimonial $testimonial;

    public static $subjectKey = 'emails.testimonial-admin.subject';

    public static $viewKey = 'emails.testimonial-admin';

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Testimonial $testimonial = null)
    {
        $this->testimonial = $testimonial ?: Testimonial::random();

        if($this->testimonial->attachment_url) {
            $this->attachment = $this->testimonial->attachment_url;
        }
    }

    public function getReplaces(): array
    {
        return [
            'testimonial_id' => $this->testimonial->id,
        ];
    }
}
