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

$res = [];
$students=array_unique((array_column($data, 0)));
$subjects=array_unique((array_column($data, 1)));

sort($students);
sort($subjects);
array_multisort($data);

for ($i = 0; $i < count($data)-1; $i++) {
    if($data[$i][0] === $data[$i+1][0] && $data[$i][1] === $data[$i+1][1]) {
        $data[$i+1][2] = $data[$i+1][2] + $data[$i][2];
        unset($data[$i]);
    }
}


foreach ($data as $entry){
    [$student, $subject, $grade] = $entry;
    $res[$student][$subject] = $grade;
}
foreach ($students as $student_iter){
    foreach ($subjects as $subject_iter){
        if (!isset($res[$student_iter][$subject_iter])){
            $blank = [$student_iter, $subject_iter, ''];
            if (!in_array($blank, $data)){
                array_push($data, $blank);
            }
        }
    }
}
