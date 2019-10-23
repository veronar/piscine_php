

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
	}

}