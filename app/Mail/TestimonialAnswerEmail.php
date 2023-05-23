<?php

namespace App\Mail;

use App\Models\Place;
use App\Models\Staff;
use App\Models\Testimonial;
use App\Models\Tour;
use App\Models\UserQuestion;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use const _PHPStan_5c71ab23c\__;

class TestimonialAnswerEmail extends BaseTemplateEmail
{
    public static $subjectKey = 'emails.testimonial-answer.subject';
    public static $viewKey = 'emails.testimonial-answer';
    public Testimonial $testimonial;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Testimonial $testimonial = null)
    {
        $this->testimonial = $testimonial ?: Testimonial::random();

        if ($this->testimonial->attachment_url) {
            $this->attachment = $this->testimonial->attachment_url;
        }
    }

    public function getReplaces(): array
    {
        $context = match ($this->testimonial->model) {
            Tour::class => __('Tour') . ' ' . $this->testimonial->model->title,
            Staff::class => $this->testimonial->model->types?->first?->title . '',
            Place::class => __('Place') . ' ' . $this->testimonial->model->title,
            default => '',
        };

        return [
            'testimonial_id' => $this->testimonial->id,
            'pid' => $this->testimonial->parent_id,
            'context' => $context,
        ];
    }
}
