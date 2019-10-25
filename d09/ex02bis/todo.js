var iscookie = [];
var ft_list;

$(document).ready(function(){
	$('#new').click(addnew);
	$('#ft_list div').click(del);
	ft_list = $('#ft_list');
	var temp = document.cookie;
	if (temp && temp != '') {
		iscookie = JSON.parse(temp);
		iscookie.forEach(function (e) {
			addTodo(e);
		})
	}
});

$(window).on('beforeunload', function(){
	var todo = ft_list.children();
	var newcookie = [];
	for (var i = 0; i < todo.length; i++)
		newcookie.unshift(todo[i].innerHTML);
	document.cookie = JSON.stringify(newcookie);
});

function addnew() {
	var todo = prompt("What would you like to add?");
	if (todo) {
		addTodo(todo);
	}
}

function addTodo(todo){
	ft_list.prepend($('<div class="elems">' + todo + '</div>').click(del));
}

function del() {
	if (confirm("Are you sure you would like to delete this entry?") == true) {
		this.remove();
	}
}
