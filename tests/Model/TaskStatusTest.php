<?php

declare(strict_types=1);

namespace App\Tests\Model;

use App\Model\TaskStatus;
use PHPUnit\Framework\TestCase;
use ValueError;

final class TaskStatusTest extends TestCase
{
    public function test_has_three_possible_values(): void
    {
        $cases = TaskStatus::cases();
        $this->assertCount(3, $cases);
        $this->assertEquals(TaskStatus::Todo, $cases[0]);
        $this->assertEquals(TaskStatus::InProgress, $cases[1]);
        $this->assertEquals(TaskStatus::Done, $cases[2]);
    }

    public function test_can_be_created_from_string(): void
    {
        $this->assertEquals(TaskStatus::Todo, TaskStatus::from('todo'));
        $this->assertEquals(TaskStatus::InProgress, TaskStatus::from('in-progress'));
        $this->assertEquals(TaskStatus::Done, TaskStatus::from('done'));
    }

    public function test_throws_exception_for_invalid_value(): void
    {
        $this->expectException(ValueError::class);
        TaskStatus::from('invalid');
    }

    public function test_can_be_converted_to_string(): void
    {
        $this->assertEquals('todo', TaskStatus::Todo->value);
        $this->assertEquals('in-progress', TaskStatus::InProgress->value);
        $this->assertEquals('done', TaskStatus::Done->value);
    }

    public function test_can_be_compared(): void
    {
        $this->assertTrue(TaskStatus::Todo === TaskStatus::from('todo'));
        $this->assertTrue(TaskStatus::InProgress === TaskStatus::from('in-progress'));
        $this->assertTrue(TaskStatus::Done === TaskStatus::from('done'));
    }
} 
