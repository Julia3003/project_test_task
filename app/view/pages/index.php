<form name="tasks" action="" method="post">
    <p>
        <label>Дата рішення с</label>
        <input name="date_from" type="date" value="<?= $data['dateFrom']; ?>" placeholder="Дата рішення с" class="w3-input w3-border">
        <p>
            <?php if(!empty($errors['dateFrom'])):?>
                <?= $errors['dateFrom']; ?>
            <?php endif; ?>
        </p>
    </p>
    <p>
        <label>Дата рішення по</label>
        <input name="date_to" type="date" value="<?= $data['dateTo']; ?>" placeholder="Дата рішення по" class="w3-input w3-border">
        <p>
            <?php if(!empty($errors['dateTo'])):?>
                <?= $errors['dateTo']; ?>
            <?php endif; ?>
        </p>
    </p>
    <p>
        <input type="submit" value="Фільтр" class="w3-btn w3-green">
    </p>
</form>


<table class="table table-success table-striped">
    <tr>
        <th>ПІБ (хто вирішив заявку)</th>
        <th>Відключення</th>
        <th>Перевірка/здешевлення</th>
        <th>Тех. питання</th>
        <th>Інше</th>
        <th>Усього</th>
    </tr>
    <?php foreach ($tasks as $task): ?>
        <tr>
            <td><?= $task['agent']; ?></td>
            <td><?= $task['outage']; ?></td>
            <td><?= $task['check-discount']; ?></td>
            <td><?= $task['technical-issue']; ?></td>
            <td><?= $task['other']; ?></td>
            <td><?= $task['outage'] + $task['check-discount'] + $task['technical-issue'] + $task['other']; ?></td>
        </tr>
    <?php endforeach; ?>
</table>