<?php

namespace AmoCRM\Entity;


class CustomField implements SerializableEntityInterface
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var array
     */
    private $values = [];


    public function serialize(): array
    {
        return [
            'id' => $this->id,
            'values' => $this->values
        ];
    }

    /**
     * @param int $id
     */
    public function __construct(int $id = null)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return $this
     */
    public function setId(int $id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return array
     */
    public function getValues(): array
    {
        return $this->values;
    }

    /**
     * @param array $values
     * @return $this
     */
    public function setValues(array $values)
    {
        $this->values = $values;
        return $this;
    }

    /**
     * @param string $value
     * @param string $enum
     * @return $this
     */
    public function addValue($value, $enum = null)
    {
        $this->values[] = [
            'value' => $value,
            'enum' => $enum
        ];
        return $this;
    }
}