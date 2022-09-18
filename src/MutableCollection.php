<?php declare(strict_types = 1);

namespace Luky\Iterator;

use Luky\Iterator\Exception\InvalidMemberException;

/**
 * @template T of object
 *
 * @extends ObjectIterator<T>
 *
 * @property T[] $data
 *
 * @method T current()
 */
abstract class MutableCollection extends ObjectIterator
{
	/**
	 * @param array<int, T> $data
	 */
	final public function __construct(array $data = [])
	{
		foreach ($data as $candidate) {
			$this->assertType($candidate);
		}

		$this->data = $data;
	}


	/**
	 * @param T $item
	 */
	public function add(object $item): static
	{
		$this->assertType($item);

		$this->data[] = $item;

		return $this;
	}


	/**
	 * @return T[]
	 */
	public function toArray(): array
	{
		return \iterator_to_array($this);
	}


	/**
	 * @param T $candidate
	 */
	protected function assertType(object $candidate): void
	{
		$type = $this->getType();

		if ($candidate instanceof $type === false) {
			throw new InvalidMemberException(
				\sprintf(
					'Provided item has class "%s", expected "%s"',
					$candidate::class,
					$type,
				),
			);
		}
	}


	/**
	 * @return class-string<T>
	 */
	abstract protected function getType(): string;
}
