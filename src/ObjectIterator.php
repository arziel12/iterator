<?php declare(strict_types = 1);

namespace Luky\Iterator;

/**
 * @template Item of object
 *
 * @implements \Iterator<int, Item>
 */
abstract class ObjectIterator implements \Iterator, \Countable
{
	/**
	 * @var array<int|string, Item>
	 */
	protected array $data = [];


	/**
	 * @param array<int|string, Item> $data
	 */
	abstract function __construct(array $data = []);


	/**
	 * @param Item ...$args
	 *
	 * @return static
	 */
	public static function fromArgs(mixed ...$args): static
	{
		return new static($args);
	}


	public function isEmpty(): bool
	{
		return \count($this->data) === 0;
	}


	public function count(): int
	{
		return \count($this->data);
	}


	/**
	 * @return Item|false
	 */
	public function current(): mixed
	{
		return \current($this->data);
	}


	public function next(): void
	{
		\next($this->data);
	}


	public function key(): int|string|null
	{
		return \key($this->data);
	}


	public function valid(): bool
	{
		return \key($this->data) !== null;
	}


	public function rewind(): void
	{
		\reset($this->data);
	}
}
