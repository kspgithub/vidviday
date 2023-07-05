<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\BeWithUs;

class CreateBeWithUsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('be_with_us', function (Blueprint $table) {
            $table->id();
            $table->json('title');
            $table->json('url')->nullable();
            $table->string('icon')->nullable();
            $table->boolean('published')->default(false);
            $table->integer('position')->default(0);
            $table->timestamps();
        });

        // Inserting initial data
        BeWithUs::create([
            'title' => [
                'uk' => 'Facebook',
                'en' => 'Facebook',
                'ru' => 'Facebook',
                'pl' => 'Facebook',
            ],
            'url' => [
                'uk' => 'https://www.facebook.com/vidviday',
                'en' => 'https://www.facebook.com/vidviday',
                'ru' => 'https://www.facebook.com/vidviday',
                'pl' => 'https://www.facebook.com/vidviday',
            ],
            'icon' => 'social-facebook',
            'published' => true,
            'position' => 1,
        ]);

        BeWithUs::create([
            'title' => [
                'uk' => 'Instagram',
                'en' => 'Instagram',
                'ru' => 'Instagram',
                'pl' => 'Instagram',
            ],
            'url' => [
                'uk' => 'https://www.instagram.com/vidviday/',
                'en' => 'https://www.instagram.com/vidviday/',
                'ru' => 'https://www.instagram.com/vidviday/',
                'pl' => 'https://www.instagram.com/vidviday/',
            ],
            'icon' => 'social-instagram',
            'published' => true,
            'position' => 2,
        ]);

        BeWithUs::create([
            'title' => [
                'uk' => 'YouTube',
                'en' => 'YouTube',
                'ru' => 'YouTube',
                'pl' => 'YouTube',
            ],
            'url' => [
                'uk' => 'https://www.youtube.com/user/vidviday',
                'en' => 'https://www.youtube.com/user/vidviday',
                'ru' => 'https://www.youtube.com/user/vidviday',
                'pl' => 'https://www.youtube.com/user/vidviday',
            ],
            'icon' => 'social-youtube',
            'published' => true,
            'position' => 3,
        ]);

        BeWithUs::create([
            'title' => [
                'uk' => 'TikTok',
                'en' => 'TikTok',
                'ru' => 'TikTok',
                'pl' => 'TikTok',
            ],
            'url' => [
                'uk' => 'https://www.tiktok.com/@vidviday',
                'en' => 'https://www.tiktok.com/@vidviday',
                'ru' => 'https://www.tiktok.com/@vidviday',
                'pl' => 'https://www.tiktok.com/@vidviday',
            ],
            'icon' => 'social-tiktok',
            'published' => true,
            'position' => 4,
        ]);

        BeWithUs::create([
            'title' => [
                'uk' => 'Telegram',
                'en' => 'Telegram',
                'ru' => 'Telegram',
                'pl' => 'Telegram',
            ],
            'url' => [
                'uk' => 'https://t.me/vidviday',
                'en' => 'https://t.me/vidviday',
                'ru' => 'https://t.me/vidviday',
                'pl' => 'https://t.me/vidviday',
            ],
            'icon' => 'social-telegram',
            'published' => true,
            'position' => 5,
        ]);

        BeWithUs::create([
            'title' => [
                'uk' => 'TripAdvisor',
                'en' => 'TripAdvisor',
                'ru' => 'TripAdvisor',
                'pl' => 'TripAdvisor',
            ],
            'url' => [
                'uk' => 'https://www.tripadvisor.com/Attraction_Review-g295377-d14176633-Reviews-Vidviday-Lviv_Lviv_Oblast.html',
                'en' => 'https://www.tripadvisor.com/Attraction_Review-g295377-d14176633-Reviews-Vidviday-Lviv_Lviv_Oblast.html',
                'ru' => 'https://www.tripadvisor.com/Attraction_Review-g295377-d14176633-Reviews-Vidviday-Lviv_Lviv_Oblast.html',
                'pl' => 'https://www.tripadvisor.com/Attraction_Review-g295377-d14176633-Reviews-Vidviday-Lviv_Lviv_Oblast.html',
            ],
            'icon' => 'social-tripadvisor',
            'published' => true,
            'position' => 6,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('be_with_us');
    }
}
