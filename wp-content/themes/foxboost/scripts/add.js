document.addEventListener('DOMContentLoaded', () => {
    const inputFiles = document.querySelectorAll('.input-file__input');

    inputFiles.forEach(inputFile => {
        inputFile.addEventListener('change', () => {
            const file = inputFile.files[0];
            if (!file) return;

            const closest = inputFile.closest('.input-file');
            if (!closest) return;

            const inputText = closest.querySelector('.input-file__text');
            if (!inputText) return;

            inputText.textContent = file.name;
        })
    })

    const formTipsElements = document.querySelectorAll('.formtip');
    formTipsElements.forEach(formTipsElement => formTipsElement.classList.add('hidden'));

    const formTipsButton = document.querySelector('.formtips');
    if (formTipsButton) {
        formTipsButton.addEventListener('click', () => {
            if (formTipsButton.classList.contains('button_outlined')) {
                formTipsButton.classList.remove('button_outlined');
                formTipsButton.textContent = "Показать подсказки"
            } else {
                formTipsButton.classList.add('button_outlined');
                formTipsButton.textContent = "Скрыть подсказки"
            }
            formTipsElements.forEach(formTipElement => {
                if (formTipElement.classList.contains('hidden')) formTipElement.classList.remove('hidden');
                else formTipElement.classList.add('hidden');
            });
        })
    }

    const selectFormButtons = document.querySelectorAll('.examples__image');
    selectFormButtons.forEach(selectFormButton=>
        selectFormButton.addEventListener('click', showForm));

    if (selectFormButtons.length > 0) {
        selectFormButtons[0].classList.add('examples__image_selected');
    }

    function showForm(e) {
        const selectFormButton = e.target;

        if (!selectFormButton) {
            console.error('DOM: showForm, no selectFormButton found');
            return;
        }

        selectFormButtons.forEach(selectFormButton => selectFormButton.classList.remove('examples__image_selected'));
        selectFormButton.classList.add('examples__image_selected');

        const id = selectFormButton.dataset.id;
        if (!id) {
            console.error('DOM: showForm, no ID of selectFormButton found');
            return;
        }

        const addForms = document.querySelectorAll('.formcontent');
        addForms.forEach(addForm => addForm.classList.add('hidden'));
        const formToShow = document.querySelector(`#addform${id}`);
        if (!formToShow) {
            console.error('DOM: showForm, formToShow not found, ID: ', id);
            return;
        }

        formToShow.classList.remove('hidden');
    }
})

function checkInput(formName) {
    if (!formName) {
        console.error('Error: Form: checkInput: no form supplied');
        return false;
    }

    const formElement = document.querySelector(`#${formName}`);
    if (!formElement) {
        console.error('Error: Form: checkInput: no form found: ', formName);
        return false;
    }

    const fields = formElement.querySelectorAll('.fields');
    let valid = true;

    fields.forEach(field => {
        if (field.value === "" || field.classList.contains('fields_error')) {
             field.classList.add('fields_error');
             field.value = field.dataset.error;
             valid = false;
        }
    })

    return valid;
}
function clearError(itemId) {
    if (!itemId) {
        console.error('Error: Form: clearError: no itemId supplied');
        return;
    }

    const originElement = document.querySelector(`#${itemId}`);
    if (!originElement) {
        console.error('Error: Form: clearError: no originElement found, id: ', `#${itemId}`);
        return;
    }
    if (originElement.classList.contains('fields_error')) {
        originElement.classList.remove('fields_error');
        originElement.value = '';
    }
}