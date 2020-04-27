<?php

namespace AmoCRM\Entity;

class Result
{
    /**
     * @var \stdClass
     */
    private $rawResult;

    public function __construct(\stdClass $rawResult)
    {
        $this->rawResult = $rawResult;
    }

    public function getEmbeddedItems(): array
    {
        return isset($this->rawResult->_embedded)
            && isset($this->rawResult->_embedded->items)
            && is_array($this->rawResult->_embedded->items)
                ? $this->rawResult->_embedded->items
                : [];
    }
}
