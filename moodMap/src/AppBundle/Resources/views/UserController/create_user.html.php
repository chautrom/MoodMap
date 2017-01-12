<?php echo $view['form']->start($form) ?>
    <?php echo $view['form']->row($form['username']) ?>
    <?php echo $view['form']->row($form['email']) ?>

    <?php echo $view['form']->row($form['password']['first']) ?>
    <?php echo $view['form']->row($form['password']['second']) ?>

    <button type="submit">Register!</button>
<?php echo $view['form']->end($form) ?>