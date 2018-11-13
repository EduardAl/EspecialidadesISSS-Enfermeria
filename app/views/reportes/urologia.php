<?php require RUTA_APP.'\views\inc\header.php'; ?> 

<table>
    <?php foreach($datos['post'] as $var): ?>
    <tr>
        <td><?= $var->id; ?></td>
        <td><?= $var->name; ?></td>
        <td><?= $var->description; ?></td>
        <td><?= $var->specialty_id; ?></td>
    </tr>
<?php endforeach; ?>
</table>
<?php require RUTA_APP.'\views\inc\footer.php'; ?> 