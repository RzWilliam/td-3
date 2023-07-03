<?php

use Rzwilliam\Td3\Api;
use PHPUnit\Framework\TestCase;

class ApiTest extends TestCase
{
    public function testGetAllCardsName()
    {
        $api = new Api();
        $this->assertIsArray($api->GetAllCardsName(1, 1));
    }

    public function testGetCardImage()
    {
        $api = new Api();
        $test = $api->GetCardImage('Achacha Chanbara');
        $this->assertArrayHasKey('cardName', $test);
        $this->assertArrayHasKey('imageUrl', $test);
        $this->assertIsString($test['cardName']);
        $this->assertIsString($test['imageUrl']);
    }
}