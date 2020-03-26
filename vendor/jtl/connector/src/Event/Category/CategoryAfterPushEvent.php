<?php
namespace jtl\Connector\Event\Category;

use Symfony\Component\EventDispatcher\Event;
use jtl\Connector\Model\Category;


class CategoryAfterPushEvent extends Event
{
    const EVENT_NAME = 'category.after.push';

	protected $category;

    public function __construct(Category &$category)
    {
		$this->category = $category;
    }

    public function getCategory()
    {
        return $this->category;
	}
	
}