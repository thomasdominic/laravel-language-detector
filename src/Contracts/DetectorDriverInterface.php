<?php

namespace Thomasdominic\LanguageDetector\Contracts;

/**
 * DetectorDriverInterface.
 */
interface DetectorDriverInterface
{
    /**
     * Return detected language.
     *
     * @return string
     */
    public function detect();
}
