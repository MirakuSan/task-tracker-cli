<?php

declare(strict_types=1);

namespace App\Tests\Model;

use App\Model\Task;
use App\Model\TaskStatus;
use PHPUnit\Framework\TestCase;

final class TaskTest extends TestCase
{
    public function test_can_create_task_with_required_properties(): void
    {
        $task = new Task(1, 'Buy groceries');

        $this->assertEquals(1, $task->getId());
        $this->assertEquals('Buy groceries', $task->getDescription());
        $this->assertEquals(TaskStatus::Todo, $task->getStatus());
        $this->assertNotNull($task->getCreatedAt());
        $this->assertNotNull($task->getUpdatedAt());
    }

    public function test_can_create_task_with_all_properties(): void
    {
        $createdAt = new \DateTimeImmutable('2024-03-20 10:00:00');
        $updatedAt = new \DateTimeImmutable('2024-03-20 10:30:00');
        
        $task = new Task(
            id: 1,
            description: 'Buy groceries',
            status: TaskStatus::InProgress,
            createdAt: $createdAt,
            updatedAt: $updatedAt
        );

        $this->assertEquals(1, $task->getId());
        $this->assertEquals('Buy groceries', $task->getDescription());
        $this->assertEquals(TaskStatus::InProgress, $task->getStatus());
        $this->assertEquals($createdAt, $task->getCreatedAt());
        $this->assertEquals($updatedAt, $task->getUpdatedAt());
    }

    public function test_cannot_create_task_with_empty_description(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Description cannot be empty');

        new Task(1, '');
    }

    public function test_can_update_description(): void
    {
        $task = new Task(1, 'Buy groceries');
        $oldUpdatedAt = $task->getUpdatedAt();

        $task->updateDescription('Buy more groceries');
        
        $this->assertEquals('Buy more groceries', $task->getDescription());
        $this->assertGreaterThan($oldUpdatedAt, $task->getUpdatedAt());
    }

    public function test_cannot_update_to_empty_description(): void
    {
        $task = new Task(1, 'Buy groceries');
        
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Description cannot be empty');
        
        $task->updateDescription('');
    }

    public function test_can_update_status(): void
    {
        $task = new Task(1, 'Buy groceries');
        $oldUpdatedAt = $task->getUpdatedAt();

        $task->updateStatus(TaskStatus::InProgress);
        
        $this->assertEquals(TaskStatus::InProgress, $task->getStatus());
        $this->assertGreaterThan($oldUpdatedAt, $task->getUpdatedAt());
    }

    public function test_can_be_converted_to_array(): void
    {
        $createdAt = new \DateTimeImmutable('2024-03-20 10:00:00');
        $updatedAt = new \DateTimeImmutable('2024-03-20 10:30:00');
        
        $task = new Task(
            id: 1,
            description: 'Buy groceries',
            status: TaskStatus::InProgress,
            createdAt: $createdAt,
            updatedAt: $updatedAt
        );

        $expected = [
            'id' => 1,
            'description' => 'Buy groceries',
            'status' => 'in-progress',
            'created_at' => '2024-03-20 10:00:00',
            'updated_at' => '2024-03-20 10:30:00'
        ];

        $this->assertEquals($expected, $task->toArray());
    }
} 
