<?php

namespace SymfonyBundles\EventQueueBundle\Command;

class QueueProcess
{
    /**
     * @var string
     */
    protected $path;

    /**
     * @var string
     */
    protected $queueName;

    /**
     * @param string $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * @param string $queueName
     */
    public function setQueueName($queueName)
    {
        $this->queueName = $queueName;
    }

    /**
     * @return string
     */
    protected function getFilename()
    {
        return sprintf($this->path, $this->queueName);
    }

    /**
     * @return bool Returns TRUE on success or FALSE on failture.
     */
    public function save()
    {
        return (bool) file_put_contents($this->getFilename(), date('H:i/d.m'));
    }

    /**
     * @return bool Returns TRUE on success or FALSE on failture.
     */
    public function has()
    {
        return file_exists($this->getFilename());
    }

    /**
     * @return bool Returns TRUE on success or FALSE on failture.
     */
    public function delete()
    {
        if ($this->has()) {
            return unlink($this->getFilename());
        }

        return false;
    }

    /**
     * @return bool Returns TRUE on success or FALSE on failture.
     */
    public function kill()
    {
        return $this->delete();
    }
}
