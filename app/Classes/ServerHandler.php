<?php


namespace App\Classes;


use App\Knowledge;
use App\Profile;
use App\User;
use Illuminate\Support\Facades\Log;
use VK\CallbackApi\Server\VKCallbackApiServerHandler;
use VK\Client\VKApiClient;

class ServerHandler extends VKCallbackApiServerHandler
{
    private $SECRET;
    const GROUP_ID = 129882361;

    private $CONFIRMATION_TOKEN;

    protected $chatId;
    protected $text;
    protected $payload;

    protected $routes = [];

    public function __construct()
    {
        $this->SECRET = env("APP_VK_CUSTOM_SECRET");
        $this->CONFIRMATION_TOKEN = env("APP_VK_CONFIRMATION_WORD");

        Log::info("before include");
        include_once base_path('routes/bot.php');
        Log::info("after include");

    }

    public function addRoute($path, $function)
    {
        array_push($this->routes, [
            "path" => $path,
            "function" => $function
        ]);
    }

    function confirmation(int $group_id, ?string $secret)
    {
        Log::info(print_r($group_id, true));
        Log::info("token=>" . $this->CONFIRMATION_TOKEN);
        if ($secret === $this->SECRET && $group_id === static::GROUP_ID) {
            echo $this->CONFIRMATION_TOKEN;
        }
    }

    public function messageNew(int $group_id, ?string $secret, array $object)
    {
        Log::info(print_r($object, true));
        $this->chatId = $object["peer_id"];
        $this->text = $object["text"];

        $this->payload = $object["payload"] ?? null;


        $fromId = $object["from_id"];

        $access_token = env("VK_SECRET_KEY");
        $vk = new VKApiClient("5.131");
        $reponse = $vk->users()->get($access_token, [
            'user_ids' => $fromId,
            'fields' => 'photo_50,verified,sex,domain',
            'name_case' => 'Nom',
        ]);


        $user = User::where("email", $fromId)->first();

        if (is_null($user)) {
            $user = User::create([
                "email" => $fromId,
                'name' => "test",
                'password' => bcrypt("test"),
            ]);

            Profile::create([
                'first_name'=>$fromId,
                'last_name'=>$fromId,
                'faculty'=>1,
                'speciality'=>1,
                'department'=>1,
                'group'=>1,
                'course'=>1,
                'vk_url'=>'test',
                'true_first_name'=>$fromId,
                'true_last_name'=>$fromId,
                'user_id'=>$user->id,
            ]);

        }

        Log::info("new message from bot=>" . $this->chatId . " " . $this->text);

        $tmp = mb_strtolower($this->text);
        // $answers = Knowledge::where("keyword","=","$tmp")->get();
        $answers = Knowledge::where("keyword", "like", "%$tmp%")->get();
        $is_found = false;
        if (count($answers) > 0) {
            $tmp_answer = $answers->random(1);
            $this->sendMessage($this->chatId, $tmp_answer[0]->answer);
            $is_found = true;
        }

        if (!is_null($this->payload))
            foreach ($this->routes as $route) {
                if (mb_strpos(mb_strtolower($this->payload), mb_strtolower($route["path"])) !== false) {
                    $user = User::with(["profile"])->where("email",$fromId)->first();
                    $route["function"]($user);
                    $is_found = true;
                    break;
                }
            }

        if (!$is_found)
            foreach ($this->routes as $route) {
                $this->sendMessage($this->chatId, $this->text . " " . $route["path"]);

                if (mb_strpos(mb_strtolower($this->text), mb_strtolower($route["path"])) !== false) {

                    $route["function"]();
                    $is_found = true;
                    break;
                }
            }

/*
        if (!$is_found)
            $this->sendMessageWithKeyboard($this->chatId, "Я тебя не понимаю!(");

        $this->sendMessageWithKeyboard($this->chatId, "Спасибо! Ваше сообщение: $this->text ");
      */  echo 'ok';
    }

    protected function sendMessage($chatId, $message)
    {
        try {
            $access_token = env("VK_SECRET_KEY");
            $vk = new VKApiClient();
            $vk->messages()->send($access_token, [
                'peer_id' => 2000000001,//$chatId,
                'message' => $message,
                'random_id' => random_int(0, 10000000000),

            ]);
        } catch (\Exception $e) {
            Log::info($e->getMessage() . " " . $e->getLine());
        }
    }

    protected function sendMessageWithKeyboard($chatId, $message)
    {
        try {
            $access_token = env("VK_SECRET_KEY");
            $vk = new VKApiClient();
            $vk->messages()->send($access_token, [
                'peer_id' => $chatId,
                'message' => $message,
                'random_id' => random_int(0, 10000000000),
                'keyboard' => json_encode([
                    "one_time" => false,
                    "buttons" => [
                        [
                            [
                                "action" => [
                                    "type" => "text",
                                    "payload" => "{\"button\":\"присутствую\"}",
                                    "label" => "Я пришёль!"
                                ],
                                "color" => "primary"
                            ],
                        ],
                        [
                            [
                                "action" => [
                                    "type" => "text",
                                    "payload" => "{\"button\":\"привет\"}",
                                    "label" => "Привет!"
                                ],
                                "color" => "positive"
                            ],

                            [
                                "action" => [
                                    "type" => "text",
                                    "payload" => "{\"button\":\"прощай\"}",
                                    "label" => "Прощай!"
                                ],
                                "color" => "negative"
                            ],

                            [
                                "action" => [
                                    "type" => "text",
                                    "payload" => "{\"button\":\"Как дела у твоей мамки?\"}",
                                    "label" => "Как дела у твоей мамки?!"
                                ],
                                "color" => "negative"
                            ]
                        ], [
                            [
                                "action" => [
                                    "type" => "text",
                                    "payload" => "{\"button\":\"как дела\"}",
                                    "label" => "Как дела!"
                                ],
                                "color" => "secondary"
                            ],

                            [
                                "action" => [
                                    "type" => "text",
                                    "payload" => "{\"button\":\"расписание звонков\"}",
                                    "label" => "Список звонков!"
                                ],
                                "color" => "negative"
                            ],

                            [
                                "action" => [
                                    "type" => "text",
                                    "payload" => "{\"button\":\"список студентов\"}",
                                    "label" => "Список студентов!"
                                ],
                                "color" => "negative"
                            ],
                        ]
                    ]
                ])

            ]);

        } catch (\Exception $e) {
            Log::info($e->getMessage() . " " . $e->getLine());
        }
    }
}
