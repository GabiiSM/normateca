function updateRecords() {
	// Obtén el valor seleccionado
	var selectedValue = document.getElementById("records").value;

	// Actualiza el valor del campo oculto
	document.getElementById("selectedRecords").value = selectedValue;

	// Envía el formulario automáticamente
	document.getElementById("myForm").submit();
}

function Formulariolimpiar() {
	// Create a hidden form
	var form = document.createElement("form");
	form.setAttribute("method", "post");
	form.setAttribute("action", "../controllers/frontend/frontController.php");

	// Add an input field for a flag to indicate clearing
	var input = document.createElement("input");
	input.setAttribute("type", "hidden");
	input.setAttribute("name", "limpiar");
	input.setAttribute("value", "true");
	form.appendChild(input);

	// Append the form to the document body and submit it
	document.body.appendChild(form);
	form.submit();
}
