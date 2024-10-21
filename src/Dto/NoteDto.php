<?php

namespace IsapOu\AgileCrm\Dto;

use IsapOu\AgileCrm\Contracts\EpochTimeInterface;
use IsapOu\AgileCrm\Support\Carbon;

final class NoteDto extends Dto
{
    public function __construct(
        public string $subject,
        public string $description,
        public ?array $contact_ids = [],
        public ?int $id = null,
        readonly public ?EpochTimeInterface $created_time = null
    ) {}

    public static function toDto(array $data): static
    {
        return new self(
            subject: $data['subject'],
            description: $data['description'],
            contact_ids: $data['contact_ids'],
            id: $data['id'],
            created_time: Carbon::parse($data['created_time']),
        );
    }
}
