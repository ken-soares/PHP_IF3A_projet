// Get the button and paragraph elements
var button = document.getElementById('show-hide');
var paragraph = document.getElementById('paragraph');

// Add an event listener to the button
button.addEventListener('click', function() {
	// Toggle the visibility of the paragraph
	paragraph.style.display = (paragraph.style.display === 'block') ? 'none' : 'block';
	
	if(paragraph.style.display == "block") {
		button.innerHTML = "afficher moins";
		paragraph.style.display === 'none';
	} else {
		button.innerHTML = "description du club";
	}
});