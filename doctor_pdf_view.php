<?php
$pdf_url = $_GET["location"];
echo "<input type='hidden' value='{$pdf_url}' id='doc-pdf-url'>";

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Dental Potography</title>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.3.200/pdf.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<style type="text/css">
		body {
			overflow: hidden;
		}

		#preloader {
			position: fixed;
			top: 0;
			left: 0;
			right: 0;
			bottom: 0;
			background-color: #fff;
			z-index: 99;
		}

		#status {
			width: 200px;
			height: 200px;
			position: absolute;
			left: 50%;
			top: 50%;
			background-image: url(loaders/rolling_ball.gif);
			background-repeat: no-repeat;
			background-position: center;
			margin: -100 0 0 -100;
		}

		#pdf-viewer {
			border: black 4px solid;
			border-radius: 15px;
			padding: 0 0 10% 12%;
		}

		#title {
			font-size: 2.2em;
			color: #0FA4BA;
			text-align: center;
			padding-right: 15%;
			font-family: Arial;
		}
	</style>


	<script>
		window.onload = function() {
			document.addEventListener("contextmenu", function(e) {
				e.preventDefault();
				if (event.keyCode == 123) {
					disableEvent(e);
				}
			}, false);

			function disableEvent(e) {
				if (e.stopPropagation) {
					e.stopPropagation();
				} else if (window.event) {
					window.event.cancelBubble = true;
				}
			}
		}
		$(document).contextmenu(function() {
			return false;
		});
		url = $("#doc-pdf-url").val();
		var thePdf = null;
		var scale = 1.58;
		pdfjsLib.getDocument(url).promise.then(function(pdf) {
			thePdf = pdf;
			viewer = document.getElementById('pdf-viewer');
			for (page = 1; page <= pdf.numPages; page++) {
				canvas = document.createElement("canvas");
				canvas.className = 'pdf-page-canvas';
				viewer.appendChild(canvas);
				renderPage(page, canvas);
			}
		});

		function renderPage(pageNumber, canvas) {
			thePdf.getPage(pageNumber).then(function(page) {
				viewport = page.getViewport(scale);
				canvas.height = viewport.height;
				canvas.width = viewport.width;
				page.render({
					canvasContext: canvas.getContext('2d'),
					viewport: viewport
				});
			});
		}
		$(window).on('load', function() {
			$('#status').fadeOut();
			$('#preloader').delay(400).fadeOut('slow');
			$('body').delay(400).css({
				'overflow': 'visible'
			});
		});
	</script>
</head>

<body>
	<div id="preloader">
		<div id="status"></div>
	</div>
	<div id="pdf-viewer">
		<h3 id="title">Dental Potography</h3>
	</div>
</body>

</html>