import Swal from "sweetalert2";
import { Toast } from "../funciones";

const formulario = document.querySelector('form');
const btnBuscar = document.getElementById('btnBuscar');

const buscar = async () => {
    const cliente = document.getElementById('cliente').value;
    const tipo_habitacion = document.getElementById('tipo_habitacion').value;

    if (!cliente || !tipo_habitacion) {
        // Validación simple para asegurarte de que ambos campos estén seleccionados.
        Toast.fire({
            title: 'Por favor, seleccione cliente y tipo de habitación.',
            icon: 'warning',
            timer: 3000,
            timerProgressBar: true
        });
        return;
    }

    const url = `/tu_ruta_de_api_para_buscar_facturas?cliente=${cliente}&tipo_habitacion=${tipo_habitacion}`;
    const config = {
        method: 'GET'
    };

    try {
        const respuesta = await fetch(url, config);
        const data = await respuesta.json();

        console.log(data);

        if (data.length === 0) {
            Toast.fire({
                title: 'No se encontraron facturas para la búsqueda especificada.',
                icon: 'info'
            });
        } else {
            generarPDF(data);
        }
    } catch (error) {
        console.error(error);
        Toast.fire({
            title: 'Ocurrió un error al buscar facturas.',
            icon: 'error'
        });
    }
};

const generarPDF = async (datos) => {
    const url = `/tu_ruta_de_api_para_generar_pdf`;

    const config = {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(datos),
    };

    try {
        const respuesta = await fetch(url, config);

        if (respuesta.ok) {
            const blob = await respuesta.blob();

            if (blob) {
                const urlBlob = window.URL.createObjectURL(blob);

                // Abre el PDF en una nueva ventana o pestaña
                window.open(urlBlob, '_blank');
            } else {
                console.error('No se pudo obtener el blob del PDF.');
            }
        } else {
            console.error('Error al generar el PDF.');
        }
    } catch (error) {
        console.error(error);
        Toast.fire({
            title: 'Ocurrió un error al generar el PDF.',
            icon: 'error'
        });
    }
};

btnBuscar.addEventListener('click', buscar);
