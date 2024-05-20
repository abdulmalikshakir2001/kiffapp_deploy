import './bootstrap';

import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';
window.Alpine = Alpine;

// import 'pdfjs-dist/legacy/build/pdf.min';
// import 'pdfjs-dist/legacy/build/pdf.worker.min';
// import  {PDFViewer} from  'pdfjs-dist/legacy/web/pdf_viewer';
// var viewer = new PDFViewer({
//     container: document.getElementById('pdf-viewer'),
//     viewerCssClass: 'custom-pdf-viewer',
//     textLayerMode: 1
//   });

Alpine.plugin(focus);

Alpine.start();
