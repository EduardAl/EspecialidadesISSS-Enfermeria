<?php require RUTA_APP.'\views\inc\header.php'; ?>

        <h1>List of employees</h1>
        <?php
        Table::create(array(
            "dataStore"=>$this->dataStore("employees")
        ));
        ?>

<?php require RUTA_APP.'\views\inc\footer.php'; ?>
