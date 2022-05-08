<?php

use App\Support\Collection;

class CollectionTest extends \PHPUnit\Framework\TestCase
{


    /** @test*/
    public function empty_instantiatedCollection_returns_no_items()
    {
        $collection = new Collection();

        $this->assertEmpty($collection->get());
    }

    /** @test*/

    public function count_is_correct_for_items_passed_in()
    {
        $collection = new Collection([
            'one', 'two', 'three'
        ]);

        $this->assertEquals(3, $collection->count());
    }

    /** @test */
    public function  items_returned_match_items_passed_in()
    {
        $collection = new Collection([
            'one', 'two'
        ]);

        $this->assertCount(2, $collection->get());
        $this->assertEquals($collection->get()[0], 'one');
        $this->assertEquals($collection->get()[1], 'two');
    }

    /** @test */
    public function collection_is_instance_of_iterator_aggregate()
    {
        $collection = new Collection();

        $this->assertInstanceOf(IteratorAggregate::class, $collection);
    }

    /** @test */
    public function collection_can_be_iterated()
    {
        $collection = new Collection([
            'one', 'two', 'three'
        ]);

        $items = [];

        foreach ($collection as $item) {
            $items[] = $item;
        }

        $this->assertCount(3, $items);
        $this->assertInstanceOf(ArrayIterator::class, $collection->getIterator());
    }

    /** @test */

    public function collection_can_be_merged_with_another_collection()
    {
        $collection1 = new Collection([
            'one', 'two'
        ]);

        $collection2 = new Collection([
            'three', 'four'
        ]);

        $collection1->merge($collection2);

        $this->assertCount(4, $collection1->get());
        $this->assertEquals($collection1->get()[0], 'one');
        $this->assertEquals($collection1->get()[1], 'two');
        $this->assertEquals($collection1->get()[2], 'three');
        $this->assertEquals($collection1->get()[3], 'four');
    }

    /** @test */

    public function can_add_to_existing_collection()
    {
        $collection = new Collection([
            'one', 'two'
        ]);
        $collection->add(['three']);



        $this->assertEquals(3, $collection->count());
        $this->assertCount(3, $collection->get());
    }

    /** @test */
    public function return_json_encoded_items()
    {
        $collection = new Collection([
            ['username' => 'alex'],
            ['username' => 'billy']
        ]);

        $this->assertIsString('string', $collection->toJson());
        $this->assertEquals('[{"username":"alex"},{"username":"billy"}]', $collection->toJson());
    }

    /** @test */
    public function json_encoded_collection_object_return_json()
    {
        $collection = new Collection([
            ['username' => 'alex'],
            ['username' => 'billy']
        ]);

        $encoded = json_encode($collection);

        $this->assertIsString('string', $encoded);
        $this->assertEquals('[{"username":"alex"},{"username":"billy"}]', $encoded);
    }
}
