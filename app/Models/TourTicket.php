<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class TourTicket extends Model
{
    use HasFactory;
    use HasTranslations;

    const TYPE_TEMPLATE = 1;
    const TYPE_CUSTOM = 2;

    protected $table = 'tours_tickets';

    public $timestamps = false;

    public $translatable = [
        'text',
        'title',
    ];

    protected $fillable = [
        'tour_id',
        'ticket_id',
        'title',
        'text',
    ];

    public function tour()
    {
        return $this->belongsTo(Tour::class, 'tour_id');
    }

    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'ticket_id');
    }

//    public function getTextAttribute()
//    {
//        $locale = $this->getLocale();
//        $text = $this->attributes['text'] ?? '';
//        $text = !empty($text) ? json_decode($text, true) : [];
//        return !empty($this->ticket) ? $this->ticket->text : ($text[$locale] ?? '');
//    }
//
//    public function getTitleAttribute()
//    {
//        $locale = $this->getLocale();
//        $title = $this->attributes['title'] ?? '';
//        $title = !empty($title) ? json_decode($title, true) : [];
//        $prefix = $title[$locale] ?? ($title['uk'] ?? '');
//        return trim(($this->ticket->title ?? '') . ' ' . $prefix);
//    }
}
