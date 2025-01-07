<?php

class NewsController {
    public static function showFitnessNews() {
        
        if (!isset($_SESSION['user'])) {
            header('Location: /DAW2024');
            exit();
        }
        
        // URL-ul feed-ului RSS de la Men's Health
        $rss_url = 'https://www.menshealth.com/rss/all.xml';
        $rss = simplexml_load_file($rss_url);

        if ($rss === false) {
            echo "Eroare la preluarea feed-ului RSS.";
            return;
        }

        // Creăm un array cu știrile extrase din feed
        $news_items = [];
        foreach ($rss->channel->item as $item) {
            $news_items[] = [
                'title' => (string)$item->title,
                'link' => (string)$item->link,
                'description' => (string)$item->description
            ];
        }

        // Include fișierul de view și trimite datele
        require_once 'app/views/news/index.php';
    }
}


?>
