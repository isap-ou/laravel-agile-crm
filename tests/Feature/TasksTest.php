<?php

namespace Isapp\AgileCrm\Tests\Feature;

use Illuminate\Support\Collection;
use Isapp\AgileCrm\Dto\ContactDto;
use Isapp\AgileCrm\Dto\TaskDto;
use Isapp\AgileCrm\Enums\Tasks\TaskPriorityType;
use Isapp\AgileCrm\Enums\Tasks\TaskType;
use Isapp\AgileCrm\Facades\AgileCrm;
use Isapp\AgileCrm\Support\Carbon;
use Isapp\AgileCrm\Tests\AgileCrmTest;
use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\Attributes\Test;

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
