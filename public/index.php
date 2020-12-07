<?php
require __DIR__ . '/../vendor/autoload.php';
 
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
 
use \LINE\LINEBot;
use \LINE\LINEBot\HTTPClient\CurlHTTPClient;
use \LINE\LINEBot\MessageBuilder\MultiMessageBuilder;
use \LINE\LINEBot\MessageBuilder\TextMessageBuilder;
use \LINE\LINEBot\MessageBuilder\StickerMessageBuilder;
use \LINE\LINEBot\SignatureValidator as SignatureValidator;
 
$pass_signature = false;
 
// set LINE channel_access_token and channel_secret
$channel_access_token = "72KOAgZokzDGJ89j83xhWtT6xn/Ts+Ok1jfQ/hRcUdbo7ImD3Npmh7xnyJYUDMCZvO3up8nqRpUsbGtRYeLZwAXeXyYzh5dYfyNMbx/T2UC7BZGFAAHxJv47Qbuhfzzue60TTyRFjLqirTAr4N7ytQdB04t89/1O/w1cDnyilFU=";
$channel_secret = "1e71a8cda2d3d78d6963a2d870db687b";
 
// inisiasi objek bot
$httpClient = new CurlHTTPClient($channel_access_token);
$bot = new LINEBot($httpClient, ['channelSecret' => $channel_secret]);
 
$app = AppFactory::create();
$app->setBasePath("/public");
 
$app->get('/', function (Request $request, Response $response, $args) {
    $response->getBody()->write("Hello World!");
    return $response;
});
 
// buat route untuk webhook
$app->post('/webhook', function (Request $request, Response $response) use ($channel_secret, $bot, $httpClient, $pass_signature) {
    // get request body and line signature header
    $body = $request->getBody();
    $signature = $request->getHeaderLine('HTTP_X_LINE_SIGNATURE');
 
    // log body and signature
    file_put_contents('php://stderr', 'Body: ' . $body);
 
    if ($pass_signature === false) {
        // is LINE_SIGNATURE exists in request header?
        if (empty($signature)) {
            return $response->withStatus(400, 'Signature not set');
        }
 
        // is this request comes from LINE?
        if (!SignatureValidator::validateSignature($body, $channel_secret, $signature)) {
            return $response->withStatus(400, 'Invalid signature');
        }
    }
    
    $data = json_decode($body, true);
    if(is_array($data['events'])){
        foreach ($data['events'] as $event){
            // typenya message?
            if ($event['type'] == 'message'){
                // typenya text?
                if($event['message']['type'] == 'text'){

                    // send same message as reply to user
                    $msg1 = new TextMessageBuilder($event['message']['text']);
                    $msg2 = new TextMessageBuilder($event['message']['text']);
                    $msg3 = new TextMessageBuilder($event['message']['text']);
                    $msg4 = new TextMessageBuilder("wkwkwk biar kaya gema gitu 3x");

                    $multi_msg = new MultiMessageBuilder();
                    $multi_msg->add($msg1);
                    $multi_msg->add($msg2);
                    $multi_msg->add($msg3);
                    $multi_msg->add($msg4);

                    $result = $bot->replyMessage($event['replyToken'], $multi_msg);
     
                    $response->getBody()->write(json_encode($result->getJSONDecodedBody()));
                    return $response
                        ->withHeader('Content-Type', 'application/json')
                        ->withStatus($result->getHTTPStatus());
                }
            }
        }
    }
 
});
$app->run();
 
