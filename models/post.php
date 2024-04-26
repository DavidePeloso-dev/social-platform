<?php

/**
 * 
 */
class post
{
    public function __construct(public int $id, public string $title, public array $tags, public array $medias)
    {
        $this->id = $id;
        $this->title = $title;
        $this->tags = $tags;
        $this->medias = $medias;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getTags()
    {
        return $this->tags;
    }

    public function getMedias()
    {
        return $this->medias;
    }
}
