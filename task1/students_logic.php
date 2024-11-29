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
// выделение студентов и предметов
$students=array_unique((array_column($data, 0)));
$subjects=array_unique((array_column($data, 1)));

sort($students);
sort($subjects);
array_multisort($data);
// расчет количества баллов
for ($i = 0; $i < count($data)-1; $i++) {
    if($data[$i][0] === $data[$i+1][0] && $data[$i][1] === $data[$i+1][1]) {
        $data[$i+1][2] = $data[$i+1][2] + $data[$i][2];
        unset($data[$i]);
    }
}

// формирование двумерного массива для проверки комбинаций студент-предмет
foreach ($data as $entry){
    [$student, $subject, $grade] = $entry;
    $check[$student][$subject] = $grade;
}
// заполнение массива data всеми комбинациями студент-предмет (в качестве оценки проставляется пустая строка)
foreach ($students as $student_iter){
    foreach ($subjects as $subject_iter){
        if (!isset($check[$student_iter][$subject_iter])){
            $blank = [$student_iter, $subject_iter, ''];
            if (!in_array($blank, $data)){
                array_push($data, $blank);
            }
        }
    }
}
