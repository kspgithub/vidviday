<?php

use App\Models\FaqItem;

if (! function_exists('countQuestions')) {
    function countQuestions(int $loop, ...$sections)
    {
        $count = 0;

        foreach ($sections as $section) {
            $count += count(faqBySection($section));
        }

        $number = $count + $loop;

        return $number > 9 ? $number : "0{$number}";
    }
}

if (! function_exists('faqBySection')) {
    function faqBySection(string $section)
    {
        $faqs = FaqItem::wherePublished(true)->get();

        return $faqs->where('section', $section)->all();
    }
}
