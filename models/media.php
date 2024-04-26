<?php

/**
 * 
 */
class media
{
    public function __construct(public string $path, public string $media_type)
    {
        $this->path = $path;
        $this->media_type = $media_type;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function getMediaType()
    {
        return $this->media_type;
    }
}
