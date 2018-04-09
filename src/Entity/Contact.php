<?php

namespace AmoCRM\Entity;


class Contact implements SerializableEntityInterface
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $createdAt;

    /**
     * @var int
     */
    private $updatedAt;

    /**
     * @var CustomField[]
     */
    private $customFields = [];


    public function serialize(): array
    {
        return [
            'name' => $this->name,
            'created_at' => $this->createdAt ?: time(),
            'updated_at' => $this->updatedAt ?: time(),
            'custom_fields' => array_map(
                function (SerializableEntityInterface $entity) {
                    return $entity->serialize();
                },
                $this->customFields
            )
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
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name)
    {
        $this->name = $name;
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

    /**
     * @return CustomField[]
     */
    public function getCustomFields(): array
    {
        return $this->customFields;
    }

    /**
     * @param CustomField[] $customFields
     * @return $this
     */
    public function setCustomFields(array $customFields)
    {
        $this->customFields = $customFields;
        return $this;
    }

    /**
     * @param CustomField $customField
     * @return $this
     */
    public function addCustomField(CustomField $customField)
    {
        $this->customFields[] = $customField;
        return $this;
    }
}