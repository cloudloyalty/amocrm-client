<?php

namespace AmoCRM\Entity;

class Task implements PersistableEntityInterface
{
    const ELEMENT_TYPE_CONTACT = 1;
    const ELEMENT_TYPE_LEAD = 2;
    const ELEMENT_TYPE_COMPANY = 3;
    const ELEMENT_TYPE_CUSTOMER = 12;

    const TASK_TYPE_CALL = 1;
    const TASK_TYPE_MEETING = 2;
    const TASK_TYPE_LETTER = 3;

    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $elementId;

    /**
     * @var int
     */
    private $elementType;

    /**
     * @var int
     */
    private $taskType;

    /**
     * @var string
     */
    private $text;

    /**
     * @var int
     */
    private $createdAt;

    /**
     * @var int
     */
    private $updatedAt;

    public function serialize(): array
    {
        return [
            'element_id' => $this->elementId,
            'element_type' => $this->elementType,
            'task_type' => $this->taskType,
            'text' => $this->text,
            'created_at' => $this->createdAt ?: time(),
            'updated_at' => $this->updatedAt ?: time(),
        ];
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getElementId(): int
    {
        return $this->elementId;
    }

    public function setElementId(int $elementId): self
    {
        $this->elementId = $elementId;
        return $this;
    }

    /**
     * @return int
     */
    public function getElementType(): int
    {
        return $this->elementType;
    }

    public function setElementType(int $elementType): self
    {
        $this->elementType = $elementType;
        return $this;
    }

    /**
     * @return int
     */
    public function getTaskType(): int
    {
        return $this->taskType;
    }

    public function setTaskType(int $taskType): self
    {
        $this->taskType = $taskType;
        return $this;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;
        return $this;
    }

    /**
     * @return int
     */
    public function getCreatedAt(): int
    {
        return $this->createdAt;
    }

    /**
     * @param int $createdAt
     * @return $this
     */
    public function setCreatedAt(int $createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return int
     */
    public function getUpdatedAt(): int
    {
        return $this->updatedAt;
    }

    /**
     * @param int $updatedAt
     * @return $this
     */
    public function setUpdatedAt(int $updatedAt)
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    public function getResource(): string
    {
        return '/api/v2/tasks';
    }

    public function isNew(): bool
    {
        return true;
    }
}