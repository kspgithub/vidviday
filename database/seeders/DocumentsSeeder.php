<?php

namespace Database\Seeders;

use App\Models\Document;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Seeder;

class DocumentsSeeder extends Seeder
{
    use TruncateTable;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $this->truncate('documents');
        $documents = [
            [
                'title' => [
                    'uk' => 'Витяг з Єдиного державного реєстру',
                ],
                'image' => 'https://vidviday.ua/UserFiles/Image/dokumenty/vytiah_2016.12.07.jpg',
                'file' => 'https://vidviday.ua/UserFiles/File/dokumenty/Vytiah_JeDR.pdf',
            ],
            [
                'title' => [
                    'uk' => 'Ліцензія туроператора',
                ],
                'image' => 'https://vidviday.ua/UserFiles/Image/dokumenty/licenzija_Vidviday_perehliad.jpg',
                'file' => 'https://vidviday.ua/UserFiles/File/dokumenty/licenzija-Vidviday.jpg',
            ],
            [
                'title' => [
                    'uk' => ' Банківська гарантія',
                ],
                'image' => 'https://vidviday.ua/UserFiles/Image/dokumenty/bankivska-harantia-sait_page-0001.jpg',
                'file' => 'https://vidviday.ua/UserFiles/File/dokumenty/bankivska-harantia-sait_compressed.pdf',
            ],
        ];

        foreach ($documents as $doc) {
            $document = new Document();
            $image_url = $document->storeFileFromUrl($doc['image']);
            $file_url = $document->storeFileFromUrl($doc['file']);
            if ($image_url !== false && $file_url !== false) {
                $document->title = $doc['title'];
                $document->image = $image_url;
                $document->file = $file_url;
                $document->save();
            }
        }
    }
}
