<?php

namespace Fousky\Component\iDoklad\LOV;

/**
 * @author Lukáš Brzák <brzak@fousky.cz>
 */
interface iDokladEnumInterface
{
    /**
     * @param int $value
     */
    public function __construct(int $value);

    /**
     * @return int
     */
    public function getValue(): int;
}
