<div class="col-md-6">
  <input type="hidden" name="type_form" value="create">
  <div class="form-group">
    <input class="form-control" type="text" name="description" placeholder="Descrição">
  </div>
  <div class="form-group">
    <input class="form-control" type="text" name="price" placeholder="R$ 0,00">
  </div>
  <div class="form-group">
    <input class="form-control" type="date" name="date" placeholder="Data vencmento">
  </div>
  <div class="form-group">
    <select class="form-control" name="category_id" >
      <?php foreach ($categories as $category) : ?>
        <option value="<?= $category->id ?>">
          <?php if ($category->icon_id) : ?>
            <?php foreach ($icons as $icon) : ?>
              <?= $icon->title ?>
            <?php endforeach; ?>
          <?php endif; ?>
          <?= $category->title ?>
        </option>
      <?php endforeach; ?>
    </select>
  </div>
  <input type="hidden" name="user_id" value="<?= $userData->id ?>">
  <div class="form-group">
    <input class="btn bg-primary text-white" type="submit" value="Enviar">
  </div>
</div>