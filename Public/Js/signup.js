$('.arrive').click(function() {
	//已到
	var name = $(this).parent().attr('name');
	$('div[name="'+name+'"]').removeClass('signup-selected');
	$(this).parent().addClass('signup-selected');
	$('input[name="' + name + '"]').val('1');
});
$('.absent').click(function() {
	//缺席
	var name = $(this).parent().attr('name');
	$('div[name="'+name+'"]').removeClass('signup-selected');
	$(this).parent().addClass('signup-selected');
	$('input[name="' + name + '"]').val('-1');
});
$('.leave').click(function() {
	//请假
	var name = $(this).parent().attr('name');
	$('div[name="'+name+'"]').removeClass('signup-selected');
	$(this).parent().addClass('signup-selected');
	$('input[name="' + name + '"]').val('0');
});