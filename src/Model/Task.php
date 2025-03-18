<?php

declare(strict_types=1);

namespace App\Model;

final class Task
{
    public function __construct(
        private readonly int $id,
        private string $description,
        private TaskStatus $status = TaskStatus::Todo,
        private readonly \DateTimeImmutable $createdAt = new \DateTimeImmutable(),
        private \DateTimeImmutable $updatedAt = new \DateTimeImmutable()
    ) {
        if (empty(trim($description))) {
            throw new \InvalidArgumentException('Description cannot be empty');
        }

        if ($this->updatedAt === new \DateTimeImmutable()) {
            $this->updatedAt = $this->createdAt;
        }
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getStatus(): TaskStatus
    {
        return $this->status;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): \DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function updateDescription(string $description): void
    {
        if (empty(trim($description))) {
            throw new \InvalidArgumentException('Description cannot be empty');
        }

        $this->description = $description;
        $this->updatedAt = new \DateTimeImmutable();
    }

    public function updateStatus(TaskStatus $status): void
    {
        $this->status = $status;
        $this->updatedAt = new \DateTimeImmutable();
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'description' => $this->description,
            'status' => $this->status->value,
            'created_at' => $this->createdAt->format('Y-m-d H:i:s'),
            'updated_at' => $this->updatedAt->format('Y-m-d H:i:s')
        ];
    }
} 
