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
    public function GetAllCardsName(): array
    {
        $totalPages = 143;
        $allCards = [];
        for ($pageNumber = 1; $pageNumber <= $totalPages; $pageNumber++) {
            $response = $this->fetchUrlPage($pageNumber);
            $content = $response->getContent();

            $dom = new \DOMDocument();
            libxml_use_internal_errors(true);
            $dom->loadHTML($content);
            libxml_use_internal_errors(false);

            $mainElement = $dom->getElementById('main');
            if($mainElement != null){
                foreach ($mainElement->getElementsByTagName('strong') as $card) {
                    $allCards[] = $card->textContent;
                }
            }
        }

        return $allCards;
    }

    public function GetCardDetails(string $cardName): \DOMDocument
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

        return $dom;
    }

}
