<?php

namespace App\Entity;

use App\Repository\EmployeesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmployeesRepository::class)]
class Employees
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 60)]
    private ?string $Name = null;

    #[ORM\Column(length: 80)]
    private ?string $Email = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $DateOfBirth = null;

    #[ORM\Column(length: 100)]
    private ?string $Address = null;

    #[ORM\Column(length: 60)]
    private ?string $Mobile = null;

    #[ORM\Column(length: 60)]
    private ?string $Education = null;

    #[ORM\Column(length: 60)]
    private ?string $Department = null;

    #[ORM\Column(length: 60, nullable: true)]
    private ?string $ManagerName = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $Joining_date = null;

    #[ORM\Column(length: 60, nullable: true)]
    private ?string $ProfilePic = null;

    #[ORM\Column(length: 60, nullable: true)]
    private ?string $Resume = null;

    #[ORM\Column(length: 30)]
    private ?string $gender = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $created_at = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $update_at = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): static
    {
        $this->Name = $Name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(string $Email): static
    {
        $this->Email = $Email;

        return $this;
    }

    public function getDateOfBirth(): ?\DateTimeInterface
    {
        return $this->DateOfBirth;
    }

    public function setDateOfBirth(\DateTimeInterface $DateOfBirth): static
    {
        $this->DateOfBirth = $DateOfBirth;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->Address;
    }

    public function setAddress(string $Address): static
    {
        $this->Address = $Address;

        return $this;
    }

    public function getMobile(): ?string
    {
        return $this->Mobile;
    }

    public function setMobile(string $Mobile): static
    {
        $this->Mobile = $Mobile;

        return $this;
    }

    public function getEducation(): ?string
    {
        return $this->Education;
    }

    public function setEducation(string $Education): static
    {
        $this->Education = $Education;

        return $this;
    }

    public function getDepartment(): ?string
    {
        return $this->Department;
    }

    public function setDepartment(string $Department): static
    {
        $this->Department = $Department;

        return $this;
    }

    public function getManagerName(): ?string
    {
        return $this->ManagerName;
    }

    public function setManagerName(?string $ManagerName): static
    {
        $this->ManagerName = $ManagerName;

        return $this;
    }

    public function getJoiningDate(): ?\DateTimeInterface
    {
        return $this->Joining_date;
    }

    public function setJoiningDate(\DateTimeInterface $Joining_date): static
    {
        $this->Joining_date = $Joining_date;

        return $this;
    }

    public function getProfilePic(): ?string
    {
        return $this->ProfilePic;
    }

    public function setProfilePic(?string $ProfilePic): static
    {
        $this->ProfilePic = $ProfilePic;

        return $this;
    }

    public function getResume(): ?string
    {
        return $this->Resume;
    }

    public function setResume(?string $Resume): static
    {
        $this->Resume = $Resume;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(string $gender): static
    {
        $this->gender = $gender;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdateAt(): ?\DateTimeInterface
    {
        return $this->update_at;
    }

    public function setUpdateAt(\DateTimeInterface $update_at): static
    {
        $this->update_at = $update_at;

        return $this;
    }
}
