<?php
require_once RUTA_APP.'/views/inc/header.php';
require_once RUTA_APP.'/models/urologia_model.php'
?>
<table class="table">
    <?php foreach ($data as $info): ?>
    <tr>
        <td><?=$info->id ?></td>
        <td><?=$info->name ?></td>
        <td><?=$info->description?></td>
        <td><?=$info->specialty_id?></td>
    </tr>
    <?php endforeach; ?>
</table>
<?php require_once RUTA_APP.'/views/inc/footer.php'?>