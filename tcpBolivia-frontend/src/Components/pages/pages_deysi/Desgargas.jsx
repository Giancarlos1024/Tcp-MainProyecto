import React from 'react';
import jsPDF from 'jspdf';
import html2canvas from 'html2canvas';
import { Document, Packer, Paragraph, TextRun, ImageRun } from 'docx';
import * as XLSX from 'xlsx';
import '../../../Styles/Styles_deysi/descargas.css';

const Descargas = ({ targetId }) => {
  const handleDownloadPDF = () => {
    const input = document.getElementById(targetId);
    if (input) {
      html2canvas(input)
        .then((canvas) => {
          const imgData = canvas.toDataURL('image/png');
          const pdf = new jsPDF('p', 'mm', 'a4');
          const imgWidth = 210; // A4 width in mm
          const imgHeight = (canvas.height * imgWidth) / canvas.width;
          pdf.addImage(imgData, 'PNG', 0, 0, imgWidth, imgHeight);
          pdf.save('dinamicas.pdf');
        })
        .catch((error) => {
          console.error('Error generating canvas', error);
        });
    } else {
      console.error('Element not found');
    }
  };

  const handleDownloadImage = () => {
    const input = document.getElementById(targetId);
    if (input) {
      html2canvas(input)
        .then((canvas) => {
          const link = document.createElement('a');
          link.href = canvas.toDataURL('image/png');
          link.download = 'dinamicas.png';
          link.click();
        })
        .catch((error) => {
          console.error('Error generating canvas', error);
        });
    } else {
      console.error('Element not found');
    }
  };

  const handleDownloadWord = () => {
    const input = document.getElementById(targetId);
    if (input) {
      html2canvas(input)
        .then((canvas) => {
          const imgData = canvas.toDataURL('image/png');
          const doc = new Document({
            sections: [
              {
                children: [
                  new Paragraph({
                    children: [
                      new TextRun({
                        text: "Reporte de Dinámicas",
                        bold: true,
                        size: 24,
                      }),
                      new TextRun("\n\n"),
                    ],
                  }),
                  new Paragraph({
                    children: [
                      new ImageRun({
                        data: imgData,
                        transformation: {
                          width: canvas.width / 2, // Ajusta el ancho como consideres
                          height: canvas.height / 2, // Ajusta la altura como consideres
                        },
                      }),
                    ],
                  }),
                ],
              },
            ],
          });

          Packer.toBlob(doc).then((blob) => {
            const link = document.createElement('a');
            link.href = URL.createObjectURL(blob);
            link.download = 'dinamicas.docx';
            link.click();
          });
        })
        .catch((error) => {
          console.error('Error generating canvas', error);
        });
    } else {
      console.error('Element not found');
    }
  };

  const handleDownloadExcel = () => {
    const input = document.getElementById(targetId);
    if (input) {
      html2canvas(input)
        .then((canvas) => {
          const imgData = canvas.toDataURL('image/png');
          const wb = XLSX.utils.book_new();
          const ws = XLSX.utils.aoa_to_sheet([
            ["Reporte de Dinámicas"],
            [""],
            ["Contenido del reporte en formato imagen:"],
            ["", { t: 's', v: '', l: { Target: imgData } }]
          ]);

          XLSX.utils.book_append_sheet(wb, ws, 'Dinamicas');
          XLSX.writeFile(wb, 'dinamicas.xlsx');
        })
        .catch((error) => {
          console.error('Error generating canvas', error);
        });
    } else {
      console.error('Element not found');
    }
  };

  return (
    <div className="descargas">
      <i onClick={handleDownloadPDF} className="fas fa-file-pdf" title="Descargar PDF"></i>
      <i onClick={handleDownloadImage} className="fas fa-image" title="Descargar Imagen"></i>
      <i onClick={handleDownloadWord} className="fas fa-file-word" title="Descargar Word"></i>
      <i onClick={handleDownloadExcel} className="fas fa-file-excel" title="Descargar Excel"></i>
    </div>
  );
};

export default Descargas;
