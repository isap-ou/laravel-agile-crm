<?php

namespace IsapOu\AgileCrm\Tests\Feature;

use Illuminate\Support\Collection;
use IsapOu\AgileCrm\Dto\ContactDto;
use IsapOu\AgileCrm\Dto\TaskDto;
use IsapOu\AgileCrm\Enums\Tasks\TaskPriorityType;
use IsapOu\AgileCrm\Enums\Tasks\TaskType;
use IsapOu\AgileCrm\Facades\AgileCrm;
use IsapOu\AgileCrm\Support\Carbon;
use IsapOu\AgileCrm\Tests\AgileCrmTest;
use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\Attributes\Test;

use function xdebug_break;

class TasksTest extends AgileCrmTest
{
    #[Test]
    public function index(): void
    {
        $response = AgileCrm::tasks()->index();
        $this->assertInstanceOf(Collection::class, $response);
    }

    #[Test]
    public function createTask(): array
    {
        $contact = $this->createContact();
        $note = $this->createNote($contact);

        $this->assertInstanceOf(ContactDto::class, $contact);

        $taskDto = new TaskDto(
            type: TaskType::EMAIL,
            priority_type: TaskPriorityType::NORMAL,
            due: Carbon::now()->addDay(),
            subject: $this->faker->text(32),
            contacts: [(string) $contact->id],
            notes: [(string) $note->id],
            taskDescription: $this->faker->text(256)
        );

        $task = AgileCrm::tasks()->create($taskDto);

        $this->assertInstanceOf(TaskDto::class, $task);

        return ['contact' => $contact, 'task' => $task, 'note' => $note];
    }

    #[Test]
    #[Depends('create')]
    public function show(array $data): void
    {
        $response = AgileCrm::tasks()->show($data['task']->id);

        $this->assertInstanceOf(TaskDto::class, $response);
    }

    #[Test]
    #[Depends('create')]
    public function deleteAgileCrmTask(array $data): void
    {
        $response = AgileCrm::tasks()->delete($data['task']->id);
        $this->assertTrue($response);

        $response = AgileCrm::contacts()->delete($data['contact']->id);
        $this->assertTrue($response);
    }
}
