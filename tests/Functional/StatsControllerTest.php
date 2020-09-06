<?php


namespace App\Tests\Functional;
use App\Tests\TestCase;


class StatsControllerTest extends TestCase
{

    public function test_a_500_is_returned_when_requesting_stats_with_invalid_parameters(){

        //TODO create a factory and replace this array
        $params = [
            'id' => 'abc',
            "dateStart" => "2020-01-01",
            "dateEnd" => "2020-01-15"
        ];


        $response = $this->requestClient->request('GET', "/hotel/6/reviews-stats",
            array(),
            array(),
            array('CONTENT_TYPE' => 'application/json'),
          json_encode($params)
            );
        //Assert json contains instead
        $this->assertEquals('{"Error":"The type of the \"id\" attribute for class \"App\\\Dto\\\ReviewStatsInput\" must be one of \"int\" (\"string\" given)."}',$this->requestClient->getResponse()->getContent());


    }

}