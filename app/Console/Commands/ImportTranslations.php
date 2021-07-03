<?php

namespace App\Console\Commands;

use App\Models\LanguageLine;
use Illuminate\Console\Command;

class ImportTranslations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'translations:import {locale=uk}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $locale = $this->argument('locale');

        if (!file_exists(resource_path("lang/$locale.json"))) {
            $this->error(__('File :file not found.', ['file'=>"lang/$locale.json"]));
        } else {
            $json = json_decode(file_get_contents(resource_path("lang/$locale.json")), true);
            foreach ($json as $key=>$value) {
                $line = LanguageLine::query()
                    ->where('group', '*')
                    ->where('key', $key)->first();
                if ($line === null) {
                    LanguageLine::create([
                        'group' => '*',
                        'key' => $key,
                        'text' => ['en' => $key, 'uk' => $value, 'ru' => $value, 'pl'=>$key],
                    ]);
                }
            }
        }

        return 0;
    }
}
