import './bootstrap';

import pdfjsLib from 'pdfjs-dist';

function renderPDF(url, container) {
  pdfjsLib.getDocument(url).promise.then(function(pdf) {
    var viewer = document.getElementById(container);

    for (var pageNumber = 1; pageNumber <= pdf.numPages; pageNumber++) {
      pdf.getPage(pageNumber).then(function(page) {
        var canvas = document.createElement('canvas');
        viewer.appendChild(canvas);

        var viewport = page.getViewport({ scale: 1.5 });
        var context = canvas.getContext('2d');
        canvas.height = viewport.height;
        canvas.width = viewport.width;

        var renderContext = {
          canvasContext: context,
          viewport: viewport,
        };

        page.render(renderContext);
      });
    }
  });
}

window.renderPDF = renderPDF;
