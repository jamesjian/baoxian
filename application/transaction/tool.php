<?php

namespace App\Transaction;

use \App\Model\Article as Model_Article;
use \App\Model\Articlecategory as Model_Articlecategory;

class Tool {

    public static function generate_sitemap() {
        $str = '<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
         xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd"
         xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
		<url>
      <loc>http://' . SERVER_NAME . '/</loc>
      <lastmod>' . date('Y-m-d') . '</lastmod>
      <changefreq>daily</changefreq>
      <priority>1</priority>
   </url>
		<url>
      <loc>http://' . SERVER_NAME . '/about-us.php</loc>
      <lastmod>' . date('Y-m-d') . '</lastmod>
      <changefreq>daily</changefreq>
      <priority>1</priority>
   </url>
		<url>
      <loc>http://' . SERVER_NAME . '/contact-us.php</loc>
      <lastmod>' . date('Y-m-d') . '</lastmod>
      <changefreq>daily</changefreq>
      <priority>1</priority>
   </url>
		';
        $cats = Model_Articlecategory::get_all_active_cats();
        $link_prefix = "http://' . SERVER_NAME . '/front/article/category/";
        foreach ($cats as $cat) {
            $cat_str = '<url>
      <loc>' . $link_prefix . $cat['title'] . '</loc>
      <lastmod>' . date('Y-m-d') . '</lastmod>
      <changefreq>weekly</changefreq>
      <priority>0.8</priority>
   </url>';
            $str .= $cat_str;
        }
        $articles = Model_Article::get_all_active_articles();
        //\Zx\Test\Test::object_log('$articles', $articles, __FILE__, __LINE__, __CLASS__, __METHOD__);
        $link_prefix = 'http://' . SERVER_NAME . '/front/article/content/';
        foreach ($articles as $article) {
        //\Zx\Test\Test::object_log('$articles',$article['id'], __FILE__, __LINE__, __CLASS__, __METHOD__);
            $article_str = '<url>
      <loc>' . $link_prefix . $article['url'] . '</loc>
      <lastmod>' . date('Y-m-d') . '</lastmod>
      <changefreq>weekly</changefreq>
      <priority>0.8</priority>
   </url>';
            $str .= $article_str;
        }
        $str .= '</urlset>';
        file_put_contents(PHP_ROOT . 'sitemap.xml', $str);
        return true;
    }

}