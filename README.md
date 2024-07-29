# Token Text Splitter

This is a token text splitter. It splits the texts based on the token size. It is useful for splitting the text for the token based models like GPT-3, GPT-4, etc. The splitter will split the text into chunks based on the token size and overlap. 

Some written languages (e.g Chinese, Japanese) have characters which encode to 2 or more tokens. The splitter has a mechanism to ensure that the chunk is not split in the middle of the token. Each chunk will have well-formated Unicode characters.


## Installation

```bash
composer require mathsgod/token-text-splitter
``` 


## Usage
    
```php

use TextSplitter\TokenTextSplitter;

$text = "蘋果公司（Apple Inc.）是美國的一家跨國科技公司，總部位於加利福尼亞州的庫比蒂諾。蘋果公司的硬體產品包括iPhone智慧型手機、iPad平板電腦、Mac個人電腦、iPod多媒體播放器、Apple Watch智慧手錶和Apple TV數位媒體機。蘋果公司的軟體產品包括iOS、iPadOS、macOS、watchOS和tvOS作業系統，iTunes多媒體播放軟體，Safari網頁瀏覽器，iLife和iWork生產力套件，Final Cut Pro X和Logic Pro X專業影音剪輯軟體。蘋果公司的線上服務包括App Store、Apple Music、iCloud、iTunes Store和Apple TV+。蘋果公司的零售店面遍佈全球，是全球最大的科技公司之一。";

// token size is 10
// overlap is 5
$splitter = new TextSplitter\TokenTextSplitter("gpt-4o", 10, 5);

$chunks = $splitter->splitText($text);

print_r($chunks);


```

### Output

```
Array
(
    [0] => 蘋果公司（Apple Inc.）是
    [1] => Apple Inc.）是美國的一家跨
    [2] => 美國的一家跨國科技公司，總
    [3] => 國科技公司，總部位於加利
    [4] => 部位於加利福尼亞州的
    [5] => 福尼亞州的庫比蒂諾
    [6] => 庫比蒂諾。蘋果公司的
    [7] => 。蘋果公司的硬體產品包括i
    [8] => 硬體產品包括iPhone智慧型手機、
    [9] => Phone智慧型手機、iPad平板電
    [10] => iPad平板電腦、Mac個
    [11] => 腦、Mac個人電腦、
    [12] => 人電腦、iPod多媒體
    [13] => iPod多媒體播放器、Apple Watch智慧
    [14] => 播放器、Apple Watch智慧手錶和Apple
    [15] => 手錶和Apple TV數位媒體
    [16] =>  TV數位媒體機。蘋果
    [17] => 機。蘋果公司的軟體產品
    [18] => 公司的軟體產品包括iOS、i
    [19] => 包括iOS、iPadOS、macOS
    [20] => PadOS、macOS、watchOS和tv
    [21] => 、watchOS和tvOS作業系統
    [22] => OS作業系統，iTunes多媒
    [23] => ，iTunes多媒體播放軟體
    [24] => 體播放軟體，Safari網頁
    [25] => ，Safari網頁瀏覽器，iLife
    [26] => 瀏覽器，iLife和iWork生
    [27] => Life和iWork生產力套件，
    [28] => 產力套件，Final Cut Pro X和
    [29] => Final Cut Pro X和Logic Pro X專業
    [30] => Logic Pro X專業影音剪輯軟
    [31] => 影音剪輯軟體。蘋果
    [32] => 體。蘋果公司的線上服務包括
    [33] => 公司的線上服務包括App Store、Apple Music
    [34] => App Store、Apple Music、iCloud、i
    [35] => 、iCloud、iTunes Store和Apple TV
    [36] => Tunes Store和Apple TV+。蘋果
    [37] => +。蘋果公司的零售店面
    [38] => 公司的零售店面遍佈全球，是
    [39] => 遍佈全球，是全球最大的科技公司之一
    [40] => 全球最大的科技公司之一。
)
```
