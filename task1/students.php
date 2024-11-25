<?php
require_once("students_logic.php");
?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <table class="table mt-3 col">
                <thead>
                <tr>
                    <th scope="col">  </th>
                    <?php foreach($subjects as $subject): ?>
                    <th scope="col"><?=htmlspecialchars($subject)?></th>
                    <?php endforeach; ?>
                </tr>
                </thead>
                <tbody>
                <?php foreach($students as $student):?>
                    <tr>
                        <td><?=htmlspecialchars($student)?></td>
                        <?php foreach($subjects as $subject): ?>
                            <td></td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</div>
