<?php
$text = <<<TXT
        <p class="big">
            Год основания:<b>1589 г.</b> Волгоград отмечает день города в <b>2-е воскресенье сентября</b>. <br>В <b>2023 году</b> эта дата - <b>10 сентября</b>.
        </p>
        <p class="float">
            <img src="https://www.calend.ru/img/content_events/i0/961.jpg" alt="Волгоград" width="300" height="200" itemprop="image">
            <span class="caption gray">Скульптура «Родина-мать зовет!» входит в число семи чудес России (Фото: Art Konovalov, по лицензии shutterstock.com)</span>
        </p>
        <p>
            <i><b>Великая Отечественная война в истории города</b></i></p><p><i>Важнейшей операцией Советской Армии в Великой Отечественной войне стала <a href="https://www.calend.ru/holidays/0/0/1869/">Сталинградская битва</a> (17.07.1942 - 02.02.1943). Целью боевых действий советских войск являлись оборона  Сталинграда и разгром действовавшей на сталинградском направлении группировки противника. Победа советских войск в Сталинградской битве имела решающее значение для победы Советского Союза в Великой Отечественной войне.</i>
        </p>
TXT;
function get_clickbait($text){
    $dom = new DOMDocument();
    @$dom->loadHTML(mb_convert_encoding($text, 'HTML-ENTITIES', 'UTF-8'));
    $words_counter = 0;
    $res = '';
    $words_limit = 29;

    foreach($dom->getElementsByTagName('p') as $node){
        if ($words_counter >= $words_limit){ break; }

        $node_html = $dom->saveHTML($node);
        $node_text = strip_tags($node_html);
        $words = preg_split("/[\s\-]+/u", $node_text, -1, PREG_SPLIT_NO_EMPTY);
        $words_capacity = $words_limit - $words_counter;

        if(count($words) <= $words_capacity){
            $res .= $node_html;
            $words_counter += count($words);
        }
        else{
            $trimmed_words = array_slice($words, 0, $words_capacity);
            $last_word = array_pop($trimmed_words);
            $last_word .= '...';
            $trimmed_words[] = $last_word;
            $trimmed_text = implode(' ', $trimmed_words);

            $new_node = $dom->createElement('p');
            $new_node->setAttribute('class', $node->getAttribute('class'));
            $new_node->nodeValue = $trimmed_text;

            $res .= $dom->saveHTML($new_node);
            $words_counter += $words_capacity;
            break;
        }
    }
    return $res;
}