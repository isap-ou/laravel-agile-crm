<?php

namespace IsapOu\AgileCrm\Dto;

use InvalidArgumentException;
use IsapOu\AgileCrm\Contracts\EpochTimeInterface;
use IsapOu\AgileCrm\Enums\Tasks\TaskPriorityType;
use IsapOu\AgileCrm\Enums\Tasks\TaskStatus;
use IsapOu\AgileCrm\Enums\Tasks\TaskType;
use IsapOu\AgileCrm\Support\Carbon;

use function array_filter;
use function array_walk;

final class TaskDto extends Dto
{
    /** @var string[] */
    public array $contacts = [];

    /** @var string[] */
    public array $notes = [];

    public function __construct(
        public TaskType $type,
        public TaskPriorityType $priority_type,
        public EpochTimeInterface $due,
        public string $subject,
        public ?string $taskDescription = null,
        public ?int $id = null,
        public int $progress = 0,
        array $contacts = [],
        /** @var string[] */ array $notes = [],
        readonly public ?EpochTimeInterface $created_time = null,
        readonly public ?EpochTimeInterface $task_completed_time = null,
        readonly public ?EpochTimeInterface $task_start_time = null,
        public ?TaskStatus $status = null,
        public bool $is_complete = false,
    ) {
        if (! empty($contacts)) {
            array_walk($contacts, function (&$value) {
                if (! is_numeric($value) && ! \is_string($value)) {
                    throw new InvalidArgumentException('Contacts should be a numeric value');
                }
            });
            $this->contacts = array_filter($contacts);
        }
        if (! empty($notes)) {
            array_walk($notes, function (&$notes) {
                if (! is_numeric($notes) && ! \is_string($notes)) {
                    throw new InvalidArgumentException('Notes should be a numeric value');
                }
            });
            $this->notes = array_filter($notes);
        }

        if ($this->progress < 0 || $progress > 100) {
            throw new InvalidArgumentException('Progress should be between 0 and 100');
        }
    }

    public static function toDto(array $data): static
    {
        $contacts = [];
        $notes = [];
        if (! empty($data['contacts'])) {
            $contacts = collect($data['contacts'])->map(function ($contact) {
                if (\is_array($contact)) {
                    return (string) $contact['id'];
                }

                return (string) $contact;
            })->toArray();
        }
        if (! empty($data['notes'])) {
            $notes = collect($data['notes'])->map(function ($item) {
                if (\is_array($item)) {
                    return (string) $item['id'];
                }

                return (string) $contact;
            })->toArray();
        }

        $dto = new self(
            type: TaskType::tryFrom($data['type']),
            priority_type: TaskPriorityType::tryFrom($data['priority_type']),
            due: Carbon::parse($data['due']),
            subject: $data['subject'] ?? '',
            taskDescription: $data['taskDescription'] ?? null,
            id: $data['id'] ?? null,
            progress: $data['progress'] ?? 0,
            contacts: $contacts,
            notes: $notes,
            created_time: Carbon::parse($data['created_time']),
            task_completed_time: Carbon::parse($data['task_completed_time']),
            task_start_time: Carbon::parse($data['task_start_time']),
            status: TaskStatus::tryFrom($data['status']),
            is_complete: $data['is_complete'] ?? false,
        );

        return $dto;
    }
}
