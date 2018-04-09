<?php

namespace AmoCRM\Entity;

interface PersistableEntityInterface extends SerializableEntityInterface
{
    public function getResource(): string;

    public function isNew(): bool;
}