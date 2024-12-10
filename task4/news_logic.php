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
function get_clickbait($text) {
    $dom = new DOMDocument();
    @$dom->loadHTML(mb_convert_encoding($text, 'HTML-ENTITIES', 'UTF-8'));
    $words_counter = 0;
    $words_limit = 29;
    $result_dom = new DOMDocument();

    foreach ($dom->getElementsByTagName('p') as $node) {
        if ($words_counter >= $words_limit) {
            break;
        }

        // копирование узла
        $node_clone = $result_dom->importNode($node, true);
        $words_counter = processNode($node_clone, $words_counter, $words_limit);

        $result_dom->appendChild($node_clone);

        if ($words_counter >= $words_limit) {
            break;
        }
    }

    return $result_dom->saveHTML();
}

function processNode($node, $words_counter, $words_limit) {
    if ($node->nodeType === XML_TEXT_NODE) {
        $node_text = $node->nodeValue;
        $words = preg_split('/[\s\-]+/u', $node_text, -1, PREG_SPLIT_NO_EMPTY);
        $remaining_words = $words_limit - $words_counter;

        if (count($words) > $remaining_words) {
            // если слов больше лимита, то лишние слова обрезаются
            $trimmed_words = array_slice($words, 0, $remaining_words);
            $node->nodeValue = implode(' ', $trimmed_words) . '...';
            $words_counter = $words_limit;
        } else {
            // если слов меньше лимита добавляется весь текст
            $words_counter += count($words);
        }
    } elseif ($node->hasChildNodes()) {
        // обработка дочерних узлов
        foreach ($node->childNodes as $child) {
            if ($words_counter >= $words_limit) {
                // удаление узлов, если достигнут лимит
                while ($node->lastChild !== $child) {
                    $node->removeChild($node->lastChild);
                }
                break;
            }
            $words_counter = processNode($child, $words_counter, $words_limit);
        }
    }

    return $words_counter;
}

