<?php
declare(strict_types=1);

namespace Filoucrackeur\StorageFrameworkManager\Domain\Model\Dto;

interface BackendInterface
{
    /**
     * @return string
     */
    public function getIdentifier(): string;

    /**
     * @return string
     */
    public function getType(): string;

    /**
     * @return array
     */
    public function getConfiguration(): array;

    /**
     * @return string
     */
    public function getStatus(): string;

    /**
     * @return mixed
     */
    public function getBackend();
}
