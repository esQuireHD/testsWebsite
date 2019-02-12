//funkcija, kas kontrolē progresa joslu
function progressBar(min, max) {
	var percent = min / max * 100;
	$("#fillBar").css("width", percent + "%");
}