<div class="modal-dialog">
 <div class="modal-content">
  <div class="modal-header">
   <h5 class="modal-title" id="update"><?= $category->title ?></h5>
   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
   </button>
  </div>
  <div class="modal-body">
   <table class="table table-hover table-bordered">
    <tr>
     <td>title</td>
     <td> <?= $category->title ?></td>
    </tr>
    <tr>
     <td>parent category</td>
     <td> <?= $category->parent_title ?></td>
    </tr>
    <td colspan="2" class="text-center alert-dark">sub categories</td>
    <?php foreach ($category->sub as $key => $sub) : ?>
     <tr>
      <td colspan="2" class="text-center">
       <?= $sub->title ?>
      </td>
     </tr>
    <?php endforeach ?>
   </table>
  </div>
  <div class="modal-footer">
   <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
  </div>
 </div>
</div>
</form>