<?php

namespace App;

interface LessonRepositoryInterface{
    public function getAll();
}

class FileLessonRepository implements LessonRepositoryInterface
{
    public function getAll()
    {
        return [];
    }

}

class DbLessonRepository implements LessonRepositoryInterface
{
    public function getAll()
    {
        return Lesson::all()->toArray(); /// viola el principio de sustitución de liskov
    }

}

function foo(LessonRepositoryInterface $repo)
{
    $data = $repo->getAll();
 
}
