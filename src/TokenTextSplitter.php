<?php

namespace TextSplitter;

use Yethee\Tiktoken\EncoderProvider;

class TokenTextSplitter
{
    private $encoder;
    private $chunk_size;
    private $chunk_overlap;

    public function __construct(string $model, int $chunk_size, int $chunk_overlap = 0)
    {
        //create encoder    

        $provider = new EncoderProvider();
        $this->encoder = $provider->getForModel($model);

        $this->chunk_size = $chunk_size;
        $this->chunk_overlap = $chunk_overlap;
    }

    public function splitText(string $text)
    {
        $tokens = $this->encoder->encode($text);
        $chunks = [];
        $token_length = count($tokens);
        $token_start = 0;
        $text_start = 0;

        while ($token_start < $token_length) {

            if ($token_start + $this->chunk_overlap >= $token_length) {
                break;  //last chunk 
            }

            $t = $this->extractText($text, $tokens, $token_start, $text_start, $this->chunk_size);

            $chunks[] = $t["text"];
            //            echo "chunk: " . $t["text"] . " count:" . $t["count"] . "\n";


            $t2 =  $this->extractText($text, $tokens, $token_start, $text_start, $this->chunk_size - $this->chunk_overlap);

            $token_start = $token_start + $t2["count"];
            $text_start = $text_start + mb_strlen($t2["text"]);
        }
        return $chunks;
    }

    private function extractText($text, $tokens, $token_start, $text_start, $chunk_size,)
    {
        $slice1 = array_slice($tokens, $token_start, $chunk_size);
        $decoded_slice1 = $this->encoder->decode($slice1);

        $decoded_len = mb_strlen($decoded_slice1);
        if (mb_substr($text, $text_start, $decoded_len) != $decoded_slice1) {
            return $this->extractText($text, $tokens, $token_start, $text_start, $chunk_size - 1);
        }

        return ["text" => $decoded_slice1, "count" => count($slice1)];
    }
}
