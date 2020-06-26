
$.ajaxSetup({
  headers: {
    // "Content-Type": "application/json",
    //  "X-Requested-With": "XMLHttpRequest",
    'X-CSRF-TOKEN': $('meta[name="X-CSRF-TOKEN"]').attr('content')
  }
});
$('.select2').select2();


function addCategory(btn) {
  event.preventDefault();
  var form = $(btn).closest('form'),
    url = form.attr("action"),
    data = form.serialize();
  var save = store(url, data);
  save.done((res) => {
    resetForm(form)
    addNewRow(res.data)
    alert(res.msg)

  });
  save.fail((err) => {
    var errors = err.responseJSON.data
    showErrors(errors, form)
  });

}
function store(url, data, method) {
  return $.ajax({
    method: method || "post",
    url: url,
    data: data,
  })
}

function showErrors(errors, el) {
  $.each(errors, function (key, value) {
    var input = el.find('*[name="' + key + '"]'),
      error_el = input.siblings(".invalid-feedback");
    error_el.html(value)
    error_el.addClass("d-block")
  });

}

function getRaw(data) {

  return '<tr id="category-' + data.id + '">' +
    '<td> ' + data.title + '</td>' +
    '<td>' + data.parent_title + '</td>' +
    '<td>' +
    '<div class="row">' +
    '<a href="/categories/' + data.id + '/edit" class="btn btn-info text-white mx-2 px-2" onclick="getCategory(\'categories/' + data.id + 'edit\')" > edit</a>' +
    '<a href="/categories/' + data.id + '" class="btn btn-primary px-2 mx-2" onclick="getCategory(\'/categories/' + data.id + ')" > show</a>' +
    '<a href="/categories/' + data.id + '/delete" class="btn btn-danger  px-2 mx-2" onclick="destroy(\'/categories/' + data.id + '/delete\',' + data.id + ')"> delete </a>' +
    '</div>' +

    '</td>' +
    '</tr>'
}

function addNewRow(data) {
  var table = $("#catgories-body");
  var raw = getRaw(data);
  table.prepend(raw);
}
function resetForm(form) {

  form.find('.form-control').each(function () {
    $(this).val('');
  });
  form.closest('.modal').modal('hide');
  form.find('.invalid-feedback').removeClass('d-block').html("")
}


//////////////////////////edit//////////////////////

function getCategory(url) {
  event.preventDefault();
  $.ajax({
    method: 'get',
    url: url,
    success: function (data) {
      $("#editModal").html(data).modal('show');
    }
  })
}


function updateCategory(btn) {
  event.preventDefault();
  var form = $(btn).closest('form'),
    url = form.attr("action"),
    data = form.serialize();
  var save = store(url, data);
  save.done((res) => {

    resetForm(form)
    updateRow(res.data)
    alert(res.msg)
  });
  save.fail((err) => {
    var errors = err.responseJSON.data
    showErrors(errors, form)
  });

}
function updateRow(data) {

  var raw = getRaw(data);
  $("#category-" + data.id).replaceWith(raw);
}


function alert(msg) {
  return Swal.fire({
    icon: 'success',
    title: msg,
    showConfirmButton: false,
    timer: 1500
  })
}

function destroy(url, id) {
  event.preventDefault();

  Swal.fire({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
    if (result.value) {
      $.ajax({
        method: 'delete',
        url: url,
        success: function (data) {
          $("#category-" + id).remove();
          alert(data.msg);
        }
      })
    }
  })




}