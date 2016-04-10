<?php
/**
 * Created by PhpStorm.
 * User: Vitaly
 * Date: 27.02.2016
 * Time: 22:54
 */

namespace App\Helpers;

use Cache;

class RssHelper
{
    public static function get($source_url, $count = 10)
    {
        return [];

        $cache_key = 'RSS_URL_' . $source_url;

        //Cache::store('memcached')->pull($cache_key);

        $rss_items_arr = Cache::store('memcached')->get($cache_key);

        if ($rss_items_arr) {
            $output_start = rand(0, count($rss_items_arr) - $count);
            return array_slice($rss_items_arr, $output_start, $count);
        }

        $rss_xml = simplexml_load_file($source_url);

        $rss_xml_items = $rss_xml->xpath('/rss/channel/item');

        $rss_items_arr = [];
        foreach ($rss_xml_items as $rss_xml_item) {

            $rss_items_arr[] = (object) [
                'title' => (string) $rss_xml_item->title,
                'link' => (string) $rss_xml_item->link,
                'description' => (string) $rss_xml_item->description,
            ];
        }

        Cache::store('memcached')->put($cache_key, $rss_items_arr, 10);

        $output_start = rand(0, count($rss_items_arr) - $count);
        return array_slice($rss_items_arr, $output_start, $count);
    }

}