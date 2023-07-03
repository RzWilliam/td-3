<?php

use Rzwilliam\Td3\Api;
use PHPUnit\Framework\TestCase;

class ApiTest extends TestCase
{
    public function testGetAllCardsName()
    {
        $api = new Api();
        $this->assertIsArray($api->GetAllCardsName());
    }
}