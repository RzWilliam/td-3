<?php

//declare(script_types=1);

namespace Rzwilliam\Td3;

use Symfony\Component\HttpClient\HttpClient;


class Api
{
    private function fetchUrlPage(int $page): \Symfony\Contracts\HttpClient\ResponseInterface
    {
        $client = HttpClient::create([
            'verify_peer' => false,
        ]);
        $response = $client->request(
            'GET',
            'https://www.yugioh.com/cards?page='. $page
        );
        return $response;
    }

    /**
     * @return string[]
     */
    public function GetAllCardsName(int $startPage = 1, int $endPage = 143): array
    {
        $allCards = [];
        for ($pageNumber = $startPage; $pageNumber <= $endPage; $pageNumber++) {
            $response = $this->fetchUrlPage($pageNumber);
            $content = $response->getContent();

            $dom = new \DOMDocument();
            libxml_use_internal_errors(true);
            $dom->loadHTML($content);
            libxml_use_internal_errors(false);

            $mainElement = $dom->getElementById('main');
            if ($mainElement !== null) {
                foreach ($mainElement->getElementsByTagName('strong') as $card) {
                    $allCards[] = $card->textContent;
                }
            }
        }

        return $allCards;
    }

    /**
     * @return array<string, string|null>
     */
    public function GetCardImage(string $cardName): array
    {
        $cardName = str_replace(' ', '-', strtolower($cardName));
        $client = HttpClient::create([
            'verify_peer' => false,
        ]);
        $response = $client->request(
            'GET',
            'https://www.yugioh.com/cards/'.$cardName
        );
        $content = $response->getContent();

        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($content);
        libxml_use_internal_errors(false);
        $h1Element = $dom->getElementsByTagName('h1');
        if($h1Element !== null)$name = $h1Element->item(0);
        $imageElement = $dom->getElementsByTagName('img');
        if($imageElement !== null)$url = $imageElement->item(0);


        return [
            'cardName' => $name?->textContent,
            'imageUrl' => $url?->getAttribute('src'),
        ];
    }
}
