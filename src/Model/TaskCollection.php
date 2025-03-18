<?php

declare(strict_types=1);

namespace App\Model;

use Countable;
use IteratorAggregate;
use ArrayIterator;
use Traversable;

final class TaskCollection implements Countable, IteratorAggregate
{
    /** @var array<int, Task> */
    private array $tasks = [];

    public function add(Task $task): void
    {
        if ($this->has($task->getId())) {
            throw new \InvalidArgumentException(
                sprintf('Task with ID %d already exists', $task->getId())
            );
        }

        $this->tasks[$task->getId()] = $task;
    }

    public function get(int $id): Task
    {
        if (!$this->has($id)) {
            throw new \InvalidArgumentException(
                sprintf('Task with ID %d not found', $id)
            );
        }

        return $this->tasks[$id];
    }

    public function has(int $id): bool
    {
        return isset($this->tasks[$id]);
    }

    public function remove(int $id): void
    {
        unset($this->tasks[$id]);
    }

    public function filterByStatus(TaskStatus $status): self
    {
        $filtered = new self();
        
        foreach ($this->tasks as $task) {
            if ($task->getStatus() === $status) {
                $filtered->add($task);
            }
        }

        return $filtered;
    }

    /**
     * @return array<int, array>
     */
    public function toArray(): array
    {
        return array_values(array_map(
            fn(Task $task) => $task->toArray(),
            $this->tasks
        ));
    }

    public function count(): int
    {
        return count($this->tasks);
    }

    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->tasks);
    }
} 
