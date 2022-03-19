<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\CalendarRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CalendarRepository::class)]
class Calendar
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\ManyToOne(targetEntity: CalendarAccount::class, inversedBy: 'calendars')]
    #[ORM\JoinColumn(nullable: false)]
    private CalendarAccount $calendarAccount;

    #[ORM\Column(type: 'string', length: 255)]
    private string $sourceId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCalendarAccount(): ?CalendarAccount
    {
        return $this->calendarAccount;
    }

    public function setCalendarAccount(CalendarAccount $calendarAccount): self
    {
        $this->calendarAccount = $calendarAccount;

        return $this;
    }

    public function getSourceId(): string
    {
        return $this->sourceId;
    }

    public function setSourceId(string $sourceId): self
    {
        $this->sourceId = $sourceId;

        return $this;
    }
}
