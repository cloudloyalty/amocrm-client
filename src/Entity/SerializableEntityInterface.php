<?php

namespace AmoCRM\Entity;

interface SerializableEntityInterface
{
    public function serialize(): array;
}
