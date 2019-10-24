
var iscookie = [];
var ft_list;

window.onload = function () {
	document.querySelector("#new").addEventListener("click", addnew);
	ft_list = document.getElementById("ft_list");
	var temp = document.cookie;
	if (temp && temp != '') {
		iscookie = JSON.parse(temp);
		iscookie.forEach(function (e) {
			addTodo(e);
		});
	}
};

window.onunload = function () {
	var todo = ft_list.children;
	var newcookie = [];
	for (var i = 0; i < todo.length; i++)
		newcookie.unshift(todo[i].innerHTML);
	document.cookie = JSON.stringify(newcookie);
};

function addnew() {
	
	var todo = prompt("What would you like to add?");

	if (todo) {
		addTodo(todo);
	}
}

function addTodo(todo){
    var newtem = document.createElement("div");
	newtem.innerHTML = todo;
	
	newtem.setAttribute("class", "elems");
	newtem.setAttribute("onclick", "del(this)");

    ft_list.insertBefore(newtem, ft_list.firstChild);
}

function del(elem) {
	if (confirm("Are you sure you would like to delete this entry?") == true) {
		ft_list.removeChild(elem);
	}
}
