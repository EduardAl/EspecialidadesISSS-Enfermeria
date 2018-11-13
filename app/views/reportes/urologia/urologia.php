<?php require RUTA_APP.'\views\inc\header.php'; ?> 

<div class="container">
<table class="table table-dark">
    <?php foreach($datos['info'] as $var): ?>
    <tr>
        <td><?= $var->id; ?></td>
        <td><?= $var->name; ?></td>
        <td><?= $var->description; ?></td>
        <td><?= $var->specialty_id; ?></td>
    </tr>
<?php endforeach; ?>
</table>
</div>
<?php require RUTA_APP.'\views\inc\footer.php'; ?> 