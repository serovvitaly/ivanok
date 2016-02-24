<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class YandexApi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'yapi:metrika';

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
     * @return mixed
     */
    public function handle()
    {
        $this->info('Yandex API');

        $oauth_token = '4670d767fb384a5cb22e434efd19cce1';

        $counter_id = 6800620;

        $url_params = [
            'metrics' => 'ym:pv:pageviews',
            'date1' => '90daysAgo',
            'date2' => 'yesterday',
            'dimensions' => 'ym:pv:URLHash',
            'limit' => 500,
            'filters' => 'ym:pv:pageviews>10'
            //'preset' => 'url_params'
        ];

        /**
         * https://metrika.yandex.ru/stat/new?metric=ym%3Apv%3Apageviews&sort=-ym%3Apv%3Apageviews&selected_rows=pZZLFB%2C%2BmaWUp%2C7%2Fww28%2CRU1oi1%2CbEFQFX%2CB%2B8pr9%2CZErlh4%2CQyHagE%2CGAOHY8%2CqEpgk2&chart_type=pie&period=2015-11-22%3A2016-02-23&table=hits&title=%D0%90%D0%B4%D1%80%D0%B5%D1%81+%D1%81%D1%82%D1%80%D0%B0%D0%BD%D0%B8%D1%86%D1%8B&metrics=ym%3Apv%3Apageviews&dimensions=ym%3Apv%3AURLHash&id=6800620
         */

        $url_params['id'] = $counter_id;
        $url_params['oauth_token'] = $oauth_token;

        $url_params = http_build_query($url_params);

        $url = "https://api-metrika.yandex.ru/stat/v1/data?" . $url_params;

        $response = file_get_contents($url);
        $response = json_decode($response);

        $this->info('count = ' . count($response->data));

        foreach ($response->data as $data) {

            $url = $data->dimensions[0]->name;
            $traffic = $data->metrics[0];

            if ( ! preg_match('/ivanok/', $url) ) continue;

            $url = substr($url, 16);

            if ( strlen($url) < 2 ) continue;

            $post = \App\Models\PostModel::where('url', '=', $url)->first();

            if ( ! $post ) continue;

            $post->metrika_pageviews = $traffic;
            $post->is_actual = 1;

            $post->save();

            //echo $traffic . ' === ' . $url . "\n";
        }

        $this->info('...end');
    }
}
