(function () {
    document.addEventListener("DOMContentLoaded", () => {
        const inputFilter = document.querySelector('#panel-filter');
        const inputClear = document.querySelector('#panel-filter-clear');
        const campaigns = document.querySelectorAll('.campaign');

        if (!inputFilter) return console.warn('DOM: no #panel-filter found');

        if (!campaigns.length) return console.warn('DOM: no .campaign found');


        if (inputClear) inputClear.addEventListener('click', clearFilter); else console.warn('DOM: no #panel-filter-clear found');

        inputFilter.addEventListener('input', handleFilter)

        function handleFilter(e) {
            const inputFilter = e.target;
            if (!inputFilter) return console.warn('onInput: no inputFilter supplied');


            const filter = inputFilter.value.trim().toLowerCase();

            campaigns.forEach(campaign => {
                const titleElement = campaign.querySelector('.campaign__title');
                const title = titleElement ? titleElement.textContent.toLowerCase() : '';

                if (!filter || title.includes(filter)) {
                    campaign.style.display = '';
                } else {
                    campaign.style.display = 'none';
                }
            });
        }

        function clearFilter() {
            inputFilter.value = '';
            handleFilter({ target: inputFilter });
        }
    });
})();
