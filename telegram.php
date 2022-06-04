<?php
class TelegramBot
{
    private $uri = 'https://api.telegram.org/bot';
    private $name = '';
    private $admin_list = [];

    public function __construct(string $bot_token, string $bot_name)
    {
        $this->uri = $this->uri . $bot_token;
        $this->name = $bot_name;
    }

    public function __call($name, $args)
    {
        return $this->call($name, count($args) === 0 ? [] : $args[0]);
    }

    public function call($method, $params = null)
    {
        $handle = curl_init($this->uri.'/'.$method);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($handle, CURLOPT_TIMEOUT, 60);
        curl_setopt($handle, CURLOPT_POST, true);
        curl_setopt($handle, CURLOPT_POSTFIELDS, json_encode($params));
        curl_setopt($handle, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
        
        $response = curl_exec($handle);

        return ($response) ? json_decode($response, true) : false;
    }

    public function getName()
    {
        return $this->name;
    }

    public function filterText(string $text)
    {
        return str_replace($this->name, "", $text);
    }

    private function request()
    {
        return json_decode(file_get_contents("php://input"), true);
    }

    public function serve()
    {

        $update = $this->request();

        if ($update && isset($update["message"])) {
        
            $message = $update['message'];
            
            $message_id = $message['message_id'];
            $chat_id = $message['chat']['id'];
            $username=$message['from']['username'];
            $first_name=$message['from']['first_name'];
            $last_name=$message['from']['last_name'];
            $text = $this->filterText($message['text']);
            $myid="412056113";
            switch($text)
            {
                case '/start':
                {
                    $this->sendMessage([
                        'chat_id' => $chat_id,
                        'parse_mode' => "MarkDown",
                        'disable_web_page_preview'=>'true',
                        'text' => "أهلاً بكم في بوت  الاستفسار والدعم الخاص بمنصة [SunMedia](https://www.sunvideomediavip.com/welcome?s=Jte0Vg&lang=ar) 
                            sunMedia هو موقع خاص بالربح من الانترنت عن طريق اكمال مهام بسيطة بوقت قصير 
                            -
                            -
                        -للاستفسار تواصلو معي  : [من هنا](https://t.me/jalall_kh)
                        -للتسجيل في الموقع : [انقر هنا](https://www.sunvideomediavip.com/welcome?s=Jte0Vg&lang=ar)
                        ",
                    ]);
                    $this->sendMessage([
                        'chat_id' => $myid,
                        'parse_mode' => "MarkDown",
                        'disable_web_page_preview'=>'true',
                        'text' => "chatID : $chat_id 
                        username :$username 
                        first_name : $first_name
                        last_name : $last_name
                        ",
                    ]);
                    break;
                }
                case '/join':
                {
                    $url = "AgACAgQAAxkBAAKKa2KbXxVxb7EaJHidIPUogC6-3fUWAALBrTEbRS3dUAw6i3i3IfPZAQADAgADeAADJAQ";
                    $this->sendPhoto([
                        'chat_id' => $chat_id,
                        'parse_mode' => "MarkDown",
                        'disable_web_page_preview'=>'true',
                        'photo' => $url,
                        'caption' => " كـيـفـيـة الانضمام : 
                        تسجيل اشتراك في المنصة يتطلب منك وجود ايميل جيمل او هوتميل او ياهو 
                        -الدخول الى الموقع بواسطة الزر الذي في الاسفل
                        -ادخال المعلومات المطلوبة وإبقاء رمز الدعوة الموجود وإلا لن يتم قبول البيانات
                        -اضغط على تسجيل
                        -أدخل رمز التحقق ثم موافق
                        
                        -
                        -
                     -في حال وجود أي مشكلة تواصلو معي : [من هنا](https://t.me/jalall_kh)
                     -للتسجيل في الموقع : [انقر هنا](https://www.sunvideomediavip.com/welcome?s=Jte0Vg&lang=ar)
                     -للانضمام إلى غروب الدعم الخاصة بالفريق : [انقر هنا](https://t.me/+iMgI6bKC4_EyZDBk)
                        ",
                    ]);
                    break;
                }
                case '/how_use':
                {
                    $this->sendMessage([
                        'chat_id' => $chat_id,
                        'parse_mode' => "MarkDown",
                        'disable_web_page_preview'=>'true',
                        'text' => "كـيـفـيـة الاسـتخدام : 
                    -بعد تسجيل الدخول إلى الموقع اضغط على جملة :
                       Receive with one click
                      أو   بنقرة واحدة الاستلام
                    -ثم اتبع الخطوات التالية:
                     * انقر على زر 'ينهي' أو 'finish'
                     *قم بالضغط على زر الرجوع للخروج من التطبيق الذي تم فتحه  
                     * انقر ثانية على ذات الزر 
                     * تفتح نافذة صغيرة تسألك إذا أتمممت المهمة انقرعلى زر 'مكتمل' أو 'completed'
                     -
                    -
                     -في حال وجود أي مشكلة تواصلو معي : [من هنا](https://t.me/jalall_kh)
                     -للتسجيل في الموقع : [انقر هنا](https://www.sunvideomediavip.com/welcome?s=Jte0Vg&lang=ar)
                     -للانضمام إلى غروب الدعم الخاصة بالفريق : [انقر هنا](https://t.me/+iMgI6bKC4_EyZDBk)
                    ",
                    ]);
                    break;                    
                }
                case '/how_earn':
                {
                    $this->sendMessage([
                        'chat_id' => $chat_id,
                        'parse_mode' => "MarkDown",
                        'disable_web_page_preview'=>'true',
                        'text' => "كـيـفـيـة الحصول على الربح :
                    -عليك إنشاء محفظة الكترونية عللى أٍي منصة ولتكن trust wallet وإضافة عملة  {USDT} عليها
                    - كلفة سحب الرصيد هي 2$ لذلك من الأفضل التأكد أن المبلغ مناسب قبل تأكيد التحويل
                    -يتم تحويل الرصيد إلى محفظتك الالكترونية ثم يمكنك سحبه منها وتصريفه عند أي طرف
                    -إذا لم تجد شخص يستطيع تحويل هذه العملة لأجلك تواصل معنا 
                    -
                    -
                    في حال وجود أي مشكلة تواصلو معي : [من هنا](https://t.me/jalall_kh)
                    للتسجيل في الموقع : [انقر هنا](https://www.sunvideomediavip.com/welcome?s=Jte0Vg&lang=ar)
                    للانضمام إلى غروب الدعم الخاصة بالفريق : [انقر هنا](https://t.me/+iMgI6bKC4_EyZDBk)
                    ",
                    ]);
                    break;
                }
                case '/how_get':
                {   
                    $this->sendMessage([
                        'chat_id' => $chat_id,
                        'parse_mode' => "MarkDown",
                        'disable_web_page_preview'=>'true',
                        'text' => "كـيـفـيـة الحصول على هدية التسجيل  :
                          *بعد إتمام التسجيل وإتمام أول أربع مهام قم بالانضمام الى المجموعة الرسمية 
                            ثم أرسل اسم المستخدم+3
                            على سبيل المثال اذا كان اسم المستخدم usern 
                            عندها نكتب usern+3
                            ثم نرسلها 
                          *ستحصل على الرصيد الإضافي عندما يرى الأدمن رسالتك
                          -
                          -
                          العودة للبداية : /start
                         للانضمام إلى المجموعة الرسمية : [انقر هنا](https://t.me/SUNAMY888)
                         للانضمام إلى غروب الدعم الخاصة بالفريق : [انقر هنا](https://t.me/+iMgI6bKC4_EyZDBk)
            
                    ", ]);
            
                    break;
                }
                case '/ping':
                {   
                    $this->sendMessage([
                        'chat_id' => $chat_id,
                        'text' => 'pong'
                    ]);
                    break;
                }
                case '/pong':
                {   
                    $this->sendMessage([
                        'chat_id' => $chat_id,
                        'text' => 'ping'
                    ]);
                    break;
                }
                default:
                {
                    break;
                }
            }
        }

    }
}
