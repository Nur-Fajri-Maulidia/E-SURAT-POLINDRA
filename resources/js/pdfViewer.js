import { getDocument, GlobalWorkerOptions } from 'pdfjs-dist/build/pdf';

const workerSrc = "{{ asset('assets/js/pdfjs-dist/build/pdf.worker.js') }}";

GlobalWorkerOptions.workerSrc = workerSrc;

export function renderPDF(url, container) {
  getDocument(url)
    .promise.then(function(pdf) {
      var viewer = container;

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
    })
    .catch(function(error) {
      console.error('Error loading PDF:', error);
    });
}
