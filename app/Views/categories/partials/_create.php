

<form action="/categories" method="post">
 
<div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Create Category</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <?php include(APPPATH . "Views{$ds}categories{$ds}partials{$ds}_form.php") ?>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" onclick=" addCategory(this)">Save changes</button>
          </div>
        </div>
      </div>
    </form>