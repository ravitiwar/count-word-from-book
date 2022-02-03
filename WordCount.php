<?php


class WordCount
{
    public function readFile($url)
    {
        $hashMap = [];
        $handle = fopen($url, 'r');
        while ($line = fgets($handle)) {
            $words = [];
            // Excluding the words having count less than 3 characters
            preg_match_all('/\b\w[a-zA-Z]{3,1000}\b/m', $line, $words);
            foreach ($words[0] as $word) {
                $word = strtolower($word);
                if (!empty($word) && !in_array($word, $this->getExcludedWord())) {
                    $hashMap[$word] = isset($hashMap[$word]) ? $hashMap[$word] + 1 : 1;
                }

            }
        }
        arsort($hashMap);
        return array_slice(array_keys($hashMap), 0, -(count($hashMap) - 15));
    }

    public function getExcludedWord()
    {
        return [
            'that',
            'with',
            'this',
            'from',
            'there',
            'have',
            'were',
            'they',
            'which',
            'like',
            'then',
            'their',
            'some',
            'what',
            'when',
            'upon',
            'into',
            'ahab',
            'more',
            'them',
            'other',
            'would',
            'been',
            'over',
            'these',
            'will',
            'though',
            'chapter',
            'than',
            'those',
        ];
    }
}

print_r((new WordCount())->readFile("https://www.gutenberg.org/files/2701/2701-0.txt"));
