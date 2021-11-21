<?php


namespace App\Classes;


use App\Knowledge;
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
            User::create([
                "email" => $fromId,
                'name' => "test",
                'password' => bcrypt("test"),
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

        foreach ($this->routes as $route) {
            Log::info($this->text . " " . $route["path"]);
            if ($this->text === $route["path"]) {
                $route["function"]();
                break;
            }
        }

        if (!$is_found)
            $this->sendMessageWithKeyboard($this->chatId, "Я тебя не понимаю!(");
        $this->sendMessageWithKeyboard($this->chatId, "Спасибо! Ваше сообщение: $this->text ");
        echo 'ok';
    }

    protected function sendMessage($chatId, $message)
    {
        try {
            $access_token = env("VK_SECRET_KEY");
            $vk = new VKApiClient();
            $vk->messages()->send($access_token, [
                'peer_id' => $chatId,
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
                        ]
                    ]
                ])

            ]);

        } catch (\Exception $e) {
            Log::info($e->getMessage() . " " . $e->getLine());
        }
    }
}
