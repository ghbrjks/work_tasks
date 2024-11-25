<?php
require_once("students_logic.php");
?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <table class="table mt-3">
                <thead>
                <tr>
                    <th scope="col">  </th>
                    <?php foreach($data as $item): ?>
                    <th scope="col"><?=htmlspecialchars($item[1])?></th>
                    <?php endforeach; ?>
                </tr>
                </thead>
                <tbody>
                <?php foreach($data as $item):?>
                    <tr>
                        <td><?=htmlspecialchars($item['0'])?></td>
                        <td><?=htmlspecialchars($item['2'])?></td>
                        <td><?=htmlspecialchars($item['2'])?></td>
                        <td><?=htmlspecialchars($item['2'])?></td>
                    </tr>
                <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</div>
