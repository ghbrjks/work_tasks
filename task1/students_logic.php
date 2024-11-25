<?php
$data = [
    ['Иванов', 'Математика', 5],
    ['Иванов', 'Математика', 4],
    ['Иванов', 'Математика', 5],
    ['Петров', 'Математика', 5],
    ['Сидоров', 'Физика', 4],
    ['Иванов', 'Физика', 4],
    ['Петров', 'ОБЖ', 4],
];
$subjects = array_unique(array_column($data, 1));
$students = array_unique(array_column($data, 0));

for ($i = 0; $i < count($data)-1; $i++) {
    if($data[$i][0] === $data[$i+1][0] && $data[$i][1] === $data[$i+1][1]) {
        $data[$i+1][2] = $data[$i+1][2] + $data[$i][2];
        unset($data[$i]);
    }
}
sort($subjects);
sort($students);
