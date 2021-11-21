<?php

use Illuminate\Support\Facades\Log;


$this->addRoute("расписание звонков", function () {
    $list = \App\ClassCallList::all();
    foreach ($list as $item) {
        $item = (object)$item;
        $this->sendMessage($this->chatId,  "#$item->index [$item->start_at - $item->end_at] $item->title ");
    }
});


$this->addRoute("список студентов", function () {
    $list = \App\Student::all();
    foreach ($list as $item) {
        $item = (object)$item;
        $this->sendMessage($this->chatId,  "#$item->id $item->first_name $item->last_name");
    }
});
