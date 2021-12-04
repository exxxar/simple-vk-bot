<?php

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

/*$this->addRoute("присутствую", function ($user) {
    $name = $user->profile->first_name;
    $this->sendMessage($this->chatId, "Студент #$user->id ($name) отправил отметку о присутствии");
    $this->sendMessage($this->chatId,"Возьми с полки пирожок:)");
});*/

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
    $list = \App\Profile::all();
    $tmp = "";

    foreach ($list as $item) {
        $item = (object)$item;
        $tmp .= "#$item->id $item->first_name $item->last_name \n";

    }

    $this->sendMessage($this->chatId, "$tmp");
});

$this->addRoute("Моё имя ([a-zA-Zа-яА-Я0-9]+)", function ($user, $name) {

    if (is_null($user))
    {
        $this->sendMessage($this->chatId, "Тебя не нашли, бро");
        return;
    }

    $user->profile->first_name = $name;
    $user->profile->save();

    $this->sendMessage($this->chatId, "Ваше имя ".$name);

});


$this->addRoute("Мой возраст ([0-9]+)", function ($user, $age) {

    if (is_null($user))
    {
        $this->sendMessage($this->chatId, "Тебя не нашли, бро");
        return;
    }

    $this->sendMessage($this->chatId, "Ваш возраст ".$age);

});

