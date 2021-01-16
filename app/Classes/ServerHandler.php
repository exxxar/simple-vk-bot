<?php


namespace App\Classes;


use Illuminate\Support\Facades\Log;
use VK\CallbackApi\Server\VKCallbackApiServerHandler;
use VK\Client\VKApiClient;

class ServerHandler extends VKCallbackApiServerHandler
{
    const SECRET = 'fastoran_bot_secret_1';
    const GROUP_ID = 129163510;
    const CONFIRMATION_TOKEN = 'fd1b1f3a';

    protected $chatId;
    protected $text;

    function confirmation(int $group_id, ?string $secret)
    {
        Log::info(print_r($group_id, true));
        if ($secret === static::SECRET && $group_id === static::GROUP_ID) {
            echo static::CONFIRMATION_TOKEN;
        }
    }

    public function messageNew(int $group_id, ?string $secret, array $object)
    {
        Log::info(print_r($object, true));


        $this->chatId = $object["peer_id"];
        $this->text = $object["text"];

        $arr = [
            [
                "key" => "привет",
                "func" => function () {
                    $this->sendMessage($this->chatId, "Привет, Друг!");
                },
            ],
            [
                "key" => "как дела",
                "func" => function () {
                    $this->sendMessage($this->chatId, "Норм, а у тебя?");
                    },
            ],

            [
                "key" => "хай",
                "func" => function () {
                    $this->sendMessage($this->chatId, "Нихао!");
                },
            ]

        ];

        $is_found = false;
        foreach ($arr as $item) {

            $tmp = mb_strtolower($this->text);

            Log::info("$tmp =>");
            if (strpos($tmp, $item["key"]) !==false) {
                $item["func"]();
                $is_found = true;
                //break;
            }
        }

        if (!$is_found)
            $this->sendMessageWithKeyboard($this->chatId, "Я тебя не понимаю!(");

        //$this->sendMessageWithKeyboard($this->chatId,"Спасибо! Ваше сообщение: $this->text ");
        echo 'ok';
    }

    protected function sendMessage($chatId, $message)
    {
        $access_token = env("VK_SECRET_KEY");
        $vk = new VKApiClient();
        $vk->messages()->send($access_token, [
            'peer_id' => $chatId,
            'message' => $message,
            'random_id' => random_int(0, 10000000000),

        ]);
    }

    protected function sendMessageWithKeyboard($chatId, $message)
    {
        $access_token = env("VK_SECRET_KEY");
        $vk = new VKApiClient();
        $vk->messages()->send($access_token, [
            'peer_id' => $chatId,
            'message' => $message,
            'random_id' => random_int(0, 10000000000),
            'keyboard' => json_encode([
                "one_time"=>false,
                "buttons"=>[
                    [
                        [
                            "action"=>[
                                "type"=>"text",
                                "payload"=>"{\"button\":\"привет\"}",
                                "label"=>"Привет!"
                            ],
                            "color"=>"positive"
                        ],

                        [
                            "action"=>[
                                "type"=>"text",
                                "payload"=>"{\"button\":\"прощай\"}",
                                "label"=>"Прощай!"
                            ],
                            "color"=>"negative"
                        ]
                    ],[
                        [
                            "action"=>[
                                "type"=>"text",
                                "payload"=>"{\"button\":\"как дела\"}",
                                "label"=>"Как дела!"
                            ],
                            "color"=>"secondary"
                        ],
                    ]
                ]
            ])

        ]);
    }
}
