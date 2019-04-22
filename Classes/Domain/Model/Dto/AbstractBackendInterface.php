<?php
declare(strict_types=1);

namespace Filoucrackeur\StorageFrameworkManager\Domain\Model\Dto;

use Filoucrackeur\StorageFrameworkManager\Type\Backend\Status;

abstract class AbstractBackendInterface implements BackendInterface
{
    /**
     * @var string
     */
    protected $identifier;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $className;

    /**
     * @var array
     */
    protected $configuration;

    /**
     * @var Status
     */
    protected $status;

    /**
     * @var
     */
    private $backend;

    /**
     * @param string $identifier
     * @param string $className
     * @param array $configuration
     */
    public function __construct(string $identifier, string $className, array $configuration)
    {
        $this->identifier = $identifier;
        $this->className = $className;
        $this->configuration = $configuration;
    }

    /**
     * @return string
     */
    public function getIdentifier(): string
    {
        return $this->identifier;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getClassName(): string
    {
        return $this->className;
    }

    /**
     * @return array
     */
    public function getConfiguration(): array
    {
        return $this->configuration;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    public function getBackend()
    {
        return $this->backend;
    }
}
