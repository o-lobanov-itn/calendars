<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    private string $email;

    /**
     * @var array<string>
     */
    #[ORM\Column(type: 'json')]
    private array $roles;

    #[ORM\Column(type: 'string')]
    private string $password;

    /**
     * @var Collection<int, CalendarAccount>
     */
    #[ORM\OneToMany(mappedBy: 'calendarUser', targetEntity: CalendarAccount::class, orphanRemoval: true)]
    private Collection $calendarAccounts;

    public function __construct()
    {
        $this->roles = [];
        $this->calendarAccounts = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param array<string> $roles
     *
     * @return $this
     */
    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection<int, CalendarAccount>
     */
    public function getCalendarAccounts(): Collection
    {
        return $this->calendarAccounts;
    }

    public function addCalendarAccount(CalendarAccount $calendarAccount): self
    {
        if (!$this->calendarAccounts->contains($calendarAccount)) {
            $this->calendarAccounts[] = $calendarAccount;
            $calendarAccount->setCalendarUser($this);
        }

        return $this;
    }

    public function removeCalendarAccount(CalendarAccount $calendarAccount): self
    {
        $this->calendarAccounts->removeElement($calendarAccount);

        return $this;
    }
}
