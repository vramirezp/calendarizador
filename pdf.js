function genPDF () {
	html2canvas(document.getElementById('calendar')).then((canvas) => {
	var newImg = canvas.toDataURL("image/png");
	var doc = new jsPDF("l", "mm", "Letter");

	var width = doc.internal.pageSize.width-30;
	var divHeight = $('#calendar').height()+300;

	doc.setFontSize(36);
	var nombredoc = document.getElementById("nombredoc").value;

	doc.text(nombredoc, width/2+15, 30, 'center');

	doc.addImage(newImg,'png', 20, 45, width-10, divHeight/6);

	doc.save(nombredoc+".pdf");
	});
}