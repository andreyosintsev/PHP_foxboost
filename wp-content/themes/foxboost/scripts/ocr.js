function ocr(idImg, idOutput) {
    if (!idImg || !idOutput) {
        console.error(`OCR Error: no source or destination Ids supplied`);
        return;
    }

    const imgEl = document.getElementById(idImg);
    if (!imgEl) {
        console.error(`OCR Error: no img found. Element: ${imgEl}`);
        return;
    }

    const img = imgEl.src;

    if (!img) {
        console.error(`OCR Error: no img src found.`);
        return;
    }

    const outputElement = document.querySelector(`#${idOutput}`);
    outputElement.classList.remove('fields_error');
    outputElement.value = "Выполняется распознавание текста...";

    Tesseract.recognize(img, {"lang": "rus"})
        .then(result => result)
        .then(result => {
            outputElement.value  = result.text || "Не удалось распознать текст.";
        })
        .catch(error => {
            outputElement.value = "Ошибка распознавания текта. Введите текст вручную.";
            console.error(`OCR Error: Tesseract error: ${error}`);
        });
}