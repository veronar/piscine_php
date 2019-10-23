var tab = [];
var index = 0;
var flag = 0;

function addnew(elem) {
	
	var todo = prompt("What would you like to add?");

	if (!todo) {
		alert("Error :(");
		return false;
	}

	if (todo) {
		
		var list = document.getElementById('ft_list');
		var firstElem = list.firstChild;

		var newitem = document.createElement("div");
		newitem.setAttribute("class", "elems");
		newitem.setAttribute("onclick", "del(this)");
		newitem.setAttribute("index", index);

		var textnode = document.createTextNode(todo);
		tab[index] = todo;
		index++;
		newitem.appendChild(textnode);
		list.insertBefore(newitem, list.childNodes[0]);
	}
}

function del(elem) {
	if (confirm("Are you sure you would like to delete this entry?") == true) {
		var i = elem.getAttribute("index");
		tab.splice(i, 1);
		elem.parentNode.removeChild(elem);
		update_cookies();
	}
}

function update_cookies() {
	var newcookie = JSON.stringify(tab);
	document.cookie = "todos="+newcookie;
}

window.onload = function() {
	if (document.cookie) {
		flag = 1;
		var iscookie = document.cookie;
		var newtab = iscookie.split("=");
		var test = JSON.parse(newtab[1]);
		for (elem in test)
			add_new(test[elem]);
		flag = 0;
	}
}