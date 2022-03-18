<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\CalendarAccountRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CalendarAccountRepository::class)]
class CalendarAccount
{
    public const SOURCE_GOOGLE = 'GOOGLE';
    public const SOURCE_MICROSOFT = 'MICROSOFT';

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'calendarAccounts')]
    #[ORM\JoinColumn(nullable: false)]
    private User $calendarUser;

    #[ORM\Column(type: 'string', length: 10)]
    private string $source;

    #[ORM\Column(type: 'string', length: 2048, nullable: true)]
    private ?string $accessToken;

    #[ORM\Column(type: 'string', length: 512, nullable: true)]
    private ?string $refreshToken;

    public function getId(): int
    {
        return $this->id;
    }

    public function getCalendarUser(): User
    {
        return $this->calendarUser;
    }

    public function setCalendarUser(User $calendarUser): self
    {
        $this->calendarUser = $calendarUser;

        return $this;
    }

    public function getSource(): string
    {
        return $this->source;
    }

    public function setSource(string $source): self
    {
        $this->source = $source;

        return $this;
    }

    public function getAccessToken(): ?string
    {
        return $this->accessToken;
    }

    public function setAccessToken(?string $accessToken): self
    {
        $this->accessToken = $accessToken;

        return $this;
    }

    public function getRefreshToken(): ?string
    {
        return $this->refreshToken;
    }

    public function setRefreshToken(?string $refreshToken): self
    {
        $this->refreshToken = $refreshToken;

        return $this;
    }
}
