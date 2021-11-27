<?php

use Illuminate\Support\Facades\Log;

$this->addRoute("присутствую", function ($user) {
    $name = $user->profile->first_name;
    $this->sendMessage($this->chatId, "Студент #$user->id ($name) отправил отметку о присутствии");
    $this->sendMessage($this->chatId,"Возьми с полки пирожок:)");
});


$this->addRoute("расписание звонков", function () {
    $list = \App\ClassCallList::all();
    $tmp = "";
    foreach ($list as $item) {
        $item = (object)$item;

        $tmp .= "#$item->index [$item->start_at - $item->end_at] $item->title \n";
    }

    $this->sendMessage($this->chatId, $tmp);

});


$this->addRoute("список студентов", function () {
    $list = \App\Student::all();
    foreach ($list as $item) {
        $item = (object)$item;
        $this->sendMessage($this->chatId, "#$item->id $item->first_name $item->last_name");
    }
});

