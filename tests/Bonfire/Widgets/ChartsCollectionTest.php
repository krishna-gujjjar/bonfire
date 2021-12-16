<?php

namespace Tests\Bonfire\Widgets;

use Bonfire\Libraries\Widgets\Charts\ChartsItem;
use Bonfire\Libraries\Widgets\Charts\ChartsCollection;
use Tests\Support\TestCase;

class ChartsCollectionTest extends TestCase
{
	public function testExtendsChartsItem()
	{
		$item = new ChartsCollection([
				'title' => 'Item A',
				'type' => 'line',
				'cssClass' => 'col-3',
			]);

		$this->assertEquals('Item A', $item->title());
		$this->assertEquals('line', $item->type());
		$this->assertEquals('col-3', $item->cssClass());
	}

	public function testTitles()
	{
		$collection = new ChartsCollection();
		$this->assertNull($collection->title());

		$collection = new ChartsCollection(['title' => 'Foo']);
		$this->assertEquals('Foo', $collection->title());

		$collection = new ChartsCollection();
		$collection->setTitle('Foo');
		$this->assertEquals('Foo', $collection->title());
	}

	public function testWithItem()
	{
		$collection = new ChartsCollection(['name' => 'Foo']);
		$item1 = new ChartsItem(['title' => 'Item 1']);
		$item2 = new ChartsItem(['title' => 'Item 2']);

		$collection->addItem($item1);
		$collection->addItem($item2);

		$items = $collection->items();

		$this->assertCount(2, $items);
		$this->assertEquals('Item 1', $items[0]->title());
		$this->assertEquals('Item 2', $items[1]->title());

		$collection->removeItem('Item 1');

		$items = $collection->items();

		$this->assertCount(1, $items);
		$this->assertEquals('Item 2', $items[0]->title());

		$collection->removeAllItems();

		$items = $collection->items();
		$this->assertEquals([], $items);
	}

	public function testAddItems()
	{
		$collection = new ChartsCollection(['name' => 'Foo']);
		$item1 = new ChartsItem(['title' => 'Item 1']);
		$item2 = new ChartsItem(['title' => 'Item 2']);

		$collection->addItems([$item1, $item2]);

		$items = $collection->items();

		$this->assertCount(2, $items);
		$this->assertEquals('Item 1', $items[0]->title());
		$this->assertEquals('Item 2', $items[1]->title());
	}
}