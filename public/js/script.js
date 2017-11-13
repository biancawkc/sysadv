$(document).ready(function() {
  $(document).on('click', '.edit-modal', function() {
        $('#footer_action_button').text("Update");
        $('#footer_action_button').addClass('glyphicon-check');
        $('#footer_action_button').removeClass('glyphicon-trash');
        $('.actionBtn').addClass('btn-success');
        $('.actionBtn').removeClass('btn-danger');
        $('.actionBtn').addClass('edit');
        $('.modal-title').text('Edit');
        $('.deleteContent').hide();
        $('.form-horizontal').show();
        $('#fid').val($(this).data('id_estado_processo'));
        $('#n').val($(this).data('desc_est_processo'));
        $('#myModal').modal('show');
    });
    $(document).on('click', '.delete-modal', function() {
        $('#footer_action_button').text(" Delete");
        $('#footer_action_button').removeClass('glyphicon-check');
        $('#footer_action_button').addClass('glyphicon-trash');
        $('.actionBtn').removeClass('btn-success');
        $('.actionBtn').addClass('btn-danger');
        $('.actionBtn').addClass('delete');
        $('.modal-title').text('Delete');
        $('.did').text($(this).data('id_estado_processo'));
        $('.deleteContent').show();
        $('.form-horizontal').hide();
        $('.dname').html($(this).data('desc_est_processo'));
        $('#myModal').modal('show');
    });

    $('.modal-footer').on('click', '.edit', function() {

        $.ajax({
            type: 'post',
            url: '/editItem',
            data: {
                '_token': $('input[name=_token]').val(),
                'id_estado_processo': $("#fid").val(),
                'desc_est_processo': $('#n').val()
            },
            success: function(data) {
                $('.item' + data.id_estado_processo).replaceWith("<tr class='item" + data.id_estado_processo + "'><td>" + data.id_estado_processo + "</td><td>" + data.desc_est_processo + "</td><td><button class='edit-modal btn btn-info' data-id='" + data.id_estado_processo + "' data-name='" + data.desc_est_processo + "'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-id='" + data.id_estado_processo + "' data-name='" + data.desc_est_processo + "' ><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");
            }
        });
    });
    $("#add").click(function() {

        $.ajax({
            type: 'post',
            url: '/addItem',
            data: {
                '_token': $('input[name=_token]').val(),
                'name': $('input[name=desc_est_processo]').val()
            },
            success: function(data) {
                if ((data.errors)){
                  $('.error').removeClass('hidden');
                    $('.error').text(data.errors.name);
                }
                else {
                    $('.error').addClass('hidden');
                    $('#table').append("<tr class='item" + data.id_estado_processo + "'><td>" + data.id_estado_processo + "</td><td>" + data.desc_est_processo + "</td><td><button class='edit-modal btn btn-info' data-id='" + data.id_estado_processo + "' data-name='" + data.desc_est_processo + "'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-id='" + data.id_estado_processo + "' data-name='" + data.desc_est_processo + "'><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");
                }
            },

        });
        $('#name').val('');
    });
    $('.modal-footer').on('click', '.delete', function() {
        $.ajax({
            type: 'post',
            url: '/deleteItem',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $('.did').text()
            },
            success: function(data) {
                $('.item' + $('.did').text()).remove();
            }
        });
    });
});
