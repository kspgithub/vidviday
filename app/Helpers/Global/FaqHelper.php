<?php


use App\Models\FaqItem;

if (!function_exists("countQuestion")) {

    function countQuestion(int $loop, ...$sections)
    {
        $count = 0;

        foreach ($sections as $section) {
            $count += count(faqBySection($section));
        }

        return $count + $loop;
    }
}

if (!function_exists("faqBySection")) {

    function faqBySection(string $section)
    {

        $faqs = FaqItem::wherePublished(true)->get();

        return $faqs->where("section", $section)->all();
    }
}
