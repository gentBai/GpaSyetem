$(document).ready(function() {

	$('.could-edit').click(function() {
		var id = $(this).attr('id');
		$(this).addClass('hidden');
		$('input[name="' + id + '"]').removeClass('hidden').focus();
	});
	$('input').blur(function() {
		var id = $(this).attr('name');
		var c_id = $('#c_id').val();
		var t_id = $(this).attr('tid');
		var s_id = $(this).attr('sid');
		var old_score = $(this).attr('old');
		var new_score = $(this).val();
		if(new_score < 0 || new_score > 100) {
			alert("输入不合法");
		} else {
			$(this).addClass('hidden');
			$('#'+id).removeClass('hidden').html(new_score);
			$(this).val(new_score).attr('old', new_score);
			$.post('/teacher/updateClass/updateScore',
					{
						"c_id": c_id,
						"t_id": t_id,
						"s_id": s_id,
						"old_score": old_score,
						"new_score": new_score
					},
					function(data) {
						var res = $.parseJSON(data);
						if(res['status'] == 1) {
							$('#' + s_id).html(res['t_score']);
						}
			});
		}
	});

});