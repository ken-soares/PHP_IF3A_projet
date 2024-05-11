$("#link").click(function () {
   event.preventDefault();
});
function display_paragraph() {
	const l = document.getElementById("link");
	const p = document.getElementById("paragraph");
	
	if (p.style.display === "none") {
		p.style.display = "block";
		l.innerHTML = "afficher  moins";
	} else {
		p.style.display = "none";
		l.innerHTML = "description du club";
	}
}