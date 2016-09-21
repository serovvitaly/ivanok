<?php

namespace App\Console\Commands;

use DOMDocument;
use Illuminate\Console\Command;

class WomanParser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'woman';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
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
        include_once '/var/www/new.ivanok.ru/app/Helpers/simple_html_dom.php';

        $urls_arr = ['http://www.woman.ru/beauty/body/article/175580/'];

        $posts_arr = \App\Models\NewPostModel::take(100)->get();

        /**
         * @var $post \App\Models\NewPostModel
         */
        foreach ($posts_arr as $post) {

            $url = $post->source_url;

            $this->info($url);

            $images_arr = $this->getImages($url);

            $origin_dir = public_path('img/origin/');

            if ( ! empty($images_arr) ) {

                foreach ($images_arr as $image_url) {

                    $file_name = md5('img' . $image_url) . '.jpg';

                    $file_predir = substr($file_name, 0, 2);

                    $file_name = $file_predir . '/' . substr($file_name, 2);

                    if ( ! file_exists($origin_dir . $file_predir) ) {

                        mkdir($origin_dir . $file_predir);
                    }

                    $file_content = file_get_contents($image_url);

                    file_put_contents($origin_dir . $file_name, $file_content);

                    $post->medias()->create([
                        'file_name' => $file_name
                    ]);
                }
            }

            continue;

            $html_dom = \App\Helpers\simple_html_dom\file_get_html($url);

            $p_items_arr = $html_dom->find('div[class=article-text] p');

            $article_text_items_arr = [];
            foreach ($p_items_arr as $p_item) {

                $article_text_items_arr[] = '<p>' . (string) $p_item->innertext() . '</p>';
            }

            $article_text = implode("\n", $article_text_items_arr);

            if (! empty($article_text)) {

                $post->content = $article_text;
                $post->save();
            }

            //$page_content = file_get_contents($url);

            //$page_content = $this->clearContent($page_content);

            //$this->getArticleText($page_content);

            /*$main_image_url = $this->getMainImage($page_content);

            if ($main_image_url) {

                $post->img = $main_image_url;
                $post->save();
            }*/
        }
    }

    /**
     * Очещает содержимое страницы от лишнего мусора
     * @param $content
     * @return string
     */
    public function clearContent($content)
    {
        $content = preg_replace('/<script(.*)script>/siU', '', $content);
        $content = preg_replace('/<noindex(.*)noindex>/siU', '', $content);
        $content = preg_replace('/<html(.*)>/siU', '<html>', $content);

        return $content;
    }

    public function getImages($url)
    {
        $url .= '?startLeaflet=1';

        $page_content = file_get_contents($url);

        preg_match_all('/http\:\/\/i[\d]{1,}.woman.ru\/womanru\/images\/gallery([^"]*)_(\d+)x(\d+)\.([^"]*)/', $page_content, $matches);

        if (empty($matches)) {
            return [];
        }

        $images_prefixes_arr = array_unique($matches[1]);

        $unique_images_keys_arr = array_keys($images_prefixes_arr);

        $images_arr = [];

        foreach ($matches[0] as $image_key => $image_url) {

            if ( ! in_array($image_key, $unique_images_keys_arr) ) {
                continue;
            }

            $images_arr[] = $image_url;
        }

        return $images_arr;
    }

    /**
     * Возвращает URL основной картинки в посте
     * @param $content
     * @return null|string
     */
    public function getMainImage($content)
    {
        preg_match('/http\:\/\/i(\d+)\.woman\.ru\/womanru\/images\/gallery([^"]*)/', $content, $matches);

        if (empty($matches)) {
            return null;
        }

        $img_url = $matches[0];

        return $img_url;
    }

    /**
     * Возвращает текст статьи
     * @param $content
     */
    public function getArticleText($content)
    {
        //$xml = simplexml_load_string($content);

        $doc = new DOMDocument();
        $doc->loadHTML($content);

        //$p = $xml->xpath("//*[contains(@class, 'article-text')]");

        //print_r($p);
    }

    public static function getWomanRss()
    {
        $rss_url = 'http://www.woman.ru/beauty/rss/';

        $rss_xml_str = file_get_contents($rss_url);

        $rss_xml_obj = simplexml_load_string($rss_xml_str);

        $rss_items = $rss_xml_obj->xpath('/rss/channel/item');

        if (empty($rss_items)) {
            return [];
        }

        $items_arr = [];

        foreach ($rss_items as $rss_item_obj) {

            $items_arr[] = (object) [
                'title' => trim((string) $rss_item_obj->title),
                'description' => trim((string) $rss_item_obj->description),
                'link' => trim((string) $rss_item_obj->link),
                'date' => date('Y-m-d H:i:s', strtotime((string) $rss_item_obj->pubDate)),
            ];
        }

        return $items_arr;
    }
}
