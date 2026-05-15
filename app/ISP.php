<?php

namespace App;

interface ManageableInterface{
    public function beManaged();
}

interface WorkableInterface
{
    public function work();
 
}
interface SleepableInterface
{
    public function sleep();
 
}

class HumanWorker implements WorkableInterface, SleepableInterface, ManageableInterface
{

    public function work()
    {
        return 'Humano Trabajando';
    }
    public function sleep()
    {
        return 'Humano Durmiendo';
    }

    public function beManaged()
    {
        $this->work();
        $this->sleep();
    }
}

class Android implements WorkableInterface, ManageableInterface
{
    public function work() {
         return 'Android Trabajando';
    }
    
    public function beManaged()
    {
         $this->work();
    }

    
}


class Captain
{
    public function manage(ManageableInterface $worker)
    {
        $worker->beManaged();
    }
}
