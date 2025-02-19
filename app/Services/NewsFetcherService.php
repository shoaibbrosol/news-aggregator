<?php
namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use App\Models\Article;

class NewsFetcherService
{

    public function fetchAndStore()
    {
        $sources = [
            'newsapi' => 'https://newsapi.org/v2/top-headlines?country=us&apiKey='.env('NEWSAPI_KEY'),
            'guardian' => 'https://content.guardianapis.com/search?api-key='.env('GUARDIAN_API_KEY'),
            'nytimes' => 'https://api.nytimes.com/svc/topstories/v2/home.json?api-key='.env('NYTIMES_API_KEY'),
        ];

        foreach ($sources as $source => $url) {
            $response = Http::get($url);

            if ($response->successful()) {
                $articles = $this->parseResponse($source, $response->json());

                foreach ($articles as $article) {
                    Article::updateOrCreate(
                        ['url' => $article['url']],
                        $article
                    );
                }
            }
        }
    }

    private function parseResponse($source, $data)
    {
        $articles = [];

        switch ($source) {
            case 'newsapi':
                foreach ($data['articles'] as $article) {
                    $articles[] = [
                        'title' => $article['title'],
                        'description' => $article['description'],
                        'url' => $article['url'],
                        'image_url' => $article['urlToImage'],
                        'author' => $article['author'] ?? 'Unknown',
                        'source' => 'NewsAPI',
                        'category' => null,
                        'published_at' => isset($article['publishedAt'])
                            ? Carbon::parse($article['publishedAt'])->format('Y-m-d H:i:s')
                            : null,
                    ];
                }
                break;

            case 'guardian':
                foreach ($data['response']['results'] as $article) {
                    $articles[] = [
                        'title' => $article['webTitle'],
                        'description' => null,
                        'url' => $article['webUrl'],
                        'image_url' => null,
                        'author' => 'The Guardian',
                        'source' => 'The Guardian',
                        'category' => $article['sectionName'] ?? null,
                        'published_at' =>isset($article['publishedAt'])
                            ? Carbon::parse($article['webPublicationDate'])->format('Y-m-d H:i:s')
                            : null,
                    ];
                }
                break;

            case 'nytimes':
                foreach ($data['results'] as $article) {
                    $articles[] = [
                        'title' => $article['title'],
                        'description' => $article['abstract'],
                        'url' => $article['url'],
                        'image_url' => $article['multimedia'][0]['url'] ?? null,
                        'author' => $article['byline'] ?? 'Unknown',
                        'source' => 'New York Times',
                        'category' => $article['section'] ?? null,
                        'published_at' =>isset($article['publishedAt'])
                            ? Carbon::parse($article['published_date'])->format('Y-m-d H:i:s')
                            : null,
                    ];
                }
                break;
        }

        return $articles;
    }
}
