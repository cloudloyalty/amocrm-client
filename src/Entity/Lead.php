<?php

namespace AmoCRM\Entity;


class Lead implements PersistableEntityInterface
{
    /**
     * @var int
     * @phpstan-ignore-next-line
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
     * @var int
     */
    private $statusId;

    /**
     * @var CustomField[]
     */
    private $customFields = [];

    /**
     * @var string[]
     */
    private $tags = [];

    /**
     * @var int[]
     */
    private $contactsId = [];


    public function serialize(): array
    {
        return [
            'name' => $this->name,
            'created_at' => $this->createdAt ?: time(),
            'updated_at' => $this->updatedAt ?: time(),
            'status_id' => $this->statusId,
            'custom_fields' => array_map(
                function (SerializableEntityInterface $entity) {
                    return $entity->serialize();
                },
                $this->customFields
            ),
            'tags' => join(',', $this->tags),
            'contacts_id' => join(',', $this->contactsId),
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
     * @return int
     */
    public function getStatusId(): int
    {
        return $this->statusId;
    }

    public function setStatusId(int $statusId): self
    {
        $this->statusId = $statusId;
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

    /**
     * @return string[]
     */
    public function getTags(): array
    {
        return $this->tags;
    }

    /**
     * @param string[] $tags
     * @return $this
     */
    public function setTags(array $tags)
    {
        $this->tags = $tags;
        return $this;
    }

    /**
     * @param string $tag
     * @return $this
     */
    public function addTag(string $tag)
    {
        $this->tags[] = $tag;
        return $this;
    }

    /**
     * @return int[]
     */
    public function getContactsId(): array
    {
        return $this->contactsId;
    }

    /**
     * @param int[] $contactsId
     * @return Lead
     */
    public function setContactsId(array $contactsId): self
    {
        $this->contactsId = $contactsId;
        return $this;
    }

    public function addContactId(int $contactId): self
    {
        $this->contactsId[] = $contactId;
        return $this;
    }

    public function getResource(): string
    {
        return '/api/v2/leads';
    }

    public function isNew(): bool
    {
        return true;
    }
}