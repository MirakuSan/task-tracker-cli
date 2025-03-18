<?php

declare(strict_types=1);

namespace App\Tests\Model;

use App\Model\Task;
use App\Model\TaskStatus;
use App\Model\TaskCollection;
use PHPUnit\Framework\TestCase;

final class TaskCollectionTest extends TestCase
{
    private TaskCollection $collection;
    private Task $task1;
    private Task $task2;
    private Task $task3;

    protected function setUp(): void
    {
        $this->collection = new TaskCollection();
        
        $this->task1 = new Task(1, 'Buy groceries');
        $this->task2 = new Task(2, 'Do laundry', TaskStatus::InProgress);
        $this->task3 = new Task(3, 'Call mom', TaskStatus::Done);
    }

    public function test_can_add_task(): void
    {
        $this->collection->add($this->task1);
        
        $this->assertCount(1, $this->collection);
        $this->assertTrue($this->collection->has(1));
    }

    public function test_cannot_add_duplicate_task(): void
    {
        $this->collection->add($this->task1);
        
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Task with ID 1 already exists');
        
        $this->collection->add($this->task1);
    }

    public function test_can_get_task_by_id(): void
    {
        $this->collection->add($this->task1);
        
        $task = $this->collection->get(1);
        
        $this->assertSame($this->task1, $task);
    }

    public function test_throws_exception_when_getting_non_existent_task(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Task with ID 1 not found');
        
        $this->collection->get(1);
    }

    public function test_can_remove_task(): void
    {
        $this->collection->add($this->task1);
        $this->collection->remove(1);
        
        $this->assertCount(0, $this->collection);
        $this->assertFalse($this->collection->has(1));
    }

    public function test_can_filter_by_status(): void
    {
        $this->collection->add($this->task1);
        $this->collection->add($this->task2);
        $this->collection->add($this->task3);

        $todoTasks = $this->collection->filterByStatus(TaskStatus::Todo);
        $inProgressTasks = $this->collection->filterByStatus(TaskStatus::InProgress);
        $doneTasks = $this->collection->filterByStatus(TaskStatus::Done);

        $this->assertCount(1, $todoTasks);
        $this->assertCount(1, $inProgressTasks);
        $this->assertCount(1, $doneTasks);

        $this->assertSame($this->task1, $todoTasks->get(1));
        $this->assertSame($this->task2, $inProgressTasks->get(2));
        $this->assertSame($this->task3, $doneTasks->get(3));
    }

    public function test_can_convert_to_array(): void
    {
        $this->collection->add($this->task1);
        $this->collection->add($this->task2);

        $array = $this->collection->toArray();

        $this->assertCount(2, $array);
        $this->assertEquals($this->task1->toArray(), $array[0]);
        $this->assertEquals($this->task2->toArray(), $array[1]);
    }

    public function test_can_iterate_over_tasks(): void
    {
        $this->collection->add($this->task1);
        $this->collection->add($this->task2);

        $count = 0;
        foreach ($this->collection as $task) {
            $count++;
            $this->assertInstanceOf(Task::class, $task);
        }

        $this->assertEquals(2, $count);
    }
} 
