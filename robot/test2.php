<?php
    require '../vendor/autoload.php';

    $guzzleClient = new \GuzzleHttp\Client(['verify' => false]);
    
    $client = OpenAI::client('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');

    $result = $client->completions()->create([
        'model' => 'text-davinci-003',
        'prompt' => 'What is physics?',
    ]);
    
    var_dump($result);
    //echo $result['choices'][0]['text']; // an open-source, widely-used, server-side scripting language.
?>