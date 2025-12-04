/**
 * panel.js — логика панели фоксбустов
 * Содержит:
 *   - Общие функции (AJAX, логирование, обновление)
 *   - Управление статусами фоксбустов
 *   - Удаление подписчиков
 *   - Фильтр кампаний
 *   - Раскрытие кампаний
 */

console.log('panel.js loaded');

const base_url = 'http://localhost/foxboost';

/* ============================================================
   0. Утилиты (модуль Utils)
   ============================================================ */
const Utils = (() => {

    function ajaxJson(url, data, onSuccess, onFail) {
        $.getJSON(url, data)
            .done(result => {
                if (result.success) onSuccess(result);
                else {
                    console.error('Ошибка AJAX-результата:', result);
                    if (onFail) onFail(result);
                }
            })
            .fail((jqXHR, textStatus, errorThrown) => {
                console.error('Ошибка AJAX-запроса:', textStatus, errorThrown);
                if (onFail) onFail({ textStatus, errorThrown });
            });
    }

    function reload() {
        location.reload();
    }

    function log(...args) {
        console.log('panel.js: ', ...args);
    }

    function error(...args) {
        console.error('panel.js: ', ...args);
    }

    function warn(...args) {
        console.warn('panel.js: ', ...args);
    }

    return { ajaxJson, reload, log, error, warn };
})();


/* ============================================================
   1. Модуль управления статусами фоксбустов (MoveModule)
   ============================================================ */
const MoveModule = (() => {

    const apiUrl = `${base_url}/api/foxboost-move.php`;

    function init() {
        $(document).on('click',
            '.button_complete, .button_restart, .button_archive, .button_restore',
            onMoveClick
        );
    }

    function onMoveClick(e) {
        const $btn = $(this);
        const postId = $btn.data('postid');
        const moveTo = $btn.data('moveto');

        Utils.ajaxJson(
            apiUrl,
            { post_id: postId, move_to: moveTo },
            result => {
                Utils.log(`Фоксбуст ${result.post_id} перемещен в статус ${result.move_to}`);
                Utils.reload();
            },
            result => {
                Utils.error(`Ошибка перемещения фоксбуста ${result.post_id} в статус ${result.move_to}`);
            }
        );
    }

    return { init };
})();


/* ============================================================
   2. Модуль удаления подписчиков (SubscriberModule)
   ============================================================ */
const SubscriberModule = (() => {

    const apiUrl = `${base_url}/api/subscriber-delete.php`;

    function init() {
        $(document).on('click', '.button_delete', onDeleteClick);
    }

    function onDeleteClick() {
        const $btn = $(this);
        const foxboostId = $btn.data('postid');
        const subscriberId = $btn.data('subscriberid');

        Utils.ajaxJson(
            apiUrl,
            { subscriber_id: subscriberId, foxboost_id: foxboostId },
            result => {
                Utils.log(`Подписка пользователя ${result.subscriber_id} на фоксбуст ${result.post_id} отменена`);
                Utils.reload(`Ошибка отписки пользователя ${result.subscriber_id} на фоксбуст ${result.post_id}`);
            },
            result => {
                Utils.error()
            }
        );
    }

    return { init };
})();


/* ============================================================
   3. Фильтр кампаний (FilterModule)
   ============================================================ */
const FilterModule = (() => {

    function init() {
        document.addEventListener('DOMContentLoaded', () => {
            const input = document.querySelector('#panel-filter');
            const clear = document.querySelector('#panel-filter-clear');
            const campaigns = document.querySelectorAll('.campaign');

            if (!input) return console.warn('DOM: no #panel-filter found');

            if (!clear) console.warn('DOM: no #panel-filter-clear found');

            input.addEventListener('input', () => filter(input, campaigns));
            if (clear) clear.addEventListener('click', () => clearFilter(input, campaigns));
        });
    }

    function filter(input, campaigns) {
        const value = input.value.trim().toLowerCase();

        campaigns.forEach(campaign => {
            const title = campaign.querySelector('.campaign__title')?.textContent.toLowerCase() ?? '';
            campaign.style.display = (!value || title.includes(value)) ? '' : 'none';
        });
    }

    function clearFilter(input, campaigns) {
        input.value = '';
        filter(input, campaigns);
    }

    return { init };
})();


/* ============================================================
   4. Раскрытие кампаний (AccordionModule)
   ============================================================ */
const AccordionModule = (() => {

    function init() {
        document.addEventListener('DOMContentLoaded', () => {
            const campaigns = document.querySelectorAll('.campaign');

            campaigns.forEach(campaign => {
                const header = campaign.querySelector('.campaign__header');
                if (!header) return Util.error('DOM: no ".campaign__header" element found');

                header.addEventListener('click', e => {
                    if (e.target.closest('.campaign__control')) return;
                    campaign.classList.toggle('campaign_expanded');
                });
            });
        });
    }

    return { init };
})();

/* ============================================================
   5. Таблица с раздвигающимися столбцами
   ============================================================ */
const TableModule = (() => {

    function init() {
        document.addEventListener('DOMContentLoaded', () => {
            const tables = document.querySelectorAll('.campaign__table');

            tables.forEach(table => {
                const cells = table.querySelectorAll('.campaign__table-cell');
                const controlIndex = [...cells].findIndex(c => c.classList.contains('campaign__table-cell_control'));

                table.addEventListener('click', e => {
                    const cell = e.target.closest('.campaign__table-cell');
                    if (!cell || cell.classList.contains('campaign__table-cell_control')) return;

                    const index = [...cells].indexOf(cell);

                    // Формируем новый шаблон grid-template-columns
                    const columns = [];
                    cells.forEach((c, i) => {
                        if (i === index) columns.push('max-content');      // активная колонка
                        else if (i === controlIndex) columns.push('auto'); // control всегда auto
                        else columns.push('1fr');                          // остальные
                    });

                    table.style.gridTemplateColumns = columns.join(' ');
                });
            });
        });
    }

    return { init };
})();


/* ============================================================
   5. Инициализация всех модулей
   ============================================================ */
MoveModule.init();
SubscriberModule.init();
FilterModule.init();
AccordionModule.init();
// TableModule.init();