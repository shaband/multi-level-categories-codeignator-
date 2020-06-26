<?= csrf_field() ?>
<div class="form-group">
 <label for="title"> Title</label>
 <input name="title" class="form-control" value=" <?= isset($category) ? $category->title : null; ?>">
 <div class="invalid-feedback">
 </div>
</div>
<div class="form-group">
 <label for="category_id">Categories</label>
 <select name="category_id" class="form-control">
  <option value="" disabled selected>Select Category </option>
  <?php foreach ($categories as $cate) : ?>
   <option value="<?= $cate->id ?>" <?= (isset($category) && $category->category_id == $cate->id) ? "selected" : null ?>>
    <?= $cate->title ?>
   </option>
  <?php endforeach ?>
 </select>
 <div class="invalid-feedback">
 </div>
</div>